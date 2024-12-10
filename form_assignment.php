<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <label>employeeId:</label><br>
        <input type="number" name="eId"><br>
        <label>firstname:</label><br>
        <input type="text" name="fname"><br>
        <label>lastname:</label><br>
        <input type="text" name="lname"><br>
        <label>email Address:</label><br>
        <input type="text" name="email"><br>
        <label>phone:</label><br>
        <input type="number" name="phone"><br>
        <input type="submit">
    </form>
    <?php
        // Create a db called employee_attendance_tracker

        // having 2 tables
        // 1. employees
        // 2. attendance

        // employees table 
        // -------------------
        // employeeId
        // firstname
        // lastname
        // email
        // phone

        // attendance table
        // --------------------
        // employeeId
        // date
        // timeIn
        // timeOut

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "employee_attendance_tracker";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){
            die("connection failed: " . $conn->connect_error);
        }

        //sql to create table
        $sql = "CREATE TABLE Attendance_Record (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            employeeId INT NOT NULL,
            date DATE  NOT NULL DEFAULT CURRENT_DATE,
            timeIn TIME NOT NULL DEFAULT CURRENT_TIME,
            timeOut TIME DEFAULT CURRENT_TIME,
            UNIQUE KEY unique_record (employeeId, date, timeIn, timeOut)
            
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table Attendance_Record created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
          
        $conn->close();
        //reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

        // if(isset($_GET["eId"]) && isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["email"]) && isset($_GET["phone"])){
        //     $emp = $_GET['eId'];
        //     $fname = $_GET['fname'];
        //     $lname = $_GET['lname'];
        //     $email = $_GET['email'];
        //     $phone = $_GET['phone'];
        //     $sql = "INSERT INTO Staff_Records ( employeeId, firstname, lastname, email, phone)
        //     VALUES ( '$emp','$fname', '$lname', '$email', '$phone')";
        //     if($conn->query($sql) === TRUE){
        //         echo "New record for employee created sucessfully";
        //     }else{
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //         $conn->close();
        //     }
        // }else{
        //     echo 'Please fill all the details in the form';
        // }

    ?>

</body>
</html>