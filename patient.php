<?php
 

   session_start();
  $result = $_SESSION['user'] ;
  $row = $_SESSION['resp'] ;
  $row1 = $_SESSION['med'] ;
  
  date_default_timezone_set('Africa/Nairobi'); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management | Hospital System</title>
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
            --sidebar-bg: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .patient-header {
            background: linear-gradient(135deg, var(--primary-color), #0b5ed7);
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .patient-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .patient-info-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
        }
        
        .patient-info-card .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--secondary-color);
            min-width: 120px;
        }
        
        .medical-tab {
            border-left: 4px solid var(--primary-color);
            padding-left: 15px;
            margin-bottom: 15px;
        }
        
        .vital-stat {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        
        .vital-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .vital-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .vital-label {
            font-size: 0.9rem;
            color: var(--secondary-color);
            text-transform: uppercase;
        }
        
        .medication-card {
            border-left: 4px solid var(--success-color);
            margin-bottom: 15px;
        }
        
        .allergy-badge {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e9ecef;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary-color);
            border: 2px solid white;
        }
        
        .timeline-date {
            font-size: 0.8rem;
            color: var(--secondary-color);
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background-color: #f0f0f0;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .patient-avatar {
                width: 80px;
                height: 80px;
            }
            
            .info-label {
                min-width: 100px;
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
    <!-- Patient Header -->
    <div class="patient-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-auto text-center text-md-start">
                    <div id="ini" class="rounded-circle border border-3 border-white mb-2" ><?php echo htmlspecialchars($result['initials']); ?> </div>
                </div>
                <div class="col-md">
                    <h2 class="mb-1"><?php echo htmlspecialchars($result['firstname'])," ",htmlspecialchars($result['lastname']); ?></h2>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <div><strong>ID:</strong><?php echo htmlspecialchars($result['patientid']); ?></div>
                        <div><strong>Gender:</strong><?php echo htmlspecialchars($result['sex']); ?></div>
                        <div><strong>Blood Type:</strong> A+</div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success">Active</span>
                        <span class="badge bg-info">Diabetic</span>
                        <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($row1['medication_name']); ?></span>
                    </div>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                        <a href="#" class="btn btn-light btn-sm">
                            <i class="bi bi-envelope"></i> Message
                        </a>
                        <a href="appointments.php" class="btn btn-light btn-sm">
                            <i class="bi bi-calendar-plus"></i> Make Appointment
                        </a>
                             <!--logout button-->
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
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-4">
                <!-- Patient Details Card -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-info-circle"></i> Patient Details
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="info-label">Address:</div>
                            <div><?php echo htmlspecialchars($row['postalcode']); ?>, <?php echo htmlspecialchars($row['address1']); ?>
                            <br><?php echo htmlspecialchars($row['address2']); ?>, <?php echo htmlspecialchars($row['postaladdress']); ?></div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="info-label">Phone:</div>
                            <div><?php echo htmlspecialchars($row['cellno']); ?></div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="info-label">Email:</div>
                            <div><?php echo htmlspecialchars($result['email']); ?></div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="info-label">Primary Care:</div>
                            <div>Dr. Sarah Johnson<br>Internal Medicine</div>
                        </div>
                        <div class="d-flex">
                            <div class="info-label">Insurance:</div>
                            <div>Blue Cross Blue Shield<br>ID: XHB123456789</div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contacts -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-telephone"></i> Emergency Contacts
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold"><?php echo htmlspecialchars($row['kinName']); ?></h6>
                            <div>Spouse</div>
                            <div><?php echo htmlspecialchars($row['kinNO']); ?></div>
                        </div>
                        <div>
                            <h6 class="fw-bold">Michael Smith</h6>
                            <div>Son</div>
                            <div>(617) 555-0189</div>
                        </div>
                    </div>
                </div>

                <!-- Allergies -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-exclamation-triangle"></i> Allergies & Alerts
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold text-danger mb-3">Allergies</h6>
                        <div>
                            <span class="allergy-badge"><i class="bi bi-exclamation-triangle-fill me-1"></i>Penicillin</span>
                            <span class="allergy-badge"><i class="bi bi-exclamation-triangle-fill me-1"></i>Sulfa Drugs</span>
                            <span class="allergy-badge"><i class="bi bi-exclamation-triangle-fill me-1"></i>Latex</span>
                        </div>
                        
                        <h6 class="fw-bold mt-4 mb-3">Other Alerts</h6>
                        <div class="alert alert-warning p-2 mb-2">
                            <i class="bi bi-info-circle me-2"></i>Fall risk - requires assistance
                        </div>
                        <div class="alert alert-info p-2">
                            <i class="bi bi-info-circle me-2"></i>DNR on file
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-8">
                <!-- Vital Signs -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-heart-pulse"></i> Vital Signs
                        <span class="float-end text-muted small">Last updated: Today, <?= date("h:i:s A") ?></span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="vital-stat">
                                    <div class="vital-value">120/80</div>
                                    <div class="vital-label">Blood Pressure</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="vital-stat">
                                    <div class="vital-value">72</div>
                                    <div class="vital-label">Pulse (bpm)</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="vital-stat">
                                    <div class="vital-value">98.6°F</div>
                                    <div class="vital-label">Temperature</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="vital-stat">
                                    <div class="vital-value">18</div>
                                    <div class="vital-label">Respiration</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Medications -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-capsule"></i> Current Medications
                    </div>
                    <div class="card-body">
                        <?php 
                        if(is_array($row1)) { 
                            
                            echo "<div class='card medication-card mb-3'>";
                            echo "<div class='card-body p-3'>";
                            echo "<div class='d-flex justify-content-between'>";
                            echo "<h6 class='fw-bold mb-1'>".htmlspecialchars($row1['medication_name'])."</h6>";
                            if ($row1['is_active']) {
                                echo "<span class='badge bg-primary'>Active</span>";
                                echo "</div>";
                            } else {
                                echo "<span class='badge bg-danger '>Inactive</span>";
                                echo "</div>";
                            }
                            echo "<div class='text-muted small mb-2'>".htmlspecialchars($row1['dosage'])."</div>";
                            echo "<div class='d-flex flex-wrap gap-3'>";
                            echo "<div><strong>Dose:</strong> ".htmlspecialchars($row1['frequency'])."</div>";
                            echo "<div><strong>Prescribed:</strong> ".htmlspecialchars($row1['start_date'])."</div>";
                            echo "<div><strong>By:</strong> ".htmlspecialchars($row1['prescribed_by'])."</div>";
                            echo "</div></div></div>";
                        
                        
                    } else {
                        echo "<p>No medications found.</p>";
                    }
                    ?>
                      </div>
                      </div>
                      <!-- Hardcoded meds
                        <div class="card medication-card mb-3">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">Lisinopril</h6>
                                    <span class="badge bg-primary">Active</span>
                                </div>
                                <div class="text-muted small mb-2">10mg tablet</div>
                                <div class="d-flex flex-wrap gap-3">
                                    <div><strong>Dose:</strong> 1 tablet daily</div>
                                    <div><strong>Prescribed:</strong> 03/15/2023</div>
                                    <div><strong>By:</strong> Dr. Johnson</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card medication-card mb-3">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-bold mb-1">Metformin</h6>
                                    <span class="badge bg-primary">Active</span>
                                </div>
                                <div class="text-muted small mb-2">500mg tablet</div>
                                <div class="d-flex flex-wrap gap-3">
                                    <div><strong>Dose:</strong> 1 tablet twice daily</div>
                                    <div><strong>Prescribed:</strong> 01/10/2023</div>
                                    <div><strong>By:</strong> Dr. Johnson</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <!-- Medical History -->
               <!-- <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-file-medical"></i> Medical History
                    </div>
                    <div class="card-body">
                        <div class="medical-tab">
                            <h6 class="fw-bold">Chronic Conditions</h6>
                            <ul>
                                <li>Type 2 Diabetes (diagnosed 2018)</li>
                                <li>Hypertension (diagnosed 2020)</li>
                                <li>Hyperlipidemia</li>
                            </ul>
                        </div>
                        
                        <div class="medical-tab">
                            <h6 class="fw-bold">Surgical History</h6>
                            <ul>
                                <li>Appendectomy (2005)</li>
                                <li>Knee arthroscopy (2012)</li>
                            </ul>
                        </div>
                        
                        <div class="medical-tab">
                            <h6 class="fw-bold">Family History</h6>
                            <ul>
                                <li>Father: CAD (died at 68)</li>
                                <li>Mother: Type 2 Diabetes</li>
                                <li>Sister: Breast cancer</li>
                            </ul>
                        </div>
                    </div>
                </div>-->

                <!-- Recent Activity -->
                <div class="card patient-info-card mb-4">
                    <div class="card-header">
                        <i class="bi bi-clock-history"></i> Recent Activity
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-date">Today, 08:45 AM</div>
                                <h6 class="fw-bold mb-1">Vital signs recorded</h6>
                                <p class="mb-2">By Nurse Peterson</p>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-date">Yesterday, 2:30 PM</div>
                                <h6 class="fw-bold mb-1">Follow-up appointment</h6>
                                <p class="mb-2">With Dr. Johnson - BP slightly elevated</p>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-date">Last Week, 04/15/2023</div>
                                <h6 class="fw-bold mb-1">Lab tests completed</h6>
                                <p class="mb-2">HbA1c: 6.8%, Cholesterol: 198 mg/dL</p>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-date">03/28/2023</div>
                                <h6 class="fw-bold mb-1">Medication adjusted</h6>
                                <p class="mb-2">Lisinopril increased to 10mg daily</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>