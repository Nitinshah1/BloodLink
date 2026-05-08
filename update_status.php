<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_status'])) {
    $session_id = $_SESSION['donor_id'];
    $status = mysqli_real_escape_string($conn, $_POST['new_status']);

    // 'id' ki jagah 'donor_id' kar diya hai jo teri table mein hai
    $sql = "UPDATE donors SET status = '$status' WHERE donor_id = '$session_id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        die("Query Fail: " . mysqli_error($conn));
    }
}
?>