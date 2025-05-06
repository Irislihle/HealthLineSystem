<?php

$host = "localhost";
$user = "mokgadi";
$pass = "Masha@20";
$db = "healthline_schema";
$conn = new mysqli($host,$user,$pass,$db);

if($conn -> connect_error){
    die("Failed to connect DB". $conn -> connect_error);
}else{
   
}