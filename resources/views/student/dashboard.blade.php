
<x-dashboard-layout :user="$user">
<div class="student-dashboard">
    <div class="student-fullname">
            <div class="hello-student">Hello,</div>
            <div class="student-name">Marielle</div>  
    </div>

    <!-- <div class="overlap-fs-2">
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
                </nav> -->

<div class="dashboard-overview">APPOINTMENTS OVERVIEW</div>
    <div class="appointment-list-sd">
        <div class="appointment-scroll">
            <div class="placeholder-container-sd">
                @for($i = 0; $i < 10; $i++)
                <div class="appointment-wrapper-ovrvw">
                    <div class="appointment-placeholder-sd">
                        <div class="appointment-date-sd">
                            <span class="date-sd">{{ str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="month-sd">{{ ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Oct', 'Jan', 'Oct'][rand(0, 7)] }}</span>
                        </div>
                        <div class="appointment-details-sd">
                            <span class="prof-name">Prof. {{ ['Smith', 'Johnson', 'Williams', 'Brown', 'Davis', 'Sanxian', 'Bando', 'Marielle'][rand(0, 7)] }}</span>
                            <span class="prof-college">College of {{ ['Engineering', 'Arts', 'Agriculture, Food, Environment and Natural Resources', 'Education', 'Criminal Justice', 'Economics, Management and Development Studies', 'Science'][rand(0, 6)] }}</span>
                            
                        </div>
                        <div class="appointment-time-sd">
                            <span class="prof-time">{{ str_pad(rand(8, 16), 2, '0', STR_PAD_LEFT) }}:00 {{ rand(0, 1) ? 'AM' : 'PM' }}</span>
                            <span class="prof-duration">30 Min</span>
                        </div>
                    </div>
                        <button class="cancel-apt-sd" onclick="cancelAppointment(this)">&times;</button>
                </div>
                    <div class="no-app-yet">No approved appointments</div>
                @endfor
            </div>
        </div>
    </div>
    <div class="pending-overview">PENDING APPOINTMENTS</div>
    <div class="pending-list-sd">
        <div class="pending-scroll">
            <div class="pending-container-sd">
                @for($i = 0; $i < 10; $i++)
                <div class="pending-wrapper-ovrvw">
                    <div class="pending-placeholder-sd">
                        <div class="pending-date-sd">
                            <span class="date-sd">{{ str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="month-sd">{{ ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Oct', 'Jan', 'Oct'][rand(0, 7)] }}</span>
                        </div>
                        <div class="pending-details-sd">
                            <span class="prof-name">Prof. {{ ['Smith', 'Johnson', 'Williams', 'Brown', 'Davis', 'Sanxian', 'Bando', 'Marielle'][rand(0, 7)] }}</span>
                            <span class="prof-college">College of {{ ['Engineering', 'Arts', 'Agriculture, Food, Environment and Natural Resources', 'Education', 'Criminal Justice', 'Economics, Management and Development Studies', 'Science'][rand(0, 6)] }}</span>
                            
                        </div>
                        <div class="pending-time-sd">
                            <span class="prof-time">{{ str_pad(rand(8, 16), 2, '0', STR_PAD_LEFT) }}:00 {{ rand(0, 1) ? 'AM' : 'PM' }}</span>
                            <span class="prof-duration">30 Min</span>
                        </div>
                    </div>
                        <button class="cancel-apt-sd" onclick="cancelAppointment(this)">&times;</button>
                </div>
                    <div class="no-app-yet">No approved appointments</div>
                @endfor
            </div>
        </div>
    </div>
    <div class="no-book">
        <p>Make an appointment </p>
    </div>
    <div class="apt">
        <button class="apt-here-button" onclick="window.location.href='/faculty-availability'">Book Now</button>
    </div>
</div>
</div>

<script>
    function scrollToNewAppointment() {
    const scrollContainer = document.querySelector('.appointment-scroll');
    scrollContainer.scrollTop = scrollContainer.scrollHeight;
}


function cancelAppointment(button) {
    const isConfirmed = confirm("Are you sure you want to cancel this appointment?");
    
    if (isConfirmed) {
        const appointmentWrapper = button.closest('.appointment-wrapper-ovrvw');
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
    }
}
</script>
</x-dashboard-layout>