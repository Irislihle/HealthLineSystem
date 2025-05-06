<?php
  include("connect.php");

  $sql ="select * from admin";

  $sql = "SELECT * FROM admin ";
  $stmt = $conn->prepare($sql);

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0){
    while($row = $result -> fetch_assoc()){
        echo "<h1>".$row['username']."</h1>";
    }
     
     
  }

?>
