
<?php

require_once 'connect.php';
//used lName to check which form you are submitting 
//since lName is not required on the signin form we used it to verify
if($_SERVER['REQUEST_METHOD'] == "POST" &&isset($_POST['eName'])){


  
    $id = $_POST['pID'];
    $gender = $_POST['gender'];
    $initials = $_POST['initials'];
    $firstName = $_POST['fName'];
    $email = $_POST['email'];
    $lastName = $_POST['lName'];
    $password = password_hash($_POST['pWord'], PASSWORD_DEFAULT);
    $role = "patient";
    $addr1 = $_POST['addr1'];
    $addr2 = $_POST['addr2'];
    $pAddr = $_POST['pAddr'];
    $pCode = $_POST['pCode'];
    $telNo = $_POST['telNO'];
    $kinname = $_POST['eName'];
    $cellNO = $_POST['cellNO'];
    $kinNO = $_POST['eAddr'];



   
    
    $query = "INSERT INTO patient(patientid,firstname,lastname,resp,sex,initials,email,password,role) 
             VALUES('$id','$firstName','$lastName','$id','$gender','$initials','$email','$password','$role')";

   

     
    if($conn -> query($query) == true ){
        echo "Successfully Registered";
    
    }else{
        echo "Registration Failed inserting in patient ";
    }

  

$query1 =  "INSERT INTO respaccount(idnumber,firstname,lastname,address1,address2,postalcode,telno,cellno,gender,postaladdress,initials,kinName,kinNO) 
    VALUES('$id','$firstName','$lastName','$addr1','$addr2','$pCode','$telNo','$cellNO','$gender','$pAddr','$initials','$kinname','$kinNO')"; 


if( $conn -> query($query1) == true){
header("Location:Login.php");
die();
echo "Successfully Registered";


}else{
echo "Registration Failed inserting in respaccount";
}
}
     

//if the user is trying to login
elseif($_SERVER["REQUEST_METHOD"] == "POST"){

    include 'connect.php';
   
    $email = $_POST['email'];
    $password = $_POST['pWord'];



   
$email = $_POST['email'];
$password = $_POST['pWord'];

// Modified function to check user with password verification
function checkUser($conn, $table, $email, $password) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();  
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password for all user types
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return false;
}

//checking the user in each table
 $user = checkUser($conn,'admin', $email, $password);
 if ($user) {
    
   //getting the total number of doctors
    $sql1 = "SELECT COUNT(*) AS tot FROM doctors";
    $stmt1 = $conn-> prepare($sql1);
    $stmt1 ->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();
   
    //getting the total number of patients
    $sql = "SELECT COUNT(*) AS total FROM patient";
    $stmt = $conn-> prepare($sql);
    $stmt ->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //getting the total number of appointments
    $sql2 = "SELECT COUNT(*) AS appoints FROM appointments ";
    $stmt2 = $conn-> prepare($sql2);
    $stmt2 ->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();

    //storing the user in a session
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['total'] = $row;
    $_SESSION['tot'] = $row1;
    $_SESSION['appoints'] = $row2;

    header("Location:admin.php");
    echo "<p style='color:green;'>Login successful!</p>";
    echo "<p>The user loged in to the admin dashboard</p>";
    exit();
 }

 $user = checkUser($conn,'doctors', $email, $password);
    if ($user) {
        //getting the doctors details
        $sql = "SELECT * FROM doctors WHERE doctorid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user['doctorid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //getting the total number of patients
        $sql = "SELECT COUNT(*) AS total FROM patient";
        $stmt = $conn-> prepare($sql);
        $stmt ->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
       //getting the total number of appointments
        $sql2 = "SELECT COUNT(*) AS appoints FROM appointments wHERE doctorid = ?";
        $stmt2 = $conn-> prepare($sql2);
        $stmt2->bind_param("s", $user['doctorid']);
        $stmt2 ->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        //get all the appointments for the doctor
        $sql3 = "SELECT *  FROM appointments wHERE doctorid = ?";
        $stmt3 = $conn-> prepare($sql3);
        $stmt3->bind_param("s", $user['doctorid']);
        $stmt3 ->execute();
        $result3 = $stmt3->get_result();
        $row3 = $result3->fetch_assoc();
        //storing the user in a session
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['total'] = $row;
        $_SESSION['appoints'] = $row2;
        

        header("Location:doctor.php");
        echo "<p style='color:green;'>Login successful!</p>";
        echo "<p>The user loged in to the doctor dashboard</p>";
        exit();
    }

    $user = checkUser($conn,'patient', $email, $password);
    if ($user) {
        //getting the recently logged in user id
         $sql = "SELECT * FROM respaccount WHERE idnumber = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("s", $user['patientid']);
        $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       //the patient's medication
       $sql1 = "SELECT * FROM CurrentMedications WHERE patient_id = ?";
       $stmt1 = $conn->prepare($sql1);
       $stmt1->bind_param("s", $user['patientid']);
       $stmt1->execute();
      $result1 = $stmt1->get_result();
      $row1 = $result1->fetch_assoc();

     //storing the user in a session
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['resp'] = $row;
        $_SESSION['med'] = $row1;
        header("Location:patient.php");
        echo "<p style='color:green;'>Login successful!</p>";
        echo "<p>The user loged in to the patient dashboard</p>";
        exit();
    }

    else{
        
        header("Location:Login.php");
        echo "Invalid credentials. Please try again.";
    }


}

/*
    $userFound = false;

    foreach($roles as $role => $table){

      // SQL query to fetch the user record
    $sql = "SELECT * FROM $table  WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, now check the password
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        
        // Verify the password using password_verify() if the password is hashed
        if ($password == $stored_password) {
            echo "<p style='color:green;'>Login successful! </p>";
            echo "<p>The user loged in to the $table dashboard</p>";
        } else {
            
            echo "Invalid credentials. Please try again.";
        }
    }

    //else {
       // echo "<p>The user loged in to the $table dashboard</p>";
    //}
     /*  $stmt = $conn -> prepare("SELECT * $table WHERE email =?");
        $stmt -> bind_param("s",$email);
        $stmt -> execute();
        $result = $stmt -> get_result();

        if($row = $result -> fetch_assoc()){
            //found a username match, now check password

            if(password_verify($password,$row['password'])){
                //Credentials are correct
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $role;

                //redirect the user to the dashboard based on the role
               // header("Location: dashboard_$role.php");
               echo "The user loged in to the $table dashboard";
                exit();
            }else{
                    echo "Incorrect password.";
                    $userFound = true;
                    break;
            }
        }
         $stmt -> close();*/

    

    

 /*   // SQL query to fetch the user record
    $sql = "SELECT * FROM $table  WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, now check the password
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify the password using password_verify() if the password is hashed
        if ($password == $stored_password) {
            echo "<p style='color:green;'>Login successful!</p>";
        } else {
            echo "Invalid credentials. Please try again.";
        }
    } else {
        echo "Invalid credentials. Please try again.";
    }

 /*   $sql = "SELECT * FROM users where email = '$email' and password='$password'";
    $result = $conn -> query($sql);
     
    if($result -> num_rows > 0){
        session_start();

        $row = $result -> fetch_assoc();
        $_SESSION['email']=$row['email'];

        echo "successfully loged in";
        //header("Location: homepage.php");
        exit();

    }
    else{
     
        echo "Not Found, Incorrect Email or Password";
    }*/

    //$conn -> close();
    ?>