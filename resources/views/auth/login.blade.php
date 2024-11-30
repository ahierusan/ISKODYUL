<!DOCTYPE html>
<html>
    <head>
        <x-heading-preset />
    </head>
<div class="LOGIN">
    <div class="overlap-wrapper-login">
        <div class="overlap-login">
            <img class="wavy-login" src="assets/images/wavy.png"/>
            <div class="rectangle-login"></div>
            <img class="layat-diwa-login" src="assets/images/layat diwa full.png" />
            <div class="text-login">
                <div class="hello-there">Hello there!</div>
            </div>
            <div class="div-wrapper-login">
                <div class="div-login">Login to your account</div>
            </div>
            <p class="iskodyul-login">
                <span class="isko-login">ISKO</span>
                <span class="dyul-login">DYUL</span>
            </p>

            <!-- Grouped "Choose your role" and role selection -->
            <div class="role-selection-container">
                <div class="choose-text">Choose your role</div>
                <div class="role-selection">
                    <div class="frame">
                        <input type="radio" name="role" id="student" value="Student">
                        <label class="role" for="student">STUDENT</label>
                    </div>
                    <div class="frame">
                        <input type="radio" name="role" id="faculty" value="Faculty">
                        <label class="role" for="faculty">FACULTY</label>                           
                    </div>
                </div>
                @if ($errors->has('role'))
                    <div class="alert alert-danger">
                        {{ $errors->first('role') }}
                    </div>
                @endif
                @if ($errors->has('security_key'))
                    <div class="alert alert-danger">
                        {{ $errors->first('security_key') }}
                    </div>
                @endif
            </div>


            <div id="security-key-container" style="display: none;">
                <input type="text" id="securityKey" placeholder="Enter Security Key">
            </div>
            <!-- Grouped login text and Google icon -->
            <form action="/auth/redirect" method="get" id="google-login-form">
                <input type="hidden" id="role" name="role" value="">
                <input type="hidden" id="hiddenSecurityKey" name="security_key" value="">
                <div class="login-container">
                    <div class="login-title">Use CvSU Email</div>
                    <button type="submit" class="google-sign-in">
                        <img class="google-icon" src="assets/images/google icon.png" alt="Google Icon"/>
                        <span class="text-wrapper">Sign in with Google</span>
                    </button>
                </div>
            </form>


            <a href="/" class="back-arrow-login-link">
                <img 
                class="back-arrow-login"
                alt="arrowbaclogin"
                src="assets/images/back arrow.png";
                />
            </a>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const facultyRadio = document.getElementById("faculty");
        const studentRadio = document.getElementById("student");
        const securityKeyContainer = document.getElementById("security-key-container");
        const googleLoginForm = document.getElementById("google-login-form");
        const roleInput = document.getElementById("role");
        const hiddenSecurityKeyInput = document.getElementById("hiddenSecurityKey");
        const securityKeyInput = document.getElementById("securityKey");

        // Show or hide security key input based on selected role
        facultyRadio.addEventListener("change", function () {
            if (facultyRadio.checked) {
                securityKeyContainer.style.display = "block";
                roleInput.value = "Faculty";
            }
        });

        studentRadio.addEventListener("change", function () {
            if (studentRadio.checked) {
                securityKeyContainer.style.display = "none";
                roleInput.value = "Student";
            }
        });

        // Validate and dynamically set form action on submit
        googleLoginForm.addEventListener("submit", function (event) {
            // Ensure a role is selected
            if (!facultyRadio.checked && !studentRadio.checked) {
                event.preventDefault();
                alert("Please select a role before proceeding to log in.");
                return;
            }

            // Additional validation for faculty role
            if (facultyRadio.checked) {
                const securityKey = securityKeyInput.value.trim();
                if (!securityKey) {
                    event.preventDefault();
                    alert("Please enter the security key for Faculty login.");
                    return;
                }
                hiddenSecurityKeyInput.value = securityKey; // Pass the security key to the hidden input
            }

            // Update the form action dynamically
            const role = roleInput.value;
            googleLoginForm.action = `/auth/redirect?role=${role}`;
        });
    });
</script>

</html>
