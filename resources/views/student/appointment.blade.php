<!DOCTYPE html>
<html>
<head>
    <x-heading-preset />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
</head>
<body>
    <div class="appointment-facultysearch">
        <div class="overlap-wrapper-fs">
            <div class="dropdown">
                <button class="dropdown-button" id="selected-college" onclick="toggleDropdown()">
                    Select College
                    <span class="arrow-down">&#9662;</span>
                </button>

                <div class="dropdown-content" id="dropdown-content">
                    @foreach ($collegeDepartments as $department)
                        <div 
                            class="dropdown-item" 
                            onclick="updateSelected('{{ $department->id }}', '{{ $department->college_name }} - {{ $department->acronym }}')"
                            data-id="{{ $department->id }}"
                            data-college="{{ $department->college_name }} - {{ $department->acronym }}"
                        >
                            {{ $department->college_name }} - {{ $department->acronym }}
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Hidden input to store selected department -->
            <input type="hidden" name="college_department_id" id="college_department_id" value="{{ old('college_department_id', $faculty->college_department_id ?? '') }}">

            <script src="script-fs.js"></script>

            <script>
                function toggleDropdown() {
                    const dropdownContent = document.getElementById("dropdown-content");
                    dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
                }

                function updateSelected(id, collegeName) {
                    const dropdownButton = document.getElementById("selected-college");
                    dropdownButton.innerText = collegeName + " ▼"; // Update the button text with selected college

                    // Set the value of hidden input for form submission
                    document.getElementById("college_department_id").value = id;

                    // Hide dropdown after selection
                    document.getElementById("dropdown-content").style.display = "none";

                    // Fetch the faculty list based on department ID
                    fetch(`/appointment/faculty-list/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            // Clear previous faculty list
                            const facultyListContainer = document.querySelector(".faculty-list-items");
                            facultyListContainer.innerHTML = '';

                            // Populate new faculty list
                            data.faculties.forEach(faculty => {
                                const li = document.createElement('li');
                                li.innerText = `${faculty.first_name} ${faculty.last_name}`;
                                li.onclick = function() {
                                    displayFacultyInformation(faculty);  // Display faculty details when clicked
                                };
                                facultyListContainer.appendChild(li);
                            });
                        });
                }

                // Display faculty information when clicked
                // Update the displayFacultyInformation function
                function displayFacultyInformation(faculty) {
                    // Existing faculty details code
                    document.querySelector(".faculty-details p:nth-child(1)").innerText = `College: ${faculty.college_name}`;
                    document.querySelector(".faculty-details p:nth-child(2)").innerText = `Name: ${faculty.first_name} ${faculty.last_name}`;
                    document.querySelector(".faculty-details p:nth-child(3)").innerText = `Department: ${faculty.department}`;
                    document.querySelector(".faculty-details p:nth-child(4)").innerText = `Email: ${faculty.email}`;
                    document.querySelector(".faculty-details p:nth-child(5)").innerText = `Bldg. & Room Code: ${faculty.bldg_no}`;

                    // Add this to initialize calendar when faculty is selected
                    initializeFacultyCalendar(faculty.id);

                    const bookButton = document.querySelector(".book-button");
                    bookButton.onclick = function() {
                        // Store the faculty ID in both sessionStorage and Laravel session
                        sessionStorage.setItem('selected_faculty_id', faculty.id);
                        fetch('/session/store-faculty', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ faculty_id: faculty.id })
                        }).then(() => {
                            window.location.href = `/select-schedule`;
                        });
                    };
                }

        // Add this new function for calendar initialization
        function initializeFacultyCalendar(facultyId) {
            // Destroy existing calendar if it exists
            if ($('#faculty-calendar').hasClass('fc')) {
                $('#faculty-calendar').fullCalendar('destroy');
            }

            // Fetch faculty availability
            fetch(`/appointment/faculty-availability/${facultyId}`)
                .then(response => response.json())
                .then(data => {
                    const events = [];
                    const currentDate = moment().startOf('day');
                    const startOfWeek = currentDate.clone().startOf('week');
                    
                    // Convert availabilities to calendar events
                    data.availabilities.forEach(function(availability) {
                        const dayMap = {
                            'Monday': 1, 'Tuesday': 2, 'Wednesday': 3,
                            'Thursday': 4, 'Friday': 5, 'Saturday': 6
                        };
                        const dayIndex = dayMap[availability.day_of_week];
                        
                        // Create events for the next 4 weeks
                        for (let week = 0; week < 4; week++) {
                            const eventDate = startOfWeek.clone().add(week, 'weeks').add(dayIndex, 'days');
                            
                            // Only add events for current and future dates
                            if (eventDate.isSameOrAfter(currentDate)) {
                                events.push({
                                    title: 'Available',
                                    start: eventDate.format('YYYY-MM-DD') + 'T' + availability.start_time,
                                    end: eventDate.format('YYYY-MM-DD') + 'T' + availability.end_time,
                                    className: 'availability-event',
                                    rendering: 'background'
                                });
                            }
                        }
                    });

                    // Initialize calendar
                    $('#faculty-calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'agendaWeek,agendaDay'
                        },
                        defaultView: 'agendaWeek',
                        height: 'auto',
                        slotDuration: '00:30:00',
                        slotLabelFormat: 'h:mm A',
                        minTime: '07:00:00',
                        maxTime: '19:00:00',
                        allDaySlot: false,
                        events: events,
                        validRange: {
                            start: currentDate.format('YYYY-MM-DD'),
                            end: currentDate.clone().add(2, 'weeks').format('YYYY-MM-DD')
                        },
                        eventRender: function(event, element) {
                            if (event.className.includes('availability-event')) {
                                element.css('opacity', '0.7');
                            }
                        },
                        businessHours: {
                            dow: [1,2,3,4,5,6], // Monday - Saturday
                            start: '07:00',
                            end: '19:00',
                        },
                        viewRender: function(view, element) {
                            // Disable the prev button if the view's start date is before today
                            const viewStart = view.start.clone().startOf('day');
                            $('.fc-prev-button').prop('disabled', viewStart.isSameOrBefore(currentDate));
                        }
                    });
                });
        }

                window.onclick = function(event) {
                    if (!event.target.closest('.dropdown')) {
                        const dropdownContent = document.getElementById("dropdown-content");
                        dropdownContent.style.display = "none";
                    }
                }

                window.onload = function () {
                    const dropdownContent = document.getElementById("dropdown-content");
                    dropdownContent.style.display = "none";  // Ensure dropdown is hidden initially
                };
            </script>

            <div class="overlap-fs"></div>

            <!-- Other Sections -->
            <div class="college-selection-group">
                <img class="select-college" src="assets/images/college selection.png" />
                <div class="college-selection"><div class="faculty-wrapper-1">College Selection</div></div>
                <div class="college-selection-caption"><div class="caption">Find Professors in their respective colleges</div></div>
            </div>

            <div class="overlap-group-fs">
                <img class="faculty-schedule" src="assets/images/faculty schedule.png" />
                <div class="colleges-section">
                    <div class="faculty-wrapper">Faculty Schedule</div>
                </div>
                <!-- Add this div for the calendar -->
                <div id="faculty-calendar" class="calendar-content"></div>
            </div>

            <div class="div-fs">
                <div class="faculty-details">
                    <p>College: </p>
                    <p>Name: </p>
                    <p>Position: </p>
                    <p>Email: </p>
                    <p>Bldg. & Room Code: </p>
                </div>
                <img class="faculty-information" src="assets/images/faculty information.png" />
                <div class="div-wrapper-fs">
                    <div class="faculty-wrapper">Faculty Information</div>
                </div>
                <button class="book-button">Book Here</button>
            </div>

            <div class="colleges-section-wrapper">
                <img class="faculty-list" src="assets/images/faculty list.png"/>
                <div class="colleges-section-2">
                    <div class="faculty-wrapper">Faculty List</div>
                    <ul class="faculty-list-items placeholder">
                        <!-- Faculty list will be populated here -->
                    </ul>
                </div>
            </div>

            <div class="overlap-fs-2">
                <img class="rectangle-fs" src="assets/images/Rectangle 39912.png" />
                <div class="iskodyul-logo">
                    <div class="overlap-group-2-fs">
                        <div class="dyul-fs">DYUL</div>
                        <div class="isko-fs">ISKO</div>
                    </div>
                </div>
                <nav class="menu-group">
                    <a href="/student-dashboard">DASHBOARD</a>
                    <a href="/appointment" class="appointment">APPOINTMENT</a>
                    <a href="about.html">ABOUT</a>
                    <a href="/logout" class="logout-fs">LOGOUT</a>
                </nav>

                <img class="line-fs" src="assets/images/line.png" />
                <div class="group-fs">
                    <div class="overlap-fs-3">
                        <img class="img-fs-3" src="assets/images/triangle select sched.png" />
                        <div class="rectangle-fs-2"></div>
                        <div class="frame-fs"><div class="select-schedule">Select Schedule</div></div>
                    </div>
                </div>
                <div class="overlap-group-wrapper-fs">
                    <div class="overlap-fs-3">
                        <img class="img-fs-2" src="assets/images/triangle selected (fs).png" />
                        <div class="faculty-search-fs"></div>
                        <div class="frame-fs-2"><div class="faculty-search-text">Faculty Search</div></div>
                    </div>
                </div>
                <div class="group-2-fs">
                    <div class="overlap-3">
                        <img class="img-fs-4" src="assets/images/triangle info.png" />
                        <div class="rectangle-fs-3"></div>
                        <div class="frame-fs-3"><div class="information-fs">Information</div></div>
                    </div>
                </div>
                <div class="frame-wrapper-fs">
                    <div class="frame-fs-4"><div class="confirmation-fs">Confirmation</div></div>
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

</body>
</html>