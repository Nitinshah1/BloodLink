<?php
session_start();
include 'config.php';

if (file_exists('db_helper.php')) { include 'db_helper.php'; }

if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['donor_id'];

// 1. Take fresh data from database (with new columns)
$sql = "SELECT * FROM donors WHERE donor_id = " . intval($id);
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// 2. Update Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs for security
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $update_sql = "UPDATE donors SET 
        father_name='$father_name', 
        marital_status='$marital_status', 
        dob='$dob', 
        gender='$gender', 
        state='$state', 
        city='$city', 
        address='$address', 
        pincode='$pincode', 
        mobile='$mobile' 
        WHERE donor_id=" . intval($id);

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Profile updated successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - BloodLink</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="register.css">
    <style>
        .edit-container { max-width: 900px; margin: 30px auto; padding: 20px; }
        .edit-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        .section-tag { grid-column: span 2; background: #f8f9fa; padding: 10px; font-weight: bold; color: #c41e3a; border-left: 4px solid #c41e3a; margin-top: 10px; }
        @media (max-width: 768px) { .edit-grid { grid-template-columns: 1fr; } .full-width { grid-column: span 1; } }
    </style>
</head>
<body>
    <div class="edit-container">
        <div class="form-card" style="padding: 30px;">
            <h2 style="text-align: center; color: #22577A;">✏️ Update Your Information</h2>
            <p style="text-align: center; color: #666; margin-bottom: 25px;">You can change your contact and personal details here.</p>
            
            <form method="POST">
                <div class="edit-grid">
                    <div class="section-tag">Personal Details</div>
                    
                    <div class="form-group">
                        <label>Full Name (Read Only)</label>
                        <input type="text" value="<?php echo htmlspecialchars($row['full_name']); ?>" disabled style="background: #eee;">
                    </div>

                    <div class="form-group">
                        <label>Father/Husband Name</label>
                        <input type="text" name="father_name" value="<?php echo htmlspecialchars($row['father_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                            <option value="Other" <?php if($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Marital Status</label>
                        <select name="marital_status" required>
                            <option value="Single" <?php if($row['marital_status'] == 'Single') echo 'selected'; ?>>Single</option>
                            <option value="Married" <?php if($row['marital_status'] == 'Married') echo 'selected'; ?>>Married</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Blood Group (Read Only)</label>
                        <input type="text" value="<?php echo $row['blood_group']; ?>" disabled style="background: #eee; font-weight: bold; color: #c41e3a;">
                    </div>

                    <div class="section-tag">Contact & Location</div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" value="<?php echo htmlspecialchars($row['state']); ?>" required placeholder="e.g. Uttarakhand">
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo htmlspecialchars($row['city']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" value="<?php echo htmlspecialchars($row['pincode']); ?>" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Full Address</label>
                        <textarea name="address" rows="3" required><?php echo htmlspecialchars($row['address']); ?></textarea>
                    </div>

                    <div class="full-width" style="display: flex; gap: 10px; margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" style="flex: 2;">Save All Changes ✅</button>
                        <a href="dashboard.php" class="btn btn-secondary" style="flex: 1; text-align: center; text-decoration: none; padding-top: 12px;">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>