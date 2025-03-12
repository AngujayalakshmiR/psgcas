<?php
session_start();
include 'dbconn.php'; // Database connection

if (!isset($_SESSION['empUserName'])) {
    echo "Session expired. Please log in again.";
    exit();
}

$Name = $_SESSION['Name'];
$companyName = $_POST['companyName'] ?? '';
$projectTitle = $_POST['projectTitle'] ?? '';

if (empty($companyName) || empty($projectTitle)) {
    echo "Invalid company or project.";
    exit();
}

// Fetch task updates for the logged-in employee
$sql = "SELECT ID, date, taskDetails, totalHrs, actualHrs FROM dailyupdates 
        WHERE name = ? AND companyName = ? AND projectTitle = ? 
        ORDER BY date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $Name, $companyName, $projectTitle);
$stmt->execute();
$result = $stmt->get_result();

$taskData = [];
while ($row = $result->fetch_assoc()) {
    $taskData[] = $row;
}

$stmt->close();
$conn->close();

// Return JSON response for AJAX
echo json_encode($taskData);
?>
