<?php 
// Backend logic untouched
$errorMsg = ''; 
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'wrongpass') {
        $errorMsg = 'Incorrect password. Please try again.';
    } elseif ($_GET['error'] == 'notfound') {
        $errorMsg = 'User not found. Please check your email/mobile number.';
    } elseif ($_GET['error'] == 'empty') {
        $errorMsg = 'Please fill in all fields.';
    } elseif ($_GET['error'] == 'dberror') {
        $errorMsg = 'Database error. Please try again later.';
    } elseif ($_GET['error'] == 'nopassword') {
        $errorMsg = 'No password set for this account. Please contact administrator.';
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login - Blood Donor System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e63946;
            --primary-hover: #c1121f;
            --bg-gradient: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --text-main: #2b2d42;
            --text-muted: #8d99ae;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            background-attachment: fixed;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--text-main);
        }

        /* Decorative Background Blobs */
        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(230, 57, 70, 0.1);
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
        }

        .container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: var(--glass-bg);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 3rem;
            margin-bottom: 10px;
            display: inline-block;
            filter: drop-shadow(0 4px 6px rgba(230, 57, 70, 0.3));
        }

        h1 {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .tagline {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 2px solid #edf2f4;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.1);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s ease;
            font-family: inherit;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
            margin-bottom: 12px;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-muted);
            text-decoration: none;
            display: block;
            text-align: center;
            font-size: 0.9rem;
        }

        .error-message-box {
            background-color: #fff1f2;
            border-left: 4px solid var(--primary);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: #991b1b;
        }

        .footer-links {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-pass {
            display: block;
            text-align: right;
            font-size: 0.8rem;
            margin-top: -15px;
            margin-bottom: 20px;
            color: var(--text-muted);
            text-decoration: none;
        }

        .forgot-pass:hover { color: var(--primary); }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-card { animation: fadeIn 0.6s ease-out; }
    </style>
</head>
<body>
    <div class="blob" style="top: 10%; left: 10%;"></div>
    <div class="blob" style="bottom: 10%; right: 10%; background: rgba(0,0,0,0.05);"></div>

    <div class="container">
        <div class="login-card">
            <header class="logo-section">
                <div class="logo-icon">🩸</div>
                <div class="logo-text">
                    <h1>Donor Login</h1>
                    <p class="tagline">Welcome back, Hero!</p>
                </div>
            </header>

            <?php if (!empty($errorMsg)): ?>
            <div class="error-message-box">
                <strong>Wait!</strong> <?php echo htmlspecialchars($errorMsg); ?>
            </div>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="emailOrMobile">Email or Mobile</label>
                    <input type="text" id="emailOrMobile" name="emailOrMobile" required placeholder="Enter details">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <a href="forgot_password.php" class="forgot-pass">Forgot Password?</a>

                <button type="submit" class="btn btn-primary">Login to Account</button>
                <a href="index.php" class="btn btn-secondary">← Back to Home</a>
            </form>

            <div class="footer-links">
                <p>New donor? <a href="register.php">Create Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>