<?php
include 'config.php'; // Database se connect karne ke liye [cite: 2026-01-26]

if(isset($_GET['phone'])){
    $phone = mysqli_real_escape_string($conn, $_GET['phone']);

    // Database mein number check ho raha hai [cite: 2026-01-26]
    $check_query = "SELECT * FROM blood_requests WHERE contact_no = '$phone'";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) > 0) {
        // Number milne par delete [cite: 2026-01-26]
        $delete_query = "DELETE FROM blood_requests WHERE contact_no = '$phone'";
        if(mysqli_query($conn, $delete_query)) {
            echo "<script>alert('✅ Post Verified & Deleted!'); window.location='index.php';</script>";
        }
    } else {
        // Number nahi milne par error [cite: 2026-01-26]
        echo "<script>alert('❌ Invalid number: post not found!'); window.location='post_request.php';</script>";
    }
}
?>