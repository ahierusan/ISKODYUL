<html>
<head>
    <x-heading-preset />
    <style>
        /* Your existing styles */
        .appointment-selectschedule {
            background-color: #ffffff;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
        }

        .overlap-wrapper-ss {
            background-color: #ffffff;
            width: 100%;
        }

        .overlap-ss {
            width: 100%;
            position: relative;
        }

        .continue-button-ss {
            background-color: #1c355e;
            border-radius: 8px;
            height: 40px;
            width: 120px;
            border: none;
            cursor: pointer;
        }

        .continue-ss {
            color: #ffffff;
            font-family: "Inter-Regular", Helvetica;
            font-size: 16px;
            font-weight: 400;
        }

        .back-button-ss {
            background-color: #6c757d;
            border-radius: 8px;
            height: 40px;
            width: 120px;
            border: none;
            cursor: pointer;
        }

        .back-ss {
            color: #ffffff;
            font-family: "Inter-Regular", Helvetica;
            font-size: 16px;
            font-weight: 400;
        }

        /* New schedule selection styles */
      .schedule-section-ss {
          position: absolute;
          top: 600px;
          left: 100px;
          width: 5700px;  /* Fixed width instead of percentage */
          padding: 20px;
      }

      .schedule-container-ss {
          position: relative;
          background: white;
          border-radius: 8px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          padding: 30px;
          width: 100%;
      }

        /* Update only the date grid and buttons to use absolute positioning */
      .date-grid-ss {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 15px;
        margin-bottom: 30px;
        width: 100%;
    }

    .time-duration-grid-ss {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        width: 100%;
    }

      .date-button-ss {
          position: relative;
          width: 550px;
          height: 400px;
          padding: 12px;
          border: 1px solid #ddd;
          border-radius: 8px;
          background: white;
          cursor: pointer;
          text-align: center;
          transition: all 0.2s;
          font-family: "Inter-Regular", Helvetica;
      }

      .date-weekday-ss {
          position: absolute;
          width: 100%;
          left: 0;
          font-size: 70px;
          color: #666;
      }

      /* Top weekday */
      .date-weekday-ss:first-child {
          top: 8px;
      }

      /* Bottom month */
      .date-weekday-ss:last-child {
          bottom: 8px;
      }

      .date-day-ss {
          position: absolute;
          width: 100%;
          left: 0;
          top: 50%;
          transform: translateY(-50%);
          font-size: 120px;
          font-weight: bold;
          text-align: center;
      }

      /* Keep your original hover and selected states */
      .date-button-ss:hover {
          background: #f0f0f0;
      }

      .date-button-ss.selected {
          background: #1c355e;
          color: white;
          border-color: #1c355e;
      }

        .time-duration-grid-ss {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .section-title-ss {
            font-size: 120px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
            font-family: "Inter-Regular", Helvetica;
        }

        .form-control-ss {
          width: 2500px;
          padding: 10px;
          border: 1px solid #ddd;
          border-radius: 8px;
          font-size: 70px;
          box-sizing: border-box;
      }

        /* Alert positioning */
.alert-ss {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
    box-sizing: border-box;
    font-size: 80px;
}

/* Toggle hours button positioning */
.toggle-hours-ss {
    position: relative;
    width: 700px;
    height: 150px;
    margin-bottom: 10px;
    font-size: 75px;
}

        .alert-warning-ss {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
        }

        .button-container-ss {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="appointment-selectschedule">
        <div class="overlap-wrapper-ss">
            <div class="overlap-ss">
                <!-- Keep your existing header and navigation -->
                <div class="overlap-ss-2">
                    <img class="rectangle-ss" src="assets/images/Rectangle 39912.png" />
                    <div class="iskodyul-logo-ss">
                        <div class="overlap-group-2-ss">
                            <div class="dyul-ss">DYUL</div>
                            <div class="isko-ss">ISKO</div>
                        </div>
                    </div>
                    <nav class="menu-group-ss">
                        <a href="/student-dashboard">DASHBOARD</a>
                        <a href="/appointment" class="appointment-ss">APPOINTMENT</a>
                        <a href="about.html">ABOUT</a>
                        <a href="/logout" class="logout-ss">LOGOUT</a>
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

                <!-- New Schedule Selection Section -->
                <div class="schedule-section-ss">
                    <div class="schedule-container-ss">
                      <!-- Add these just below your schedule-container-ss div -->
                    <div id="noAvailabilityAlert" class="alert-ss alert-warning-ss" style="display: none;">
                        This day is not within the faculty member's availability. Toggle "Show All Hours" to schedule outside regular hours. This will require approval.
                    </div>

<div id="outsideHoursAlert" class="alert-ss alert-warning-ss" style="display: none;">
    This time is outside the faculty member's regular hours and will require approval.
</div>
                        <form action="{{ route('appointment.schedule.store') }}" method="POST" id="scheduleForm">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert-ss alert-warning-ss">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div>
                                <div class="section-title-ss">1. Select Date</div>
                                <input type="hidden" name="date" id="selectedDate" required>
                                <div class="date-grid-ss" id="dateGrid"></div>
                            </div>

                            <div class="time-duration-grid-ss">
                                <div>
                                    <div class="section-title-ss">2. Select Time</div>
                                    <button type="button" class="toggle-hours-ss" onclick="toggleTimeSlots()">
                                        Show All Hours
                                    </button>
                                    <select name="time" class="form-control-ss" required>
                                        <option value="">Choose time</option>
                                    </select>
                                </div>

                                <div>
                                    <div class="section-title-ss">3. Select Duration</div>
                                    <select name="duration" class="form-control-ss" required>
                                        <option value="30">30 minutes</option>
                                        <option value="60">1 hour</option>
                                    </select>
                                </div>
                            </div>

                            <div id="outsideHoursAlert" class="alert-ss alert-warning-ss" style="display: none;">
                                This time is outside regular hours (8 AM - 5 PM) and will require faculty approval.
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-container-ss">
                    <div class="back-button-group-ss">
                        <button class="back-button-ss" onclick="location.href='/appointment';">
                            <div class="back-ss">Back</div>
                        </button>
                    </div>
                    <div class="continue-button-group-ss">
                        <button class="continue-button-ss" type="submit" form="scheduleForm">
                            <div class="continue-ss">Continue</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
        // Track state
        let facultyAvailabilities = [];
        let showingAllHours = false;
        let facultyAppointments = [];

        // Fetch faculty availabilities when page loads
        async function fetchFacultyAvailabilities() {
            const facultyId = sessionStorage.getItem('selected_faculty_id');
            console.log('Fetching availabilities for faculty:', facultyId);

            if (!facultyId) {
                console.error('No faculty ID found in session storage');
                return;
            }

            try {
                const response = await fetch(`/api/faculty/${facultyId}/availabilities`);
                if (!response.ok) throw new Error('Failed to fetch availabilities');
                const data = await response.json();
                console.log('Availability data:', data);
                facultyAvailabilities = data.availabilities;
                updateDateGridAvailability();
            } catch (error) {
                console.error('Error fetching faculty availabilities:', error);
            }
        }

        function generateDateGrid() {
            const grid = document.getElementById('dateGrid');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            // Ensure we're working with the start of the day in local time
            tomorrow.setHours(0, 0, 0, 0);
            
            const twoWeeksLater = new Date(tomorrow);
            twoWeeksLater.setDate(tomorrow.getDate() + 13); // 14 days including tomorrow

            grid.innerHTML = '';
            grid.style.display = 'grid';
            grid.style.gridTemplateColumns = 'repeat(7, 1fr)';
            grid.style.gap = '15px';

            for (let d = new Date(tomorrow); d <= twoWeeksLater; d.setDate(d.getDate() + 1)) {
                const dateButton = document.createElement('div');
                dateButton.className = 'date-button-ss';
                
                // Format date string in YYYY-MM-DD format using local time
                const dateString = d.toLocaleDateString('en-CA'); // en-CA gives YYYY-MM-DD format
                
                const weekday = d.toLocaleDateString('en-US', { weekday: 'short' });
                const day = d.getDate();
                const month = d.toLocaleDateString('en-US', { month: 'short' });
                
                dateButton.innerHTML = `
                    <div class="date-weekday-ss">${weekday}</div>
                    <div class="date-day-ss">${day}</div>
                    <div class="date-weekday-ss">${month}</div>
                `;

                dateButton.setAttribute('data-date', dateString);
                dateButton.addEventListener('click', handleDateSelection);
                grid.appendChild(dateButton);
            }
        }

        function updateDateGridAvailability() {
            const dateButtons = document.querySelectorAll('.date-button-ss');
            dateButtons.forEach(button => {
                const dateString = button.getAttribute('data-date');
                const hasAvailability = checkDateAvailability(dateString);
                
                if (hasAvailability) {
                    button.style.backgroundColor = 'rgba(28, 53, 94, 0.1)';
                    button.setAttribute('data-available', 'true');
                } else {
                    button.style.backgroundColor = '#ffffff';
                    button.setAttribute('data-available', 'false');
                }
            });
        }

            function handleDateSelection(event) {
              const dateButton = event.currentTarget;
              const dateString = dateButton.getAttribute('data-date');
              const hasAvailability = dateButton.getAttribute('data-available') === 'true';
              const isCurrentlySelected = dateButton.classList.contains('selected');
              
              // Reset all buttons to their original state
              document.querySelectorAll('.date-button-ss').forEach(btn => {
                  btn.classList.remove('selected');
                  btn.style.backgroundColor = btn.getAttribute('data-available') === 'true' 
                      ? 'rgba(28, 53, 94, 0.1)' 
                      : '#ffffff';
                  btn.style.color = '#000000';
              });

              // If clicking the same date, unselect it
              if (isCurrentlySelected) {
                  document.getElementById('selectedDate').value = '';
                  resetTimeAndDurationDropdowns();
                  document.getElementById('noAvailabilityAlert').style.display = 'none';
                  document.getElementById('outsideHoursAlert').style.display = 'none';
                  return;
              }

              // Handle new date selection
              dateButton.classList.add('selected');
              dateButton.style.backgroundColor = '#1c355e';
              dateButton.style.color = 'white';
              document.getElementById('selectedDate').value = dateString;

              if (!hasAvailability) {
                  document.getElementById('noAvailabilityAlert').style.display = 'block';
                  document.getElementById('outsideHoursAlert').style.display = 'none';
                  resetTimeAndDurationDropdowns();
              } else {
                  document.getElementById('noAvailabilityAlert').style.display = 'none';
                  document.getElementById('outsideHoursAlert').style.display = 'none';
                  generateTimeSlots(showingAllHours);
              }
          }

          function resetTimeAndDurationDropdowns() {
              const timeSelect = document.querySelector('select[name="time"]');
              const durationSelect = document.querySelector('select[name="duration"]');
              
              // Reset time dropdown to just the placeholder
              timeSelect.innerHTML = '<option value="">Choose time</option>';
              
              // Reset duration dropdown to default options but disabled
              durationSelect.innerHTML = `
                  <option value="30">30 minutes</option>
                  <option value="60">1 hour</option>
              `;
              durationSelect.disabled = true;
          }

        function checkDateAvailability(dateString) {
            // Convert the date string to UTC to ensure consistent comparison
            const buttonDate = new Date(dateString + 'T00:00:00Z');
            
            return facultyAvailabilities.some(availability => {
                // Convert availability date to UTC for comparison
                const availabilityDate = new Date(availability.date + 'T00:00:00Z');
                return buttonDate.getTime() === availabilityDate.getTime();
            });
        }

        function getAvailabilityForDate(dateString) {
            return facultyAvailabilities.find(availability => 
                availability.date === dateString
            );
        }

        async function generateTimeSlots(showAll = false) {
            const select = document.querySelector('select[name="time"]');
            select.innerHTML = '<option value="">Choose time</option>';
            
            const selectedDate = document.getElementById('selectedDate').value;
            if (!selectedDate) return;
            const facultyId = sessionStorage.getItem('selected_faculty_id');
            
            try {
                const response = await fetch(`/appointment/available-slots/${facultyId}?date=${selectedDate}`);
                const data = await response.json();
                
                // Only disable select if we're not showing all hours AND there are no available slots
                if (!showAll) {
                    if (!data.timeSlots.length) {
                        select.disabled = true;
                        return;
                    }
                    // Add only available slots
                    select.disabled = false;
                    data.timeSlots.forEach(time => {
                        const option = document.createElement('option');
                        option.value = time;
                        option.textContent = time;
                        select.appendChild(option);
                    });
                } else {
                    // Always enable select when showing all hours
                    select.disabled = false;
                    // Generate all possible slots from 7:00 to 18:30
                    generateAllTimeSlots(select, data.bookedSlots || []);
                }
                
                updateDurationOptions();
            } catch (error) {
                console.error('Error fetching available time slots:', error);
            }
        }

        function generateAllTimeSlots(select, bookedSlots) {
            const startHour = 7;
            const endHour = 18;
            
            function timeToMinutes(timeString) {
                const [hours, minutes] = timeString.split(':').map(Number);
                return hours * 60 + minutes;
            }

            for (let hour = startHour; hour <= endHour; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    if (hour === endHour && minute > 30) continue;
                    
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const option = document.createElement('option');
                    option.value = timeString;
                    option.textContent = timeString;
                    
                    const slotTime = timeToMinutes(timeString + ':00');
                    option.disabled = bookedSlots.some(bookedSlot => {
                        const bookingStart = timeToMinutes(bookedSlot.start_formatted);
                        const bookingEnd = timeToMinutes(bookedSlot.end);
                        return slotTime >= bookingStart && slotTime < bookingEnd;
                    });
                    
                    select.appendChild(option);
                }
            }
        }

          function toggleTimeSlots() {
            showingAllHours = !showingAllHours;
            
            const toggleButton = document.querySelector('.toggle-hours-ss');
            toggleButton.textContent = showingAllHours ? 'Show Regular Hours' : 'Show All Hours';
            
            const selectedDate = document.getElementById('selectedDate').value;
            if (selectedDate) {
                generateTimeSlots(showingAllHours);
            }
            
            // Reset alerts based on current state
            const hasAvailability = checkDateAvailability(selectedDate);
            if (!showingAllHours) {
                document.getElementById('outsideHoursAlert').style.display = 'none';
                if (!hasAvailability) {
                    resetTimeAndDurationDropdowns();
                }
            }
        }

        function isTimeWithinRange(time, startTime, endTime) {
            const t = convertTimeToMinutes(time);
            const start = convertTimeToMinutes(startTime);
            const end = convertTimeToMinutes(endTime);
            return t >= start && t <= end;
        }

        function convertTimeToMinutes(time) {
            const [hours, minutes] = time.split(':').map(Number);
            return hours * 60 + minutes;
        }

        function updateDurationOptions() {
          const timeSelect = document.querySelector('select[name="time"]');
          const durationSelect = document.querySelector('select[name="duration"]');
          const selectedTime = timeSelect.value;
          const selectedDate = document.getElementById('selectedDate').value;
          const availability = getAvailabilityForDate(selectedDate);

          if (!selectedTime) {
              durationSelect.disabled = true;
              return;
          }

          durationSelect.disabled = false;

          const [hours, minutes] = selectedTime.split(':').map(Number);
          const selectedTimeMinutes = hours * 60 + minutes;

          // Calculate end time based on availability or default end time
          let endTimeMinutes;
          if (availability && !showingAllHours) {
              const [availEndHours, availEndMinutes] = availability.end_time.split(':').map(Number);
              endTimeMinutes = availEndHours * 60 + availEndMinutes;
          } else {
              endTimeMinutes = 18 * 60 + 30; // 6:30 PM
          }

          const availableMinutes = endTimeMinutes - selectedTimeMinutes;

          durationSelect.innerHTML = '';

          if (availableMinutes >= 30) {
              durationSelect.add(new Option('30 minutes', '30'));
          }
          if (availableMinutes >= 60) {
              durationSelect.add(new Option('1 hour', '60'));
          }

          if (durationSelect.options.length === 0) {
              durationSelect.add(new Option('No available duration', ''));
              durationSelect.disabled = true;
          }

          // Show outside hours alert if needed
          if (availability && showingAllHours) {
              const isWithinAvailability = isTimeWithinRange(
                  selectedTime,
                  availability.start_time,
                  availability.end_time
              );
              document.getElementById('outsideHoursAlert').style.display = 
                  isWithinAvailability ? 'none' : 'block';
          }
      }

        // Initialize when page loads
          document.addEventListener('DOMContentLoaded', function() {
            const timeSelect = document.querySelector('select[name="time"]');
            timeSelect.addEventListener('change', updateDurationOptions);
            
            // Initialize with disabled time dropdown
            timeSelect.disabled = true;
            
            generateDateGrid();
            fetchFacultyAvailabilities();
        });

        // Add this script section to select-schedule.blade.php
document.addEventListener('DOMContentLoaded', function() {
    // Restore previously selected date and time from sessionStorage
    const savedDate = sessionStorage.getItem('appointment_date');
    const savedTime = sessionStorage.getItem('appointment_time');
    const savedDuration = sessionStorage.getItem('appointment_duration');

    if (savedDate) {
        // Wait for date grid to be populated and faculty availabilities to be fetched
        const checkGridInterval = setInterval(() => {
            const dateButton = document.querySelector(`[data-date="${savedDate}"]`);
            if (dateButton) {
                clearInterval(checkGridInterval);
                // Trigger click on the saved date
                dateButton.click();
                
                // After date is selected, restore time and duration
                if (savedTime) {
                    const timeSelect = document.querySelector('select[name="time"]');
                    const checkTimeInterval = setInterval(() => {
                        if (timeSelect && !timeSelect.disabled) {
                            clearInterval(checkTimeInterval);
                            timeSelect.value = savedTime;
                            timeSelect.dispatchEvent(new Event('change'));
                            
                            // Restore duration after time is set
                            if (savedDuration) {
                                const durationSelect = document.querySelector('select[name="duration"]');
                                durationSelect.value = savedDuration;
                            }
                        }
                    }, 100);
                }
            }
        }, 100);
    }

    // Add event listeners to save selections
    document.querySelectorAll('.date-button-ss').forEach(button => {
        button.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            sessionStorage.setItem('appointment_date', date);
        });
    });

    document.querySelector('select[name="time"]').addEventListener('change', function() {
        sessionStorage.setItem('appointment_time', this.value);
    });

    document.querySelector('select[name="duration"]').addEventListener('change', function() {
        sessionStorage.setItem('appointment_duration', this.value);
    });

    // Clear storage when form is submitted
    document.getElementById('scheduleForm').addEventListener('submit', function() {
        // Don't clear storage here - we'll clear it after successful appointment creation
    });
});
    </script>
</body>
</html>