<?php ob_start();?>
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
    <?php if(isset($_SESSION['sucess'])) { ?>
        <div class="success-container">
            <div class="success-message">
                <p>New record for employee created successfully!</p>
            </div>
            <div class="button-group">
                <a href="staff-onboarding.php" class="btn btn-primary">Add Another Employee</a>
                <a href="employee-records.php" class="btn btn-secondary">View Employee List</a>
            </div>
            <?php unset($_SESSION['sucess']); ?>
        </div>
    <?php } else { ?>
        <form>
            <div class="form-message">Please fill all the details in the form</div>

            <!-- Employee ID -->
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

            <!-- First Name -->
            <label>First Name:</label><br>
            <input type="text" name="fname" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['fname'].'"';
            } ?>><br>

            <!-- Last Name -->
            <label>Last Name:</label><br>
            <input type="text" name="lname" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['lname'].'"';
            } ?>><br>

            <!-- Marital Status -->
            <label>Marital Status:</label><br>
            <input type="text" name="mstatus" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['mstatus'].'"';
            } ?>><br>

            <!-- Gender -->
            <label>Gender:</label><br>
            <input type="text" name="gender" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['gender'].'"';
            } ?>><br>

            <!-- Email Address -->
            <label>Email Address:</label><br>
            <input type="email" name="email" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['email'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['email'])){
                    echo $_SESSION['errors']['email'];
                    unset($_SESSION['errors']['email']);
                }?>
            </div>

            <!-- Phone -->
            <label>Phone:</label><br>
            <input type="number" name="phone" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['phone'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['phone'])){
                    echo $_SESSION['errors']['phone'];
                    unset($_SESSION['errors']['phone']);
                }?>
            </div>
             <!-- Date of Employment -->
             <label>Date Of Employment:</label><br>
            <input type="date" name="doe" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['doe'].'"';
            } ?>><br><br>
             <!-- Date of birth -->
             <label>Date Of Birth:</label><br>
            <input type="date" name="dob" required <?php if(isset($_SESSION['previous_values'])){
                //echo 'value="'.$_SESSION['previous_values']['dob'].'"';
                $dob = date('Y-m-d', strtotime($_SESSION['previous_values']['dob']));
                echo 'value="'.$dob.'"';
            } ?>><br><br>

            <!-- Nationality -->
            <label>Nationality:</label><br>
            <input type="text" name="nationality" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nationality'].'"';
            } ?>><br>

            <!-- Religion -->
            <label>Religion:</label><br>
            <input type="text" name="religion" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['religion'].'"';
            } ?>><br>

            <!-- State of Origin -->
            <label>State Of Origin:</label><br>
            <input type="text" name="stateOfOrigin" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['stateOfOrigin'].'"';
            } ?>><br>

            <!-- LGA -->
            <label>LGA:</label><br>
            <input type="text" name="lga" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['lga'].'"';
            } ?>><br>

            <!-- Next of Kin Full Name -->
            <label>Next Of Kin Fullname:</label><br>
            <input type="text" name="nextfullname" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nextfullname'].'"';
            } ?>><br>

            <!-- Next of Kin Relationship -->
            <label>Next Of Kin Relationship:</label><br>
            <input type="text" name="nextrelation" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nextrelation'].'"';
            } ?>><br>

            <!-- Next of Kin Email -->
            <label>Next Of Kin Email:</label><br>
            <input type="email" name="nextemail" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nextemail'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['nextemail'])){
                    echo $_SESSION['errors']['nextemail'];
                    unset($_SESSION['errors']['nextemail']);
                }?>
            </div>


            <!-- Next of Kin Phone -->
            <label>Next Of Kin Phone:</label><br>
            <input type="text" name="nextphone" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nextphone'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['nextphone'])){
                    echo $_SESSION['errors']['nextphone'];
                    unset($_SESSION['errors']['nextphone']);
                }?>
            </div>


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
            /* height: 250vh; */
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
        form input[type="number"],
        form input[type="email"] {
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
        .success-container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #4CAF50;
            background-color: #f9fff9;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            color: #4CAF50;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary {
            background-color: #007BFF;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #495057;
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
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
            $mstatus = $_GET['mstatus'];
            $gender = $_GET['gender'];
            $email = $_GET['email'];
            $phone = $_GET['phone'];
            $date_of_employment = $_GET['doe'];
            $date_of_birth = $_GET['dob'];
            $nationality = $_GET['nationality'];
            $religion = $_GET['religion'];
            $stateOfOrigin = $_GET['stateOfOrigin'];
            $lga = $_GET['lga'];
            $nextfullname = $_GET['nextfullname'];
            $nextrelation = $_GET['nextrelation'];
            $nextemail = $_GET['nextemail'];
            $nextphone= $_GET['nextphone'];

            $_SESSION['previous_values'] = [
                'id' => $employeeid,
                'fname' => $fname,
                'lname' => $lname,
                'mstatus' => $mstatus,
                'gender' => $gender,
                'email' => $email,
                'phone' => $phone,
                'doe' => $date_of_employment,
                'dob' => $date_of_birth,
                'nationality' => $nationality,
                'religion' => $religion,
                'stateOfOrigin' => $stateOfOrigin,
                'lga' => $lga,
                'nextfullname' => $nextfullname,
                'nextrelation' => $nextrelation,
                'nextemail' => $nextemail,
                'nextphone' => $nextphone
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
                WHERE e.next_Of_Kin_Email = '$nextemail'
            ";
            $result = $conn->query($sql);
            if($result !== FALSE ){
                $employee_rec = $result->fetch_all(MYSQLI_ASSOC);
                if (count($employee_rec) > 0) {
                    //echo 'employee next of kin email already exists';
                    $_SESSION["errors"]['nextemail'] = "employee next of kin email already exists";
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
            $sql = "SELECT *
                FROM employees e 
                WHERE e.next_Of_Kin_Phone = '$nextphone'
            ";
            $result = $conn->query($sql);
            if($result !== FALSE ){
                $employee_rec = $result->fetch_all(MYSQLI_ASSOC);
                if (count($employee_rec) > 0) {
                    //echo 'employee phone number already exists';
                    $_SESSION["errors"]['nextphone'] = "employee next of kin phone number already exists";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }
            }
            $sql = "INSERT INTO employees (employee_id, first_name, last_name, marital_status, gender, email, phone_number, date_of_employment, date_of_birth, nationality, religion, state_Of_Origin, lga, next_Of_Kin_FullName, next_Of_Kin_Relationship, next_Of_Kin_Email, next_Of_Kin_Phone )
            VALUES ( '$employeeid', '$fname', '$lname', '$mstatus', '$gender', '$email', '$phone', '$date_of_employment', '$date_of_birth', '$nationality', '$religion', '$stateOfOrigin', '$lga', '$nextfullname', '$nextrelation', '$nextemail', '$nextphone')";

            if($conn->query($sql) === TRUE){
                //echo "New record for employee created sucessfully";
                $_SESSION['sucess'] = 'New record for employee created';
                header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
               // $conn->close();
            }
        }
    $conn->close();
    ob_end_flush();
    ?>

</body>
</html>