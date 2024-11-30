<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        $role = request('role');
        $securityKey = request('security_key');

        // Get the user's IP address to use as a unique key for cache
        $cacheKey = 'failed_security_key_attempts_' . request()->ip();

        if (Cache::has($cacheKey) && Cache::get($cacheKey)['attempts'] >= 3) {
            // If attempts exceed 3, calculate the lockout time
            $lockoutTime = Cache::get($cacheKey)['expires_at'];
            $remainingTime = now()->diff($lockoutTime); 

            $remainingMinutes = $remainingTime->i;
            $remainingSeconds = $remainingTime->s;

            return redirect('/login')->withErrors(['security_key' => "Too many failed attempts. Please try again in {$remainingMinutes} minute(s) and {$remainingSeconds} second(s)."]);
        }

        if (strtolower($role) === 'faculty') {
            $expectedKey = env('FACULTY_SECURITY_KEY');
            if ($securityKey !== $expectedKey) {
                $attempts = Cache::get($cacheKey)['attempts'] ?? 0;
                $attempts++;

                if ($attempts >= 3) {
                    Cache::put($cacheKey, [
                        'attempts' => $attempts,
                        'expires_at' => now()->addMinutes(10),
                    ], now()->addMinutes(10));
                    return redirect('/login')->withErrors(['security_key' => 'Too many failed attempts. Please try again in 10 minutes.']);
                }

                Cache::put($cacheKey, [
                    'attempts' => $attempts,
                    'expires_at' => now()->addMinutes(10),
                ], now()->addMinutes(10));

                return redirect('/login')->withErrors(['security_key' => 'Invalid security key provided.']);
            }
        }

        session(['role' => $role]); // Store role in session

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email', 'https://www.googleapis.com/auth/calendar'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user(); 
            $role = session('role'); 

            $user = User::where('google_id', $googleUser->id)->first();


            if ($user) {
                if ($user->email === env('ADMIN_EMAIL')) {
                    $user->role = 'admin';
                    $user->save();
                } else {
                // Role mismatch validation
                if (strtolower(trim($role)) !== strtolower(trim($user->role))) {
                    return redirect('/login')->withErrors(['role' => 'Invalid role provided. Please try again.']);
                    }
                }


                $user->update(['google_access_token' => $googleUser->token]);
                $user->update(['google_refresh_token' => $googleUser->refreshToken]);


                Auth::login($user);

                switch (strtolower($user->role)) {
                    case 'admin':
                        return redirect('/admin-dashboard');
                    case 'faculty':
                        $faculty = \App\Models\Faculty::where('user_id', $user->id)->first();
                        if ($faculty) {
                            return redirect('/faculty-dashboard');
                        } else {
                            return redirect('/faculty-setup');
                        }
                    case 'student':
                        return redirect('/student-dashboard');
                    default:
                        return redirect('/login')->withErrors(['role' => 'Invalid role assigned.']);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'google_access_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'role' => $role,
                ]);

                if ($user->email === env('ADMIN_EMAIL')) {
                    $user->role = 'admin'; 
                    $user->save();
                }

                Auth::login($user);


                // Redirect based on role
                switch (strtolower($user->role)) {
                    case 'admin':
                        return redirect('/admin-dashboard');
                    case 'faculty':
                        $faculty = \App\Models\Faculty::where('user_id', $user->id)->first();
                        if ($faculty) {
                            return redirect('/faculty-dashboard');
                        } else {
                            return redirect('/faculty-setup');
                        }
                    case 'student':
                        return redirect('/student-dashboard');
                    default:
                        return redirect('/login')->withErrors(['role' => 'Invalid role assigned.']);
                }
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Unable to authenticate with Google.']);
        }
    }


}
