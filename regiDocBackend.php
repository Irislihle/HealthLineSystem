<?php
    require_once 'connect.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //hash the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Retrieve form data
        $id = $_POST['doctorid'];
        $spec = $_POST['specialization'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $initials = $_POST['initials'];
        $email = $_POST['email'];
        $password;
        $dep = $_POST['department'];
        $sex = $_POST['sex'];
        $role = "doctor";


        $query = "INSERT INTO doctors(doctorid,firstname,laststname,specialization,initials,email,password,role,department,sex) 
                  VALUES('$id','$firstName','$lastName','$spec','$initials','$email','$password','$role','$dep','$sex')";
       
        if ($conn->query($query) === TRUE) {
            echo "Successfully Registered";
            header("Location:admin.php");
        } else {
            echo "Registration Failed inserting in doctor table";
        }


                  
    }



?>