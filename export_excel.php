<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_logged_in'])) { exit("Access Denied"); }

// 1. Filter Parameters pakadna
$state_filter = $_GET['state_filter'] ?? '';
$blood_filter = $_GET['blood_filter'] ?? '';

$filename = "donors_report_" . date('Y-m-d') . ".csv";
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Full Name', 'Father Name', 'Blood Group', 'Gender', 'Mobile', 'State', 'City', 'Status'));

// 2. Dynamic Query banana (Wahi logic jo dashboard par hai)
$where_clauses = [];
if (!empty($state_filter)) {
    $where_clauses[] = "state = '" . mysqli_real_escape_string($conn, $state_filter) . "'";
}
if (!empty($blood_filter)) {
    $where_clauses[] = "blood_group = '" . mysqli_real_escape_string($conn, $blood_filter) . "'";
}

$sql = "SELECT donor_id, full_name, father_name, blood_group, gender, mobile, state, city, status FROM donors";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where_clauses);
}
$sql .= " ORDER BY donor_id DESC";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}
fclose($output);
exit();
?>