<?php
include 'config.php'; // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blood Donors - Blood Donor Matching System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="search.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <style>
        .donor-result-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 20px;
            border-left: 6px solid #c41e3a;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }
        .donor-result-card:hover { transform: translateY(-3px); }
        .donor-info h3 { margin: 0; color: #1a1a1a; font-size: 1.25rem; margin-bottom: 8px; }
        .donor-info p { margin: 4px 0; color: #555; font-size: 0.95rem; line-height: 1.4; }
        .donor-info b { color: #333; }
        .blood-badge { 
            background: #fff5f5; 
            color: #c41e3a; 
            padding: 4px 12px; 
            border-radius: 8px; 
            font-weight: 800; 
            display: inline-block;
            margin-top: 10px;
        }
        .call-action-btn {
            background: #c41e3a;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .whatsapp-btn {
            background: #25D366;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .no-data-box {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .search-filters {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            flex-wrap: wrap;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .form-group { flex: 1; min-width: 180px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; }
        .form-group select, .form-group input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="hero-background">
        <div class="hero-pattern"></div>
    </div>
    <div class="container">
        <header class="main-header">
            <div class="logo-section">
                <div class="logo-icon">🔍</div>
                <div class="logo-text">
                    <h1>Search Blood Donors</h1>
                    <p class="tagline">Find available donors quickly</p>
                </div>
            </div>
        </header>

        <main>
            <form id="searchForm" class="search-form" action="search.php" method="GET">
                <div class="search-filters">
                    <div class="form-group">
                        <label for="bloodGroup">Blood Group <span class="required">*</span></label>
                        <select id="bloodGroup" name="bloodGroup" required>
                            <option value="">Select blood group</option>
                            <?php 
                            $groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                            foreach($groups as $g) {
                                $selected = (isset($_GET['bloodGroup']) && $_GET['bloodGroup'] == $g) ? 'selected' : '';
                                echo "<option value='$g' $selected>$g</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
    <label for="state">State</label>
    <select id="state" name="state">
        <option value="">All India</option>
        <?php 
        $all_states = [
            "Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", 
            "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli and Daman and Diu", "Delhi", "Goa", 
            "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", 
            "Kerala", "Ladakh", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", 
            "Mizoram", "Nagaland", "Odisha", "Puducherry", "Punjab", "Rajasthan", "Sikkim", 
            "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
        ];
        
        foreach($all_states as $s) {
            $selected = (isset($_GET['state']) && $_GET['state'] == $s) ? 'selected' : '';
            echo "<option value='$s' $selected>$s</option>";
        }
        ?>
    </select>
</div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="Enter city name" 
                               value="<?php echo isset($_GET['city']) ? htmlspecialchars($_GET['city']) : ''; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary btn-search" style="height: 48px; padding: 0 30px;">
                        <span>Search Donors</span>
                    </button>
                </div>
            </form>

            <div id="resultsSection" class="results-section" style="margin-top: 50px;">
                <?php
                if (isset($_GET['bloodGroup']) && !empty($_GET['bloodGroup'])) {
                    $blood = mysqli_real_escape_string($conn, $_GET['bloodGroup']);
                    $city = mysqli_real_escape_string($conn, $_GET['city'] ?? '');
                    $state = mysqli_real_escape_string($conn, $_GET['state'] ?? '');

                    // Updated Query for State and City
                    $sql = "SELECT * FROM donors WHERE blood_group = '$blood'";

                    if(!empty($state)) {
                        $sql .= " AND state = '$state'";
                    }

                    if(!empty($city)) {
                        $city = trim($city);
                        $sql .= " AND city LIKE '%$city%'";
                    }

                    $sql .= " ORDER BY donor_id DESC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<h2 style='margin-bottom:25px; color:#333;'>Matching Donors Found</h2>";
                        echo "<div class='donors-list'>";
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class='donor-result-card'>
                                <div class='donor-info'>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <h3>👨‍💼 <?php echo htmlspecialchars($row['full_name']); ?></h3>
                                        <span style="background:#e8f5e9; color:#2e7d32; font-size:10px; padding:2px 8px; border-radius:10px; font-weight:bold;">VERIFIED</span>
                                    </div>
                                    <p>👤 <b>Father's Name:</b> <?php echo htmlspecialchars($row['father_name'] ?? 'N/A'); ?></p>
                                    <p>🏙️ <b>Location:</b> <?php echo htmlspecialchars($row['city']); ?>, <?php echo htmlspecialchars($row['state']); ?></p>
                                    <p>📞 <b>Phone:</b> <?php echo htmlspecialchars($row['mobile']); ?></p>
                                    <div class='blood-badge'>🩸 Blood Group: <?php echo $row['blood_group']; ?></div>
                                </div>
                                <div class='action-area' style="min-width: 180px;">
                                    <a href='tel:<?php echo $row['mobile']; ?>' class='call-action-btn'>
                                        <span>📞 Call Now</span>
                                    </a>
                                    <a href='https://wa.me/91<?php echo $row['mobile']; ?>?text=Hello%20<?php echo urlencode($row['full_name']); ?>,%20we%20found%20your%20contact%20on%20the%20Blood%20Donor%20Portal.%20We%20need%20urgent%20<?php echo $row['blood_group']; ?>%20blood.' target='_blank' class='whatsapp-btn'>
                                        <span>💬 WhatsApp</span>
                                    </a>
                                    <button type='button' onclick="openConfirmationModal('<?php echo $row['donor_id']; ?>', '<?php echo addslashes($row['full_name']); ?>')" style='background:#f8f9fa; color:#333; border:1px solid #ddd; padding:10px; border-radius:8px; cursor:pointer; font-weight:bold; width:100%; margin-top:10px; font-size:13px;'>
                                        ✅ I Received Blood
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                        echo "</div>";

                        // Map Iframe logic
                        $map_search = !empty($city) ? $city : (!empty($state) ? $state : 'Uttarakhand');
                        ?>
                        <div class="map-container" style="margin-top: 40px; margin-bottom: 30px;">
                            <h3 style="color: #22577A; margin-bottom: 15px;">🔍 Nearby Hospitals in <?php echo htmlspecialchars($map_search); ?></h3>
                            <div style="width: 100%; overflow: hidden; border-radius: 15px; border: 4px solid #c41e3a; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <iframe 
                                    width="100%" 
                                    height="450" 
                                    frameborder="0" 
                                    src="https://maps.google.com/maps?q=<?php echo urlencode($map_search . ' hospital'); ?>&t=&z=13&ie=UTF8&iwloc=&output=embed">
                                </iframe>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "
                        <div class='no-data-box'>
                            <p style='font-size: 1.3rem; color: #c41e3a; font-weight: 600;'>No Donors Found.</p>
                            <p style='color: #666;'>Try selecting a different state or searching in a nearby city.</p>
                        </div>";
                    }
                } else {
                    echo "<div style='text-align:center; padding:60px; color:#888; background:white; border-radius:20px; border:1px solid #eee; box-shadow: 0 4px 10px rgba(0,0,0,0.02);'>
                            <span style='font-size: 3rem;'>🔍</span>
                            <p style='margin-top:15px; font-size:1.1rem;'>Enter details to find blood donors near you.</p>
                          </div>";
                }
                ?>
            </div>
        </main>

        <footer style="margin-top: 60px; text-align: center; padding-bottom: 40px;">
            <a href="index.php" style="color: #c41e3a; text-decoration: none; font-weight: 600;">← Back to Home</a>
        </footer>
    </div>

    <div id="confirmationModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:white; padding:30px; border-radius:15px; width:350px; text-align:center; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
            <h2 style="color:#c41e3a; margin-top:0;">Confirm Receipt</h2>
            <p style="color:#555;">Did you receive blood from <br><span id="display_donor_name" style="font-weight:bold; color:#000;"></span>?</p>
            
            <form action="submit_donation.php" method="POST">
                <input type="hidden" name="donor_id" id="modal_donor_id">
                <input type="text" name="seeker_phone" placeholder="Your Mobile Number" required maxlength="10" style="width:100%; padding:12px; margin:15px 0; border:1px solid #ddd; border-radius:8px;">
                
                <button type="submit" name="submit_report" style="background:#28a745; color:white; border:none; padding:12px; width:100%; border-radius:8px; cursor:pointer; font-weight:bold; font-size:16px;">
                    Confirm & Notify
                </button>
                <p onclick="closeConfirmationModal()" style="margin-top:15px; color:#888; cursor:pointer; text-decoration:underline; font-size:14px;">Cancel</p>
            </form>
        </div>
    </div>

    
</body>
</html>