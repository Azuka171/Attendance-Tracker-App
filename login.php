<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>

            <form id="loginForm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email">
                    <small class="error" id="emailError">Enter a valid email.</small>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                    <small class="error" id="passwordError">Password is required.</small>
                </div>

                <button type="submit" class="btn">Login</button>
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
            max-width: 350px;
        }

        .login-form {
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
            $email = $_POST['email'];
            $password  = $_POST['password'];
            $sql = " SELECT * FROM users WHERE email = '$email' AND `password` = '$password'";
            $result = $conn->query($sql);
            $emp = $result->fetch_assoc();
            // echo print_r(count($emp)>0);die;
            if($result !== FALSE && $emp!==null){
                echo "login successful";
                // $_SESSION['sucess'] = 'New record for employee created';
                // header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "login unsuccessful";
                // echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }
    ?>
    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Get field values
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();

            // Email validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailPattern)) {
                document.getElementById("emailError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
            }

            // Password validation
            if (password === "") {
                document.getElementById("passwordError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("passwordError").style.display = "none";
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>