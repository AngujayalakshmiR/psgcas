<?php
session_start();
include 'dbconn.php'; // Ensure you have a file to handle database connection

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Get companyName and projectTitle from GET request
    $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
    $projectTitle = isset($_POST['projectTitle']) ? $_POST['projectTitle'] : '';

    // Allowed file types
    $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'ppt', 'pptx', 'xlsx', 'xls'];

    if (in_array($fileType, $allowed)) {
        $uploadDir = "b2/";  // Ensure this directory exists
        $destination = $uploadDir . basename($fileName);

        if (move_uploaded_file($fileTmpName, $destination)) {
            // Store file in database
            $stmt = $conn->prepare("INSERT INTO requirementtable (companyName, projectTitle, reqfile) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $companyName, $projectTitle, $destination);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "filename" => $fileName]);
            } else {
                echo json_encode(["success" => false, "error" => "Database error"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Upload failed."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid file type: " . $fileType]);
    }
} else {
    echo json_encode(["success" => false, "error" => "No file uploaded."]);
}
?>
