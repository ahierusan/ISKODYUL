

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


.appointment-confirmation {
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
.appointment-confirmation .overlap-wrapper-cf {
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
.appointment-confirmation .overlap-cf {
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


.appointment-selectschedule .information-wrapper { /* REPOSITION NG RECTANGLE */
    position: absolute;
    width: 599px;
    height: 965px;
    top: 900px;
    left: 2700px;
    z-index: 0;
    overflow: visible;
    flex-direction: column;
}



.appointment-selectschedule .select-date { /* SELECT DATE TEXT */
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


.appointment-selectschedule .select-time { /* SELECT TIME TEXT */
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


.appointment-selectschedule .information-text {
    position: absolute;
    width: 569px;
    height: 55px;
    top: -330px;
    left: -1460px;
    flex-direction: column;
}
.appointment-confirmation .overlap-cf-2 { /* reposition ng menu panel */
    position: absolute;
    width: 1768px;
    height: 198px;
    top: 43px;
    left: 80px;
    flex-direction: column;
}
.appointment-confirmation .rectangle-cf { /* resizing at pinaka background ng menu panel */
    width: 5825px;
    height: 383px;
    position: relative;
    top: 0;
    left: 0;
    flex-direction: column;
}

.appointment-confirmation .iskodyul-logo-cf {
    position: absolute;
    width: 266px;
    height: 96px;
    top: 89px;
    left: 98px;
}
.appointment-confirmation .overlap-group-2-cf {
    position: relative;
    width: 232px;
    height: 66px;
    
}
.appointment-confirmation .dyul-cf {
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
.appointment-confirmation .isko-cf {
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
.appointment-confirmation .menu-group-cf { /* REPOSITIONING NG DASHBOARD, APTMT, ABT, LOGOUT */
    position: absolute;
    top: 50px;
    left: 900px;
}

.appointment-confirmation .line-cf {
    position: absolute;
    width: 5808px;
    height: 1px;
    top: 220px;
    left: 4px;
    object-fit: cover;
    z-index: 2;
}
.appointment-confirmation .group-cf { /* REPOSITION BUONG SELECT SCHEDULE PATI ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 113px;
    left: 1180px;
}
.appointment-confirmation .overlap-cf-3 { /* REPOSITION FACULTY SEARCH AT SELECT SCHEDULE WITH ELEMENTS */
    position: relative;
    height: 2px;
    top: 150px;
}
.appointment-confirmation .img-cf-2 { /* TRIANGLE SA FACULTY SEARCH */
    position: absolute;
    width: 101px;
    height: 141px;
    top: -41px;
    left: 1420px;
    z-index: 3;
}

.appointment-confirmation .frame-cf-2 { /* RECTANGLE SA FACULTY SEARCH BOX */
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
.appointment-confirmation .img-cf-3 { /* TRIANGLE SA SELECT SCHEDULE */
    position: absolute;
    width: 101px;
    height: 145px;
    top: -45px;
    left: 1700px;
    z-index: 3;
}

.appointment-confirmation .rectangle-cf-2 { /* RECTANGLE SA SELECT SCHEDULE */
    width: 1450px;
    height: 135px;
    background-color: #ffffff;
    position: absolute;
    top: -39px;
    left: 265px;
    z-index: 1;
}

.appointment-confirmation .img-cf-4 { /* TRIANGLE SA INFORMATION */
    position: absolute;
    width: 101px;
    height: 143px;
    top: -40px;
    left: 1927px;
    z-index: 3;
}
.appointment-confirmation .rectangle-cf-3 { /* RECTANGLE SA INFORMATION */
    width: 1450px;
    height: 138px;
    background-color: #ffffff;
    position: absolute;
    top: -39px;
    left: 483px;
    z-index: 1;
}

.appointment-confirmation .group-2-cf { /* BUONG INFORMATION INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 83px;
    top: 260px;
    left: 2414px;
}
.appointment-confirmation .information-cf { /*information text */
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


.appointment-confirmation .frame-cf { /* SELECT SCHEDULE FRAME , REPOSITION NG TEXT*/
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

.appointment-confirmation .frame-cf-3 { /* REPOSITION OF  INFORMATION TEXT */
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
.appointment-confirmation .select-schedule {
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
.appointment-confirmation .overlap-group-wrapper-cf { /* BUONG FACULTY SEARCH BAR INCL. ELEMENTS */
    position: absolute;
    width: 492px;
    height: 103px;
    top: 113px;
    left: 20px;
}



.appointment-confirmation .faculty-search-text {
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

.appointment-confirmation .frame-wrapper-cf { /* RECTANGLE NG CONFIRMATION */
    position: absolute;
    width: 1460px;
    height: 140px;
    top: 220px;
    left: 4350px;
    background-color: #ecf39e;
    border-radius: 0px 0px 35px 0px;
}
.appointment-confirmation .frame-cf-4 { /* CONFIRMATION TEXT */
    width: 156px;
    position: relative;
    left: 700px;
    background-color: #ecf39e;
    border-radius: 0px 0px 15px 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    top: 25px;
}
.appointment-confirmation .confirmation-cf {
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


.appointment-confirmation .menu-group-cf {
    position: absolute;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffffff;
    font-family: "Futura Hv BT", Helvetica;
    gap: 350px;
}

.appointment-confirmation .menu-group-cf a {
    text-decoration: none;
    color: #31572c;
    font-size: 65px;
    padding: 10px 20px;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-size: 500% 120%;

}
.appointment-confirmation .menu-group-cf .appointment-cf {
    position: relative;
    background-size: 120% 120%;
    background-color: rgba(211, 218, 203, 0.6);
    border-radius: 15px
}

.appointment-confirmation .menu-group-cf a:hover {
    background-color: rgba(211, 218, 203, 0.6);
    background-size: 520% 120%;
    border-radius: 15px;
    color: #31572c;
    transform: scale(1.1);
}

.appointment-confirmation .menu-group-cf .logout-cf {
    position: relative;
    margin-left: 2200px; 
    margin-right: 50px; 
    font-size: 65px; 
}

.appointment-confirmation .continue-button-cf {
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

.appointment-confirmation .continue-button-cf:hover {
    background-color: #4f772d;
    transform: scale(1.05);
}

.appointment-confirmation .continue-cf { /* continue */
    position: absolute;
    top: 50px;
    left: 120px;
    font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
    font-weight: 700;
    color: #ffffff;
    font-size: 65px;
    text-align: left;
    letter-spacing: 0;
    line-height: 30px;
    white-space: nowrap;
}

.appointment-confirmation .back-button-cf {
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

.appointment-confirmation .back-button-cf:hover {
    background-color: #31572c55;
}
.appointment-confirmation .back-cf { /* back */
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

.appointment-confirmation .continue-button-group-cf {
    position: absolute;
    top: 1800px;
    left: 3700px;
}

.appointment-confirmation .back-button-group-cf {
    position: absolute;
    top: 1800px;
    left: 3150px;
}

.appointment-confirmation .schedule-container {
    position: relative;
    top: 550px;
    text-align: left;
    left: 300px;
}

.appointment-confirmation .apt-category {
    font-family: "Futura Hv BT", Helvetica;
    font-size: 280px;
    font-weight: bold;
    color: #3c643c;
    margin-bottom: 20px;
}

.appointment-confirmation .date-time {
    position: relative;
    top: 550px;
    font-family: "Futura Hv BT", Helvetica;
    font-size:98px;
    font-weight: bold;
    color: #3c643c;
    margin-bottom: 20px;
}

.appointment-confirmation .date-time span {
    display: block;
    margin: 5px 0;
}

.appointment-confirmation .location-room {
    position: relative;
    top: 150px;
    font-family: "Futura Hv BT", Helvetica;
    font-size: 68px;
    font-weight: bold;
    color: #3c643c;
    margin-top: 550px;
}

.appointment-confirmation .location-room span {
    display: block;
    margin: 5px 0;
}

.appointment-confirmation .contact-info {
    position: relative;
    top: 300px;
    font-family: "Futura Hv BT", Helvetica;
    font-size: 68px;
    font-weight: bold;
    color: #3c643c;
    margin-top: 40px;
}

.appointment-confirmation .divider {
    position: relative;
    top: 600px;
    left: -200px;
    border: none;
    border-top: 9px solid #31572c;
    margin: 20px auto;
    width: 90%;
}

.appointment-confirmation .additional-notes {
    position: relative;
    top: 480px;
    font-family: "Futura Hv BT", Helvetica;
    font-size: 68px;
    font-weight: bold;
    color: #3c643c;
    margin-top: 40px;
}


</style>
  </head>
  <body>
    <div class="appointment-confirmation">
      <div class="overlap-wrapper-cf">
        
    
        <div class="overlap-cf">
            <div class="continue-button-group-cf">
                <button class="continue-button-cf" onclick="location.href='/student-dashboard';">
                    <div class="continue-cf">Confirm</div>
                </button>
            </div>
            <div class="back-button-group-cf">
                <button class="back-button-cf" onclick="location.href='/information';">
                    <div class="back-cf">Back</div>
                </button>
            </div>


        <div class="schedule-container">
            <div class="apt-category">[APPOINTMENT CATEGORY]</div>
            <div class="date-time">
                <span>[DATE]</span>
                <span>[TIME]</span>
            </div>
            <hr class="divider">
            <div class="location-room">
                <span>[LOCATION]</span>
                <span>[ROOM]</span>
            </div>
            <div class="contact-info">
                [NAME]<br>
                <a href="#" style="color: #31572c; text-decoration: none;">[EMAIL]</a>
            </div>
            <div class="additional-notes">
                <span>[ADDITIONAL NOTES]</span>
            </div>
        </div>

        </div>

          <div class="overlap-cf-2">
            <img class="rectangle-cf" src="assets/images/Rectangle 39912.png" />
            <div class="iskodyul-logo-cf">
              <div class="overlap-group-2-cf">
                <div class="dyul-cf">DYUL</div>
                <div class="isko-cf">ISKO</div>
              </div>
            </div>
            <nav class="menu-group-cf">
                <a href="dashboard.html">DASHBOARD</a>
                <a href="search_faculty.html" class="appointment-cf">APPOINTMENT</a>
                <a href="about.html">ABOUT</a>
                <a href="login.html" class="logout-cf">LOGOUT</a>
            </nav>

            <img class="line-cf" src="assets/images/line.png" />
            <div class="group-cf">
              <div class="overlap-cf-3">
                <img class="img-cf-3" src="assets/images/triangle info.png" />
                <div class="rectangle-cf-2"></div>
                <div class="frame-cf"><div class="select-schedule">Select Schedule</div></div>
              </div>
            </div>
            <div class="overlap-group-wrapper-cf">
              <div class="overlap-cf-3">
                <img class="img-cf-2" src="assets/images/triangle select sched.png" />
                <div class="faculty-search-cf"></div>
                <div class="frame-cf-2"><div class="faculty-search-text">Faculty Search</div></div>
              </div>
            </div>
            <div class="group-2-cf">
              <div class="overlap-3">
                <img class="img-cf-4" src="assets/images/triangle select sched.png" />
                <div class="rectangle-cf-3"></div>
                <div class="frame-cf-3"><div class="information-cf">Information</div></div>
              </div>
            </div>
            <div class="frame-wrapper-cf">
              <div class="frame-cf-4"><div class="confirmation-cf">Confirmation</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>