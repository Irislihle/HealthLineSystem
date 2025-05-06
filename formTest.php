<?php
 

   session_start();
  $result = $_SESSION['user'] ;
  $row = $_SESSION['resp'] ;
   date_default_timezone_set('Africa/Nairobi'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card">
    <?php if ($result) { ?>
        <h2>User Details</h2>
        <p>Current server time: <?= date("h:i:s A") ?></p>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($result['patientid']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($result['firstname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($result['email']); ?></p>
       <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['cellno']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address1']); ?></p> 
    <?php } else { ?>
        <h2>User Not Found</h2>
    <?php } ?>
</div>

<div id="clock"></div>
<script>
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString(); // e.g., 2:45:10 PM
    document.getElementById('clock').textContent = "Current time: " + timeString;
}
setInterval(updateClock, 1000); // update every second
updateClock(); // initial call
</script>
</body>
</html>