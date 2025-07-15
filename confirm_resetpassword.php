<?php require_once 'db_connection.php';?>
<?php
session_start();
if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_code'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['reset_email'];
$code = $_SESSION['reset_code'];

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $entered_code = trim($_POST['reset_code']);
    $new_password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($entered_code) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($entered_code != $_SESSION['reset_code']) {
        $error = "Invalid reset code.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Reset code is valid, update password
        $email = $_SESSION['reset_email'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            $success = "Password has been successfully reset.";
            $_SESSION['success_message'] = $success;
            // Optionally unset session vars
            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_code']);
            header("Location: login.php");
            exit();
        } else {
            $error = "An error occurred while resetting your password.";
        }
    }
}?>

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
            <h2>Reset Password</h2>

            <?php if (!empty($success)): ?>
                <div class="success-msg"><?= $success ?></div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= $error ?></div>
            <?php endif; ?>

            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label>Reset Code</label>
                    <input type="text" name="reset_code" id="code">
                    <small class="error" id="codeError">Enter a valid code.</small>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" id="psw">
                    <small class="error" id="passwordError">Enter a valid password.</small>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm">
                    <small class="error" id="confirmError">Passwords must match.</small>
                </div>

                <input type="submit" class="btn" name="submit" value="Reset Password">
            </form>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
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
        .form-group {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px 10px 10px; /* Space for button */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 20px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            margin-bottom:0px;
            font-weight: bold;
        }
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</body>
</html>