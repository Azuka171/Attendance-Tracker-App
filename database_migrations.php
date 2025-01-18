<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #4e54c8, #8f94fb);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        form {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px 20px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        form button {
            background: #4e54c8;
            color: #fff;
            font-size: 16px;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        form button:hover {
            background: #3a41a7;
        }

        h1, p {
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
        }

    </style>
    <?php
        if ($_SERVER["REQUEST_METHOD"]=='POST') {
            # code...
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "employee_attendance_tracker";

            $conn = new mysqli($servername, $username, $password);
            if($conn->connect_error){
                die("connection failed: " . $conn->connect_error);
            }


            //sql to create table
            // $sql = "CREATE DATABASE IF NOT EXISTS employee_attendance_tracker;

            // USE employee_attendance_tracker;
            
            // CREATE TABLE IF NOT EXISTS employees (
            //     employeeId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            //     firstname VARCHAR(32) NOT NULL,
            //     lastname VARCHAR(32) NOT NULL,
            //     email VARCHAR(64) NOT NULL,
            //     phone VARCHAR(16) NOT NULL
            // );

            // CREATE TABLE IF NOT EXISTS attendance (
            //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            //     employeeId INT NOT NULL,
            //     date DATE  NOT NULL DEFAULT CURRENT_DATE,
            //     timeIn TIME NOT NULL DEFAULT CURRENT_TIME,
            //     timeOut TIME,
            //     FOREIGN KEY (employeeId) REFERENCES employees(employeeId)
                
            // )";
            // if ($conn->query($sql) === TRUE) {
            //     echo "Database created successfully";
            // } else {
            //     echo "Error creating table: " . $conn->error;
            // }



            $sql = "CREATE DATABASE IF NOT EXISTS employee_attendance_tracker;";
            if ($conn->query($sql) === TRUE) {
                echo "Database created successfully <br>";
            } else {
                echo "Error creating table: " . $conn->error. "<br>";
            }

            $conn->select_db($dbname);

            $sql = "CREATE TABLE IF NOT EXISTS employees (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                employeeId VARCHAR(16),
                firstname VARCHAR(32) NOT NULL,
                lastname VARCHAR(32) NOT NULL,
                email VARCHAR(64) NOT NULL,
                phone VARCHAR(16) NOT NULL
            );";
            if ($conn->query($sql) === TRUE) {
                echo "Table employees created successfully <br>";
            } else {
                echo " <br>Error creating table: " . $conn->error. "<br>";
            }
            $sql = "CREATE TABLE IF NOT EXISTS attendance (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                employeeId INT UNSIGNED NOT NULL,
                date DATE  NOT NULL DEFAULT CURRENT_DATE,
                timeIn TIME NOT NULL DEFAULT CURRENT_TIME,
                timeOut TIME,
                FOREIGN KEY (employeeId) REFERENCES employees(id) ON DELETE CASCADE
                
            )";
            if ($conn->query($sql) === TRUE) {
                echo "Table attendance created successfully <br>";
            } else {
                echo "Error creating table: " . $conn->error. "<br>";
            }
            
            $conn->close();
        }
    ?>
    <form action="" method='POST'>
        <button type='submit'>Migrate Database</button>
    </form>
</body>
</html>