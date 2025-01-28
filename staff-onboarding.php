<?php ob_start();?>
<?php session_start();?>
<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee onboarding page</title>
</head>
<body>
    <?php if(isset($_SESSION['sucess'])) { ?>
        <div class="success-container">
            <div class="success-message">
                <?php if(isset($_GET['mode']) && $_GET['mode'] === 'edit'){ ?> <p> employee record updated successfully!</p>
                <?php }else{ ?><p>New record for employee created successfully!</p><?php } ?>
            </div>
            <div class="button-group">
                <a href="staff-onboarding.php" class="btn btn-primary">Add Another Employee</a>
                <a href="employee-records.php" class="btn btn-secondary">View Employee List</a>
            </div>
            <?php unset($_SESSION['sucess']); ?>
        </div>
    <?php } else{ 
    
        if(isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode']==='edit'){
            //only works in edit mode
            
            // 1. sql call to get user details
            $id = $_GET['id']; 
           
            $emp_query = "SELECT * FROM employees WHERE id = $id";
            $emp_result = $conn->query($emp_query);
            // $employee_name = "Unknown Employee";
            // $employee_id = "N/A";
            if ($emp_result && $emp_result->num_rows > 0) {
                $emp_data = $emp_result->fetch_assoc();

                // 2. set previous_values session variables using the gotten details
                $_SESSION['previous_values'] = [
                    'id' => $emp_data["id"],
                    'employeeid' => $emp_data["employee_id"],
                    'fname' => $emp_data["first_name"],
                    'lname' => $emp_data["last_name"],
                    'mstatus' => $emp_data["marital_status"],
                    'gender' => $emp_data["gender"],
                    'email' => $emp_data["email"],
                    'phone' => $emp_data["phone_number"],
                    'doe' => $emp_data["date_of_employment"],
                    'dob' => $emp_data["date_of_birth"],
                    'nationality' => $emp_data["nationality"],
                    'religion' => $emp_data["religion"],
                    'stateOfOrigin' => $emp_data["state_Of_Origin"],
                    'lga' =>$emp_data["lga"],
                    'nextfullname' =>$emp_data["next_Of_Kin_FullName"],
                    'nextrelation' => $emp_data["next_Of_Kin_Relationship"],
                    'nextemail' => $emp_data["next_Of_Kin_Email"],
                    'nextphone' => $emp_data["next_Of_Kin_Phone"],
                    'passport_photo' => $emp_data["passport_photo"],
                    'certificate_doc' => $emp_data["certificate_path"],
                ];
            }else{
                echo "Error". $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- php if  are we iuin edit mode?-->
            <?php if(isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode'] === 'edit'){?>
                <div class="form-message">Edit the Employee details</div>
            <?php }else{ ?>
                <div class="form-message">Please fill all the details in the form to create a new employee</div>
            <?php } ?>
             <!-- if true -->
              <!-- else: -->

            <!-- Employee ID -->
            <label>Employee Id:</label><br>
            <input type="text" name="employeeid" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['employeeid'].'"';
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
            <input type="tel" name="phone" required <?php if(isset($_SESSION['previous_values'])){
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
            <input type="tel" name="nextphone" required <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['nextphone'].'"';
            } ?>><br>
            <div class="error-message">
                <?php if(isset($_SESSION['errors']['nextphone'])){
                    echo $_SESSION['errors']['nextphone'];
                    unset($_SESSION['errors']['nextphone']);
                }?>
            </div>
            <label>Upload your Passport Photograph:</label><br>
            <input type="file" name="passport_photo" id="passport_photo" accept=".jpg,.png,.jpeg"  <?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['passport_photo'].'"';
            } ?>>
           <br><br>
            <label>Upload your Certificate:</label><br>
            <input type="file" name="certificate_doc" id="certificate_doc" accept=".pdf,"<?php if(isset($_SESSION['previous_values'])){
                echo 'value="'.$_SESSION['previous_values']['certificate_doc'].'"';
            } ?>>
            <br>

            <input type="submit" name="submit" <?php if(isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode']){echo "value='save'";} ?>>
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
        


        if(isset($_POST["submit"])){
            // $emp = $_POST['eId'];
            $employeeid = $_POST['employeeid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mstatus = $_POST['mstatus'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $date_of_employment = $_POST['doe'];
            $date_of_birth = $_POST['dob'];
            $nationality = $_POST['nationality'];
            $religion = $_POST['religion'];
            $stateOfOrigin = $_POST['stateOfOrigin'];
            $lga = $_POST['lga'];
            $nextfullname = $_POST['nextfullname'];
            $nextrelation = $_POST['nextrelation'];
            $nextemail = $_POST['nextemail'];
            $nextphone= $_POST['nextphone'];
            $fileimage= $_POST['passport_photo'];
            $certificate= $_POST['certificate_path'];


            $_SESSION['previous_values'] = [
                'employeeid' => $employeeid,
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
                'nextphone' => $nextphone,
                'passport_photo' => $fileimage,
                'certificate_doc' => $certificate
            ];

            if (!isset($_GET['mode'])) {
                
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
                //code for file uploads
                $target_dir = "uploads/passport_photos/";
                $target_file = $target_dir .time()."_".str_replace(" ", "_",basename($_FILES["passport_photo"]["name"]));
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                $check = getimagesize($_FILES["passport_photo"]["tmp_name"]);
                //echo print_r($check).'<br>';
                if($check !== false){
                    echo "file is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                }else{
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                if(move_uploaded_file($_FILES["passport_photo"]["tmp_name"], $target_file)){
                    echo "The file". htmlspecialchars(basename($_FILES["passport_photo"]["name"])). "has been uploaded";
                }else{
                    echo "sorry, there was an error uploading your file";
                }
                $certificate_dir = "uploads/certificates/";
                $certificate_file  = $certificate_dir .time()."_".str_replace(" ", "_",basename($_FILES["certificate_doc"]["name"]));
                //$certificate_file = $certificate_dir .time(). basename($_FILES["certificate_doc"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($certificate_file, PATHINFO_EXTENSION));
                
                $check = getimagesize($_FILES["certificate_doc"]["tmp_name"]);
                //echo print_r($check).'<br>';
                if($check !== false){
                    echo "certificate uploaded - " . $check["mime"] . ".";
                    $uploadOk = 1;
                }else{
                    echo "certificate not uploaded.";
                    $uploadOk = 0;
                }
                if(move_uploaded_file($_FILES["certificate_doc"]["tmp_name"], $certificate_file)){
                    echo "The file". htmlspecialchars(basename($_FILES["certificate_doc"]["name"])). "has been uploaded";
                }else{
                    echo "sorry, there was an error uploading your certificate";
                }
            }
       
        
            // send to db
            // check if you are in edit mode
            if (isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode']) {
                $update_id = $_GET['id']; 
                $sql = "UPDATE employees SET 
                    first_name = '$fname',
                    last_name = '$lname',
                    marital_status = '$mstatus',
                    gender = '$gender',
                    email = '$email',
                    phone_number = '$phone',
                    date_of_employment = '$date_of_employment',
                    date_of_birth = '$date_of_birth',
                    nationality = '$nationality',
                    religion = '$religion',
                    state_Of_Origin = '$stateOfOrigin',
                    lga = '$lga',
                    next_Of_Kin_FullName = '$nextfullname',
                    next_Of_Kin_Relationship = '$nextrelation',
                    next_Of_Kin_Email = '$nextemail',
                    next_Of_Kin_Phone = '$nextphone',
                    passport_photo = '$target_file',
                    certificate_path = '$certificate_file'
                    WHERE id='$update_id';
                ";
            }else{
            $sql = "INSERT INTO employees (employee_id, first_name, last_name, marital_status, gender, email, phone_number, date_of_employment, date_of_birth, nationality, religion, state_Of_Origin, lga, next_Of_Kin_FullName, next_Of_Kin_Relationship, next_Of_Kin_Email, next_Of_Kin_Phone, passport_photo, certificate_path)
            VALUES ( '$employeeid', '$fname', '$lname', '$mstatus', '$gender', '$email', '$phone', '$date_of_employment', '$date_of_birth', '$nationality', '$religion', '$stateOfOrigin', '$lga', '$nextfullname', '$nextrelation', '$nextemail', '$nextphone',  '$target_file', '$certificate_file')";
              
            }

            if($conn->query($sql) === TRUE){
                //echo "New record for employee created sucessfully";
                
                $_SESSION['sucess'] = 'New record for employee created';
                header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
               // $conn->close();
            }
        }else{
            echo print_r(isset($_POST['submit']));die;
        }
    $conn->close();
    ob_end_flush();
    ?>

</body>
</html>