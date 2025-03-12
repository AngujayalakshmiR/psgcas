<?php
include("dbconn.php");

// Handle Delete Request First
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Fetch file paths to delete them from the server
    $query = "SELECT empPic, empAadhar, empPan FROM employeedetails WHERE ID = '$delete_id'";
    $fileResult = $conn->query($query);
    $fileRow = $fileResult->fetch_assoc();
    
    // Delete files if they exist
    if ($fileRow) {
        if (file_exists($fileRow['empPic'])) unlink($fileRow['empPic']);
        if (file_exists($fileRow['empAadhar'])) unlink($fileRow['empAadhar']);
        if (file_exists($fileRow['empPan'])) unlink($fileRow['empPan']);
    }

    // Delete employee record from database
    $deleteSQL = "DELETE FROM employeedetails WHERE ID = '$delete_id'";
    if ($conn->query($deleteSQL) === TRUE) {
        echo "Data deleted successfully"; // Return only this message
    } else {
        echo "Error deleting employee";
    }
    exit;
}

// Fetch Employee Data (Only if NOT a delete request)
$sql = "SELECT ID, Name, Designation, empPhNo, empAdd, empPic, empAadhar, empPan, empUserName FROM employeedetails";
$result = $conn->query($sql);

$employees = array();
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode(["data" => $employees]);
?>
