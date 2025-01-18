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
    font-size: 75px;
}

/* Toggle hours button positioning */
.toggle-hours-ss {
    position: relative;
    width: 800px;
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
                                <div class="section-title-ss">Select Date</div>
                                <input type="hidden" name="date" id="selectedDate" required>
                                <div class="date-grid-ss" id="dateGrid"></div>
                            </div>

                            <div class="time-duration-grid-ss">
                                <div>
                                    <div class="section-title-ss">Select Time</div>
                                    <button type="button" class="toggle-hours-ss" onclick="toggleTimeSlots()">
                                        Show All Hours
                                    </button>
                                    <select name="time" class="form-control-ss" required>
                                        <option value="">Choose time</option>
                                    </select>
                                </div>

                                <div>
                                    <div class="section-title-ss">Select Duration</div>
                                    <select name="duration" class="form-control-ss" required>
                                        <option value="30">30 minutes</option>
                                        <option value="60">1 hour</option>
                                        <option value="90">1.5 hours</option>
                                        <option value="120">2 hours</option>
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
        let showingAllHours = false;

        function generateDateGrid() {
            const grid = document.getElementById('dateGrid');
            const today = new Date();
            const twoWeeksLater = new Date();
            twoWeeksLater.setDate(today.getDate() + 14);

            grid.innerHTML = '';

            for (let d = new Date(today); d <= twoWeeksLater; d.setDate(d.getDate() + 1)) {
                const dateButton = document.createElement('div');
                dateButton.className = 'date-button-ss';
                
                const weekday = d.toLocaleDateString('en-US', { weekday: 'short' });
                const day = d.getDate();
                const month = d.toLocaleDateString('en-US', { month: 'short' });
                
                dateButton.innerHTML = `
                    <div class="date-weekday-ss">${weekday}</div>
                    <div class="date-day-ss">${day}</div>
                    <div class="date-weekday-ss">${month}</div>
                `;

                const dateString = d.toISOString().split('T')[0];
                dateButton.setAttribute('data-date', dateString);

                dateButton.addEventListener('click', function() {
                    document.querySelectorAll('.date-button-ss').forEach(btn => btn.classList.remove('selected'));
                    this.classList.add('selected');
                    document.getElementById('selectedDate').value = dateString;
                });

                grid.appendChild(dateButton);
            }
        }

        function generateTimeSlots(showAll = false) {
            const select = document.querySelector('select[name="time"]');
            select.innerHTML = '<option value="">Choose time</option>';
            
            const startHour = showAll ? 0 : 8;
            const endHour = showAll ? 24 : 17;

            for (let hour = startHour; hour < endHour; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const option = document.createElement('option');
                    option.value = timeString;
                    option.textContent = timeString;
                    select.appendChild(option);
                }
            }
        }

        function toggleTimeSlots() {
            showingAllHours = !showingAllHours;
            generateTimeSlots(showingAllHours);
            
            const toggleButton = document.querySelector('.toggle-hours-ss');
            toggleButton.textContent = showingAllHours ? 'Show Regular Hours' : 'Show All Hours';
            
            const outsideHoursAlert = document.getElementById('outsideHoursAlert');
            outsideHoursAlert.style.display = showingAllHours ? 'block' : 'none';
        }

        // Initialize
        generateDateGrid();
        generateTimeSlots();

        // Form validation
        document.getElementById('scheduleForm').addEventListener('submit', function(event) {
            const date = document.getElementById('selectedDate').value;
            const time = document.querySelector('select[name="time"]').value;
            
            if (!date || !time) {
                event.preventDefault();
                alert('Please select both date and time');
                return;
            }

            const selectedDateTime = new Date(date + 'T' + time);
            const now = new Date();

            if (selectedDateTime < now) {
                event.preventDefault();
                alert('Cannot select past date and time');
                return;
            }
        });
    </script>
</body>
</html>