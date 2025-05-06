<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9ff;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0066cc;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #336699;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn {
            background-color: #0066cc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn:hover {
            background-color: #0055aa;
        }
        .time-slots {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 15px;
        }
        .time-slot {
            padding: 8px;
            text-align: center;
            background: #f0f5ff;
            border-radius: 5px;
            cursor: pointer;
        }
        .time-slot.selected {
            background: #0066cc;
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Schedule New Appointment</h1>
        
        <form action="save_appointment.php" method="POST">
            <!-- Patient Information -->
            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" id="patient_id" name="patient_id" required>
            </div>
            
            <!-- Doctor Selection -->
            <div class="form-group">
                <label for="doctor_id">Doctor</label>
                <select id="doctor_id" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    <?php
                    // Connect to database
                    $conn = new mysqli("localhost", "username", "password", "database");
                    
                    // Fetch doctors
                    $sql = "SELECT doctor_id, first_name, last_name, specialty FROM Doctors WHERE is_active = 1";
                    $result = $conn->query($sql);
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['doctor_id']}'>{$row['first_name']} {$row['last_name']} ({$row['specialty']})</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            
            <!-- Appointment Date -->
            <div class="form-group">
                <label for="appointment_date">Date</label>
                <input type="date" id="appointment_date" name="appointment_date" required 
                       min="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <!-- Available Time Slots (will be populated by JavaScript) -->
            <div class="form-group">
                <label>Available Time Slots</label>
                <div class="time-slots" id="timeSlots">
                    <!-- Time slots will appear here after date selection -->
                </div>
                <input type="hidden" id="appointment_time" name="appointment_time">
            </div>
            
            <!-- Appointment Details -->
            <div class="form-group">
                <label for="reason">Reason for Visit</label>
                <textarea id="reason" name="reason" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn">Schedule Appointment</button>
        </form>
    </div>

    <script>
        // Load available time slots when date is selected
        document.getElementById('appointment_date').addEventListener('change', function() {
            const date = this.value;
            const doctorId = document.getElementById('doctor_id').value;
            
            if (!date || !doctorId) return;
            
            // Fetch available time slots from server
            fetch(`get_available_slots.php?date=${date}&doctor_id=${doctorId}`)
                .then(response => response.json())
                .then(slots => {
                    const container = document.getElementById('timeSlots');
                    container.innerHTML = '';
                    
                    slots.forEach(slot => {
                        const slotElement = document.createElement('div');
                        slotElement.className = 'time-slot';
                        slotElement.textContent = slot;
                        slotElement.addEventListener('click', function() {
                            // Remove previous selection
                            document.querySelectorAll('.time-slot').forEach(el => {
                                el.classList.remove('selected');
                            });
                            
                            // Select this slot
                            this.classList.add('selected');
                            document.getElementById('appointment_time').value = this.textContent;
                        });
                        container.appendChild(slotElement);
                    });
                });
        });
    </script>
</body>
</html>