<?php
session_start();
include('config.php'); 

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Database admin check 
    $sql = "SELECT * FROM site_admin WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $row['username'];
        
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - BloodLink</title>
    <link rel="stylesheet" href="styles.css"> </head>
<body style="background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; font-family: 'Inter', sans-serif;">

    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; text-align: center;">
        <h2 style="color: #c41e3a; margin-bottom: 20px;">Admin Login</h2>

        
        
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required 
                   style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 6px;">
            
            <input type="password" name="password" placeholder="Password" required 
                   style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 6px;">
            
            <button type="submit" name="login" 
                    style="width: 100%; padding: 12px; background: #c41e3a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                Login to Dashboard
            </button>
            <br></br>
            <br></br>
            <br></br>
                <a href="index.php
                    " class="btn btn-secondary">Back to Home</a>
        </form>

        <?php if(isset($error)) echo "<p style='color: #c41e3a; margin-top: 15px; font-size: 0.9rem;'>$error</p>"; ?>
    </div>

</body>
</html>