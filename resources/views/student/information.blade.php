<html>
  <head>
    <x-heading-preset />
  </head>
  <body>
    <div class="appointment-information">
      <div class="overlap-wrapper-in">
        <div class="overlap-in">
        <div class="overlap-in-2">
            <img class="rectangle-in" src="assets/images/Rectangle 39912.png" />
            <div class="iskodyul-logo-in">
              <div class="overlap-group-2-in">
                <div class="dyul-in">DYUL</div>
                <div class="isko-in">ISKO</div>
              </div>
            </div>
            <nav class="menu-group-in">
                    <a href="/student-dashboard">DASHBOARD</a>
                    <a href="/appointment" class="appointment-in">APPOINTMENT</a>
                    <a href="about.html">ABOUT</a>
                    <a href="/logout" class="logout-in">LOGOUT</a>
                </nav>

            <img class="line-in" src="assets/images/line.png" />
            <div class="group-in">
              <div class="overlap-in-3">
                <img class="img-in-3" src="assets/images/triangle info.png" />
                <div class="rectangle-in-2"></div>
                <div class="frame-in"><div class="select-schedule">Select Schedule</div></div>
              </div>
            </div>
            <div class="overlap-group-wrapper-in">
              <div class="overlap-in-3">
                <img class="img-in-2" src="assets/images/triangle select sched.png" />
                <div class="faculty-search-in"></div>
                <div class="frame-in-2"><div class="faculty-search-text">Faculty Search</div></div>
              </div>
            </div>
            <div class="group-2-in">
              <div class="overlap-3">
                <img class="img-in-4" src="assets/images/triangle selected (fs).png" />
                <div class="rectangle-in-3"></div>
                <div class="frame-in-3"><div class="information-in">Information</div></div>
              </div>
            </div>
            <div class="frame-wrapper-in">
              <div class="frame-in-4"><div class="confirmation-in">Confirmation</div></div>
            </div>
          </div>
            <div class="line-above-colleges-in"></div>
            <div class="continue-button-group-in">
                <!-- Changed to button type="button" and added onclick handler -->
                <button class="continue-button-in" type="button" onclick="validateAndSubmit()">
                    <div class="continue-in">Continue</div>
                </button>
            </div>
            <div class="back-button-group-in">
                <button class="back-button-in" onclick="location.href='/select-schedule';">
                    <div class="back-in">Back</div>
                </button>
            </div>
            <div class="information-wrapper">
                <img class="calendar" src="assets/images/faculty list.png"/>
                <div class="information-text"><div class="select-date">Student Information</div></div>
                <div class="information-text"><div class="select-time">Schedule Details</div></div>
            </div>

            <div class="form-container-in">
                <div class="personal-info">
                    <form id="informationForm" action="{{ route('store.information') }}" method="POST">
                        @csrf
                        <input type="text" name="first_name" placeholder="First Name" class="input-field-in" required>
                        <input type="text" name="last_name" placeholder="Last Name" class="input-field-in" required>
                        <input type="text" name="student_number" placeholder="Student Number" class="input-field-in" required>
                        <input type="text" name="program_year_section" placeholder="Program, Year, and Section" class="input-field-in" required>
                        <input type="text" name="college_department" placeholder="College Department" class="input-field-in" required>
                        
                        <div class="status-category">
                        <select name="status" class="dropdown-field status-dropdown" required>
                            <option value="">Status</option>
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
                    
                        <div class="schedule-details">
                            <select name="appointment_category" class="dropdown-field appointment-category-dropdown" required>
                                <option value="">Appointment Category</option>
                                <option value="Advising">Advising</option>
                                <option value="Undergraduate Thesis Consultation">Undergraduate Thesis Consultation</option>
                                <option value="Grade Consultation">Grade Consultation</option>
                            </select>
                        </div>
                            <textarea name="additional_notes" placeholder="Additional Notes" class="textarea-field"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
 <style>
/* 
    .input-error {
        border: 1px solid #ff3333;
    } */
    </style>

    <script>
function validateAndSubmit() {
    const form = document.getElementById('informationForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    let firstInvalidField = null;

    // Remove any existing error styles
    requiredFields.forEach(field => field.classList.remove('input-error'));

    // Check each required field
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            if (!firstInvalidField) {
                firstInvalidField = field;
            }
            
            // // Add error styling to the field
            // field.classList.add('input-error');
        }
    });

    if (isValid) {
        // If all validations pass, submit the form
        form.submit();
    } else {
        if (firstInvalidField) {
            firstInvalidField.focus();
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Clear error styling on input
document.querySelectorAll('[required]').forEach(field => {
    field.addEventListener('input', function() {
        this.classList.remove('input-error');
    });
});

// Session storage code remains the same
document.addEventListener('DOMContentLoaded', function() {
    const fields = [
        'first_name', 'last_name', 'student_number', 
        'program_year_section', 'college_department',
        'status', 'appointment_category', 'additional_notes'
    ];

    fields.forEach(field => {
        const savedValue = sessionStorage.getItem(`appointment_${field}`);
        if (savedValue) {
            const element = document.querySelector(`[name="${field}"]`);
            if (element) {
                element.value = savedValue;
            }
        }
    });

    // Save form data to sessionStorage as user types/changes values
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('change', function() {
            sessionStorage.setItem(`appointment_${this.name}`, this.value);
        });
    });
});
        
    </script>
  </body>
</html>