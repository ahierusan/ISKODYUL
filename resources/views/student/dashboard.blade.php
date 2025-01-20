
<x-dashboard-layout :user="$user">
<div class="student-dashboard">
    <div class="student-fullname">
            <div class="hello-student">Hello,</div>
            <div class="student-name">Marielle</div>  
    </div>

    <div class="dashboard-overview">APPOINTMENTS OVERVIEW</div>
    <div class="appointment-list-sd">
    <div class="appointment-scroll">
        <div class="placeholder-container-sd">
            @for ($i = 0; $i < 10; $i++)
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
            @endfor
        </div>
    </div>
    </div>
</div>
</div>

<script>
    function scrollToNewAppointment() {
    const scrollContainer = document.querySelector('.appointment-scroll');
    scrollContainer.scrollTop = scrollContainer.scrollHeight;
}

// Call this whenever a new appointment is added
// scrollToNewAppointment();
</script>
</x-dashboard-layout>