<?php

// Database connection
require_once "connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $patient_id = $_POST['patient_id'];
    $doctorid = $_POST['doctorid'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = $_POST['reason'];

    // Insert appointment
    $sql = "INSERT INTO appointments (patientid, doctorid, appointment_date, appointment_time, reason) 
            VALUES ('$patient_id', '$doctorid', '$appointment_date', '$appointment_time', '$reason')";


    if ($conn->query($sql) === TRUE) {
        // Redirect to appointments page or show success message
        header("Location: appointments.php?success=1");
    } else {
        // Handle error (e.g., show error message)
        header("Location: appointments.php?error=1");
    }

    $conn->close();
}
 else {
    // Redirect to form if accessed directly
    header("Location: appointments.php");
}

?>