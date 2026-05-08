<?php
session_start();
include 'config.php'; // Database connection zaroori hai email check karne ke liye

// PHPMailer Files Include (Direct folder se)
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_otp'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // 1. Pehle check karo ki email database mein hai ya nahi
    $check_user = mysqli_query($conn, "SELECT * FROM donors WHERE email = '$email'");
    
    if (mysqli_num_rows($check_user) > 0) {
        // 2. OTP Generate karo (6 digits)
        $otp = rand(100000, 999999);
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_email'] = $email;

        // 3. PHPMailer setup
        $mail = new PHPMailer(true);

        try {
            // Server settings (Gmail example)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'wa411349@gmail.com'; // APNA EMAIL DALO
            $mail->Password   = 'rtnj zkeq espz nurr';    // APNA APP PASSWORD DALO
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'BloodLink Support');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP - BloodLink';
            $mail->Body    = "Your verification code to reset password is: <b>$otp</b>. Do not share this with anyone.";

            $mail->send();
            header("Location: verify_otp.php");
            exit();
        } catch (Exception $e) {
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "This email is not registered with us!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - BloodLink</title>
    <link rel="stylesheet" href="register.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; font-family: 'Inter', sans-serif;">
    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 380px; text-align: center;">
        <h2 style="color: #c41e3a; margin-bottom: 10px;">Forgot Password?</h2>
        <p style="color: #666; font-size: 0.9rem; margin-bottom: 25px;">Enter your registered email to receive a 6-digit verification code.</p>
        
        <?php if(isset($error)) echo "<p style='color:red; font-size:0.85rem; background:#fff1f1; padding:10px; border-radius:5px;'>$error</p>"; ?>

        <form method="POST">
            <div style="text-align: left; margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 0.85rem;">Email Address</label>
                <input type="email" name="email" required placeholder="example@mail.com" 
                       style="width: 100%; padding: 12px; margin-top: 8px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;">
            </div>
            <button type="submit" name="send_otp" 
                    style="background: #c41e3a; color: white; border: none; padding: 14px; width: 100%; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 1rem;">
                Send OTP
            </button>
        </form>
        
        <div style="margin-top: 20px;">
            <a href="index.php" style="text-decoration: none; color: #666; font-size: 0.9rem;">← Back to Home</a>
        </div>
    </div>
</body>
</html>