<?php session_start();?>
<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['sucess'])){?>
        <div class="sucess_message">
            <p>New record for employee created</p>
        </div>
        <div class="details-btn">
            <a href="staff-onboarding.php"><button>Add another employee</button></a>
            <a href="employee-records.php"><button> View employee list</button></a>
            <?php unset($_SESSION['sucess']);?>
        </div>

    <?php }else{?>
        <form>
            <div class="form-message">Please fill all the details in the form</div>
            
            <!-- <label>employeeId:</label><br>
            <input type="number" name="eId"><br> -->
            <label>Employee Id:</label><br>
            <input type="text" name="employeeid" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['id'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['id'])){
                    echo $_SESSION['errors']['id'];
                    unset($_SESSION['errors']['id']);
                }?>
            </div>
            <label>firstname:</label><br>
            <input type="text" name="fname" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['fname'].'"';
            } ?>><br>
            <label>lastname:</label><br>
            <input type="text" name="lname" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['lname'].'"';
            } ?>><br>
            <label>email Address:</label><br>
            <input type="text" name="email" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['email'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['email'])){
                    echo $_SESSION['errors']['email'];
                    unset($_SESSION['errors']['email']);
                }?>
            </div>
            <label>phone:</label><br>
            <input type="number" name="phone" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['phone'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['phone'])){
                    echo $_SESSION['errors']['phone'];
                    unset($_SESSION['errors']['phone']);
                }?>
            </div>
            <label>Date Of Employment:</label><br>
            <input type="date" name="doe" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['doe'].'"';
            } ?>><br>
            <input type="submit">
        </form>
    <?php } ?>


    <?php unset($_SESSION['previous_values']);?>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f6fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container Styling */
        form {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        /* Form Heading */
        form label {
            font-size: 14px;
            font-weight: bold;
            color: #4e54c8;
            margin-bottom: 5px;
            display: block;
        }
         /* Message Styling */
         .form-message {
            color: #4e54c8;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
        /* Error Message Styling */
        .error-message {
            color: red;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        /* Input Fields Styling */
        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
        }

        /* Submit Button Styling */
        form input[type="submit"] {
            width: 100%;
            margin-top:20px;
            background: #4e54c8;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        form input[type="submit"]:hover {
            background: #3a41a7;
        }


        /* Responsive Design */
        @media (max-width: 600px) {
            form {
                padding: 15px 20px;
            }
        }
    </style>
    <?php
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "employee_attendance_tracker";

        // $conn = new mysqli($servername, $username, $password, $dbname);
        // if($conn->connect_error){
        //     die("connection failed: " . $conn->connect_error);
        // }

        //sql to create table
        // $sql = "CREATE TABLE Attendance_Record (
        //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //     employeeId INT NOT NULL,
        //     date DATE  NOT NULL DEFAULT CURRENT_DATE,
        //     timeIn TIME NOT NULL DEFAULT CURRENT_TIME,
        //     timeOut TIME DEFAULT CURRENT_TIME,
        //     UNIQUE KEY unique_record (employeeId, date, timeIn, timeOut)
            
        // )";
        // if ($conn->query($sql) === TRUE) {
        //     echo "Table Attendance_Record created successfully";
        // } else {
        //     echo "Error creating table: " . $conn->error;
        // }
          
        // $conn->close();
        //reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

        if(isset($_GET["fname"]) && isset($_GET["lname"]) && isset($_GET["email"]) && isset($_GET["phone"])){
            // $emp = $_GET['eId'];
            $employeeid = $_GET['employeeid'];
            $fname = $_GET['fname'];
            $lname = $_GET['lname'];
            $email = $_GET['email'];
            $phone = $_GET['phone'];
            $date_of_employment = $_GET['doe'];
            $_SESSION['previous_values'] = [
                'id' => $employeeid,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone' => $phone,
                'doe' => $date_of_employment,
            ];

            $sql = "SELECT *
                FROM employees e 
                WHERE e.employee_id = '$employeeid'
            ";
            $result = $conn->query($sql);
            if($result !== FALSE ){
                $employee_rec = $result->fetch_all(MYSQLI_ASSOC);
                if (count($employee_rec) > 0) {
                    //echo 'employee id already exists';
                    $_SESSION["errors"]['id'] = "employee id already exists";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                } 
            }
            $sql = "SELECT *
                FROM employees e 
                WHERE e.email = '$email'
            ";
            $result = $conn->query($sql);
            if($result !== FALSE ){
                $employee_rec = $result->fetch_all(MYSQLI_ASSOC);
                if (count($employee_rec) > 0) {
                    echo 'employee email already exists';
                    $_SESSION["errors"]['email'] = "employee email already exists";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;

                }
            }
            $sql = "SELECT *
                FROM employees e 
                WHERE e.phone_number = '$phone'
            ";
            $result = $conn->query($sql);
            if($result !== FALSE ){
                $employee_rec = $result->fetch_all(MYSQLI_ASSOC);
                if (count($employee_rec) > 0) {
                    //echo 'employee phone number already exists';
                    $_SESSION["errors"]['phone'] = "employee phone number already exists";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }
            }
            $sql = "INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, date_of_employment)
            VALUES ( '$employeeid', '$fname', '$lname', '$email', '$phone', '$date_of_employment')";

            if($conn->query($sql) === TRUE){
                //echo "New record for employee created sucessfully";
                $_SESSION['sucess']= 'New record for employee created';
                header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }

    ?>

</body>
</html>