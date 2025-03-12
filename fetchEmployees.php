<?php
include 'dbconn.php';
header('Content-Type: application/json');
ob_clean(); // Clears any unwanted output

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "SELECT ID, companyName, projectType, totalDays, projectTitle, description, employees, reqfile FROM projectcreation WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "companyName" => $row["companyName"],
            "projectType" => $row["projectType"],
            "totalDays" => $row["totalDays"],
            "projectTitle" => $row["projectTitle"],
            "description" => $row["description"],
            "employees" => $row["employees"],  // Ensure employees are included
            "reqfile" => $row["reqfile"]  // Ensure file name is included
        ]);
    } else {
        echo json_encode(["error" => "No project found"]);
    }

    $stmt->close();
    exit; // Prevent any extra output
}
?>
