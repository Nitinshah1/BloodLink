<?php
include 'config.php';
// Database connection nd helper files included 


$id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_GET['donor_id']) ? intval($_GET['donor_id']) : 0);

if ($id > 0) {
    
    $sql = "DELETE FROM donors WHERE donor_id = $id"; 

    if (mysqli_query($conn, $sql)) {
        // Record delete hone ke baad hi ye message aana chahiye
        echo "<script>alert('Donor Deleted Successfully!'); window.location='admin_panel.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Invalid ID! Nothing deleted.'); window.location='admin_panel.php';</script>";
}
?>