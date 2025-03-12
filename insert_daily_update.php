<?php
session_start();
include 'dbconn.php';

if (!isset($_SESSION['empUserName'])) {
    echo "Session expired. Please log in again.";
    exit();
}

$name = $_SESSION['Name'];
$date = date('Y-m-d'); // Get today's date

// Retrieve form inputs
$companyName = $_POST['companyName'] ?? '';
$projectTitle = $_POST['projectTitle'] ?? '';
$projectType = $_POST['projectType'] ?? '';
$totalDays = $_POST['totalDays'] ?? '';
$taskDetails = $_POST['taskDetails'] ?? '';
$totalHrs = $_POST['totalHrs'] ?? '';

// Validate required fields
if (empty($companyName) || empty($projectTitle) || empty($taskDetails) || empty($totalHrs)) {
    echo "All fields are required.";
    exit();
}

// Check if total actual hours have already reached 8
$query = "SELECT COALESCE(SUM(actualHrs), 0) AS totalActualHrs FROM dailyupdates WHERE name = ? AND date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $name, $date);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalActualHrs = $row['totalActualHrs'];

// If actualHrs has reached 8, prevent new task addition
if ($totalActualHrs >= 8) {
    echo "You cannot add more tasks. You have reached the daily limit of 8 hours.";
    exit();
}

// Insert new task
$insertSql = "INSERT INTO dailyupdates (date, name, companyName, projectTitle, projectType, totalDays, taskDetails, totalHrs, actualHrs) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, '-')";

$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("ssssssss", $date, $name, $companyName, $projectTitle, $projectType, $totalDays, $taskDetails, $totalHrs);

if ($insertStmt->execute()) {
    echo "success"; // Triggers SweetAlert in JavaScript
} else {
    echo "Error: " . $insertStmt->error;
}

$insertStmt->close();
$conn->close();
?>
