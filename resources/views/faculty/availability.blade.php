<x-dashboard-layout :user="$user">
    <div class="container">
        <h1>Set Your Availability</h1>
        
        <!-- Current Availabilities Table -->
        <div class="current-availabilities mb-4">
            <h2>Current Availabilities</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availabilities as $availability)
                            <tr>
                                <td>{{ $availability->day_of_week }}</td>
                                <td>{{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('faculty.availability.destroy', $availability->id) }}" 
                                          class="delete-form" onsubmit="return confirm('Are you sure you want to delete this availability?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 50px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Availability Form -->
        <div class="add-availability">
            <h2>Add New Availability</h2>
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
                <div class="save-button-container">
                    <button type="submit" class="btn-success">Save Availability</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .appointment-facultysearch .btn-success {
        position: relative;
        height: 80px;
        width: 350px;
        left: 1100px;
        font-size: 35px;
    }
    
    .current-availabilities {
        margin-top: 20px;
        margin-bottom: 40px;
    }
    
    .table {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .btn-danger {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
    }
    
    .delete-form {
        display: inline-block;
    }
    
    .add-availability {
        margin-top: 30px;
    }
    </style>

    <script>
        document.getElementById('availabilityForm').addEventListener('submit', function(event) {
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;
        
        if (startTime === endTime) {
            alert("Start time cannot be the same as end time.");
            event.preventDefault();
        } else if (startTime > endTime) {
            alert("End time cannot be earlier than start time.");
            event.preventDefault();
        }
    });
    </script>
</x-dashboard-layout>