<x-dashboard-layout :user="$user">

@section('content')
<div class="container">
    <h1>Set Your Availability</h1>
    <form method="POST" action="{{ route('faculty.availability.store') }}" id="availabilityForm">
        @csrf
        <div class="mb-3">
            <label for="day_of_week" class="form-label">Day of the Week:</label>
            <select name="day_of_week" id="day_of_week" class="form-control" required>
                <option value="" disabled selected style="display: none;">Select a day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time:</label>
            <select name="start_time" id="start_time" class="form-control" required>
                @for ($i = 7; $i <= 18; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time:</label>
            <select name="end_time" id="end_time" class="form-control" required>
                @for ($i = 7; $i <= 18; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn-success">Save Availability</button>
    </form>
</div>

<script>
    document.getElementById('availabilityForm').addEventListener('submit', function(event) {
        // Get the selected start and end times
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;

        // Compare the times
        if (startTime === endTime) {
            // Alert if start time is the same as end time
            alert("Start time cannot be the same as end time.");
            event.preventDefault();  // Prevent form submission
        } else if (startTime > endTime) {
            // Alert if start time is later than end time
            alert("End time cannot be earlier than start time.");
            event.preventDefault();  // Prevent form submission
        }
    });
</script>

</x-dashboard-layout>
