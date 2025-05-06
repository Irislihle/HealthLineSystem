<?php
require_once 'connect.php'; 

$query = "SELECT * FROM doctors";
$result = $conn->query($query);
 
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
            text-decoration: none;
        }
        
        .btn-back:hover {
            background-color: #95a5a6;
        }
        
        .button-container {
            text-align: center;
            margin-top: 20px;
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
        }
        
        @media print {
            body {
                background: none;
                padding: 0;
            }
            
            .container {
                box-shadow: none;
            }
            
            thead {
                background-color: #3498db !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                color: white !important;
            }
            
            .action-buttons {
                display: none;
            }
            
            .button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>Doctors Directory</h1>
    
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
                <tr>    
            <?php 
              while($row = mysqli_fetch_assoc($result)) 
              {
              ?> 
               <td><?php echo htmlspecialchars($row['doctorid']); ?></td>
                    <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($row['laststname']); ?></td>
                    <td><?php echo htmlspecialchars($row['sex']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['specialization']); ?></td>
                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                    <td>
                <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                    </tr>
              <?php 
              }
            ?> 
                <tr>
                    <td>DOC002</td>
                    <td>Michael</td>
                    <td>Chen</td>
                    <td class="gender-male">Male</td>
                    <td>m.chen@medicalcenter.com</td>
                    <td>Neurology</td>
                    <td>Neuroscience</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DOC003</td>
                    <td>Priya</td>
                    <td>Patel</td>
                    <td class="gender-female">Female</td>
                    <td>p.patel@medicalcenter.com</td>
                    <td>Pediatrics</td>
                    <td>Child Health</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DOC004</td>
                    <td>Robert</td>
                    <td>Williams</td>
                    <td class="gender-male">Male</td>
                    <td>r.williams@medicalcenter.com</td>
                    <td>Orthopedics</td>
                    <td>Surgery</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>DOC005</td>
                    <td>Alex</td>
                    <td>Taylor</td>
                    <td class="gender-other">Non-binary</td>
                    <td>a.taylor@medicalcenter.com</td>
                    <td>Psychiatry</td>
                    <td>Mental Health</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="button-container">
        <button class="btn btn-back" onclick="window.history.back()">Back to Previous Page</button>
    </div>

    <script>
        // You would add your actual edit/delete functionality here
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const doctorId = row.cells[0].textContent;
                alert(`Edit doctor with ID: ${doctorId}`);
                // In a real application, you would redirect to an edit page or show a modal
            });
        });
        
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const doctorId = row.cells[0].textContent;
                if(confirm(`Are you sure you want to delete doctor ${doctorId}?`)) {
                    // In a real application, you would make an API call to delete
                    row.remove();
                    alert(`Doctor ${doctorId} deleted successfully`);
                }
            });
        });
    </script>
</body>
</html>