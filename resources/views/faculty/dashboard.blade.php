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
      $appointments = app(App\Http\Controllers\AppointmentController::class)->getFacultyAppointments($faculty);
    @endphp
    <div class="dashboard-faculty">
      <div class="overlap-wrapper-df">
        <div class="overlap-df">
          <div class="schedule-container">
            <div class="hello">Hello,</div>
            <div class="prof-name">{{ $faculty->last_name }}, {{ $faculty->first_name }}</div>
            <div class="divider-line"></div>
          </div>
          <div class="current-app">CURRENT APPOINTMENTS</div>
          <div class="appointment-list-df">
              <div class="appointment-scroll-df">
                  <div class="placeholder-container-df">
                      @forelse($appointments['approved'] as $appointment)
                          <div class="appointment-wrapper-current" data-appointment-id="{{ $appointment['id'] }}">
                              <div class="appointment-placeholder-df">
                                  <div class="appointment-date-df">
                                      <span class="date">{{ Carbon\Carbon::parse($appointment['date'])->format('d') }}</span>
                                      <span class="month">{{ Carbon\Carbon::parse($appointment['date'])->format('M') }}</span>
                                  </div>
                                  <div class="appointment-details-df">
                                      <span class="name">
                                        {{ $appointment['student']['last_name'] }}, {{ $appointment['student']['first_name'] }} 
                                        ({{ $appointment['student']['college_department'] }})
                                    </span>
                                      <span>{{ $appointment['appointment_category'] }}</span>

                                  </div>
                                  <div class="appointment-time-df">
                                      <span class="time">{{ Carbon\Carbon::parse($appointment['time'])->format('h:i A') }}</span>
                                      <span class="duration">{{ $appointment['duration'] }} Min</span>
                                  </div>
                              </div>
                              <button class="cancel-apt" onclick="cancelAppointment(this)">&times;</button>
                          </div>
                      @empty
                          <div class="no-app-appointments">No approved appointments</div>
                      @endforelse
                  </div>
              </div>
          </div>
          </div>

      <div class="appointment-list">
          <button class="appointments-link" onclick="togglePopup()">NEW APPOINTMENTS</button>
      </div>

      <!-- Separate Modal Container -->
      <div id="appointmentModal" class="modal hidden">
          <div class="modal-content">
              <span class="close-button">&times;</span>
              <h2>CONFIRM APPOINTMENTS</h2>
              
              <div class="modal-scroll">
                  <div class="placeholder-container-df">
                      @forelse($appointments['pending'] as $appointment)
                      <div class="appointment-wrapper" data-appointment-id="{{ $appointment['id'] }}">
                          <div class="appointment-placeholder-df">
                              <div class="appointment-date-df">
                                  <span class="date">{{ Carbon\Carbon::parse($appointment['date'])->format('d') }}</span>
                                  <span class="month">{{ Carbon\Carbon::parse($appointment['date'])->format('M') }}</span>
                              </div>
                              <div class="appointment-details-df">
                                  <span class="name">{{ $appointment['student']['last_name'] }}, {{ $appointment['student']['first_name'] }}</span>
                                  <span class="college">{{ $appointment['student']['college_department'] }}</span>
                              </div>
                              <div class="appointment-time-df">
                                  <span class="time">{{ Carbon\Carbon::parse($appointment['time'])->format('h:i A') }}</span>
                                  <span class="duration">{{ $appointment['duration'] }} Min</span>
                              </div>
                          </div>
                          <div class="action-buttons">
                              {{-- wait --}}
                              <button class="approve-apt" onclick="approveAppointment(this)">&#10003;</button>
                              <button class="delete-apt" onclick="rejectAppointment(this)">&times;</button>
                          </div>
                      </div>
                      @empty
                      <div class="no-pen-appointments">No pending appointments</div>
                      @endforelse
                  </div>
              </div>
          </div>
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
        position: relative;
        /* height: 0%; */
        background-color: white;
        padding: 30px;
        border-radius: 35px;
      }

      .fc-toolbar {
        margin-bottom: 40px !important;
      }

      .fc-toolbar h2 { /* Calendar title */
        font-family: "Futura Hv BT", Helvetica;
        font-size: 65px;
        color: #31572c;
      }
      
      .fc-toolbar button { /* Calendar buttons */
        font-family: "Futura Hv BT", Helvetica;
        font-size: 45px !important;
        color:#31572c;
        padding: 15px 25px !important;
        height: auto !important;
        background: none !important;
        border-color: #31572c !important;
        border-radius: 15px !important;
        transition: color 0.1s ease, background-color 0.3s ease;
      }

      .fc-toolbar button:hover {
        background-color: #23401a !important;
        color: #ffffff;
      }

/* Add this to your existing CSS */
      .fc-toolbar button.fc-state-active {
        background-color: #31572c !important; /* Same as your hover color */
        color: #ffffff !important;
      }

            /* Day headers */
      .fc-day-header {
        font-family: "Futura Hv BT", Helvetica;
        font-size: 45px;
        padding: 15px 0 !important;
        color: #31572c;
      }

      /* Time slots */
      .fc-time-grid .fc-slats td {
        height: 50px !important;
        font-size: 37px;
        border-top: 1px solid #d6e5d6 !important;
      }

      .fc-axis {
        font-family: "Futura Book font", Helvetica;
        font-size: 40px;
        color: #8c8c8c;
        padding: 0 20px !important;
      }
    
      .fc-event {
        border: none;
        padding: 2px 4px;
        border-radius: 3px;
      }
      
      /* Events styling */
      .availability-event {
        background-color: #4f772d !important;
        opacity: 0.2 !important;
        border: none !important;
      }

      .appointment-event {
        background-color: #31572c !important;
        border: none !important;
        padding: 10px !important;
        border-radius: 15px !important;
      }

      /* Time labels in events */
      .fc-time {
        font-family: "Futura Hv BT", Helvetica;
        font-size: 40px !important;
        margin-bottom: 5px;
      }

      .fc-title {
        font-family: "Futura Book font", Helvetica;
        font-size: 35px !important;
      }

      /* Today highlight */
      .fc-today {
        background-color: rgba(79, 119, 45, 0.1) !important;
      }

      /* Week/day view now indicator */
      .fc-now-indicator {
        border-color: #31572c !important;
      }

      /* Month view specific styles */
      .fc-month-view .fc-day {
          height: 200px !important; /* Adjust this value */
      }

      .fc-row.fc-week.fc-widget-content {
          height: 220px !important; /* Should match the day height */
      }

      /* This ensures the month view has proper height */
      .fc-dayGrid-view .fc-body .fc-row {
          min-height: 200px !important; /* Should match the above heights */
      }

      /* Optional: Adjust the text size for dates in month view */
      .fc-month-view .fc-day-number {
          font-size: 50px;
          font-family: "Futura Hv BT", Helvetica;
          padding: 15px;
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

      document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('appointmentModal');
    const btn = document.querySelector('.appointments-link');
    const closeBtn = document.querySelector('.close-button');

    // Open modal
    btn.addEventListener('click', function() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    function closeModal() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
        document.body.style.overflow = 'auto';
    }

    closeBtn.addEventListener('click', closeModal);

    // Close when clicking outside
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});

function approveAppointment(button) {
    const isConfirmed = confirm("Are you sure you want to confirm the appointment?");
    
    if (isConfirmed) {
        const appointmentWrapper = button.closest('.appointment-wrapper');
        const appointmentId = appointmentWrapper.dataset.appointmentId;

        // Send approval request to backend
        fetch(`/appointment/${appointmentId}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Animate removal from modal
                appointmentWrapper.style.height = appointmentWrapper.offsetHeight + 'px';
                appointmentWrapper.style.transition = 'all 0.3s ease';
                appointmentWrapper.style.opacity = '0';
                appointmentWrapper.style.transform = 'translateX(-100%)';
                
                setTimeout(() => {
                    appointmentWrapper.style.height = '0';
                    appointmentWrapper.style.margin = '0';
                    appointmentWrapper.style.padding = '0';
                    
                    setTimeout(() => {
                        appointmentWrapper.remove();
                        // Refresh the page to update the calendar and current appointments
                        window.location.reload();
                    }, 300);
                }, 300);
            } else {
                alert('Failed to approve appointment: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to approve appointment. Please try again.');
        });
    }
}

function rejectAppointment(button) {
    const isConfirmed = confirm("Are you sure you want to reject this appointment?");
    
    if (isConfirmed) {
        const appointmentWrapper = button.closest('.appointment-wrapper');
        const appointmentId = appointmentWrapper.dataset.appointmentId;

        // Send reject request to backend
        fetch(`/appointment/${appointmentId}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Animate removal from view
                appointmentWrapper.style.height = appointmentWrapper.offsetHeight + 'px';
                appointmentWrapper.style.transition = 'all 0.3s ease';
                appointmentWrapper.style.opacity = '0';
                appointmentWrapper.style.transform = 'translateX(-100%)';
                
                setTimeout(() => {
                    appointmentWrapper.style.height = '0';
                    appointmentWrapper.style.margin = '0';
                    appointmentWrapper.style.padding = '0';
                    
                    setTimeout(() => {
                        appointmentWrapper.remove();
                    }, 300);
                }, 300);
            } else {
                alert('Failed to reject appointment: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to reject appointment. Please try again.');
        });
    }
}

// Add some CSS to ensure smooth animations
document.head.insertAdjacentHTML('beforeend', `
    <style>
    .appointment-placeholder-df {
        transition: all 0.3s ease;
    }
    </style>
`);

function cancelAppointment(button) {
    const isConfirmed = confirm("Are you sure you want to cancel this appointment?");
    
    if (isConfirmed) {
        const appointmentWrapper = button.closest('.appointment-wrapper-current');
        const appointmentId = appointmentWrapper.dataset.appointmentId;
        
        if (!appointmentId) {
            console.error('Appointment ID not found');
            alert('Error: Could not find appointment information');
            return;
        }

        // Send cancel request to backend
        fetch(`/appointment/${appointmentId}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Animate removal from view
                appointmentWrapper.style.height = appointmentWrapper.offsetHeight + 'px';
                appointmentWrapper.style.transition = 'all 0.3s ease';
                appointmentWrapper.style.opacity = '0';
                appointmentWrapper.style.transform = 'translateX(-100%)';
                
                setTimeout(() => {
                    appointmentWrapper.style.height = '0';
                    appointmentWrapper.style.margin = '0';
                    appointmentWrapper.style.padding = '0';
                    
                    setTimeout(() => {
                        appointmentWrapper.remove();
                        // Refresh the calendar view
                        $('#calendar').fullCalendar('refetchEvents');
                    }, 300);
                }, 300);
            } else {
                throw new Error(data.message || 'Failed to cancel appointment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to cancel appointment: ' + error.message);
        });
    }
}
    </script>
  </body>
</html>