<!DOCTYPE html>
<html>
  <head>
    <x-heading-preset />
  </head>
  <body>
  	@php
  	$faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first();
  	@endphp
    <div class="dashboard-faculty">
      <div class="overlap-wrapper-df">
        <div class="overlap-df">
        <div class="schedule-container">
            <div class="hello">Hello,</div>
            <div class="prof-name">{{ $faculty->last_name }}, {{ $faculty->first_name }}</div>
            <div class="appointment-list">
                <a href="view_appointments (faculty).html" class="appointments-link">Your Appointments</a>
        </div>
        </div>
        <div class="placeholder-container-df">
            @for ($i = 0; $i < 4; $i++)
            <div class="appointment-placeholder-df">
              <div class="appointment-date-df">
                <span class="date">17</span>
                <span class="month">Nov</span>
              </div>
              <div class="appointment-details-df">
                <span class="name">Sample Name</span>
                <span class="college">Sample College</span>
              </div>
              <div class="appointment-time-df">
                <span class="time">10:00 AM</span>
                <span class="duration">30 Min</span>
              </div>
            </div>
          @endfor
      </div>
        <div class="right-section">
            <div class="calendar-box">
                <div class="calendar-title">Calendar</div>
                <div class="calendar-content"></div>
            </div>
        <div class="no-schedule">
            <p>Update availability here: </p>
            <button class="set-here-button" onclick="window.location.href='/faculty-availability'">Update</button>
        </div>
        </div>
          <div class="overlap-df-2">
            <img class="rectangle-df" src="assets/images/Rectangle 39912.png" />
            <div class="iskodyul-logo-df">
              <div class="overlap-group-2-df">
                <div class="dyul-df">DYUL</div>
                <div class="isko-df">ISKO</div>
              </div>
            </div>
            <nav class="menu-group-df">
                <a href="/faculty-dashboard" class="dashboard-df">DASHBOARD</a>
                <a href="/faculty-setup">INFORMATION</a>
                <a href="/faculty-availability">AVAILABILITY</a>
            </nav>
            <nav class="logout-only-df">
                <a href="/logout" class="logout-df">LOGOUT</a>
            </nav>
            </div>  
   
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
