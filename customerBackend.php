<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $query = "SELECT * FROM customer ORDER BY ID DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows; // Get row count

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['customerName']}</td>
                            <td>{$row['companyName']}</td>
                            <td>{$row['phoneno']}</td>
                            <td>{$row['companyAddress']}, {$row['district']}, {$row['state']}, {$row['country']} - {$row['pincode']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $tableData = "<tr><td colspan='6' style='text-align: center; '>No data available in table</td></tr>";
    }

    // Ensure JSON response is sent correctly
    header('Content-Type: application/json');
    echo json_encode(["tableData" => $tableData, "count" => $count]);
    exit();
}



// Insert Customer
// Insert Customer (Only if it's not an update)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['customername']) && !isset($_POST['update'])) {
    $customerName = $_POST['customername'];
    $companyName = $_POST['companyname'];
    $phoneno = $_POST['customerno'];
    $companyAddress = $_POST['customeraddress'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];

    $stmt = $conn->prepare("INSERT INTO customer (customerName, companyName, phoneno, companyAddress, country, state, district, pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $customerName, $companyName, $phoneno, $companyAddress, $country, $state, $district, $pincode);
    $stmt->execute();
}

// Delete Customer
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM customer WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch Customer for Editing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM customer WHERE ID = $id";
    $result = $conn->query($query);
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $customerName = $_POST['customername'];
    $companyName = $_POST['companyname'];
    $phoneno = $_POST['customerno'];
    $companyAddress = $_POST['customeraddress'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];

    // Ensure the record is being updated and not duplicated
    $stmt = $conn->prepare("UPDATE customer SET customerName=?, companyName=?, phoneno=?, companyAddress=?, country=?, state=?, district=?, pincode=? WHERE ID=?");
    $stmt->bind_param("ssssssssi", $customerName, $companyName, $phoneno, $companyAddress, $country, $state, $district, $pincode, $id);
    
    if ($stmt->execute()) {
        echo "Customer updated successfully";
    } else {
        echo "Error updating customer";
    }
}

$conn->close();
?>
