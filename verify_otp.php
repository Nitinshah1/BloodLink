<?php
// 1. Session start karna zaroori hai OTP check karne ke liye
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Security Check: Agar koi direct is page pe aaye bina email dale
if (!isset($_SESSION['reset_otp']) || !isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$error = "";

// 3. OTP Verification Logic
if (isset($_POST['verify_now'])) {
    
    $user_otp = trim($_POST['otp_code']); 
    $system_otp = $_SESSION['reset_otp']; 

    // String comparison safe rehta hai
    if ((string)$user_otp === (string)$system_otp) {
        // Success: User ko session mein verify mark kar dein
        $_SESSION['otp_verified'] = true; 
        header("Location: set_new_password.php");
        exit();
    } else {
        $error = "Invalid OTP. Please check your email and try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - BloodLink</title>
    <link rel="stylesheet" href="register.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; font-family: 'Inter', sans-serif; margin:0;">
    <div style="background: white; padding: 35px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 400px; text-align: center;">
        
        <div style="font-size: 3rem; margin-bottom: 10px;">✉️</div>
        <h2 style="color: #c41e3a; margin-bottom: 10px; font-weight: 800;">Verify OTP</h2>
        <p style="color: #666; font-size: 0.9rem; margin-bottom: 25px;">
            We've sent a 6-digit code to <br>
            <b style="color: #333;"><?php echo htmlspecialchars($_SESSION['reset_email']); ?></b>
        </p>
        
        <?php if(!empty($error)) echo "<p style='color:#721c24; background:#f8d7da; border:1px solid #f5c6cb; padding:10px; border-radius:8px; font-size:0.85rem; margin-bottom:20px;'>$error</p>"; ?>

        <form method="POST" action="">
            <div style="text-align: left; margin-bottom: 25px;">
                <label style="font-weight: 700; font-size: 0.85rem; color: #444; text-transform: uppercase;">Verification Code</label>
                <input type="text" name="otp_code" maxlength="6" required placeholder="· · · · · ·" 
                       style="width: 100%; padding: 15px; margin-top: 10px; border: 2px solid #eee; border-radius: 10px; box-sizing: border-box; text-align: center; font-size: 1.5rem; letter-spacing: 10px; font-weight: bold; transition: 0.3s; outline: none;"
                       onfocus="this.style.borderColor='#c41e3a'">
            </div>
            
            <button type="submit" name="verify_now" 
                    style="background: #c41e3a; color: white; border: none; padding: 16px; width: 100%; border-radius: 10px; cursor: pointer; font-weight: 800; font-size: 1.1rem; transition: 0.3s; box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);">
                Verify & Continue
            </button>
        </form>
        
        <div style="margin-top: 25px; border-top: 1px solid #eee; padding-top: 20px;">
            <p style="font-size: 0.85rem; color: #888;">
                Didn't receive code? <br>
                <a href="forgot_password.php" style="color: #c41e3a; text-decoration: none; font-weight: 700;">Click here to Resend</a>
            </p>
        </div>
    </div>
</body>
</html>