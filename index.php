<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica', Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f5f7fa;
        }
        .sidebar {
            width: 240px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 10px; 
        }
        .sidebar .logo img {
            width: 200px; 
            margin-bottom: 5px; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }
        .sidebar .user-details {
            text-align: center;
            margin-bottom: 10px;
        }
        .sidebar .user-details h2 {
            font-size: 20px; 
            margin-bottom: 3px;
            font-weight: bold;
        }
        .sidebar .user-details p {
            font-size: 20px;
            color: #ecf0f1;
        }
        .sidebar .divider {
            border-bottom: 1px solid #fff;
            margin: 10px 0;
        }
        .sidebar ul {
            list-style: none;
            padding-top: 10px; 
            flex-grow: 1; 
        }
        .sidebar ul li {
            margin-bottom: 15px; 
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px; 
            display: block;
            border-radius: 6px;
            transition: background-color 0.3s ease-in-out;
        }
        .sidebar ul li a:hover {
            background-color: #1abc9c;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
            width: 100%;
            background-color: #fff;
        }
        h1 {
            margin-bottom: 20px;
            color: #1976d2; /* Deep blue for headings */
            font-size: 24px;
            font-weight: 700;
        }
        label {
            margin-bottom: 10px;
            display: block;
            font-weight: 600;
        }
        #date {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 20px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 16px;
            outline: none;
        }
        #date:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .time-slot {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin: 20px 0;
        }
        .time-slot button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            color: white; 
        }
        .time-slot button.available {
            background-color: #4caf50; 
        }
        .time-slot button.selected {
            background-color: #007bff; 
        }
        .time-slot button.booked {
            background-color: #f44336; 
            color: white;
            cursor: not-allowed;
        }
        .time-slot button:hover:not(.booked) {
            background-color: #218838; 
            transform: translateY(-2px);
        }
        .confirmation-message {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
        .btn-book {
            padding: 10px 20px;
            background-color: #ff9800; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
        }
        .btn-book:hover {
            background-color: #e68900; 
        }
        @media (max-width: 600px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <a href="user_dashboard.php">
            <img src="aw-k9.png" alt="aw-k9 logo">
        </a>
    </div>
    <div class="user-details">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
    </div>
    <div class="divider"></div>
    <ul>
        <li><a href="index.php">Booking</a></li>
        <li><a href="view_appointments.php">View Appointments</a></li>
    </ul>
</div>

<div class="main-content">
    <h1>Select a Time Slot</h1>
    <label for="date">Select Date:</label>
    <input type="date" id="date" required>

    <div class="time-slot" id="calendar"></div>
    <div class="confirmation-message" id="confirmation-message"></div>
    <button id="book-button" class="btn-book" style="display: none;">Book Appointment</button>
</div>

<script>
    const calendarElement = document.getElementById('calendar');
    const confirmationMessage = document.getElementById('confirmation-message');
    const dateInput = document.getElementById('date');
    const bookButton = document.getElementById('book-button');
    let selectedTimeSlot = null;

    dateInput.addEventListener('change', () => {
        generateTimeSlots(dateInput.value);
        confirmationMessage.innerText = '';
        selectedTimeSlot = null;
        bookButton.style.display = 'none';
    });

    function generateTimeSlots(date) {
        const startTime = new Date(date);
        startTime.setHours(9, 0, 0); 
        calendarElement.innerHTML = ''; 

        for (let i = 0; i < 17; i++) {
            const timeSlot = new Date(startTime.getTime() + (i * 30 * 60000));
            const button = document.createElement('button');
            button.innerText = timeSlot.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            checkIfBooked(date, button, timeSlot);
            
            button.onclick = () => {
                if (button.classList.contains('available')) {
                    if (selectedTimeSlot) {
                        selectedTimeSlot.classList.remove('selected');
                        selectedTimeSlot.classList.add('available');
                    }
                    selectedTimeSlot = button;
                    button.classList.remove('available');
                    button.classList.add('selected');
                    confirmationMessage.innerText = `You have selected ${button.innerText}.`;
                    bookButton.style.display = 'block'; 
                }
            };

            calendarElement.appendChild(button);
        }
    }

    function checkIfBooked(date, button, timeSlot) {
        fetch('check_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                date: date,
                time: timeSlot.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.booked) {
                button.classList.add('booked'); 
                button.disabled = true; 
            } else {
                checkIfPending(date, button, timeSlot);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function checkIfPending(date, button, timeSlot) {
        fetch('check_pending.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                date: date,
                time: timeSlot.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.pending) {
                button.classList.add('pending'); 
                button.disabled = true; 
            } else {
                button.classList.add('available'); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    bookButton.addEventListener('click', () => {
        if (selectedTimeSlot) {
            const appointmentDate = dateInput.value;
            const appointmentTime = selectedTimeSlot.innerText;

            fetch('book_appointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    date: appointmentDate,
                    time: appointmentTime
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    confirmationMessage.innerText = "Your appointment is pending approval.";
                    bookButton.style.display = 'none'; 
                } else {
                    confirmationMessage.innerText = "This time slot is already booked!";
                }
            })
            .catch(error => {
                console.error('Error:', error);
                confirmationMessage.innerText = "An error occurred. Please try again.";
            });
        }
    });
</script>

</body>
</html>
