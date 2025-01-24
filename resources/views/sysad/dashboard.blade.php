
<html>
<head>
<x-dashboard-layout :user="$user">
<style>

.dashboard-sysad .student-box {
    position: relative;
    top: 250px;
    background-color: #fff;
    border-radius: 35px;
    box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
    padding: 50px;
    text-align: center;
    width: 750px;
    height: 800px;
}


.dashboard-sysad .student-title {
    position: relative;
    top: 50px;
    font-family: "Futura Hv BT", Helvetica;;
    font-size: 110px;
    font-weight: bold;
    color: #31572c;
    margin-bottom: 10px;
}

.student-box-link {
    text-decoration: none;
    display: block;
    cursor: pointer;
}

.student-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.student-box:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.student-box:active {
    transform: scale(0.95);
}

.student-box-svg {
    position: relative;
    top: 0;
    left: 0;
    width: 70%;
    height: 70%;
    z-index: 1;
    object-fit: cover;
    color: #4f772d;
}

.dashboard-sysad .faculty-box {
    position: relative;
    top: 500px;
    background-color: #fff;
    border-radius: 35px;
    box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
    padding: 50px;
    text-align: center;
    width: 750px;
    height: 800px;
}


.dashboard-sysad .faculty-title {
    position: relative;
    top: 50px;
    font-family: "Futura Hv BT", Helvetica;;
    font-size: 110px;
    font-weight: bold;
    color: #31572c;
    margin-bottom: 10px;
}

.faculty-box-link {
    text-decoration: none;
    display: block;
    cursor: pointer;
}

.faculty-box {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.faculty-box:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.faculty-box:active {
    transform: scale(0.95);
}

.faculty-box-svg {
    position: relative;
    top: 0;
    left: 0;
    width: 70%;
    height: 70%;
    z-index: 1;
    object-fit: cover;
    color: #4f772d;
}


.sec-key-title {
    position: relative;
    font-size: 105px;
    font-family: "Futura Hv BT", Helvetica;
    color: #31572c;
    margin-bottom: 20px;
}

.dashboard-sysad .set-sec {
    position: relative;
    bottom: 1700px;
    left: 1500px;
    background-color: #fff;
    border-radius: 35px;
    box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
    padding: 50px;
    text-align: left;
    width: 1550px;
    height: 1000px;
}

.dashboard-sysad .set-sec .sec-key-input {
    width: 80%; /* Responsive width */
    height: 15%;
    padding: 15px;
    margin-top: 20px;
    border: 2px solid #31572c;
    border-radius: 110px;
    font-size: 65px;
    transition: all 0.3s ease;
    outline: none;
    font-family: "Futura Book Font", Helvetica;
    padding-left: 55px;
    margin-top: 20px;
    margin-bottom: 35px;
}

.dashboard-sysad .set-sec .sec-key-input::placeholder {
    color: #31572c;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.dashboard-sysad .set-sec .sec-key-input:hover,
.dashboard-sysad .set-sec .sec-key-input:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
}

.dashboard-sysad .set-sec .sec-key-input:hover::placeholder,
.dashboard-sysad .set-sec .sec-key-input:focus::placeholder {
    opacity: 0.4;
}

.dashboard-sysad .set-sec .sec-key-update {
    width: 80%; /* Responsive width */
    height: 15%;
    padding: 15px;
    margin-top: 20px;
    border: 2px solid #31572c;
    border-radius: 110px;
    font-size: 65px;
    transition: all 0.3s ease;
    outline: none;
    font-family: "Futura Book Font", Helvetica;
    padding-left: 55px;
}

.dashboard-sysad .set-sec .sec-key-update::placeholder {
    color: #31572c;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.dashboard-sysad .set-sec .sec-key-update:hover,
.dashboard-sysad .set-sec .sec-key-update:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
}

.dashboard-sysad .set-sec .sec-key-update:hover::placeholder,
.dashboard-sysad .set-sec .sec-key-update:focus::placeholder {
    opacity: 0.4;
}

.dashboard-sysad .set-sec .sec-key-actions {
    /* display: none; */
    justify-content: center;
    gap: 50px;
    margin-top: 50px;
    z-index: 10;
    width: 40%;
    height: 20%;
}

.dashboard-sysad .set-sec .sec-key-actions button {
    position: relative;
    top: 70px;
    width: 80%;
    height: 60%;
    border: 2px solid #31572c;
    border-radius: 110px;
    font-size: 65px;
    font-family: "Futura Book Font", Helvetica;
    background-color: white;
    color: #31572c;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    margin-bottom: 35px;
}

.dashboard-sysad .set-sec .sec-key-actions .confirm-btn {
    border-color: #4CAF50;
}

.dashboard-sysad .set-sec .sec-key-actions .cancel-btn {
    border-color: #f44336;
}

.dashboard-sysad .set-sec .sec-key-actions button:hover {
    color: white;
}

.dashboard-sysad .set-sec .sec-key-actions .confirm-btn:hover {
    background-color: #4CAF50;
}

.dashboard-sysad .set-sec .sec-key-actions .cancel-btn:hover {
    background-color: #f44336;
}

.dashboard-sysad .set-sec .sec-key-input:not(:placeholder-shown) + .sec-key-update:not(:placeholder-shown) + .sec-key-actions,
.dashboard-sysad .set-sec .sec-key-update:not(:placeholder-shown) + .sec-key-input:not(:placeholder-shown) + .sec-key-actions {
    display: flex;
}
</style>
</head>
<body>

<div class="dashboard-sysad">
    <div class="one-container">
        <a href="/student-dashboard" class="student-box-link">
            <div class="student-box">
            <img src="assets/images/student-icon.svg" alt="Background Design" class="student-box-svg">
                <div class="student-title">As Student</div>
            </div>
        </a>
    </div>

    <div class="three-container">
        <a href="/faculty-dashboard" class="faculty-box-link">
            <div class="faculty-box">
            <img src="assets/images/faculty-icon.svg" alt="Background Design" class="faculty-box-svg">
                <div class="faculty-title">As Faculty</div>
            </div>
        </a>
    </div>
    
    <div class="manage-sec">
    <div class="set-sec">
        <div class="sec-key-title">Manage Security Key</div>
        <input 
            type="text" 
            class="sec-key-input" 
            placeholder="Set security key"
        >
        <input 
            type="text" 
            class="sec-key-update" 
            placeholder="Update current security key"
        >

        <div class="sec-key-actions">
            <button class="confirm-btn">Confirm</button>
            <button class="cancel-btn">Cancel</button>
        </div>
    </div>
</div>

</div>
</body>
</html>
</x-dashboard-layout>