<!DOCTYPE html>
<html>
  <head>
    <x-heading-preset />
  </head>
  <body>
    <div class="appointment-facultysearch">
      <script src="script-fs.js"></script>
      <div class="overlap-fs"></div>
      <div class="overlap-fs-2">
        <img class="rectangle-fs" src="assets/images/Rectangle 39912.png" />
        <div class="iskodyul-logo">
          <div class="overlap-group-2-fs">
            <div class="dyul-fs">DYUL</div>
            <div class="isko-fs">ISKO</div>
          </div>
        </div>
        <nav class="menu-group">
          <a href="/{{$user->role}}-dashboard">DASHBOARD</a>
          @if (strtolower($user->role) === 'admin')
            <a href="/appointment">APPOINTMENT</a>
            <!-- Admin Dashboard Button -->
            <div class="sysad-db">
              <div class="db-button">
                <a href="/admin-dashboard" class="db-link">
                  <div class="holder">
                    <div class="title">.........................</div>
                  </div>
                </a>
              </div>
            </div>
          @endif
          @if (strtolower($user->role) === 'student')
            <a href="/appointment">APPOINTMENT</a>
          @endif
          @if (strtolower($user->role) === 'faculty')
            <a href="/faculty-setup" class="appointment">SET SCHEDULE</a>
          @endif
          <a href="/logout" class="logout-fs">LOGOUT</a>
        </nav>
        <div class="slot-content">
          {{ $slot }}
        </div>
      </div>
    </div>
  </body>
</html>