
<html>
<head>
<x-dashboard-layout :user="$user">
<style>

.dashboard-sysad .student-box {
    position: relative;
    top: 790px;
    background-color: #fff;
    border-radius: 35px;
    box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
    padding: 50px;
    text-align: center;
    width: 750px;
    height: 800px;
    left: 2450px;
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
    bottom: 100px;
    background-color: #fff;
    border-radius: 35px;
    box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
    padding: 50px;
    text-align: center;
    width: 750px;
    height: 800px;
    left: 1200px;
    
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


.sec-title {
    position: relative;
    bottom: 900px;
    font-family: "Futura Hv BT", Helvetica;;
    font-size: 110px;
    font-weight: bold;
    color: #31572c;
    margin-bottom: 10px;
    z-index: 2;
    text-wrap: wrap;
    width: 850px;
    text-align: center;
    
    left: 1000px;

}

.manage-sec {
    position: relative;
    bottom: 200px;
    left: 2700px;
}

.manage-sec-btn {
            position: relative;
            width: 850px;
            height: 900px;
            border-radius: 35px;
            background-color: #fff;
            box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
            color: #31572c;
            font-size: 110px;
            font-family: "Futura Hv BT", Helvetica;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 50;
            bottom: 1700px;
            left: 1000px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: none;
        }

        .manage-sec-btn span {
            position: relative;
            order: 2;
            margin-top: 80px; /* Adjust spacing as needed */
        }

        .manage-sec-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        /* .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        } */

        .dashboard-sysad .modal-content {
            background-color: white;
            border-radius: 35px;
            width: 2200px;
            height: 800px;
            padding: 50px;
            box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 100px;
            cursor: pointer;
            color: #31572c;
            padding-right: 30px;
        }

        .dashboard-sysad .modal-title {
            position: relative;
            font-size: 150px;
            color: #31572c;
            margin-bottom: 30px;
            font-family: "Futura Hv BT", Helvetica;
            text-align: center;
        }

        .modal-input {
            position: relative;
            width: 100%;
            height: 180px;
            padding: 75px;
            margin-bottom: 20px;
            border: 2px solid #31572c;
            border-radius: 110px;
            font-size: 80px;
            font-family: "Futura Hv BT", Helvetica;
            outline: none;
            transition: all 0.3s ease;
            top: 200px;
        }

        .modal-input:hover,
        .modal-input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .modal-actions {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            top: 200px;
        }

        .modal-btn {
            position: relative;
            width: 45%;
            height: 100px;
            border: none;
            border-radius: 110px;
            font-size: 60px;
            font-family: "Futura Book Font", Helvetica;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .confirm-btn {
            position: relative;
            border-color: #4CAF50;
            color: #4CAF50;
            height: 150px;
        }

        .cancel-btn {
            position: relative;
            border-color: #f44336;
            color: #f44336;
            height: 150px;

        }

        .confirm-btn:hover {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #f44336;
            color: white;
        }

        .key-svg {
            position: relative;
            right: 1300px;
            bottom: 800px;
            width: 310%;
            height: 310%;
            z-index: 20;
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
    <img src="assets/images/key-icon.svg" alt="Background Design" class="key-svg">
        <div class="sec-title">Manage Security Key</div>
    <button class="manage-sec-btn" onclick="openModal()"></button>
    </div>

    <div id="securityKeyModal" class="modal-overlay">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div class="modal-title">Manage Security Key</div>
            
            <input type="text" class="modal-input" placeholder="Update current security key">
            <div class="modal-actions">
                <button class="modal-btn confirm-btn">Confirm</button>
                <button class="modal-btn cancel-btn" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>


</div>
<script>
        function openModal() {
            document.getElementById('securityKeyModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('securityKeyModal').style.display = 'none';
        }

        // Close modal if clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('securityKeyModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
</x-dashboard-layout>