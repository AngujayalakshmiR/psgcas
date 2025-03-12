<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projectID'])) {
    $projectID = intval($_POST['projectID']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete from requirementtable
        $deleteRequirementQuery = "DELETE FROM requirementtable WHERE ID = ?";
        $stmt1 = $conn->prepare($deleteRequirementQuery);
        $stmt1->bind_param("i", $projectID);
        $stmt1->execute();
        
        // Check if data was actually deleted
        if ($stmt1->affected_rows === 0) {
            throw new Exception("No records deleted from requirementtable.");
        }

        // Delete from descriptiontable
        $deleteDescriptionQuery = "DELETE FROM descriptiontable WHERE ID = ?";
        $stmt2 = $conn->prepare($deleteDescriptionQuery);
        $stmt2->bind_param("i", $projectID);
        $stmt2->execute();

        // Check if data was actually deleted
        if ($stmt2->affected_rows === 0) {
            throw new Exception("No records deleted from descriptiontable.");
        }

        // Delete from projectcreation
        $deleteProjectQuery = "DELETE FROM projectcreation WHERE ID = ?";
        $stmt3 = $conn->prepare($deleteProjectQuery);
        $stmt3->bind_param("i", $projectID);
        $stmt3->execute();

        // Check if data was actually deleted
        if ($stmt3->affected_rows === 0) {
            throw new Exception("No records deleted from projectcreation.");
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(["success" => "Project and related data deleted successfully"]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }

    // Close statements
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
