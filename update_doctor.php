<?php
// Database connection
require_once "connect.php";


// Get form data
$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$specialization = $_POST['specialization'];
$department = $_POST['department'];

// Update doctor in database
$sql = "UPDATE doctors SET 
        firstname='$firstname', 
        laststname='$lastname', 
        sex='$gender', 
        email='$email', 
        specialization='$specialization', 
        department='$department' 
        WHERE doctorid='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
} else {
    header("Location: admin.php");
}

$conn->close();
?>