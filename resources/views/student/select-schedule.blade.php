

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


.appointment-selectschedule {
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
.appointment-selectschedule .overlap-wrapper-ss {
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
.appointment-selectschedule .overlap-ss {
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


.appointment-selectschedule .date-time-wrapper { /* REPOSITION NG RECTANGLE */
    position: absolute;
    width: 599px;
    height: 965px;
    top: 900px;
    left: 2700px;
    z-index: 0;
    overflow: visible;
    flex-direction: column;
}

.appointment-selectschedule .calendar {
    position: relative;
    width: 3550px;
    height: 2165px;
    top: -383px;
    left: -1505px;
    z-index: 0;
    overflow: visible;
}



.appointment-selectschedule .select-date { /* SELECT DATE TEXT */
    position: absolute;
    width: 1067px;
    top: 15px;
    left: 50px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 95px;
    letter-spacing: 0;
    line-height: normal;
}


.appointment-selectschedule .select-time { /* SELECT TIME TEXT */
    position: absolute;
    width: 1067px;
    top: 15px;
    left: 2100px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 95px;
    letter-spacing: 0;
    line-height: normal;
}

.appointment-selectschedule .select-duration { /* SELECT TIME TEXT */
    position: absolute;
    width: 1067px;
    top: 1205px;
    left: 2100px;
    font-family: "Futura Hv BT", Helvetica;
    font-weight: 400;
    color: #31572c;
    font-size: 95px;
    letter-spacing: 0;
    line-height: normal;
}



.appointment-selectschedule .date-time-text {
    position: absolute;
    width: 569px;
    height: 55px;
    top: -330px;
    left: -1460px;
    flex-direction: column;
}
.appointment-selectschedule .overlap-ss-2 { /* reposition ng menu panel */
    position: absolute;
    width: 100%;
    max-width: 1768px;
    height: 198px;
    top: 43px;
    left: 1.3%;
    flex-direction: column;
}
.appointment-selectschedule .rectangle-ss { /* resizing at pinaka background ng menu panel */
    width: 5825px;
    height: 383px;
    position: relative;
    top: 0;
    left: 0;
    flex-direction: column;
}

.appointment-selectschedule .iskodyul-logo-ss {
    position: absolute;
    width: 266px;
    height: 96px;
    top: 89px;
    left: 98px;
}
.appointment-selectschedule .overlap-group-2-ss {
    position: relative;
    width: 232px;
    height: 66px;
    
}
.appointment-selectschedule .dyul-ss {
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
.appointment-selectschedule .isko-ss {
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
.appointment-selectschedule .menu-group-ss { /* REPOSITIONING NG DASHBOARD, APTMT, ABT, LOGOUT */
    position: absolute;
    top: 50px;
    left: 900px;
}





.appointment-selectschedule .line-ss {
    position: absolute;
    width: 5808px;
    height: 1px;
    top: 220px;
    left: 4px;
    object-fit: cover;
    z-index: 2;
}
.appointment-selectschedule .group-ss { /* REPOSITION BUONG SELECT SCHEDULE PATI ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 113px;
    left: 1180px;
}
.appointment-selectschedule .overlap-ss-3 { /* REPOSITION FACULTY SEARCH AT SELECT SCHEDULE WITH ELEMENTS */
    position: relative;
    height: 2px;
    top: 150px;
}
.appointment-selectschedule .img-ss-2 { /* TRIANGLE SA FACULTY SEARCH */
    position: absolute;
    width: 101px;
    height: 141px;
    top: -41px;
    left: 1420px;
    z-index: 3;
}

.appointment-selectschedule .frame-ss-2 { /* RECTANGLE SA FACULTY SEARCH BOX */
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
.appointment-selectschedule .img-ss-3 { /* TRIANGLE SA SELECT SCHEDULE */
    position: absolute;
    width: 101px;
    height: 145px;
    top: -45px;
    left: 1700px;
    z-index: 3;
}

.appointment-selectschedule .rectangle-ss-2 { /* RECTANGLE SA SELECT SCHEDULE */
    width: 1450px;
    height: 135px;
    background-color: #ecf39e;
    position: absolute;
    top: -39px;
    left: 265px;
    z-index: 1;
}

.appointment-selectschedule .img-ss-4 { /* TRIANGLE SA INFORMATION */
    position: absolute;
    width: 101px;
    height: 143px;
    top: -42px;
    left: 1933px;
    z-index: 3;
}
.appointment-selectschedule .rectangle-ss-3 { /* RECTANGLE SA INFORMATION */
    width: 1450px;
    height: 138px;
    background-color: #ffffff;
    position: absolute;
    top: -39px;
    left: 483px;
    z-index: 1;
}

.appointment-selectschedule .group-2-ss { /* BUONG INFORMATION INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 260px;
    left: 2414px;
}
.appointment-selectschedule .information-fs { /*information text */
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


.appointment-selectschedule .frame-ss { /* SELECT SCHEDULE FRAME , REPOSITION NG TEXT*/
    display: flex;
    width: 162px;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    position: absolute;
    top: -10px;
    left: 874px;
    background-color: #ecf39e;
    z-index: 2;
    
} 

.appointment-selectschedule .frame-ss-3 { /* REPOSITION OF  INFORMATION TEXT */
    display: flex;
    width: 162px;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    position: absolute;
    top: 10px;
    left: 1054px;
    background-color: #ffffff;
    z-index: 2;
    
} 
.appointment-selectschedule .select-schedule {
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
.appointment-selectschedule .overlap-group-wrapper-ss { /* BUONG FACULTY SEARCH BAR INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 103px;
    top: 113px;
    left: 20px;
}



.appointment-selectschedule .faculty-search-text {
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

.appointment-selectschedule .frame-wrapper-ss { /* RECTANGLE NG CONFIRMATION */
    position: absolute;
    width: 1460px;
    height: 140px;
    top: 220px;
    left: 4350px;
    background-color: #ffffff;
    border-radius: 0px 0px 35px 0px;
}
.appointment-selectschedule .frame-ss-4 { /* CONFIRMATION TEXT */
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
.appointment-selectschedule .confirmation-ss {
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


.appointment-selectschedule .menu-group-ss {
    position: absolute;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffffff;
    font-family: "Futura Hv BT", Helvetica;
    gap: 350px;
}

.appointment-selectschedule .menu-group-ss a {
    text-decoration: none;
    color: #31572c;
    font-size: 65px;
    padding: 10px 20px;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-size: 500% 120%;

}
.appointment-selectschedule .menu-group-ss .appointment-ss {
    position: relative;
    background-size: 120% 120%;
    background-color: rgba(211, 218, 203, 0.6);
    border-radius: 15px
}

.appointment-selectschedule .menu-group-ss a:hover {
    background-color: rgba(211, 218, 203, 0.6);
    background-size: 520% 120%;
    border-radius: 15px;
    color: #31572c;
    transform: scale(1.1);
}

.appointment-selectschedule .menu-group-ss .logout-ss {
    position: relative;
    margin-left: 2200px; 
    margin-right: 50px; 
    font-size: 65px; 
}

.appointment-selectschedule .continue-button-ss {
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

.appointment-selectschedule .continue-button-ss:hover {
    background-color: #4f772d;
    transform: scale(1.05);
}

.appointment-selectschedule .continue-ss { /* continue */
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

.appointment-selectschedule .back-button-ss {
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

.appointment-selectschedule .back-button-ss:hover {
    background-color: #31572c55;
}
.appointment-selectschedule .back-ss { /* back */
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

.appointment-selectschedule .continue-button-group-ss {
    position: absolute;
    top: 1800px;
    left: 3700px;
}

.appointment-selectschedule .back-button-group-ss {
    position: absolute;
    top: 1800px;
    left: 3150px;
}

.line-above-colleges-ss {
  position: absolute;
  top: calc(1500px - -80px); /* Adjust based on `colleges-section-wrapper` top position */
  left: 38%;
  width: 33%; /* Full width */
  height: 5px; /* Thickness of the line */
  background-color: #31572c; 
  z-index: 2; 
  rotate: 90deg;
}



</style>
  </head>
  <body>
    <div class="appointment-selectschedule">
      <div class="overlap-wrapper-ss">
    
        <div class="overlap-ss">
            <div class="line-above-colleges-ss"></div>
            <div class="continue-button-group-ss">
                <button class="continue-button-ss" onclick="location.href='/information';">
                    <div class="continue-ss">Continue</div>
                </button>
            </div>
            <div class="back-button-group-ss">
                <button class="back-button-ss" onclick="location.href='/appointment';">
                    <div class="back-ss">Back</div>
                </button>
            </div>
          <div class="date-time-wrapper">
            <img class="calendar" src="assets/images/faculty list.png"/>
            <div class="date-time-text"><div class="select-date">Select Date</div></div>
            <div class="date-time-text"><div class="select-time">Select Time</div></div>
            <div class="date-time-text"><div class="select-duration">Select Duration</div></div>

          </div>
          <div class="overlap-ss-2">
            <img class="rectangle-ss" src="assets/images/Rectangle 39912.png" />
            <div class="iskodyul-logo-ss">
              <div class="overlap-group-2-ss">
                <div class="dyul-ss">DYUL</div>
                <div class="isko-ss">ISKO</div>
              </div>
            </div>
            <nav class="menu-group-ss">
                <a href="dashboard.html">DASHBOARD</a>
                <a href="search_faculty.html" class="appointment-ss">APPOINTMENT</a>
                <a href="about.html">ABOUT</a>
                <a href="login.html" class="logout-ss">LOGOUT</a>
            </nav>

            <img class="line-ss" src="assets/images/line.png" />
            <div class="group-ss">
              <div class="overlap-ss-3">
                <img class="img-ss-3" src="assets/images/triangle selected (fs).png" />
                <div class="rectangle-ss-2"></div>
                <div class="frame-ss"><div class="select-schedule">Select Schedule</div></div>
              </div>
            </div>
            <div class="overlap-group-wrapper-ss">
              <div class="overlap-ss-3">
                <img class="img-ss-2" src="assets/images/triangle select sched.png" />
                <div class="faculty-search-ss"></div>
                <div class="frame-ss-2"><div class="faculty-search-text">Faculty Search</div></div>
              </div>
            </div>
            <div class="group-2-ss">
              <div class="overlap-3">
                <img class="img-ss-4" src="assets/images/triangle info.png" />
                <div class="rectangle-ss-3"></div>
                <div class="frame-ss-3"><div class="information-fs">Information</div></div>
              </div>
            </div>
            <div class="frame-wrapper-ss">
              <div class="frame-ss-4"><div class="confirmation-ss">Confirmation</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>