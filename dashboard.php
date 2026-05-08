<?php
session_start();
include 'config.php';

// 1. Pehle check karo user login hai ya nahi
if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Database se user ka fresh data nikalo (donor_id use karke)
$session_id = $_SESSION['donor_id'];
$query = "SELECT * FROM donors WHERE donor_id = '$session_id'"; 
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Check for any pending blood receipt reports for this donor
$donor_id_check = $user['donor_id'];
$report_query = "SELECT * FROM donation_requests WHERE donor_id = '$donor_id_check' AND status = 'pending'";
$report_result = mysqli_query($conn, $report_query);
} else {
    // Agar data nahi mila toh logout karwa do
    header("Location: logout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard - Blood Donor System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="hero-background"><div class="hero-pattern"></div></div>
    
    <div class="container" style="max-width: 900px;">
        <header class="main-header">
            <div class="logo-section">
                <span class="logo-icon">🩸</span>
                <div class="logo-text">
                    <h1>Welcome Back, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
<?php 
    // Hum sirf ye check karenge ki pichle 90 din mein donation hui hai ya nahi
    // Status kuch bhi ho, agar date set hai toh message dikhega
    if (!empty($user['last_donation'])): 
        
        $last_date = new DateTime($user['last_donation']);
        $next_date = clone $last_date;
        $next_date->modify('+90 days');
        $today = new DateTime();
        
        $diff = $today->diff($next_date);
        $days_left = (int)$diff->format("%r%a");

        // Agar aaj ki date se 90 din poore nahi hue, toh message dikhao
        if ($days_left > 0): 
?>
    <div style="background: #e3f2fd; border-left: 5px solid #2196f3; padding: 15px; border-radius: 8px; margin: 20px auto; max-width: 820px; text-align: left; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <h4 style="color: #0d47a1; margin: 0 0 5px 0;">🛡️ Recovery Period Active</h4>
        <p style="margin: 0; color: #1565c0; font-size: 14px;">
            Thank you for your life-saving donation on <b><?php echo date('d M Y', strtotime($user['last_donation'])); ?></b>. 
            Verification successful! Your profile is now hidden from search.
            <br><b style="color: #c41e3a;">You can donate again in: <?php echo $days_left; ?> days.</b>
        </p>
    </div>
<?php 
        endif; 
    endif; 
?>
                    <p class="tagline">Your profile is helping save lives today.</p>
                </div>
            </div>
        </header>

        <main>
            <div class="form-card" style="padding: 40px; text-align: center;">
                <div style="font-size: 4rem; margin-bottom: 20px;">👤</div>


                <?php if (mysqli_num_rows($report_result) > 0): ?>
<div style="background: #fff5f5; border: 2px solid #c41e3a; padding: 20px; border-radius: 12px; margin-bottom: 30px; text-align: left;">
    <h3 style="color: #c41e3a; margin-top: 0; display: flex; align-items: center; gap: 10px;">
        ⚠️ Confirmation Required
    </h3>
    <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
        Someone has reported receiving blood from you. Please verify this to update your status.
    </p>

    <?php while($report = mysqli_fetch_assoc($report_result)): ?>
    <div style="background: white; padding: 15px; border-radius: 8px; border: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <div>
            <p style="margin: 0; font-weight: bold; color: #333;">Seeker Contact: <?php echo htmlspecialchars($report['seeker_phone']); ?></p>
            <small style="color: #999;">Date: <?php echo date('d M Y', strtotime($report['created_at'])); ?></small>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <form action="verify_donation.php" method="POST" style="margin:0;">
                <input type="hidden" name="request_id" value="<?php echo $report['id']; ?>">
                <button type="submit" name="action" value="approve" style="background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-weight: bold;">Verify</button>
            </form>

            <form action="verify_donation.php" method="POST" style="margin:0;">
                <input type="hidden" name="request_id" value="<?php echo $report['id']; ?>">
                <button type="submit" name="action" value="reject" style="background: #ccc; color: #333; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Ignore</button>
            </form>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php endif; ?>


                <h2>Profile Overview</h2>
                <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
                
                <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px;">
                    <div style="background: #fff5f5; padding: 20px; border-radius: 12px; min-width: 200px;">
                        <p style="color: #666; margin: 0;">Status</p>
                        <h3 style="color: <?php echo ($user['status'] == 'Available') ? '#00b341' : '#c41e3a'; ?>; margin: 5px 0;">
                            ● <?php echo htmlspecialchars($user['status']); ?>
                        </h3>
                    </div>
                    <div style="background: #fff5f5; padding: 20px; border-radius: 12px; min-width: 200px;">
                        <p style="color: #666; margin: 0;">ID Number</p>
                        <h3 style="color: #333; margin: 5px 0;">#<?php echo $user['donor_id']; ?></h3>
                    </div>
                </div>

                <div class="status-box" style="margin: 30px auto; padding: 20px; background: #f9f9f9; border-radius: 10px; max-width: 450px; border: 1px solid #ddd;">
                    <p style="margin-bottom: 15px;">Manage your visibility for seekers:</p>
                    <form action="update_status.php" method="POST">
                        <?php if($user['status'] == 'Available'): ?>
                            <button type="submit" name="new_status" value="Unavailable" class="btn" style="background: #666; color:white; padding: 10px 20px; border:none; border-radius: 5px; cursor:pointer;">Go Offline (Hide from Search)</button>
                        <?php else: ?>
                            <button type="submit" name="new_status" value="Available" class="btn" style="background: #28a745; color:white; padding: 10px 20px; border:none; border-radius: 5px; cursor:pointer;">Go Available (Show in Search)</button>
                        <?php endif; ?>
                    </form>
                </div>


                <div style="margin-top: 30px; text-align: left; background: #fff; padding: 25px; border-radius: 12px; border: 1px solid #eee;">
    <h3 style="color: #22577A; border-bottom: 2px solid #c41e3a; padding-bottom: 10px; margin-bottom: 20px;">📜 My Personal Details</h3>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; font-size: 15px;">
        <div><strong>Father/Husband:</strong> <?php echo htmlspecialchars($user['father_name']); ?></div>
        <div><strong>Date of Birth:</strong> <?php echo date('d M Y', strtotime($user['dob'])); ?></div>
        <div><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></div>
        <div><strong>Marital Status:</strong> <?php echo htmlspecialchars($user['marital_status']); ?></div>
        <div><strong>Blood Group:</strong> <span style="color: #c41e3a; font-weight: bold;"><?php echo htmlspecialchars($user['blood_group']); ?></span></div>
        <div><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></div>
        <div style="grid-column: span 2;"><strong>Location:</strong> <?php echo htmlspecialchars($user['city'] . ", " . $user['state'] . " (" . $user['pincode'] . ")"); ?></div>
        <div style="grid-column: span 2;"><strong>Full Address:</strong> <?php echo htmlspecialchars($user['address']); ?></div>
    </div>
</div>

                <div class="form-actions" style="margin-top: 40px; justify-content: center; display: flex; gap: 10px;">
                    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                    
                    <a href="logout.php" class="btn btn-primary" style="background-color: #333;">Logout</a>

                    <a href="index.php" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </main>
    </div>
    
</body>
</html>