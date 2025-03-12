<?php
session_start();

if (!isset($_SESSION['empUserName'])) {
    header("Location: login.php");
    exit();
}

require 'dbconn.php'; // Ensure your database connection file is included

$companyName = isset($_GET['company']) ? htmlspecialchars($_GET['company']) : '';
$projectTitle = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';

$reqfile = ''; // Initialize an empty variable

if (!empty($companyName) && !empty($projectTitle)) {
    $query = "SELECT reqfile FROM requirementtable WHERE companyName = ? AND projectTitle = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $companyName, $projectTitle);
    $stmt->execute();
    $stmt->bind_result($reqfile);
    $stmt->fetch();
    $stmt->close();
}

echo json_encode(['reqfile' => $reqfile]);
?>
