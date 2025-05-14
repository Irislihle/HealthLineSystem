<?php 
session_start();
$result = $_SESSION['user'];
$row = $_SESSION['total'];
$row1 = $_SESSION['tot'];
$row4 = $_SESSION['appoints'];

require_once 'connect.php';

$sql3 = "SELECT * FROM appointments WHERE  appointment_date = CURDATE() ORDER BY appointment_time ASC";   
$stmt3 = $conn-> prepare($sql3);
$stmt3 ->execute();
$result3 = $stmt3->get_result();
$row3 = $result3->fetch_assoc();



/*$sql5 = "SELECT * FROM doctors WHERE doctorid = ?";
$stmt5 = $conn-> prepare($sql5);
$stmt5->bind_param("s", $row3['doctorid']);
$stmt5 ->execute();
$result5 = $stmt5->get_result();
$row5 = $result5->fetch_assoc();*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthLine admin</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Modal Bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #dc3545;
            --success-color: #198754;
            --sidebar-bg: #2c3e50;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            
        }
        
        /* Top Navigation */
        .top-nav {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1.5rem;
            z-index: 1000;
        }
        
        .hospital-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .hospital-brand i {
            color: var(--accent-color);
        }
        
        .emergency-alert {
            background-color: var(--accent-color);
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s;
            z-index: 999;
            padding-top: 70px;
        }
        
        .sidebar-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .sidebar-header h5 {
            color: white;
            margin-top: 10px;
            font-weight: 600;
        }
        
        .sidebar-menu {
            padding: 0 1rem;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        
        .nav-link .menu-text {
            transition: all 0.3s;
        }
        
        /* Main Content */
        .main-content,.view-appointment-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            flex: 1;
            transition: all 0.3s;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .page-title h2 {
            font-weight: 600;
            color: var(--sidebar-bg);
            margin-bottom: 5px;
        }
        
        /* Stats Cards */
        .stats-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card.patients {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }
        
        .stats-card.doctors {
            background: linear-gradient(135deg, #1cc88a, #13855c);
        }
        
        .stats-card.appointments {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
        }
        
        .stats-card.emergency {
            background: linear-gradient(135deg, #e74a3b, #be2617);
        }
        
        .stats-icon {
            font-size: 2rem;
            opacity: 0.7;
        }
        
        .stats-count {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .stats-title {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Recent Activity */
        .activity-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .activity-icon.admission {
            background-color: rgba(78, 115, 223, 0.1);
            color: #4e73df;
        }
        
        .activity-icon.appointment {
            background-color: rgba(28, 200, 138, 0.1);
            color: #1cc88a;
        }
        
        .activity-icon.emergency {
            background-color: rgba(231, 74, 59, 0.1);
            color: #e74a3b;
        }
        
        .activity-icon.prescription {
            background-color: rgba(246, 194, 62, 0.1);
            color: #f6c23e;
        }
        
        .activity-content {
            flex-grow: 1;
        }
        
        .activity-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        /* Collapsed Sidebar */
        .sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-collapsed .sidebar-header h5,
        .sidebar-collapsed .menu-text {
            display: none;
        }
        
        .sidebar-collapsed .nav-link {
            justify-content: center;
        }
        
        .sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        .active{
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-item:hover .nav-link {
            cursor: pointer;
        }

        .card{
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg top-nav">
        <div class="container-fluid">
            <button class="sidebar-toggle me-3 d-lg-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            
            <a class="hospital-brand" href="#">
                <i class="bi bi-hospital"></i>
                <span>HealthLine</span>
            </a>
            
            <div class="d-flex align-items-center ms-auto">
                <div class="emergency-alert me-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Emergency: 911
                </div>
                
                <div class="user-menu">
                    <div class="position-relative me-3">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">3</span>
                    </div>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="FB_IMG_1736980248521.jpg"  class="user-avatar" alt="User"> 
                            <span class="ms-2 d-none d-lg-inline"><?php echo htmlspecialchars($result['fullname']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="Login.php" onclick="return confirm('Are you sure you want to logout?')"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="FB_IMG_1736980248521.jpg"  width="80" class="rounded-circle border border-3 border-white mb-2">
            <h5><?php echo htmlspecialchars($result['fullname']); ?></h5>
            <small>Chief Medical Officer</small>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link " id="dashboard" href="#">
                        <i class="bi bi-speedometer2"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewPatient.php" >
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-text">Patients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewDoctors.php" >
                        <i class="bi bi-person-badge"></i>
                        <span class="menu-text">Staff</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"   id="viewAppoint" >
                        <i class="bi bi-calendar-check"></i>
                        <span class="menu-text">Appointments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="regiDoctor.php">
                        <i class="bi bi-file-medical"></i>
                        <span class="menu-text">Add Doctor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createAnnouncements.php">
                        <i class="bi bi-capsule"></i>
                        <span class="menu-text">Add Announcement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-heart-pulse"></i>
                        <span class="menu-text">Ward Management</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link" href="Login.php" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="bi bi-box-arrow-left"></i>
                        <span class="menu-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-title">
                    <h2><i class="bi bi-speedometer2 me-2"></i>Hospital Dashboard</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <button class="btn btn-outline-primary d-none d-lg-block" id="collapseToggle">
                    <i class="bi bi-arrows-angle-contract"></i> Collapse Menu
                </button>
            </div>
            
            <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card patients">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-count"><?php echo htmlspecialchars($row['total']); ?></div>
                                <div class="stats-title">Total Patients</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-people-fill stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card doctors">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-count"><?php echo htmlspecialchars($row1['tot']); ?></div>
                                <div class="stats-title">Doctors</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-person-badge stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card appointments">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-count"><?php echo htmlspecialchars($row4['appoints']); ?></div>
                                <div class="stats-title">Appointments</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-calendar-check stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="stats-card emergency">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-count">12</div>
                                <div class="stats-title">Emergency Cases</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-exclamation-triangle-fill stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="activity-card">
                        <h5 class="card-title mb-4"><i class="bi bi-activity me-2"></i>Recent Admissions</h5>
                        
                        <div class="activity-item">
                            <div class="activity-icon admission">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>John Smith admitted to Ward 3</h6>
                                <p class="mb-0">Cardiology Department</p>
                                <small class="activity-time">10 minutes ago</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon emergency">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Emergency case received</h6>
                                <p class="mb-0">Patient: Mary Johnson, Trauma</p>
                                <small class="activity-time">25 minutes ago</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon prescription">
                                <i class="bi bi-file-medical"></i>
                            </div>
                            <div class="activity-content">
                                <h6>New prescription created</h6>
                                <p class="mb-0">For Robert Davis by Dr. Smith</p>
                                <small class="activity-time">1 hour ago</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="activity-card">
                        <h5 class="card-title mb-4"><i class="bi bi-calendar3 me-2"></i>Upcoming Appointments</h5>
             <?php
                    if ($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
                               $sql2 = "SELECT * FROM patient WHERE patientid = ?";
                             $stmt2 = $conn-> prepare($sql2);
                                  $stmt2->bind_param("s", $row3['patientid']);
                             $stmt2 ->execute();
                                 $result2 = $stmt2->get_result();
                                $row2 = $result2->fetch_assoc();

                                $sql5 = "SELECT * FROM doctors WHERE doctorid = ?";
                                $stmt5 = $conn-> prepare($sql5);
                                $stmt5->bind_param("s", $row3['doctorid']);
                                $stmt5 ->execute();
                                $result5 = $stmt5->get_result();
                                $row5 = $result5->fetch_assoc();
                ?>
                        <div class="activity-item">
                            <div class="activity-icon appointment">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="activity-content">
                                <h6><?php echo htmlspecialchars($row2['firstname']); ?>  <?php echo htmlspecialchars($row2['lastname']); ?> - 
                                <?php echo htmlspecialchars($row3['appointment_time'] = date('h:i A', strtotime($row3['appointment_time']))); ?></h6>
                                <p class="mb-0">Dr. <?php echo htmlspecialchars($row5['laststname']); ?>, Room 205</p>
                                <small class="activity-time">For <?php echo htmlspecialchars($row3['duration']); ?> minutes</small>
                            </div>
                        </div>
                        <?php
                }
                    } else if ($result3->num_rows == 0) {
                        echo "<p>No appointments scheduled for today.</p>";
                    }
                ?>     
                        <div class="activity-item">
                            <div class="activity-icon appointment">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Emily Davis - 10:15 AM</h6>
                                <p class="mb-0">Dr. Lee, Room 312</p>
                                <small class="activity-time">In 1 hour 45 minutes</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon appointment">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="activity-content">
                                <h6>David Wilson - 11:30 AM</h6>
                                <p class="mb-0">Dr. Johnson, Room 104</p>
                                <small class="activity-time">In 3 hours</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="view-appointment-content" style="display: none;">
        <div class="card">
           <?php include 'viewAppoints.php'; ?>
        </div>
    </div>

   




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Toggle collapsed sidebar on desktop
        document.getElementById('collapseToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
            
            const icon = this.querySelector('i');
            if (document.body.classList.contains('sidebar-collapsed')) {
                icon.classList.remove('bi-arrows-angle-contract');
                icon.classList.add('bi-arrows-angle-expand');
                this.innerHTML = '<i class="bi bi-arrows-angle-expand"></i> Expand Menu';
            } else {
                icon.classList.remove('bi-arrows-angle-expand');
                icon.classList.add('bi-arrows-angle-contract');
                this.innerHTML = '<i class="bi bi-arrows-angle-contract"></i> Collapse Menu';
            }
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 992 && 
                !sidebar.contains(event.target) && 
                !toggleBtn.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        $(document).ready(function() {
            const viewAppointContent = $(".view-appointment-content");

            $('#viewAppoint').click(function() {
                $(".main-content").hide();
                $(".view-appointment-content").show();
                $(this).addClass("active");
                $('#mainContent').removeClass("active");
            });

            $('#dashboard').click(function() {
                $(".main-content").show();
                $(".view-appointment-content").hide();
                $(this).addClass("active");
                $('#viewAppoint').removeClass("active");
            });

          
        });
        
        
        

        
        
    </script>
</body>
</html>