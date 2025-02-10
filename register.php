<?php session_start()?>
<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
   
   
    <?php
        if(isset($_POST['submit'])){
            $firstname = $_POST['firstname'];
            $lastname  = $_POST['lastname'];
            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $email     = $_POST['email'];
            $position  = $_POST['position'];


            $_SESSION['previous_values'] = [
                'firstname'=>  $firstname,
                'lastname' =>  $lastname,
                'username' =>  $username,
                'password' =>  $password,
                'email'    =>  $email,
                'position' =>  $position
            ];
            $sql = "SELECT *
                    FROM users u
                    WHERE u.email = '$email'
                ";
                $result = $conn->query($sql);
                if($result !== FALSE ){
                    $user_reg = $result->fetch_all(MYSQLI_ASSOC);
                    if (count($user_reg) > 0) {
                        echo 'user email already exists';
                        $_SESSION["errors"]['email'] = " user email already exists";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
    
                    }
                }

            $sql = "SELECT *
                FROM users u
                    WHERE u.username = '$username'
                ";
                $result = $conn->query($sql);
                if($result !== FALSE ){
                    $user_reg = $result->fetch_all(MYSQLI_ASSOC);
                    if (count($user_reg) > 0) {
                        echo 'username already exists';
                        $_SESSION["errors"]['username'] = " username already exists";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;

                    }
                }
            $sql = "SELECT *
                    FROM users u
                    WHERE u.password = '$password'
                ";
                $result = $conn->query($sql);
                if($result !== FALSE ){
                    $user_reg = $result->fetch_all(MYSQLI_ASSOC);
                    if (count($user_reg) > 0) {
                        echo 'user password already exists';
                        $_SESSION["errors"]['password'] = " user password already exists";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
    
                    }
                }
           
            // encrypt pass
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = " INSERT INTO users ( firstname, lastname, username, `password`, email, position) VALUE('$firstname', '$lastname', '$username' , '$hashed_pass', '$email',  '$position') ";
            if($conn->query($sql) === TRUE){
                //echo "New user created sucessfully";
                 $_SESSION['success'] = 'New user created sucessfully';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }

    ?>
    <div class="container">
        <?php if(isset($_SESSION['success'])) { ?>
        <div class="success-message">
            <?php echo $_SESSION['success']; ?>
        </div>
        <div class="button-container">
            <a href="register.php">
                <button class="styled-button">Add Another User</button>
            </a>
        </div>
        <?php unset($_SESSION['success']); } else { ?>
        <div class="form-container">
            <h2>User Registration</h2>
    
            <form id="registrationForm" method="POST">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" id="firstname"  required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['firstname'].'"';
                     } ?>>
                    <!-- <small class="error" id="fnameError">First name is required.</small> -->
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" id="lastname" required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['lastname'].'"';
                     } ?>>
                    <!-- <small class="error" id="lnameError">Last name is required.</small> -->
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username"  required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['username'].'"';
                     } ?>>
                    <!-- <small class="error" id="usernameError">Username is required.</small> -->
                    <div class="error-message">
                        <?php if(isset($_SESSION['errors']['username'])){
                            echo $_SESSION['errors']['username'];
                            unset($_SESSION['errors']['username']);
                        }?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['password'].'"';
                     } ?>>
                    <!-- <small class="error" id="passwordError">Password is required.</small> -->
                    <div class="error-message">
                        <?php if(isset($_SESSION['errors']['password'])){
                            echo $_SESSION['errors']['password'];
                            unset($_SESSION['errors']['password']);
                        }?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                    <!-- <small class="error" id="confirmPasswordError">Passwords do not match.</small> -->
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email"  required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['firstname'].'"';
                     } ?>>
                    <!-- <small class="error" id="emailError">Enter a valid email.</small> -->
                    <div class="error-message">
                        <?php if(isset($_SESSION['errors']['email'])){
                            echo $_SESSION['errors']['email'];
                            unset($_SESSION['errors']['email']);
                        }?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="position" id="position" required <?php if(isset($_SESSION['previous_values'])){
                     echo 'value="'.$_SESSION['previous_values']['position'].'"';
                     } ?>>
                    <!-- <small class="error" id="positionError">Position is required.</small> -->
                </div>

                <!-- <button type="submit" class="btn">Register</button> -->
                <input type="submit" name="submit" class="btn" value="Register">
            </form>
        </div> <?php } ?>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .success-message {
            background-color:rgb(205, 223, 209);
            color:rgb(8, 187, 50);
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .button-container {
            text-align: center;
            margin-top: 10px;
        }

        .styled-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .styled-button:hover {
            background-color: #0056b3;
        }
    </style>
    
    <script>
        // document.getElementById("registrationForm").addEventListener("submit", function(event) {
        //     let isValid = true;

        //     // Get field values
        //     let firstname = document.getElementById("firstname").value.trim();
        //     let lastname = document.getElementById("lastname").value.trim();
        //     let username = document.getElementById("username").value.trim();
        //     let password = document.getElementById("password").value.trim();
        //     let confirmPassword = document.getElementById("confirm_password").value.trim();
        //     let email = document.getElementById("email").value.trim();
        //     let position = document.getElementById("position").value.trim();

        //     // Validation checks
        //     if (firstname === "") {
        //         document.getElementById("fnameError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("fnameError").style.display = "none";
        //     }

        //     if (lastname === "") {
        //         document.getElementById("lnameError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("lnameError").style.display = "none";
        //     }

        //     if (username === "") {
        //         document.getElementById("usernameError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("usernameError").style.display = "none";
        //     }

        //     if (password === "") {
        //         document.getElementById("passwordError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("passwordError").style.display = "none";
        //     }

        //     if (confirmPassword === "" || password !== confirmPassword) {
        //         document.getElementById("confirmPasswordError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("confirmPasswordError").style.display = "none";
        //     }

        //     let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //     if (!email.match(emailPattern)) {
        //         document.getElementById("emailError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("emailError").style.display = "none";
        //     }

        //     if (position === "") {
        //         document.getElementById("positionError").style.display = "block";
        //         isValid = false;
        //     } else {
        //         document.getElementById("positionError").style.display = "none";
        //     }

        //     // Prevent form submission if validation fails
        //     if (!isValid) {
        //         event.preventDefault();
        //     }
        // });
    </script>
</body>
</html>