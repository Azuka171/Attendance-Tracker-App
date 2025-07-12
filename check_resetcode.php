<?php
header('Content-Type: application/json');

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Ensure PHPMailer files are correctly included relative to api.php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


    $mail = new PHPMailer(true);


    $smpt_username = 'mailer@suntechenterprise.com.ng';
    $smtp_password = 'r8&hp_^&ZQkEoyeE';
    $smtp_port = '465';
    $smtp_host ='mail.suntechenterprise.com.ng' ;
    // $smpt_username = 'admin@affiliatepartnerpath.pro';
    // $smtp_password = 'MuE]8QO0I2Y;';
    // $smtp_port = '465';
    // $smtp_host ='affiliatepartnerpath.pro' ;

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Set to 2 for debugging, 0 for production
        $mail->isSMTP();
        $mail->Host       = $smtp_host; // Your SMTP Host
        $mail->SMTPAuth   = true;
        $mail->Username   = $smpt_username; // Your SMTP Username
        $mail->Password   = $smtp_password; // *IMPORTANT: Replace with your actual SMTP password*
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // or PHPMailer::ENCRYPTION_STARTTLS
        $mail->Port       = 465; // Use 587 for STARTTLS, 465 for SMTPS

        // Recipients
        $mail->setFrom($smpt_username, 'Robinhood Affiliate Program'); // Sender email and name
        $mail->addAddress('gideonazuka100@gmail.com'); // Admin's email address
        $mail->addReplyTo($smpt_username); // Reply-to set to user's email

        // Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = 'siiiiiii';
        $mail->Body    = 'body test';

        $mail->send();
        return ['success' => true, 'error' => null];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }

?>