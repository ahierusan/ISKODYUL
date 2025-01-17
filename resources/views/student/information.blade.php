<html>
  <head>
    <x-heading-preset />
  </head>
  <body>
    <div class="appointment-information">
      <div class="overlap-wrapper-in">
        
    
        <div class="overlap-in">
            <div class="line-above-colleges-in"></div>
            <div class="continue-button-group-in">
                <button class="continue-button-in" onclick="location.href='/confirmation';">
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
                <form>
                    <input type="text" placeholder="First Name" class="input-field-in" required>
                    <input type="text" placeholder="Last Name" class="input-field-in" required>
                    <input type="text" placeholder="Course" class="input-field-in" required>
                    <input type="text" placeholder="Year and Section" class="input-field-in" required>
                    <input type="text" placeholder="College" class="input-field-in" required>
                    
                    <select class="dropdown-field status-dropdown">
                        <option>Status</option>
                        <option>Regular</option>
                        <option>Irregular</option>
                    </select>
                </form>
            </div>
            <div class="schedule-details">
                <form>
                    <select class="dropdown-field appointment-category-dropdown">
                        <option>Appointment Category</option>
                        <option>Advising</option>
                        <option>Undergraduate Thesis Consultation</option>
                        <option>Grade Consultation</option>
                    </select>
                    <textarea placeholder="Additional Notes" class="textarea-field"></textarea>
                </form>
            </div>
        </div>

          <div class="overlap-in-2">
            <img class="rectangle-in" src="assets/images/Rectangle 39912.png" />
            <div class="iskodyul-logo-in">
              <div class="overlap-group-2-in">
                <div class="dyul-in">DYUL</div>
                <div class="isko-in">ISKO</div>
              </div>
            </div>
            <nav class="menu-group-in">
                <a href="dashboard.html">DASHBOARD</a>
                <a href="search_faculty.html" class="appointment-in">APPOINTMENT</a>
                <a href="about.html">ABOUT</a>
                <a href="login.html" class="logout-in">LOGOUT</a>
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
        </div>
      </div>
    </div>
  </body>
</html>