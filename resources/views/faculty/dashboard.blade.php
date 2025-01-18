<!DOCTYPE html>
<html>
  <head>
    <x-heading-preset />
    <!-- Add FullCalendar CSS and JS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
  </head>
  <body>
    @php
    $faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first();
    $availabilities = App\Models\FacultyAvailability::where('faculty_id', $faculty->id)->get();
    @endphp
    <div class="dashboard-faculty">
      <div class="overlap-wrapper-df">
        <div class="overlap-df">
          <div class="schedule-container">
            <div class="hello">Hello,</div>
            <div class="prof-name">{{ $faculty->last_name }}, {{ $faculty->first_name }}</div>
            <div class="appointment-list">
              <button onclick="openAppointmentsModal()" class="appointments-button">APPOINTMENTS</>
            </div>

            
            <div class="divider-line"></div>
            <div class="current-app">Current Appointments</div>
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
              <div id="calendar" class="calendar-content"></div>
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

    <style>
      .calendar-content {
        height: 100%;
        background-color: white;
        padding: 15px;
        border-radius: 8px;
      }
      
      .fc-event {
        border: none;
        padding: 2px 4px;
        border-radius: 3px;
      }
      
      .availability-event {
        background-color: #4CAF50;
        color: white;
      }
      
      .appointment-event {
        background-color: #2196F3;
        color: white;
      }
      
      .fc-time-grid-event {
        border-radius: 4px;
      }
      
      .fc-time {
        font-weight: bold;
      }
    </style>

    <script>
      $(document).ready(function() {
        // Parse PHP availabilities into calendar events
        var availabilities = @json($availabilities);
        var events = [];
        
        // Get current date for proper event rendering
        var currentDate = moment();
        var startOfWeek = currentDate.clone().startOf('week');
        
        // Convert availabilities to calendar events
        availabilities.forEach(function(availability) {
          // Get the day index (0 = Sunday, 1 = Monday, etc.)
          var dayMap = {
            'Monday': 1, 'Tuesday': 2, 'Wednesday': 3,
            'Thursday': 4, 'Friday': 5, 'Saturday': 6
          };
          var dayIndex = dayMap[availability.day_of_week];
          
          // Calculate the next occurrence of this day
          var eventDate = startOfWeek.clone().add(dayIndex, 'days');
          
          // Create event
          events.push({
            title: 'Available',
            start: eventDate.format('YYYY-MM-DD') + 'T' + availability.start_time,
            end: eventDate.format('YYYY-MM-DD') + 'T' + availability.end_time,
            className: 'availability-event',
            dow: [dayIndex], // Repeat weekly
            rendering: 'background'
          });
        });

        // Initialize calendar
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          defaultView: 'agendaWeek',
          height: 'auto',
          slotDuration: '00:30:00',
          slotLabelFormat: 'h:mm A',
          minTime: '07:00:00',
          maxTime: '19:00:00',
          allDaySlot: false,
          events: events,
          eventRender: function(event, element) {
            if (event.className.includes('availability-event')) {
              element.css('opacity', '0.7');
            }
          },
          businessHours: {
            dow: [1,2,3,4,5,6], // Monday - Saturday
            start: '07:00',
            end: '19:00',
          }
        });
      });

      {{--  Add this to the script where appointments are available
      appointments.forEach(function(appointment) {
        events.push({
          title: appointment.student_name,
          start: appointment.start_datetime,
          end: appointment.end_datetime,
          className: 'appointment-event'
        });
      }); --}}

    </script>
  </body>
</html>