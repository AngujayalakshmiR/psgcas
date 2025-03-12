<?php
include("dbconn.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        echo json_encode(["error" => "No ID provided"]);
        exit();
    }

    $id = intval($_GET['id']);
    $sql = "SELECT * FROM employeedetails WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["error" => "No employee found"]);
        exit();
    }

    $employee = $result->fetch_assoc();

    // Only return the filename
    $employee['empPic'] = basename($employee['empPic']);
    $employee['empAadhar'] = basename($employee['empAadhar']);
    $employee['empPan'] = basename($employee['empPan']);

    echo json_encode($employee);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = isset($_POST['employee_id']) ? trim($_POST['employee_id']) : null;
    $employeename = trim($_POST['employeename']);
    $designation = trim($_POST['designation']);
    $employeephnno = trim($_POST['employeephnno']);
    $customeraddress = trim($_POST['customeraddress']);
    $district = trim($_POST['district']);
    $state = trim($_POST['state']);
    $pincode = trim($_POST['pincode']);
    $country = trim($_POST['country']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check for duplicate username or password
    if ($employee_id) {
        $checkQuery = "SELECT * FROM employeedetails WHERE (empUserName = ? OR empPassword = ?) AND ID != ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ssi", $username, $password, $employee_id);
    } else {
        $checkQuery = "SELECT * FROM employeedetails WHERE empUserName = ? OR empPassword = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ss", $username, $password);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Username or Password already exists!"]);
        exit();
    }

    // File upload handling
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    function uploadFile($fileInput, $oldFile)
    {
        global $targetDir;
        if (!empty($_FILES[$fileInput]["name"])) {
            $filePath = $targetDir . basename($_FILES[$fileInput]["name"]);
            move_uploaded_file($_FILES[$fileInput]["tmp_name"], $filePath);
            return $filePath;
        } 
        return !empty($oldFile) ? $oldFile : "";
    }

    $photo = uploadFile("employeePhoto", $_POST["old_employeePhoto"] ?? "");
    $aadhar = uploadFile("aadharCard", $_POST["old_aadharCard"] ?? "");
    $pan = uploadFile("panCard", $_POST["old_panCard"] ?? "");

    if (!empty($employee_id)) {
        // Updating employee details
        $updateQuery = "UPDATE employeedetails 
                        SET Name=?, Designation=?, empPhNo=?, empAdd=?, empDistrict=?, empState=?, empPincode=?, empCountry=?, 
                            empPic=?, empAadhar=?, empPan=?, empUserName=?, empPassword=? 
                        WHERE ID=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssssssssssssi", $employeename, $designation, $employeephnno, $customeraddress, $district, $state, $pincode, 
                                            $country, $photo, $aadhar, $pan, $username, $password, $employee_id);
    } else {
        // Adding new employee
        $insertQuery = "INSERT INTO employeedetails 
                        (Name, Designation, empPhNo, empAdd, empDistrict, empState, empPincode, empCountry, empPic, empAadhar, empPan, empUserName, empPassword) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssssssssss", $employeename, $designation, $employeephnno, $customeraddress, $district, $state, $pincode, 
                                            $country, $photo, $aadhar, $pan, $username, $password);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => $employee_id ? "Employee updated successfully!" : "Employee added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
