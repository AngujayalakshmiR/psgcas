<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    // Debugging: Check if empID is received
    error_log("Received empID: " . $ID);

    $query = "SELECT * FROM employeedetails WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(["success" => true, "data" => $row]);
    } else {
        echo json_encode(["success" => false, "message" => "Employee not found"]);
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
include 'dbconn.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employee_id"])) {
    $employee_id = $_POST["employee_id"];
    $name = $_POST["employeename"];
    $designation = $_POST["designation"];
    $phone = $_POST["employeephnno"];
    $address = $_POST["customeraddress"];
    $state = $_POST["state"];
    $district = $_POST["district"];
    $pincode = $_POST["pincode"];
    $country = $_POST["country"];
    $username = $_POST["username"];

    // Handle file uploads only if new files are provided
    $photo = isset($_FILES["employeePhoto"]["name"]) && $_FILES["employeePhoto"]["name"] ? $_FILES["employeePhoto"]["name"] : null;
    $aadhar = isset($_FILES["aadharCard"]["name"]) && $_FILES["aadharCard"]["name"] ? $_FILES["aadharCard"]["name"] : null;
    $pan = isset($_FILES["panCard"]["name"]) && $_FILES["panCard"]["name"] ? $_FILES["panCard"]["name"] : null;

    if ($photo) move_uploaded_file($_FILES["employeePhoto"]["tmp_name"], "uploads/" . $photo);
    if ($aadhar) move_uploaded_file($_FILES["aadharCard"]["tmp_name"], "uploads/" . $aadhar);
    if ($pan) move_uploaded_file($_FILES["panCard"]["tmp_name"], "uploads/" . $pan);

    $sql = "UPDATE employeedetails SET Name='$name', Designation='$designation', empPhNo='$phone', empAdd='$address', empState='$state', empDistrict='$district', empPincode='$pincode', empCountry='$country', Username='$username'";

    if ($photo) $sql .= ", empPic='$photo'";
    if ($aadhar) $sql .= ", empAadhar='$aadhar'";
    if ($pan) $sql .= ", empPan='$pan'";

    $sql .= " WHERE id='$employee_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee updated successfully!'); window.location.href='employee.php';</script>";
    } else {
        echo "<script>alert('Error updating employee: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
