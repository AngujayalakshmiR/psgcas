<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM designation ORDER BY ID DESC";
    $result = $conn->query($sql);
    $output = "";
    $count = 0; // Initialize count

    if ($result->num_rows > 0) {
        $count = $result->num_rows; // Count the total rows
        $sno = 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['DesignationName']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $output .= "<tr><td colspan='3'>No designation found</td></tr>";
    }

    // Return JSON response (table + count)
    echo json_encode(["tableData" => $output, "count" => $count]);
    exit;
}


if (isset($_POST['designationName']) && !isset($_POST['edit_id'])) {
    $designation = $_POST['designationName'];

    $stmt = $conn->prepare("INSERT INTO designation (designationName) VALUES (?)");
    $stmt->bind_param("s", $designation);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Designation added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding Designation"]);
    }

    $stmt->close();
    exit;
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM designation WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Designation deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting Designation"]);
    }

    $stmt->close();
    exit;
}

if (isset($_POST['edit_id']) && isset($_POST['designationName'])) {
    $id = intval($_POST['edit_id']);
    $designation = $_POST['designationName'];

    $stmt = $conn->prepare("UPDATE designation SET designationName = ? WHERE ID = ?");
    $stmt->bind_param("si", $designation, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Designation updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating Designation"]);
    }

    $stmt->close();
    exit;
}
$conn->close();
?>
