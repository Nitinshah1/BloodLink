<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
include 'config.php';
include 'db_helper.php';

// Search logic (Optional: Agle step mein filter add karenge)
$sql = "SELECT * FROM donors ORDER BY donor_id DESC";
$result = mysqli_query($conn, $sql);
$id_column = get_id_column_name($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BloodLink</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .container { max-width: 1250px; } /* Thoda chauda kiya taaki data fit ho */
        .admin-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; }
        .admin-table th { background: #22577A; color: white; padding: 15px; text-align: left; font-size: 0.9rem; }
        .admin-table td { padding: 15px; border-bottom: 1px solid #eee; font-size: 0.85rem; }
        .status-badge { background: #e6fff0; color: #00b341; padding: 4px 10px; border-radius: 15px; font-size: 0.75rem; font-weight: 700; }
        .btn-view { color: #22577A; text-decoration: none; font-weight: 700; margin-right: 10px; }
        .delete-btn { color: #c41e3a; text-decoration: none; font-weight: 700; }
        
        /* Tooltip style for full address */
        .address-cell { position: relative; cursor: pointer; color: #666; }
        .address-cell:hover::after { content: attr(data-address); position: absolute; background: #333; color: white; padding: 10px; border-radius: 5px; width: 200px; z-index: 10; font-size: 12px; }
    </style>
</head>
<body>
    <div class="hero-background"><div class="hero-pattern"></div></div>
    
    <div class="container">
        <header class="main-header" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="logo-section">
                <span class="logo-icon">👑</span>
                <div class="logo-text">
                    <h1>Admin Control Panel</h1>
                    <p class="tagline">Managing <?php echo mysqli_num_rows($result); ?> Life-Savers</p>
                </div>
            </div>

 <a href="export_excel.php?state_filter=<?php echo isset($_GET['state_filter']) ? urlencode($_GET['state_filter']) : ''; ?>&blood_filter=<?php echo isset($_GET['blood_filter']) ? urlencode($_GET['blood_filter']) : ''; ?>" 
   class="btn" style="background: #28a745; color: white; text-decoration: none; padding: 10px 18px; border-radius: 6px; font-weight: 700;">
   📊 Export Filtered Data
</a>
            <a href="logout.php" class="btn btn-secondary" style="padding: 10px 20px;">Logout</a>
            
        </header>

        <?php
// 1. Statistics Fetch Karna
$total_donors = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM donors"));
$available_donors = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM donors WHERE status = 'Available'"));
$rare_blood = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM donors WHERE blood_group IN ('O-', 'AB-', 'B-')"));
$new_today = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM donors WHERE DATE(created_at) = CURDATE()")); // Agar created_at column hai toh
?>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    
    <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #22577A; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <p style="margin: 0; color: #666; font-size: 0.9rem; font-weight: 600;">Total Donors</p>
        <h2 style="margin: 10px 0 0; color: #22577A; font-size: 1.8rem;"><?php echo $total_donors; ?></h2>
    </div>

    <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #28a745; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <p style="margin: 0; color: #666; font-size: 0.9rem; font-weight: 600;">Available Now</p>
        <h2 style="margin: 10px 0 0; color: #28a745; font-size: 1.8rem;"><?php echo $available_donors; ?></h2>
    </div>

    <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #c41e3a; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <p style="margin: 0; color: #666; font-size: 0.9rem; font-weight: 600;">Rare Groups (O-, AB-)</p>
        <h2 style="margin: 10px 0 0; color: #c41e3a; font-size: 1.8rem;"><?php echo $rare_blood; ?></h2>
    </div>

    <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #f39c12; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <p style="margin: 0; color: #666; font-size: 0.9rem; font-weight: 600;">Today's New Joins</p>
        <h2 style="margin: 10px 0 0; color: #f39c12; font-size: 1.8rem;"><?php echo $new_today; ?></h2>
    </div>

</div>

<div style="background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <form method="GET" action="" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
        
        <div class="form-group" style="flex: 1; min-width: 200px; margin-bottom: 0;">
            <label style="font-size: 0.8rem; color: #666;">Filter by State</label>
            <select name="state_filter" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                <option value="">All States</option>
                <option value="Andhra Pradesh"> Uttarakhand </option>
        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
        <option value="Assam">Assam</option>
        <option value="Bihar">Bihar</option>
        <option value="Chhattisgarh">Chhattisgarh</option>
        <option value="Goa">Goa</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Haryana">Haryana</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Jharkhand">Jharkhand</option>
        <option value="Karnataka">Karnataka</option>
        <option value="Kerala">Kerala</option>
        <option value="Madhya Pradesh">Madhya Pradesh</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="Manipur">Manipur</option>
        <option value="Meghalaya">Meghalaya</option>
        <option value="Mizoram">Mizoram</option>
        <option value="Nagaland">Nagaland</option>
        <option value="Odisha">Odisha</option>
        <option value="Punjab">Punjab</option>
        <option value="Rajasthan">Rajasthan</option>
        <option value="Sikkim">Sikkim</option>
        <option value="Tamil Nadu">Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Andhra Pradesh</option>
        <option value="West Bengal">West Bengal</option>
        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
        <option value="Chandigarh">Chandigarh</option>
        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
        <option value="Delhi">Delhi</option>
        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
        <option value="Ladakh">Ladakh</option>
        <option value="Lakshadweep">Lakshadweep</option>
        <option value="Puducherry">Puducherry</option>
                </select>
        </div>






        <div class="form-group" style="flex: 1; min-width: 200px; margin-bottom: 0;">
            <label style="font-size: 0.8rem; color: #666;">Filter by Blood Group</label>
            <select name="blood_filter" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                <option value="">All Groups</option>
                <option value="A+">A+</option><option value="A-">A-</option>
                <option value="B+">B+</option><option value="B-">B-</option>
                <option value="O+">O+</option><option value="O-">O-</option>
                <option value="AB+">AB+</option><option value="AB-">AB-</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 10px 25px; height: 42px;">Apply Filter 🔍</button>
        <a href="admin_panel.php" class="btn btn-secondary" style="padding: 10px 20px; height: 42px; text-decoration: none; display: flex; align-items: center;">Reset</a>
    </form>
</div>

<?php
// PHP logic to handle filtering
$where_clauses = [];
if (!empty($_GET['state_filter'])) {
    $st = mysqli_real_escape_string($conn, $_GET['state_filter']);
    $where_clauses[] = "state = '$st'";
}
if (!empty($_GET['blood_filter'])) {
    $bg = mysqli_real_escape_string($conn, $_GET['blood_filter']);
    $where_clauses[] = "blood_group = '$bg'";
}

$sql = "SELECT * FROM donors";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where_clauses);
}
$sql .= " ORDER BY donor_id DESC";
$result = mysqli_query($conn, $sql);
?>

        <main>
            <div class="form-card" style="padding: 20px; overflow-x: auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Reg. ID</th>
                            <th>Donor Details</th>
                            <th>Father Name</th>
                            <th>Blood</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td>#<?php echo $row[$id_column]; ?></td>
        <td>
            <strong><?php echo $row['full_name']; ?></strong><br>
            <small><?php echo $row['gender']; ?> | <?php echo $row['marital_status']; ?></small>
        </td>
        <td><?php echo $row['father_name']; ?></td>
        <td><span style="color: #c41e3a; font-weight: 800;">🩸 <?php echo $row['blood_group']; ?></span></td>
        <td>
            🏙️ <?php echo $row['city']; ?>, <?php echo $row['state']; ?><br>
            <small class="address-cell" data-address="<?php echo $row['address']; ?>" style="color: #007bff; cursor: help;">📍 Hover for Address</small>
        </td>
        
        <td>
            <div style="font-weight: 600;">📞 <?php echo $row['mobile']; ?></div>
            
            <a href="https://wa.me/91<?php echo $row['mobile']; ?>?text=Hello%20<?php echo urlencode($row['full_name']); ?>,%20we%20have%20an%20urgent%20blood%20requirement%20for%20<?php echo urlencode($row['blood_group']); ?>%20group.%20Are%20you%20available%20to%20donate?" 
               target="_blank" 
               style="text-decoration: none; color: #25D366; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 4px; margin-top: 5px;">
               <span style="background: #25D366; color: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; font-size: 10px;">✔</span> 
               WhatsApp Chat
            </a>
            
            <small style="color: #666; font-size: 0.75rem;"><?php echo $row['email']; ?></small>
        </td>
        
        <td><span class="status-badge">Verified</span></td>
        <td>
            <a href="edit_donor_admin.php?id=<?php echo $row[$id_column]; ?>" class="btn-view">Edit</a>
            <a href="delete_donor.php?id=<?php echo $row[$id_column]; ?>" 
               class="delete-btn" 
               onclick="return confirm('Are you sure you want to delete this donor?')">
               Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>