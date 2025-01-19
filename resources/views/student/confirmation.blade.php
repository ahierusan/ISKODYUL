<html>
  <head>
    <x-heading-preset />
  </head>
  <body>


    <div class="appointment-confirmation">
      <div class="overlap-wrapper-cf">

<div class="overlap-cf">
    <div class="continue-button-group-cf">
        <form method="POST" action="{{ route('appointment.store') }}">
            @csrf
            <button type="submit" class="continue-button-cf">
                Confirm
            </button>
        </form>
    </div>
    <div class="back-button-group-cf">
        <button class="back-button-cf" onclick="location.href='/information';">
            Back
        </button>
    </div>
</div>

    @php
        $appointmentData = session('appointment_schedule');
        $studentInfo = $appointmentData['student_info'];
    @endphp

<div class="schedule-container">
    <div class="apt-category">{{ $studentInfo['appointment_category'] }}</div>
    <div class="date-time">
        <span>{{ \Carbon\Carbon::parse($appointmentData['date'])->format('F d, Y') }}</span>
        <span>
        {{ \Carbon\Carbon::parse($appointmentData['time'])->format('g:i A') }} - 
        {{ \Carbon\Carbon::parse($appointmentData['time'])->addMinutes((int)$appointmentData['duration'])->format('g:i A') }}
        </span>
    </div>
    <div class="date-time">
        <span>{{ $faculty->department }} - {{ $faculty->bldg_no }}</span>
    </div>
    <hr class="divider">
<div class="contact-info">
        {{ $faculty->first_name }} {{ $faculty->last_name }}<br>
        <a href="#" style="color: #31572c; text-decoration: none;">{{ $faculty->user->email }}</a><br>
        {{ $faculty->collegeDepartment->college_name }} ({{ $faculty->collegeDepartment->acronym}})</div>
    <hr class="divider">
    <div class="contact-info">
        {{ $studentInfo['first_name'] }} {{ $studentInfo['last_name'] }}<br>
        {{ $studentInfo['program_year_section'] }}<br>
        {{ $studentInfo['student_number'] }}<br>
        {{ $studentInfo['status'] }}
    </div>
    <hr class="divider">
    <div class="additional-notes">
        <span>
            @if(!empty($studentInfo['additional_notes']))
                Note: {{ $studentInfo['additional_notes'] }}
            @else
                No additional notes
            @endif
        </span>

        @if ($appointmentData['requires_approval'])
            <br><span style="color: #FFA500;">{{ 'Status: Pending Approval' }}</span>
        @endif
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
            <nav class="menu-group-ss">
                    <a href="/student-dashboard">DASHBOARD</a>
                    <a href="/appointment" class="appointment">APPOINTMENT</a>
                    <a href="about.html">ABOUT</a>
                    <a href="/logout" class="logout-fs">LOGOUT</a>
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
    <script>
      // Add this script section to confirmation.blade.php
document.addEventListener('DOMContentLoaded', function() {
    const confirmButton = document.querySelector('.continue-button-cf');
    
    confirmButton.addEventListener('click', function() {
        // Clear all appointment-related sessionStorage items
        Object.keys(sessionStorage).forEach(key => {
            if (key.startsWith('appointment_')) {
                sessionStorage.removeItem(key);
            }
        });
    });
});
    </script>
  </body>
</html>