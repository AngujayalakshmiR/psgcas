<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];

    $query = "SELECT COALESCE(SUM(actualHrs), 0) AS totalActualHrs FROM dailyupdates WHERE name = ? AND date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo $row['totalActualHrs']; // Return total actual hours
}
?>
