<?php require_once 'db_connection.php';?>
<?php session_start();?>
<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once 'envtemp.php';

    //Load Composer's autoloader (created by composer, not included with PHPMailer)
    // require 'vendor/autoload.php';

    // Ensure PHPMailer files are correctly included relative to api.php
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $sql = " SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        $emp = $result->fetch_assoc();
        if ($emp) {
            $reset_msg = 'this is a test reset';
            // mail($email, 'Password Reset Code', $reset_msg);
            $reset_code = rand(1000, 9999);
            $userId = $emp['id'];
            $sql = "INSERT INTO resetcodes(userid, code, expiretime) VALUES('$userId','$reset_code', DATE_ADD(NOW(), INTERVAL 30 MINUTE))";
            if ($conn->query($sql) === TRUE) {
                # code...
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = $smtp_host;                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $smtp_username;                     //SMTP username
                    $mail->Password   = $smtp_password;                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                    //Recipients
                    $mail->setFrom($smtp_username, 'Mailer');
                    $mail->addAddress($email, $emp->name);
                    $mail->addReplyTo($smtp_username, 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
    
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Reset Passowrd Code';
                    $mail->Body    = "Use code: <b>$reset_code</b> to reset your password";
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
                    $mail->send();
                    echo 'Reset code has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        else{
            echo 'oop user not found';
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
            <h2>Resetpassword</h2>

            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email">
                    <small class="error" id="emailError">Enter a valid email.</small>
                </div>
                <input type="submit" class="btn" name="submit" value="resend reset code">
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
    </style>
</body>
</html>