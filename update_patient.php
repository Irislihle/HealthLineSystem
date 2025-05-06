<?php
// Database connection
require_once "connect.php";


// Get form data
$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$initials = $_POST['initials'];
$dt = $_POST['dt'];

// Update doctor in database
$sql = "UPDATE patient SET 
        firstname='$firstname', 
        lastname='$lastname', 
        sex='$gender', 
        email='$email', 
        initials='$initials', 
        created_at='$dt' 
        WHERE patientid='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
} else {
    header("Location: admin.php");
}

$conn->close();
?>