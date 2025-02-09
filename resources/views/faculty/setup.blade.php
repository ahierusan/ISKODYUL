<!DOCTYPE html>
<html>
<head>
    <x-heading-preset />
<style>
        .faculty-setup {
            background-color: #ffffff;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .faculty-setup .overlap-wrapper-faculty-setup {
            background-color: #ffffff;
            overflow: hidden;
            box-shadow: 0px 4px 4px #00000040, 0px 4px 4px #00000040;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: stretch;
        }

        .faculty-setup .overlap-faculty-setup {
            position: relative;
            width: 100%;
            height: auto;
        }
        .faculty-setup .rectangle-faculty-setup {
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(-65deg, rgb(255, 255, 255, 0.7) 0%, rgb(236, 243, 158, 0.9) 100%);
            position: absolute;
            top: 0;
            left: 0;
        }

        .faculty-setup .category {
            position: absolute;
            top: 300px;

        }

        .faculty-setup .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px 90px;
            width: 2900px;
            height: 570px;;
            padding: 50px;
            background-color: none;
            border-radius: 25px;
            position: absolute;
            top: 1200px; 
            left: -550px;
        }
        .faculty-setup .form-container input[type="text"] {
            position: relative;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 30px;
            background-color: #ffffff;
            box-shadow: 0px 10px 15px #31572c9d;
            top: 0;
            left: 1335px;
            font-size: 45px;
            font-family: "FONTSPRING DEMO - Proxima Nova Regular", Helvetica;
            color: #555;
            padding: 20px;
        }
        .faculty-setup .form-container input[type="text"]::placeholder {
            color: #999;
        }

        .faculty-setup .form-container input[type="text"]::focus {
            box-shadow: 0 4px 20px #132a13;
            outline: none;
        }

        .faculty-setup .form-container select {
            position: relative;
            left: 1330px;
            width: 103%;
            padding: 50px;
            background-color: none;
            border-radius: 25px;
            font-size: 45px;
            font-family: "FONTSPRING DEMO - Proxima Nova Regular", Helvetica;
            color: #555;
            padding: 20px;
            padding: 10px;
            border: none;
            border-radius: 30px;
            background-color: #ffffff;
            box-shadow: 0px 10px 15px #31572c9d;
        }
        .faculty-setup. .form-container select option[disabled] {
            color: #999;

        }

        .faculty-setup .dropdown-options {
            position: relative;
            top: 940px;
            left: 3830px;
            width: 85%;
            height: 160px;
            padding: 50px;
            background-color: none;
            border-radius: 25px;
            font-size: 45px;
            font-family: "FONTSPRING DEMO - Proxima Nova Regular", Helvetica;
            color: #555;
            padding: 20px;
            padding: 10px;
            border: none;
            border-radius: 30px;
            background-color: #ffffff;
            box-shadow: 0px 10px 15px #31572c9d;
            margin-bottom: 50px;
        }
        .faculty-setup .wavy-faculty-setup {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0px;
                left: 0px;
                object-fit: cover;
                rotate: 180deg;
                transform: scaleX(-1);
            }
        .faculty-setup .layat-diwa-faculty-setup {
            position: relative;
            width: 41.4%;
            height: auto;
            top: 10px;
            left: 3500px;
            object-fit: cover;
        }
        .faculty-setup .wavy-faculty-setup {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0px;
                left: 0px;
                object-fit: cover;
            }
        .faculty-setup .text-faculty-setup {
            position: absolute;
            gap: 50px 90px;
            width: 381px;
            height: 90px;
            top: 300px;
            left: 1200px;
        }

        .faculty-setup .faculty-information {
            position: absolute;
            top: 400px;
            left: 830px;
            font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
            font-weight: 700;
            color: #132a13;
            font-size: 200px;
            letter-spacing: 3px;
            line-height: 90px;
            white-space: nowrap;
        }

        .faculty-setup .div-wrapper-faculty-setup {
            position: absolute;
            width: 294px;
            height: 38px;
            top: 700px;
            left: 1165px;
        }

        .faculty-setup .div-faculty-setup {
            position: absolute;
            top: 250px;
            left: 1300px;
            font-family: "FONTSPRING DEMO - Proxima Nova Alt Regular", Helvetica;
            font-weight: 400;
            color: #132a13;
            font-size: 90px;
            letter-spacing: 0;
            line-height: 37.5px;
            white-space: nowrap;
        }

        .faculty-setup .iskodyul-faculty-setup {
            position: absolute;
            width: 243px;
            top: 300px;
            left: 2500px;
            transform: rotate(0.45deg);
            font-family: "FONTSPRING DEMO - Proxima Nova Black", Helvetica;
            font-weight: 400;
            color: transparent;
            font-size: 180px;
            letter-spacing: 0;
            line-height: 60px;
            white-space: nowrap;
        }

        .faculty-setup .isko-faculty-setup {
            color: #31572c;
            position: relative;
            margin-right: -75px;
        }

        .faculty-setup .dyul-faculty-setup {
            color: #4f772d;
        }
        .faculty-setup .back-arrow-login-link:hover {
                transform: scale(1.1);
            }
        .faculty-setup .confirm-button-faculty-setup,
        .faculty-setup .back-button-faculty-setup {
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            
        }
        .faculty-setup .confirm-button-faculty-setup {
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
            box-sizing: border-box;
            position: absolute;
            width: 455px;
            height: 123px;
            top: 900px;
            left: 3300px;
            background-color: #31572c;
            border-radius: 50px;
            overflow: hidden; 
            text-align: center;
            display: flex;
            object-fit: contain;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;

        }
        .faculty-setup .confirm-button-faculty-setup:hover {
            background-color: #4f772d;
            box-shadow: 0px 4px 8px rgba(0,0,0, 0.2);
        }
        .faculty-setup .confirm-button-faculty-setup:active {
            background-color: #132a13;
        }
        .faculty-setup .confirm-button {
            position: absolute;
            top: 44px;
            left: 107px;
            font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
            font-weight: 700;
            color: #ffffff;
            font-size: 60px;
            text-align: center;
            line-height: 30px;
            white-space: nowrap;
        }
        .faculty-setup .back-button-faculty-setup {
            position: absolute;
            width: 455px;
            height: 125px;
            top: 2260px;
            left: 2750px;
            border-radius: 50px;
            overflow: hidden;
            border: 3px solid #31572c;
            background-color: transparent;
            display: flex;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .faculty-setup .back-button-faculty-setup:hover {
            background-color: rgba(49, 87, 44, 0.2);
            box-shadow: 0px 4px 8px rgba(0,0,0, 0.2);
        }
        
        .faculty-setup .back-button-faculty-setup:active {
            background-color: rgba(49, 87, 44, 0.4);
        }
            
        .faculty-setup .back-button {
            position: relative;
            width: 250px;
            height: 100px;
            top: 9px;
            left: 21px;
        }
        .faculty-setup .back-button-2 {
            position: absolute;
            top: 15px;
            left: 125px;
            font-family: "FONTSPRING DEMO - Proxima Nova-Bold", Helvetica;
            font-weight: 700;
            color: #132a13;
            font-size: 60px;
            text-align: center;
            white-space: nowrap;
        }
        .faculty-setup .group {
            position: absolute;
            width: 73px;
            height: 73px;
            top: 5px;
            left: 0;
            background-color: #31572c;
            border-radius: 40px;
        }
        .faculty-setup .back-arrow-faculty-setup {
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 99;
            }
        .faculty-setup .back-arrow-faculty-setup-link {
                position: absolute;
                width: 100px;
                height: 100px;
                top: 300px;
                left: 500px;
                display: inline-block;
                cursor: pointer;
                transition: transform 0.3s ease;
                z-index: 999;
            }

        .faculty-setup .college_department_id {
            position: absolute;
            width: 2900px;
            height: 570px;
            left: 200px;
        }


    </style>
</head>
<body>
    <div class="faculty-setup">
        <div class="overlap-wrapper-faculty-setup">
            <div class="overlap-faculty-setup">
                <img class="wavy-faculty-setup" src="assets/images/wavy.png"/>
                <div class="rectangle-faculty-setup"></div>
                <img class="layat-diwa-faculty-setup" src="assets/images/layat diwa full.png" />
                <div class="text-faculty-setup">
                    <div class="faculty-information">Faculty Information</div>
                </div>
                <div class="div-wrapper-faculty-setup">
                    <div class="div-faculty-setup">Set-up your account</div>
                </div>
                <p class="iskodyul-faculty-setup">
                    <span class="isko-faculty-setup">ISKO</span>
                    <span class="dyul-faculty-setup">DYUL</span>
                </p>
               <form method="POST" action="/faculty-setup" class="form-container">
                    @csrf

                    @php
                        $faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first(); // Fetch faculty data for the logged-in user
                        $inquiryCategories = json_decode($faculty->inquiry_categories, true);
                    @endphp

                    <!-- Check if faculty data exists for the user -->
                    @if ($faculty)
                        <!-- Pre-fill the input fields if data exists -->
                        <input type="text" name="first_name" id="first-name" placeholder="{{ $faculty->first_name }}" value="{{ $faculty->first_name }}" required>
                        <input type="text" name="last_name" id="last-name" placeholder="{{ $faculty->last_name }}" value="{{ $faculty->last_name }}" required>

                        <!-- Pre-select the college department based on the faculty's college_department_id -->
                        <select name="college_department_id" required>
                            <option value="" disabled selected style="color: #999;">Select your college</option>
                            @foreach ($collegeDepartments as $department)
                                <option value="{{ $department->id }}" {{ $faculty->college_department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->college_name }} - {{ $department->acronym }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" name="department" id="department" placeholder="{{ $faculty->department }}" value="{{ $faculty->department }}" required>
                        <input type="text" name="fb_link" id="fb-link" placeholder="{{ $faculty->fb_link ?? 'Facebook Link (Optional)' }}" value="{{ $faculty->fb_link }}">
                        <input type="text" name="bldg_no" id="bldg-no" placeholder="{{ $faculty->bldg_no }}" value="{{ $faculty->bldg_no }}">
                    @else
                        <!-- Placeholder text for when no data exists for the user -->
                        <input type="text" name="first_name" id="first-name" placeholder="First Name" required>
                        <input type="text" name="last_name" id="last-name" placeholder="Last Name" required>

                        <select name="college_department_id" placeholder="College" required>
                            @foreach ($collegeDepartments as $department)
                                <option value="{{ $department->id }}" {{ old('college_department_id', $user->college_department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->college_name }} - {{ $department->acronym }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" name="department" id="department" placeholder="Department (e.g. DIT)" required>
                        <input type="text" name="fb_link" id="fb-link" placeholder="Facebook Link (Optional)">
                        <input type="text" name="bldg_no" id="bldg-no" placeholder="Building Room No. (e.g. DIT CS UNIT)">
                    @endif


<!-- Update the JavaScript to populate these hidden inputs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const advisingSelect = document.querySelector('select[name="dropdown1"]');
    const thesisSelect = document.querySelector('select[name="dropdown2"]');
    const gradeSelect = document.querySelector('select[name="dropdown3"]');
    const form = document.querySelector('form');

    // Populate dropdowns with existing values if available
    @php
        $faculty = App\Models\Faculty::where('user_id', auth()->user()->id)->first();
        $inquiryCategories = $faculty ? json_decode($faculty->inquiry_categories, true) : null;
    @endphp

    @if($inquiryCategories)
        advisingSelect.value = "{{ $inquiryCategories['advising'] }}";
        thesisSelect.value = "{{ $inquiryCategories['undergraduate_thesis'] }}";
        gradeSelect.value = "{{ $inquiryCategories['grade_consultation'] }}";
    @endif

    // Function to update hidden inputs before form submission
    function updateHiddenInputs() {
        // Remove any existing hidden inputs
        document.querySelectorAll('input[name^="dropdown"]').forEach(el => el.remove());

        // Create and append hidden inputs
        const hiddenInputs = [
            { name: 'dropdown1', value: advisingSelect.value },
            { name: 'dropdown2', value: thesisSelect.value },
            { name: 'dropdown3', value: gradeSelect.value }
        ];

        hiddenInputs.forEach(input => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = input.name;
            hiddenInput.value = input.value;
            form.appendChild(hiddenInput);
        });
    }

    // Attach event listeners to dropdowns
    [advisingSelect, thesisSelect, gradeSelect].forEach(select => {
        select.addEventListener('change', function() {
            // Save to localStorage for persistence
            localStorage.setItem(select.name, this.value);
        });
    });

    // Modify form submission to include dropdown values
    form.addEventListener('submit', function(e) {
        updateHiddenInputs();
    });

    // Initial localStorage and hidden input setup
    ['dropdown1', 'dropdown2', 'dropdown3'].forEach(name => {
        const select = document.querySelector(`select[name="${name}"]`);
        const savedValue = localStorage.getItem(name);
        if (savedValue) {
            select.value = savedValue;
        }
    });
});
</script>
                    <button class="confirm-button-faculty-setup" type="submit">
                        <div class="confirm-button">
                            Confirm
                        </div>
                    </button>
                </form>

                <form class="category">
                <select name="dropdown1" class="dropdown-options" required>
                        <option value="" disabled selected style="color: #999;">Advising</option>
                        <option value="0">0 (Will not be entertained) </option>
                        <option value="1">1 (High Priority) </option>
                        <option value="2">2 (Medium Priority) </option>
                        <option value="3">3 (Low Priority) </option>
                    </select>
            

                    <select name="dropdown2" class="dropdown-options" required>
                        <option value="" disabled selected style="color: #999;">Undergraduate Thesis Consultation</option>
                       <option value="0">0 (Will not be entertained) </option>
                        <option value="1">1 (High Priority) </option>
                        <option value="2">2 (Medium Priority) </option>
                        <option value="3">3 (Low Priority) </option>
                    </select>

                    <select name="dropdown3" class="dropdown-options" required>
                        <option value="" disabled selected style="color: #999;">Grade Consultation</option>
                        <option value="0">0 (Will not be entertained) </option>
                        <option value="1">1 (High Priority) </option>
                        <option value="2">2 (Medium Priority) </option>
                        <option value="3">3 (Low Priority) </option>
                    </select>
                </form>
                    <!-- <button class="confirm-button-faculty-setup" type="submit">
                        <div class="confirm-button">
                            Confirm
                        </div>
                    </button> -->
    
                @if ($faculty)
                    <a class="back-button-faculty-setup" href="/faculty-dashboard">
                        <div class="back-button">
                            <div class="back-button-2">
                                Back
                            </div>
                        </div>
                    </a>
                @endif
        </div>
        @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
    </div>
</div>
</body>
</html>