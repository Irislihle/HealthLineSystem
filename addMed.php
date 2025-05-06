<?php



if($_SERVER["REQUEST_METHOD"] = "POST") {
// Database connection
require_once 'connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO CurrentMedications (
    patient_id, medication_name, dosage, frequency, route, 
    purpose, start_date, prescribed_by, last_refill_date, 
    next_refill_date, notes, is_active
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$is_active = isset($_POST['is_active']) && $_POST['is_active'] === 'on' ? 1 : 0;

$stmt->bind_param("sssssssssssi", 
    $_POST['patient_id'],
    $_POST['medication_name'],
    $_POST['dosage'],
    $_POST['frequency'],
    $_POST['route'],
    $_POST['purpose'],
    $_POST['start_date'],
    $_POST['prescribed_by'],
    $_POST['last_refill_date'],
    $_POST['next_refill_date'],
    $_POST['notes'],
    $is_active
);



// Execute and respond
if ($stmt->execute()) {
    echo "Medication record created successfully";
    header("Location: doctor.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
} else {
    echo "Invalid request method";
}
?>