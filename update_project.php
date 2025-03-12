<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectID = $_POST['ID'];
    $companyName = $_POST['companyName'];
    $projectType = $_POST['projectType'];
    $totalDays = $_POST['totalDays'];
    $projectTitle = $_POST['projectTitle'];
    $employees = isset($_POST['employees']) ? explode(",", $_POST['employees']) : [];
    $description = $_POST['description'];
    $employeesString = implode(",", $employees);

    // Update projectcreation table
    $sql1 = "UPDATE projectcreation 
             SET companyName='$companyName', projectType='$projectType', totalDays='$totalDays', 
                 projectTitle='$projectTitle', employees='$employeesString' 
             WHERE ID='$projectID'";

    if ($conn->query($sql1) === TRUE) {
        // Update requirementtable
        $sql2 = "UPDATE requirementtable 
                 SET projectDesc='$description' 
                 WHERE projectTitle='$projectTitle'";

        if ($conn->query($sql2) === TRUE) {
            echo "success";
        } else {
            echo "Error updating requirementtable: " . $conn->error;
        }
    } else {
        echo "Error updating projectcreation: " . $conn->error;
    }
}

$conn->close();
?>
