<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
   
    <!-- <form  id="registrationForm" action="" method ="POST">
       
        <label for="">firstname</label><br>
        <input type="text" name="firstname"><br>
        <label for="">lastname</label><br>
        <input type="text" name="lastname"><br>
        <label for="">username</label><br>
        <input type="text" name="username"><br>
        <label for="">Password</label><br>
        <input type="password" name="password"><br>
        <label for="">Confirm Password</label><br>
        <input type="password" name="confirm_password"><br>
        <label for="">Email</label><br>
        <input type="email" name="email"><br>
        <label for="">Position</label><br>
        <input type="text" name="position"><br>
        <input type="submit" name="submit">
    </form> -->
    <div class="container">
        <div class="form-container">
            <h2>User Registration</h2>

            <form id="registrationForm">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" id="firstname">
                    <small class="error" id="fnameError">First name is required.</small>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" id="lastname">
                    <small class="error" id="lnameError">Last name is required.</small>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username">
                    <small class="error" id="usernameError">Username is required.</small>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                    <small class="error" id="passwordError">Password is required.</small>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">
                    <small class="error" id="confirmPasswordError">Passwords do not match.</small>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email">
                    <small class="error" id="emailError">Enter a valid email.</small>
                </div>

                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="position" id="position">
                    <small class="error" id="positionError">Position is required.</small>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .error {
            color: red;
            font-size: 12px;
            display: none;
        }
    </style>
    <?php
        if(isset($_POST['submit'])){
            $firstname = $_POST['firstname'];
            $lastname  = $_POST['lastname'];
            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $email     = $_POST['email'];
            $position  = $_POST['position'];
            $sql = " INSERT INTO users ( firstname, lastname, username, `password`, email, position) VALUE('$firstname', '$lastname', '$username' , '$password', '$email',  '$position') ";
            if($conn->query($sql) === TRUE){
                echo "New user created sucessfully";
                
                // $_SESSION['sucess'] = 'New record for employee created';
                // header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }

    ?>
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Get field values
            let firstname = document.getElementById("firstname").value.trim();
            let lastname = document.getElementById("lastname").value.trim();
            let username = document.getElementById("username").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirmPassword = document.getElementById("confirm_password").value.trim();
            let email = document.getElementById("email").value.trim();
            let position = document.getElementById("position").value.trim();

            // Validation checks
            if (firstname === "") {
                document.getElementById("fnameError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("fnameError").style.display = "none";
            }

            if (lastname === "") {
                document.getElementById("lnameError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("lnameError").style.display = "none";
            }

            if (username === "") {
                document.getElementById("usernameError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("usernameError").style.display = "none";
            }

            if (password === "") {
                document.getElementById("passwordError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("passwordError").style.display = "none";
            }

            if (confirmPassword === "" || password !== confirmPassword) {
                document.getElementById("confirmPasswordError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("confirmPasswordError").style.display = "none";
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailPattern)) {
                document.getElementById("emailError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
            }

            if (position === "") {
                document.getElementById("positionError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("positionError").style.display = "none";
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>