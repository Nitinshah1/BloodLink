<?php
include 'config.php';

$blood = $_GET['bloodGroup'];
$city = $_GET['city'];

// Database se matching donors dhundna
$sql = "SELECT * FROM donors WHERE blood_group = '$blood' AND city LIKE '%$city%'";
$result = mysqli_query($conn, $sql);

echo "<h2>Results for $blood in $city</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<div class='donors-list' style='display: flex; flex-wrap: wrap; gap: 20px;'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='form-card' style='padding: 20px; border-left: 5px solid red; min-width: 250px;'>";
        echo "<h3>👨‍💼 " . $row['full_name'] . "</h3>";
        echo "<p>🩸 Blood Group: <b>" . $row['blood_group'] . "</b></p>";
        echo "<p>🏙️ City: " . $row['city'] . "</p>";
        echo "<p>📱 Contact: <a href='tel:" . $row['mobile'] . "'>" . $row['mobile'] . "</a></p>";
        
        echo "</div>";

        



    
        
    }
    echo "</div>";
} else {
    echo "<p>Bhai, koi donor nahi mila. Dusra city try kar.</p>";
}
?>