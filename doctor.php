<?php
     session_start();
     $row = $_SESSION['user'];
     $numP =  $_SESSION['total'];

     // Connect to database
        require_once "connect.php";
     $sql3 = "SELECT * FROM appointments WHERE doctorid = ?  AND appointment_date = CURDATE() ORDER BY appointment_time ASC";   
     $stmt3 = $conn-> prepare($sql3);
     $stmt3->bind_param("s", $row['doctorid']);
     $stmt3 ->execute();
     $result3 = $stmt3->get_result();
     $row3 = $result3->fetch_assoc();

     $sql = "SELECT COUNT(*) AS tot FROM appointments WHERE doctorid = ? "; 
        $stmt = $conn-> prepare($sql);
        $stmt->bind_param("s", $row['doctorid']);
        $stmt ->execute();
        $result = $stmt->get_result();
        $num = $result->fetch_assoc();


       $sql2 = "SELECT * FROM patient WHERE patientid = ?";
         $stmt2 = $conn-> prepare($sql2);
         $stmt2->bind_param("s", $row3['patientid']);
         $stmt2 ->execute();
         $result2 = $stmt2->get_result();
         $row2 = $result2->fetch_assoc();
    


        $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard | Hospital System</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #dc3545;
            --success-color: #198754;
            --warning-color: #ffc107;
            --sidebar-bg: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .doctor-header {
            background: linear-gradient(135deg, var(--primary-color), #0b5ed7);
            color: white;
            padding: 1.5rem 0;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .doctor-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .dashboard-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .dashboard-card .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .stat-card {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            color: white;
            margin-bottom: 20px;
        }
        
        .stat-card.appointments {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }
        
        .stat-card.patients {
            background: linear-gradient(135deg, #1cc88a, #13855c);
        }
        
        .stat-card.emergency {
            background: linear-gradient(135deg, #e74a3b, #be2617);
        }
        
        .stat-card.availability {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .appointment-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .appointment-item:last-child {
            border-bottom: none;
        }
        
        .appointment-time {
            width: 80px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .appointment-details {
            flex-grow: 1;
        }
        
        .appointment-status {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-scheduled {
            background-color: #e3f2fd;
            color: var(--primary-color);
        }
        
        .status-completed {
            background-color: #e8f5e9;
            color: var(--success-color);
        }
        
        .status-urgent {
            background-color: #ffebee;
            color: var(--accent-color);
        }
        
        .patient-avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        .task-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }
        
        .task-item .form-check-input {
            margin-right: 10px;
        }
        
        .medication-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .quick-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 15px 10px;
            border-radius: 8px;
            background-color: white;
            color: var(--primary-color);
            transition: all 0.3s;
        }
        
        .quick-action-btn:hover {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            transform: translateY(-3px);
        }
        
        .quick-action-btn i {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        
        @media (max-width: 768px) {
            .doctor-avatar {
                width: 80px;
                height: 80px;
            }
            
            .stat-value {
                font-size: 1.8rem;
            }
        }
        #ini{
            height: 110px;
            width: 110px;
            text-align: center;
            font-size: 70px;
            font-weight: 500pk;
            background-color: #2c3e50;

        } 
    </style>
</head>
<body>
    <!-- Doctor Header -->
    <div class="doctor-header">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-md-auto text-center text-md-start">
                    <div id="ini" class="rounded-circle border border-3 border-white mb-2" ><?php echo htmlspecialchars($row['initials']); ?> </div>
                </div>
                <div class="col-md">
                    <h2 class="mb-1">Dr. <?php echo htmlspecialchars($row['firstname']); ?> <?php echo htmlspecialchars($row['laststname']); ?>  </h2>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <div><strong>Department:</strong> <?php echo htmlspecialchars($row['department']); ?> </div>
                        <div><strong>Specialization:</strong><?php echo htmlspecialchars($row['specialization']); ?> </div>
                        <div><strong>Staff ID:</strong> <?php echo htmlspecialchars($row['doctorid']); ?> </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary">On Duty</span>
                        <span class="badge bg-success">Available</span>
                        <span class="badge bg-info">Senior Consultant</span>
                    </div>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                        <a href="#" class="btn btn-light">
                            <i class="bi bi-calendar-plus"></i> New Appointment
                        </a>
                        <a class="btn btn-light btn-sm" href="Login.php" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="menu-text">Logout</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Stats Row -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card appointments">
                    <i class="bi bi-calendar-check" style="font-size: 1.5rem;"></i>
                    <div class="stat-value"><?php echo htmlspecialchars($num['tot']); ?></div>
                    <div class="stat-label">Today's Appointments</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card patients">
                    <i class="bi bi-people" style="font-size: 1.5rem;"></i>
                    <div class="stat-value"><?php echo htmlspecialchars($numP['total']); ?> </div>
                    <div class="stat-label">Active Patients</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card emergency">
                    <i class="bi bi-exclamation-triangle" style="font-size: 1.5rem;"></i>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Urgent Cases</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card availability">
                    <i class="bi bi-clock" style="font-size: 1.5rem;"></i>
                    <div class="stat-value">4h</div>
                    <div class="stat-label">Available Today</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Today's Schedule -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-calendar-day"></i> Today's Schedule
                        <span class="ms-auto badge bg-primary" id="today-date"><p  id="today-date"></p></span>
                    </div>
                    <div class="card-body">
                <?php
                    if ($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
               
                ?>            
                        <div class="appointment-item">
                            <div class="appointment-time"><?php echo htmlspecialchars($row3['appointment_time'] = date('h:i A', strtotime($row3['appointment_time']))); ?></div>
                            <div class="appointment-details">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($row2['firstname']); ?>  <?php echo htmlspecialchars($row2['lastname']); ?></h6>
                                        <small><?php echo htmlspecialchars($row3['appointment_date']); ?></small>
                                        <small class="text-muted"><?php echo htmlspecialchars($row3['reason']); ?></small>
                                    </div>
                                </div>
                            </div>
                            <span class="appointment-status status-completed"><?php echo htmlspecialchars($row3['status']); ?></span>
                        </div>
                    
                    
                       <?php
                        }
                    } else if ($result3->num_rows == 0) {
                        echo "<p>No appointments scheduled for today.</p>";
                    }
                ?>    
                     
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-lightning-charge"></i> Quick Actions
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <a href="Patient_CurrentMedication.php" class="quick-action-btn">
                                    <i class="bi bi-file-earmark-medical"></i>
                                    <span>New Prescription</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-file-text"></i>
                                    <span>Medical Note</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-heart-pulse"></i>
                                    <span>Order Test</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-clipboard2-pulse"></i>
                                    <span>Vitals Entry</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Upcoming Tasks -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-list-check"></i> Tasks & Reminders
                        <button class="btn btn-sm btn-outline-primary ms-auto">+ Add</button>
                    </div>
                    <div class="card-body">
                        <div class="task-item">
                            <input class="form-check-input" type="checkbox">
                            <div>
                                <h6 class="mb-0">Review lab results for R. Johnson</h6>
                                <small class="text-muted">Due today</small>
                            </div>
                        </div>
                        
                        <div class="task-item">
                            <input class="form-check-input" type="checkbox">
                            <div>
                                <h6 class="mb-0">Sign discharge papers for M. Brown</h6>
                                <small class="text-muted">Due today</small>
                            </div>
                        </div>
                        
                        <div class="task-item">
                            <input class="form-check-input" type="checkbox">
                            <div>
                                <h6 class="mb-0">Prepare conference presentation</h6>
                                <small class="text-muted">Due May 20</small>
                            </div>
                        </div>
                        
                        <div class="task-item">
                            <input class="form-check-input" type="checkbox">
                            <div>
                                <h6 class="mb-0">Update treatment plan for E. Davis</h6>
                                <small class="text-muted">Due May 16</small>
                            </div>
                        </div>
                        
                        <div class="task-item">
                            <input class="form-check-input" type="checkbox">
                            <div>
                                <h6 class="mb-0">Follow up with pharmacy about new meds</h6>
                                <small class="text-muted">Due May 17</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Prescriptions -->
                <div class="card dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-capsule"></i> Recent Prescriptions
                    </div>
                    <div class="card-body">
                        <div class="medication-item">
                            <div>
                                <h6 class="mb-0">Atorvastatin</h6>
                                <small class="text-muted">For Robert Johnson</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>
                        
                        <div class="medication-item">
                            <div>
                                <h6 class="mb-0">Metoprolol</h6>
                                <small class="text-muted">For Emily Davis</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>
                        
                        <div class="medication-item">
                            <div>
                                <h6 class="mb-0">Amoxicillin</h6>
                                <small class="text-muted">For Michael Brown</small>
                            </div>
                            <span class="badge bg-secondary">Completed</span>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contacts -->
                <div class="card dashboard-card">
                    <div class="card-header bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-telephone"></i> Emergency Contacts
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Hospital Operator</h6>
                            <div class="text-danger">Ext. 0</div>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="fw-bold">Cardiology Dept.</h6>
                            <div class="text-danger">Ext. 245</div>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="fw-bold">Emergency Room</h6>
                            <div class="text-danger">Ext. 911</div>
                        </div>
                        
                        <div>
                            <h6 class="fw-bold">Pharmacy</h6>
                            <div class="text-danger">Ext. 333</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

     const today = new Date(); // Replace with actual date values
     const formattedDate = today.toISOString().split('T')[0]; // e.g., "2025-05-06"
     document.getElementById("today-date").textContent = formattedDate;
    </script>
</body>
</html>