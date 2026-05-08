<?php
// verify_donation.php
include 'config.php'; 
session_start();

if (!isset($_SESSION['donor_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    $donor_id = $_SESSION['donor_id'];
    $today = date('Y-m-d'); // Aaj ki date

    // 1. Donation request ko verified karo
    mysqli_query($conn, "UPDATE donation_requests SET status = 'verified' WHERE id = '$request_id'");

    // 2. Donor ka status 'Unavailable' karo AUR 'last_donation' mein aaj ki date daalo
    // Yahan galti thi, date update nahi ho rahi thi shayad
    $sql = "UPDATE donors SET status = 'Unavailable', last_donation = '$today' WHERE donor_id = '$donor_id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Verification Successful! Status updated to Unavailable.');
                window.location.href='dashboard.php';
              </script>";
    }
} else {
    // Reject logic
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    mysqli_query($conn, "UPDATE donation_requests SET status = 'rejected' WHERE id = '$request_id'");
    header("Location: dashboard.php");
}
?>