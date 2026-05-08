<?php
include 'config.php';

if(isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $blood = mysqli_real_escape_string($conn, $_POST['blood']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = "Mathura"; // Default city [cite: 2026-01-27]

    $sql = "INSERT INTO donors (name, blood_group, phone, city) VALUES ('$name', '$blood', '$phone', '$city')";
    if(mysqli_query($conn, $sql)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>