<?php
include 'config.php'; // Database connection
session_start();

if (isset($_POST['submit_report'])) {
    // Modal se data lena
    $donor_id = mysqli_real_escape_string($conn, $_POST['donor_id']);
    $seeker_phone = mysqli_real_escape_string($conn, $_POST['seeker_phone']);
    $status = "pending";

    // Table mein data insert karna
    $query = "INSERT INTO donation_requests (donor_id, seeker_phone, status) 
              VALUES ('$donor_id', '$seeker_phone', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Success! Your request has been sent to the donor for verification.');
                window.location.href='search.php'; 
              </script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>