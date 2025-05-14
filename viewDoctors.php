<?php
require_once 'connect.php'; 

session_start();
$result1 = $_SESSION['user'];


// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM doctors WHERE doctorid='$delete_id'";
    if ($conn->query($sql) ){
        header("Location: doctors.php?message=Doctor+deleted+successfully");
    } else {
        header("Location: doctors.php?error=Error+deleting+doctor");
    }
    exit();
}

// Fetch all doctors
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors Directory</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            margin-top: 3%;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        
        thead {
            background-color: #3498db;
            color: white;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            position: sticky;
            top: 0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e8f4fc;
        }
        
        .gender-male {
            color: #2980b9;
        }
        
        .gender-female {
            color: #e84393;
        }
        
        .gender-other {
            color: #9b59b6;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85em;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .btn-edit {
            background-color: #f39c12;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #e67e22;
        }
        
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #c0392b;
        }
        
        .btn-back {
            background-color: #7f8c8d;
            color: white;
            padding: 10px 20px;
        }
        
        .btn-back:hover {
            background-color: #95a5a6;
        }
        
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover {
            color: black;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .btn-save {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn-save:hover {
            background-color: #27ae60;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        @media (max-width: 768px) {
            th, td {
                padding: 10px 8px;
                font-size: 0.9em;
            }
            
            .container {
                border-radius: 0;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn {
                padding: 6px 8px;
                width: 100%;
            }
            
            .modal-content {
                width: 95%;
                margin: 20% auto;
            }
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
                    <a class="nav-link active" href="">
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
                    <a class="nav-link" href="regiDoctor.php">
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


    <h1>Doctors Directory</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    
 <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Specialization</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['doctorid']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['laststname']); ?></td>
                            <td class="gender-<?php echo strtolower($row['sex']); ?>">
                                <?php echo htmlspecialchars($row['sex']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialization']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" onclick="openEditModal(
                                        '<?php echo $row['doctorid']; ?>',
                                        '<?php echo addslashes($row['firstname']); ?>',
                                        '<?php echo addslashes($row['laststname']); ?>',
                                        '<?php echo $row['sex']; ?>',
                                        '<?php echo addslashes($row['email']); ?>',
                                        '<?php echo addslashes($row['specialization']); ?>',
                                        '<?php echo addslashes($row['department']); ?>'
                                    )">Edit</button>
                                    <a href="?delete_id=<?php echo $row['doctorid']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No doctors found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    

    
    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Doctor</h2>
            <form id="editForm" method="post" action="update_patient.php">
                <input type="hidden" id="edit_id" name="id">
                
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>

                <div class="form-group">
                    <label for="email">Initials:</label>
                    <input type="text" id="initials" name="initials" required>
                </div>
                
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="specialization">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="department">Date:</label>
                    <input type="text" id="dt" name="dt" required>
                </div>
                
                <button type="submit" class="btn-save">Save Changes</button>
            </form>
        </div>
    </div>
    
    <script>
        // Get the modal
        const modal = document.getElementById("editModal");
        const span = document.getElementsByClassName("close")[0];
        
        // Function to open modal with doctor data
        function openEditModal(id, firstname, lastname,initials,gender, email,  dt) {
            document.getElementById("edit_id").value = id;
            document.getElementById("firstname").value = firstname;
            document.getElementById("lastname").value = lastname;
            document.getElementById("gender").value = gender;
            document.getElementById("email").value = email;
            document.getElementById("initials").value = initials;
            document.getElementById("dt").value = dt;
            
            modal.style.display = "block";
        }
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
<?php
$conn->close();
?>