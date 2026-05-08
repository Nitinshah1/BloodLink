<?php
ob_start();
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['emailOrMobile']) || empty($_POST['password'])) {
        ob_end_clean();
        header("Location: login.php?error=empty");
        exit();
    }
    
    $user_id = mysqli_real_escape_string($conn, trim($_POST['emailOrMobile']));
    $password = $_POST['password'];
    
    // Use SELECT * to get all columns, then find the ID column
    $sql = "SELECT * FROM donors WHERE email = '$user_id' OR mobile = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result === false) {
        ob_end_clean();
        header("Location: login.php?error=dberror");
        exit();
    }
    
    if (mysqli_num_rows($result) == 0) {
        ob_end_clean();
        header("Location: login.php?error=notfound");
        exit();
    }
    
    $row = mysqli_fetch_assoc($result);
    
    // Find the ID column - try different possible column names
    $donor_id = null;
    $possible_id_columns = ['id', 'donor_id', 'ID', 'Donor_ID', 'donorId'];
    
    foreach ($possible_id_columns as $col) {
        if (isset($row[$col])) {
            $donor_id = $row[$col];
            break;
        }
    }
    
    // If still not found, get the first column (usually the primary key)
    if ($donor_id === null) {
        $columns = array_keys($row);
        $donor_id = $row[$columns[0]]; // Get first column value
    }
    
    if (empty($row['password']) || $row['password'] == NULL) {
        ob_end_clean();
        header("Location: login.php?error=nopassword");
        exit();
    }
    
    if (password_verify($password, $row['password'])) {
        $_SESSION['donor_id'] = $donor_id;
        $_SESSION['donor_name'] = $row['full_name'];
        ob_end_clean();
        header("Location: dashboard.php");
        exit();
    } else {
        ob_end_clean();
        header("Location: login.php?error=wrongpass");
        exit();
    }
} else {
    ob_end_clean();
    header("Location: login.php");
    exit();
}
?>
