<?php
header('Content-Type: application/json');

if (isset($_GET['file'])) {
    $filePath = "b2/" . $_GET['file'];

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Unable to delete file"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "File does not exist"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "No file specified"]);
}
?>
