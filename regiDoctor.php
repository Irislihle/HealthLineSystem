<?php
session_start();
$result1 = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          /*start of the side bar*/
       .container {
            /*max-width: 1200px;*/
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            margin-right: 6%;
            
        }
        
        /* CSS Variables */
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
       
      /*End of  the side bar*/ 
        .registration-container {
           /* max-width: 100%;*/
            width: 70%;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-right: 10%;
        }
        .form-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-submit {
            background-color: #0d6efd;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }
        .btn-submit:hover {
            background-color: #0b5ed7;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    

<!--Adding side bar-->
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
                            <span class="ms-2 d-none d-lg-inline"><?php echo htmlspecialchars($result1['fullname']); ?></span>
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
            <h5><?php echo htmlspecialchars($result1['fullname']); ?></h5>
            <small>Chief Medical Officer</small>
        </div>
        
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link " id="dashboard" href="admin.php">
                        <i class="bi bi-speedometer2"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="viewPatient.php" >
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-text">Patients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewDoctors.php">
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
                    <a class="nav-link active" href="regiDoctor.php">
                        <i class="bi bi-file-medical"></i>
                        <span class="menu-text">Add Doctor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
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


    <div class="registration-container">
        <div class="form-header">
            <h2><i class="bi bi-person-plus-fill"></i> Doctor Registration</h2>
            <p class="mb-0">Please fill in all required fields to create your account</p>
        </div>
        
        <div class="form-body">
            <form id="doctorRegistrationForm" action="regiDocBackend.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="doctorid" class="form-label required-field">Doctor ID</label>
                        <input type="text" class="form-control" id="doctorid" name="doctorid" 
                               placeholder="Enter your 13-digit ID" maxlength="13" required>
                        <div class="form-text">Your unique professional identifier</div>
                    </div>
                    <div class="col-md-6">
                        <label for="specialization" class="form-label required-field">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="firstname" class="form-label required-field">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label required-field">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="initials" class="form-label">Initials</label>
                        <input type="text" class="form-control" id="initials" name="initials" maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label for="sex" class="form-label required-field">Gender</label>
                        <select class="form-select" id="sex" name="sex" required>
                            <option value="" selected disabled>Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label required-field">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="form-text">We'll never share your email with anyone else</div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label required-field">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <i class="bi bi-eye-fill password-toggle" id="togglePassword"></i>
                    <div class="form-text">Minimum 8 characters with at least one number and one special character</div>
                </div>

                <div class="mb-4">
                    <label for="department" class="form-label required-field">Department</label>
                    <select class="form-select" id="department" name="department" required>
                        <option value="" selected disabled>Select department</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Orthopedics">Orthopedics</option>
                        <option value="General Surgery">General Surgery</option>
                        <option value="Radiology">Radiology</option>
                        <option value="Emergency Medicine">Emergency Medicine</option>
                        <option value="Oncology">Oncology</option>
                        <option value="Mental Health">Mental Health</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">Clear Form</button>
                    <button type="submit" class="btn btn-submit">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"></script>
  <!--  <script>
        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the icon
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });

        // Form validation
        document.getElementById('doctorRegistrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form validation and submission logic here
            alert('Form validation passed! Ready for backend processing.');
            // You would typically send the form data to your server here
        });
    </script>-->
</body>
</html>