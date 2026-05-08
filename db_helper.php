<?php
// Helper function to get the ID column name from donors table
function get_id_column_name($conn) {
    static $id_column = null;
    
    if ($id_column !== null) {
        return $id_column;
    }
    
    // Try to get table structure
    $result = mysqli_query($conn, "DESCRIBE donors");
    if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
            // Check if this is a primary key or auto_increment
            if ($row['Key'] == 'PRI' || strpos($row['Extra'], 'auto_increment') !== false) {
                $id_column = $row['Field'];
                return $id_column;
            }
        }
    }
    
    // If not found, try common names
    $common_names = ['id', 'donor_id', 'ID', 'Donor_ID', 'donorId'];
    $test_result = mysqli_query($conn, "SELECT * FROM donors LIMIT 1");
    if ($test_result && mysqli_num_rows($test_result) > 0) {
        $row = mysqli_fetch_assoc($test_result);
        foreach ($common_names as $name) {
            if (isset($row[$name])) {
                $id_column = $name;
                return $id_column;
            }
        }
        // If still not found, use first column
        $columns = array_keys($row);
        $id_column = $columns[0];
        return $id_column;
    }
    
    // Default fallback
    return 'id';
}
?>
