
<x-dashboard-layout :user="$user">
<div class="student-dashboard">
    <div class="student-fullname">
        <div class="hello-student">Hello,</div>
        <div class="student-name">{{ $user->name }}</div>  
    </div>

    <div class="dashboard-overview">APPOINTMENTS OVERVIEW</div>
    <div class="appointment-list-sd">
        <div class="appointment-scroll">
            <div class="placeholder-container-sd">
                @if($appointments->isNotEmpty())
                    @foreach($appointments as $appointment)
                    <div class="appointment-wrapper-ovrvw" data-id="{{ $appointment->id }}">
                        <div class="appointment-placeholder-sd">
                            <div class="appointment-date-sd">
                                <span class="date-sd">{{ \Carbon\Carbon::parse($appointment->date)->format('d') }}</span>
                                <span class="month-sd">{{ \Carbon\Carbon::parse($appointment->date)->format('M') }}</span>
                            </div>
                            <div class="appointment-details-sd">
                                <span class="prof-name">Prof. {{ $appointment->faculty->first_name }} {{ $appointment->faculty->last_name }}</span>
                                <span class="prof-college">{{ $appointment->faculty->collegeDepartment->college_name }}</span>
                            </div>
                            <div class="appointment-time-sd">
                                <span class="prof-time">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</span>
                                <span class="prof-duration">{{ $appointment->duration }} Min</span>
                            </div>
                        </div>
                        <button class="cancel-apt-sd" onclick="cancelAppointment({{ $appointment->id }})">&times;</button>
                    </div>
                    @endforeach
                @else
                    <div class="no-app-yet">No approved appointments</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function cancelAppointment(appointmentId) {
    const isConfirmed = confirm("Are you sure you want to cancel this appointment?");
    
    if (isConfirmed) {
        const appointmentWrapper = document.querySelector(`.appointment-wrapper-ovrvw[data-id="${appointmentId}"]`);
        
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

// Add CSS for smooth animations
document.head.insertAdjacentHTML('beforeend', `
    <style>
    .appointment-wrapper-ovrvw {
        transition: all 0.3s ease;
    }
    </style>
`);
</script>
</x-dashboard-layout>