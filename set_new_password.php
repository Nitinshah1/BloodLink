<?php
session_start();
include('config.php');

// 1. Double Security Check: OTP verify hua hai ya nahi?
if (!isset($_SESSION['reset_email']) || !isset($_SESSION['otp_verified'])) {
    header("Location: forgot_password.php");
    exit();
}

if (isset($_POST['update_password'])) {
    $new_pass = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = $_SESSION['reset_email'];

    if ($new_pass === $confirm_pass) {
        // Minimum password length check (Basic security)
        if(strlen($new_pass) < 6) {
            $error = "Password must be at least 6 characters long!";
        } else {
            // Password Hashing
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
            
            // Database Update
            $sql = "UPDATE donors SET password = '$hashed_password' WHERE email = '$email'";
            
            if (mysqli_query($conn, $sql)) {
                // Success: Sab clear karo aur login par bhejo
                session_unset();
                session_destroy();
                echo "<script>
                        alert('Password Updated Successfully! Please login.');
                        window.location.href='login.php';
                      </script>";
                exit();
            } else {
                $error = "Database Error: " . mysqli_error($conn);
            }
        }
    } else {
        $error = "Passwords do not match! Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - BloodLink</title>
    <link rel="stylesheet" href="register.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f4f4; font-family: 'Inter', sans-serif; margin:0;">
    <div style="background: white; padding: 35px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 400px; text-align: center;">
        
        <div style="font-size: 3rem; margin-bottom: 10px;">🔐</div>
        <h2 style="color: #c41e3a; margin-bottom: 10px; font-weight: 800;">New Password</h2>
        <p style="color: #666; font-size: 0.9rem; margin-bottom: 25px;">Create a strong password for <br><b style="color:#333;"><?php echo htmlspecialchars($_SESSION['reset_email']); ?></b></p>
        
        <?php if(isset($error)) echo "<p style='color:#721c24; background:#f8d7da; padding:10px; border-radius:8px; font-size:0.85rem; margin-bottom:20px;'>$error</p>"; ?>

        <form method="POST">
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="font-weight: 700; font-size: 0.85rem; color: #444;">New Password</label>
                <input type="password" name="password" required placeholder="Min. 6 characters" 
                       style="width: 100%; padding: 12px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; outline: none;">
            </div>
            <div style="text-align: left; margin-bottom: 25px;">
                <label style="font-weight: 700; font-size: 0.85rem; color: #444;">Confirm Password</label>
                <input type="password" name="confirm_password" required placeholder="Re-type password" 
                       style="width: 100%; padding: 12px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; outline: none;">
            </div>
            <button type="submit" name="update_password" 
                    style="background: #c41e3a; color: white; border: none; padding: 15px; width: 100%; border-radius: 10px; cursor: pointer; font-weight: 800; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);">
                Update Password
            </button>
        </form>
    </div>
</body>
</html>