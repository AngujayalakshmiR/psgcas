<?php
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM projecttype ORDER BY ID DESC";
    $result = $conn->query($sql);
    $output = "";
    $count = 0; // Initialize count

    if ($result->num_rows > 0) {
        $count = $result->num_rows; // Count the total rows
        $sno = 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['ProjecttypeName']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $output .= "<tr><td colspan='3'>No project types found</td></tr>";
    }

    // Return JSON response (table + count)
    echo json_encode(["tableData" => $output, "count" => $count]);
    exit;
}


if (isset($_POST['projecttypeName']) && !isset($_POST['edit_id'])) {
    $projecttype = $_POST['projecttypeName'];

    $stmt = $conn->prepare("INSERT INTO projecttype (projecttypeName) VALUES (?)");
    $stmt->bind_param("s", $projecttype);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Project Type added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding project type"]);
    }

    $stmt->close();
    exit;
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM projecttype WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Project Type deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting project type"]);
    }

    $stmt->close();
    exit;
}

if (isset($_POST['edit_id']) && isset($_POST['projecttypeName'])) {
    $id = intval($_POST['edit_id']);
    $projecttype = $_POST['projecttypeName'];

    $stmt = $conn->prepare("UPDATE projecttype SET projecttypeName = ? WHERE ID = ?");
    $stmt->bind_param("si", $projecttype, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Project Type updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating project type"]);
    }

    $stmt->close();
    exit;
}
$conn->close();
?>
