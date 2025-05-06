<?php
require_once 'connect.php'; 




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
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 80%;
            overflow-x: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: white;
            margin-bottom: 20px;
            margin-left: 10%;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
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
    
    <div class="button-container">
        <button class="btn btn-back" ><a href="admin.php" style="color: white;">Back to Previous Page</a></button>
    </div>
    
    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Doctor</h2>
            <form id="editForm" method="post" action="update_doctor.php">
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
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="specialization">Specialization:</label>
                    <input type="text" id="specialization" name="specialization" required>
                </div>
                
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" id="department" name="department" required>
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
        function openEditModal(id, firstname, lastname, gender, email, specialization, department) {
            document.getElementById("edit_id").value = id;
            document.getElementById("firstname").value = firstname;
            document.getElementById("lastname").value = lastname;
            document.getElementById("gender").value = gender;
            document.getElementById("email").value = email;
            document.getElementById("specialization").value = specialization;
            document.getElementById("department").value = department;
            
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