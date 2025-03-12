<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE dailyupdatesmeals SET status = '$status' WHERE ID = $id";
    
    if (mysqli_query($conn, $updateQuery)) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>
