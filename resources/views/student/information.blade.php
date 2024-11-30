

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <style>
    @font-face {
        font-family: "FONTSPRING DEMO - Proxima Nova-Bold";
        src: url("proxima-nova/Proxima-Nova-Alt-Bold.otf") format("opentype");
    }

    @font-face {
        font-family: "FONTSPRING DEMO - Proxima Nova Alt Regular";
        src: url("proxima-nova/Proxima Nova Alt Regular.otf") format("opentype");
    }

    @font-face {
        font-family: "FONTSPRING DEMO - Proxima Nova Black";
        src: url("proxima-nova/Proxima Nova Black.otf") format("opentype");
    }

    @font-face {
        font-family: "Montserrat-Medium";
        src: url("montserrat/Montserrat-Medium.woff") format("woff");
    }

    @font-face {
        font-family: "Montserrat-Regular";
        src: url("montserrat/Montserrat-SemiBold.woff") format("woff");
    }

    @font-face {
        font-family: "FONTSPRING DEMO - Proxima Nova Alt Semibold";
        src: url("proxima-nova/Proxima Nova Alt Semibold.otf") format("opentype");
    }

    @font-face {
        font-family: "Futura Hv BT";
        src: url("futura/Futura\ Heavy\ font.ttf") format("truetype");
    }


.appointment-information {
    position: fixed;
    top: 0;
    left: 0;
    background-color: #ffffff;
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}
.appointment-information .overlap-wrapper-in {
    background-color: #ffffff;
    background-image: url(wavy.png);
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: stretch;
    overflow: hidden;
}
.appointment-information .overlap-in {
    position: relative;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        -25deg,
        rgba(255, 255, 255, 0.7) 30%, 
        rgba(49, 87, 44, 1) 110%    
    );
    display: flex;
    z-index: 0;
}


.appointment-information .information-wrapper { /* REPOSITION NG RECTANGLE */
    position: absolute;
    width: 599px;
    height: 965px;
    top: 900px;
    left: 2700px;
    z-index: 0;
    overflow: visible;
    flex-direction: column;
}

.appointment-information .calendar {
    position: relative;
    width: 3550px;
    height: 2165px;
    top: -383px;
    left: -1505px;
    z-index: 0;
    overflow: visible;
}



.appointment-information .select-date { /* SELECT DATE TEXT */
    position: absolute;
    width: 1567px;
    top: 15px;
    left: 50px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 120px;
    letter-spacing: 0;
    line-height: normal;
}


.appointment-information .select-time { /* SELECT TIME TEXT */
    position: absolute;
    width: 1067px;
    top: 15px;
    left: 2100px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 120px;
    letter-spacing: 0;
    line-height: normal;
}


.appointment-information .information-text {
    position: absolute;
    width: 569px;
    height: 55px;
    top: -330px;
    left: -1460px;
    flex-direction: column;
}
.appointment-information .overlap-in-2 { /* reposition ng menu panel */
    position: absolute;
    width: 1768px;
    height: 198px;
    top: 43px;
    left: 80px;
    flex-direction: column;
}
.appointment-information .rectangle-in { /* resizing at pinaka background ng menu panel */
    width: 5825px;
    height: 383px;
    position: relative;
    top: 0;
    left: 0;
    flex-direction: column;
}

.appointment-information .iskodyul-logo-in {
    position: absolute;
    width: 266px;
    height: 96px;
    top: 89px;
    left: 98px;
}
.appointment-information .overlap-group-2-in {
    position: relative;
    width: 232px;
    height: 66px;
    
}
.appointment-information .dyul-in {
    position: absolute;
    width: 130px;
    top: 0;
    left: 258px;
    font-family: "FONTSPRING DEMO - Proxima Nova Black", Helvetica;
    font-weight: 400;
    color: #4f772d;
    font-size: 120px;
    letter-spacing: 0;
    line-height: 60px;
    white-space: nowrap;
    margin-right: -75px;
}
.appointment-information .isko-in {
    position: absolute;
    width: 130px;
    top: 0;
    left: 0;
    font-family: "FONTSPRING DEMO - Proxima Nova Black", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 120px;
    letter-spacing: 0;
    line-height: 60px;
    white-space: nowrap;
}
.appointment-information .menu-group-in { /* REPOSITIONING NG DASHBOARD, APTMT, ABT, LOGOUT */
    position: absolute;
    top: 50px;
    left: 900px;
}





.appointment-information .line-in {
    position: absolute;
    width: 5808px;
    height: 1px;
    top: 220px;
    left: 4px;
    object-fit: cover;
    z-index: 2;
}
.appointment-information .group-in { /* REPOSITION BUONG SELECT SCHEDULE PATI ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 113px;
    left: 1180px;
}
.appointment-information .overlap-in-3 { /* REPOSITION FACULTY SEARCH AT SELECT SCHEDULE WITH ELEMENTS */
    position: relative;
    height: 2px;
    top: 150px;
}
.appointment-information .img-in-2 { /* TRIANGLE SA FACULTY SEARCH */
    position: absolute;
    width: 101px;
    height: 141px;
    top: -41px;
    left: 1420px;
    z-index: 3;
}

.appointment-information .frame-in-2 { /* RECTANGLE SA FACULTY SEARCH BOX */
    width: 1420px;
    height: 115px;
    position: absolute;
    left: -6px;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    top: -39px;
    border-radius: 0px 0px 0px 35px;
}
.appointment-information .img-in-3 { /* TRIANGLE SA SELECT SCHEDULE */
    position: absolute;
    width: 101px;
    height: 145px;
    top: -45px;
    left: 1700px;
    z-index: 3;
}

.appointment-information .rectangle-in-2 { /* RECTANGLE SA SELECT SCHEDULE */
    width: 1450px;
    height: 135px;
    background-color: #ffffff;
    position: absolute;
    top: -39px;
    left: 265px;
    z-index: 1;
}

.appointment-information .img-in-4 { /* TRIANGLE SA INFORMATION */
    position: absolute;
    width: 101px;
    height: 143px;
    top: -40px;
    left: 1927px;
    z-index: 3;
}
.appointment-information .rectangle-in-3 { /* RECTANGLE SA INFORMATION */
    width: 1450px;
    height: 138px;
    background-color: #ecf39e;
    position: absolute;
    top: -39px;
    left: 483px;
    z-index: 1;
}

.appointment-information .group-2-in { /* BUONG INFORMATION INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 260px;
    left: 2414px;
}
.appointment-information .information-in { /*information text */
    position: relative;
    width: fit-content;
    margin-top: -1.00px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 55px;
    letter-spacing: 0;
    line-height: normal;
    top: -20px;
    left: 100px;
}


.appointment-information .frame-in { /* SELECT SCHEDULE FRAME , REPOSITION NG TEXT*/
    display: flex;
    width: 162px;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    position: absolute;
    top: -10px;
    left: 874px;
    background-color: #ffffff;
    z-index: 2;
    
} 

.appointment-information .frame-in-3 { /* REPOSITION OF  INFORMATION TEXT */
    display: flex;
    width: 162px;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    position: absolute;
    top: 10px;
    left: 1054px;
    background-color: #ecf39e;
    z-index: 2;
    
} 
.appointment-information .select-schedule {
    position: relative;
    width: fit-content;
    margin-top: -1.00px;
    margin-left: -17.60px;
    margin-right: -17.60px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 55px;
    letter-spacing: 0;
    line-height: normal;
    white-space: nowrap;
}
.appointment-information .overlap-group-wrapper-in { /* BUONG FACULTY SEARCH BAR INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 103px;
    top: 113px;
    left: 20px;
}



.appointment-information .faculty-search-text {
    position: relative;
    width: fit-content;
    margin-top: -1.00px;
    margin-left: -11.60px;
    margin-right: -11.60px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 55px;
    letter-spacing: 0;
    line-height: normal;
}

.appointment-information .frame-wrapper-in { /* RECTANGLE NG CONFIRMATION */
    position: absolute;
    width: 1460px;
    height: 140px;
    top: 220px;
    left: 4350px;
    background-color: #ffffff;
    border-radius: 0px 0px 35px 0px;
}
.appointment-information .frame-in-4 { /* CONFIRMATION TEXT */
    width: 156px;
    position: relative;
    left: 700px;
    background-color: #ffffff;
    border-radius: 0px 0px 15px 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    top: 25px;
}
.appointment-information .confirmation-in {
    position: relative;
    width: fit-content;
    margin-top: -1.00px;
    margin-left: -7.89px;
    margin-right: -7.89px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 55px;
    letter-spacing: 0;
    line-height: normal;
    top: 0px;
    z-index: 4;

}
/*.appointment-selectschedule .college-selection-group {
    position: absolute;
    top: 200px;
    left: 10px; */


.appointment-information .menu-group-in {
    position: absolute;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffffff;
    font-family: "Futura Hv BT", Helvetica;
    gap: 350px;
}

.appointment-information .menu-group-in a {
    text-decoration: none;
    color: #31572c;
    font-size: 65px;
    padding: 10px 20px;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-size: 500% 120%;

}
.appointment-information .menu-group-in .appointment-in {
    position: relative;
    background-size: 120% 120%;
    background-color: rgba(211, 218, 203, 0.6);
    border-radius: 15px
}

.appointment-information .menu-group-in a:hover {
    background-color: rgba(211, 218, 203, 0.6);
    background-size: 520% 120%;
    border-radius: 15px;
    color: #31572c;
    transform: scale(1.1);
}

.appointment-information .menu-group-in .logout-in {
    position: relative;
    margin-left: 2200px; 
    margin-right: 50px; 
    font-size: 65px; 
}

.appointment-information .continue-button-in {
    all: unset;
    box-sizing: border-box;
    position: absolute;
    width: 480px;
    height: 125px;
    top: 974px;
    left: 1615px;
    background-color: #31572c;
    border-radius: 45px;
    overflow: hidden;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.appointment-information .continue-button-in:hover {
    background-color: #4f772d;
    transform: scale(1.05);
}

.appointment-information .continue-in { /* continue */
    position: absolute;
    top: 50px;
    left: 100px;
    font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
    font-weight: 700;
    color: #ffffff;
    font-size: 65px;
    text-align: left;
    letter-spacing: 0;
    line-height: 30px;
    white-space: nowrap;
}

.appointment-information .back-button-in {
    all: unset;
    box-sizing: border-box;
    position: absolute;
    width: 480px;
    height: 125px;
    top: 974px;
    left: 1615px;
    background-color: #31572c33;
    border-radius: 45px;
    overflow: hidden;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.appointment-information .back-button-in:hover {
    background-color: #31572c55;
}
.appointment-information .back-in { /* back */
    position: absolute;
    top: 45px;
    left: 155px;
    font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
    font-weight: 700;
    color: #31572c;
    font-size: 65px;
    text-align: left;
    letter-spacing: 0;
    line-height: 30px;
    white-space: nowrap;
}

.appointment-information .continue-button-group-in {
    position: absolute;
    top: 1800px;
    left: 3700px;
}

.appointment-information .back-button-group-in {
    position: absolute;
    top: 1800px;
    left: 3150px;
}

.appointment-information .line-above-colleges-in {
  position: absolute;
  top: calc(1500px - -80px); 
  left: 38%;
  width: 33%; 
  height: 5px; 
  background-color: #31572c; 
  z-index: 2; 
  rotate: 90deg;
}


.appointment-information .form-container-in {
    position: absolute;
    top: 900px;
    left: 1250px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 190px 190px;
    width: 40%;
    height: 50%;
    padding: 50px;
    border-radius: 10px;
}

.appointment-information .schedule-details {
    position: relative;
    left: 1000px;
    top: px;
}
.appointment-information .personal-info, .schedule-details {
    display: flex;
    flex-direction: column;
    
}


.appointment-information .input-field-in, .dropdown-field, .textarea-field {
    width: 160%;
    padding: 35px;
    box-sizing: border-box;
    margin-bottom: 50px; /* gap adjuster between boxes */
    font-family: "Futura Hv BT", Helvetica;
    font-size: 55px;
    border: none;
    border-radius: 35px;
    background: #ffffff;
    height: 15%;
    gap: 25px 50px;
    box-shadow: 0px 10px 15px #31572c9d;

}

.appointment-information .input-field-in:focus, .dropdown-field:focus, .textarea-field:focus {
    outline: none;
    box-shadow: 0 4px 20px #132a13;
}

.appointment-information .dropdown-field {
    position: relative;
    width: 800px; 
    font-family: "Futura Hv BT", Helvetica;
    height: 150px;
    font-size: 50px;
    background: #ffffff;
    color: #31572c;

}


.appointment-information .textarea-field {
    position: relative;
    left: -130px;
    height: 500px;
    width: 1200px;
    resize: none;
    box-shadow: none;
    border: 8px solid #4f772d;
    border-radius: 35px; 
    padding: 35px; 
}

.appointment-information .dropdown-field {
    width: 100%; 
}

.appointment-information .status-dropdown {
    top: 50px;
    width: 1000px; 
}

.appointment-information .appointment-category-dropdown {
    width: 1200px; 
    left: -130px;
}



</style>
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