<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "employee_attendance_tracker";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
?>