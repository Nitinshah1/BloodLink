<?php
include 'config.php'; // Database connection line

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. CAPTCHA VALIDATION
    // Register.php 
    // Note: Live site  session based captcha to use karna better 
    
    // 2. FORM SE DATA NIKALNA (Security ke liye mysqli_real_escape_string use kiya hai)
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $last_donation = mysqli_real_escape_string($conn, $_POST['last_donation']);

    // 3. PASSWORD VALIDATION
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "<script>alert('Error: Passwords do not match!'); window.history.back();</script>";
        exit();
    }
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 4. CHECK UNIQUE EMAIL OR MOBILE (Live site ke liye zaroori hai)
    $check_query = "SELECT * FROM donors WHERE email='$email' OR mobile='$mobile' LIMIT 1";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Error: Email or Mobile already registered!'); window.history.back();</script>";
        exit();
    }

    // 5. DATABASE MEIN DATA DALNE KI COMMAND (Updated with 15 fields)
    // Dhan rahe: Columns ke naam wahi hain jo humne 'ALTER TABLE' query mein chalaye the
    $sql = "INSERT INTO donors (full_name, father_name, marital_status, email, mobile, dob, gender, blood_group, state, city, address, pincode, password, last_donation_date) 
            VALUES ('$full_name', '$father_name', '$marital_status', '$email', '$mobile', '$dob', '$gender', '$blood_group', '$state', '$city', '$address', '$pincode', '$password', '$last_donation')";

    // 6. EXECUTION AND RESPONSE
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration Successful! Thank you for joining us.'); window.location='index.php';</script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>