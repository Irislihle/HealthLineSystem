<?php
// Assume this comes from your database
$status = "scheduled"; // Possible values: 'scheduled', 'completed', 'cancelled'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle button click
    $status = ($_POST['current_status'] === 'scheduled') ? 'completed' : (($_POST['current_status'] === 'completed') ? 'cancelled' : 'scheduled');
    // Here you would typically save to database
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Doctor Dashboard | Hospital System</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
       
        </style>
</head>
<body>
    <form  method="post">
    <input type="hidden" name="current_status" value="<?php echo $status; ?>">
    
      <?php if ($status === 'completed') : ?>
        <button type="submit" class="btn btn-warning"><span>Approved </span> </button>
      <?php elseif ($status === 'scheduled') : ?>
        <button type="submit" class="btn btn-success"><span>scheduled</span></button>
        <?php elseif($status === 'cancelled') :?>
    
        <button type="submit" class="btn btn-danger"><span>cancel </span> </button>   
        <?php endif; ?>
</form>
 <span class="appointment-status status-completed">$status</span>
    <div class="container">
        <h1>Doctor Dashboard</h1>
        <p>Welcome to the Doctor Dashboard. Here you can manage your appointments.</p>
    </div>
    <div class="container">
        <h2>Appointment Status</h2>
        <p>The current status of the appointment is: <?php echo $status; ?></p>
    </div>
<p>
    <?php echo"$status"; ?>
</p>
</body>
</html>
