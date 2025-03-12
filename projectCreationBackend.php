<?php 
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $companyName = $_POST['companyName'];
    $projectType = $_POST['projectType'];
    $totalDays = $_POST['totalDays'];
    $projectTitle = $_POST['projectTitle'];
    $description = $_POST['description'];
    $employees = $_POST['employees'];
    
    // Get current date dynamically (YYYY-MM-DD format)
    $currentDate = date("Y-m-d");

    // File Handling
    $uploadDir = "reqfiles/";
    $reqfile = null;
    $fileName = null;

    if ($id) {
        $query = "SELECT reqfile FROM projectcreation WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($existingFile);
        $stmt->fetch();
        $stmt->close();

        if (!empty($existingFile)) {
            $fileName = basename($existingFile);
            $reqfile = "reqfiles/" . $fileName;
        }
    }

    if (!empty($_FILES['reqfile']['name'])) {
        $fileName = basename($_FILES["reqfile"]["name"]);
        $targetFilePath = $uploadDir . $fileName;

        if ($id && !empty($existingFile) && file_exists($existingFile)) {
            unlink($existingFile);
        }

        if (move_uploaded_file($_FILES["reqfile"]["tmp_name"], $targetFilePath)) {
            $reqfile = $targetFilePath;
        } else {
            die(json_encode(["error" => "File upload failed"]));
        }
    }

    $conn->begin_transaction(); // Start transaction

    try {
        if ($id) {
            // UPDATE projectcreation
            $query = "UPDATE projectcreation SET companyName=?, projectType=?, totalDays=?, projectTitle=?, description=?, employees=?, reqfile=? WHERE ID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssissssi", $companyName, $projectType, $totalDays, $projectTitle, $description, $employees, $reqfile, $id);
            $stmt->execute();

            // UPDATE requirementtable
            $query1 = "UPDATE requirementtable SET companyName=?, projectTitle=?, reqfile=? WHERE ID=?";
            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("sssi", $companyName, $projectTitle, $reqfile, $id);
            $stmt1->execute();

            // UPDATE descriptiontable
            $query2 = "UPDATE descriptiontable SET companyName=?, projectTitle=?, description=? WHERE ID=?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("sssi", $companyName, $projectTitle, $description, $id);
            $stmt2->execute();
        } else {
            // INSERT into projectcreation
            $query = "INSERT INTO projectcreation (date, companyName, projectType, totalDays, projectTitle, description, employees, reqfile) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssss", $currentDate, $companyName, $projectType, $totalDays, $projectTitle, $description, $employees, $reqfile);
            $stmt->execute();
            $last_id = $stmt->insert_id; // Get last inserted ID

            // INSERT into requirementtable
            $query1 = "INSERT INTO requirementtable (companyName, projectTitle, reqfile, ID) VALUES (?, ?, ?, ?)";
            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("sssi", $companyName, $projectTitle, $reqfile, $last_id);
            $stmt1->execute();

            // INSERT into descriptiontable
            $query2 = "INSERT INTO descriptiontable (date, companyName, projectTitle, description, ID) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("ssssi", $currentDate, $companyName, $projectTitle, $description, $last_id);
            
            $stmt2->execute();
        }

        $conn->commit(); // Commit transaction

        echo json_encode([
            "success" => $id ? "Project Updated!" : "Project Created!",
            "fileName" => $fileName
        ]);
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on failure
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }

    // Close statements
    $stmt->close();
    $stmt1->close();
    $stmt2->close();
    $conn->close();
}
?>
