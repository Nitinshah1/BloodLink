<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post & Manage Request | Blood Donor System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --red: #c41e3a; --dark: #333; }
        body { font-family: 'Inter', sans-serif; background: #fdf2f2; margin: 0; padding: 20px; }
        .main-container { max-width: 900px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        
        /* Glassmorphism Card Design [cite: 2025-10-01] */
        .form-card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-top: 6px solid var(--red); }
        
        h2 { color: var(--dark); font-weight: 800; margin-bottom: 20px; font-size: 1.4rem; }
        input, select, textarea { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        
        .btn-submit { background: var(--red); color: white; border: none; padding: 15px; width: 100%; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { background: #a31830; }
        
        .btn-delete { background: #333; color: white; border: none; padding: 15px; width: 100%; border-radius: 8px; font-weight: 700; cursor: pointer; }
        
        .info-text { font-size: 0.85rem; color: #666; margin-bottom: 20px; }
        
        @media (max-width: 768px) { .main-container { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="main-container">
    <div class="form-card">
        <h2>🆘 New Blood Request</h2>
        <form action="save_request.php" method="POST">
            <input type="text" name="p_name" placeholder="Patient Full Name" required>
            <select name="b_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option><option value="B+">B+</option>
                <option value="O+">O+</option><option value="AB+">AB+</option>
                <option value="A-">A-</option><option value="B-">B-</option>
                <option value="O-">O-</option><option value="AB-">AB-</option>
            </select>
            <input type="text" name="hospital" placeholder="Hospital Name & City" required>
            <input type="text" name="city" placeholder="Your City" required>
            <input type="text" id="reg_phone" name="contact" placeholder="Your Phone Number" required>
            <label style="font-size: 0.85rem; color: #666; font-weight: 600;">How urgent is the requirement?</label>
<select name="urgency" required style="border: 2px solid #ffcccc;">
    <option value="Normal">Normal (Within 24-48 hrs)</option>
    <option value="Urgent">Urgent (Within 6-12 hrs)</option>
    <option value="Urgent">Urgent (Within 3-6 hrs)</option>

    <option value="Critical">🚨 Critical (Immediately Required)</option>
</select>
            <textarea name="msg" placeholder="Any special message or emergency details..."></textarea>
            <button type="submit" class="btn-submit">Post Emergency Request</button>
        </form>
    </div>

    <div class="form-card" style="border-top-color: #333;">
        <h2>✅ Got a Donor?</h2>
        <p class="info-text">If you have found a donor, please delete your post from here so that people don’t keep calling you repeatedly.</p>
        
        <div id="delete_step_1">
            <input type="text" id="del_phone" placeholder="Enter Registered Phone Number">
            <button type="button" class="btn-delete" onclick="handleOTP()">Request OTP to Delete</button>
        </div>
    </div>
</div>

<script>
function handleOTP() {
    let phone = document.getElementById('del_phone').value;
    if(phone == "") {
        alert("Bhai, pehle phone number toh daal!");
        return;
    }

    // Fake OTP Generation [cite: 2025-10-01]
    let fakeOTP = Math.floor(1000 + Math.random() * 9000);
    alert("🔐 Verification Code: " + fakeOTP + "\n(Simulation: Real SMS would go to " + phone + ")");

    let userOTP = prompt("Enter the 4-digit code sent to " + phone);

    if(userOTP == fakeOTP) {
        // Redirect to a delete logic page with phone number [cite: 2026-01-26]
        window.location.href = "delete_by_phone.php?phone=" + phone;
    } else {
        alert("❌ Wrong Code! Verification failed.");
    }
}
</script>

</body>
</html>