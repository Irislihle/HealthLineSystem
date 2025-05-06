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
        #btn1 {
            display:flex;
            justify-content: center;
            background-color: #0066cc;
            color: white;
            padding: 12px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 30%;
            margin-left: 50%;
        }
        #btn2 {
            display:flex;
            justify-content: center;
            background-color: #0066cc;
            color: white;
            padding: 12px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 30%;
            
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
                <select id="doctorid" name="doctorid" required>
                    <option value="">Select Doctor</option>
                    <?php
                    // Connect to database
                    require_once "connect.php";
                    
                    // Fetch doctors
                    $sql = "SELECT doctorid, firstname, laststname, specialization FROM doctors ";
                    $result = $conn->query($sql);
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['doctorid']}'>{$row['firstname']} {$row['laststname']} ({$row['specialization']})</option>";
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
                <label>Appointment Time</label>
                <div class="time-slots" id="timeSlots">
                    <!-- Time slots will appear here after date selection -->
                </div>
                <input type="Time" id="appointment_time" name="appointment_time">
            </div>
            
            <!-- Appointment Details -->
            <div class="form-group">
                <label for="reason">Reason for Visit</label>
                <textarea id="reason" name="reason" rows="3"></textarea>
            </div>
            <div>
<div style="display: flex; gap: 10px;">
    <button type="submit" id='btn1' class="btn">Schedule Appointment</button>
    <button type="submit" id='btn2' class="btn"><a href="patient.php" style="color: white;">Previous Page</a></button>
</div>
            
        </form>
    </div>

    </script>
</body>
</html>
