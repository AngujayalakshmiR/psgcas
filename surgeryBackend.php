<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM surgery ORDER BY ID DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['surgerydate']}</td>
                            <td>{$row['surgerydesc']}</td>
                            <td>{$row['starttime']}</td>
                            <td>{$row['endtime']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $tableData = "<tr><td colspan='6' style='text-align: center;'>No surgery records found</td></tr>";
    }

    header('Content-Type: application/json');
    echo json_encode(["tableData" => $tableData, "count" => $count]);
    exit();
}

// Insert Surgery
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['surgerydate']) && isset($_POST['surgerydesc']) && !isset($_POST['update'])) {
    $surgerydate = $_POST['surgerydate'];
    $surgerydesc = $_POST['surgerydesc'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $stmt = $conn->prepare("INSERT INTO surgery (surgerydate, surgerydesc, starttime, endtime) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $surgerydate, $surgerydesc, $starttime, $endtime);
    $stmt->execute();
}

// Delete Surgery
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM surgery WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch Surgery for Editing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM surgery WHERE ID = $id";
    $result = $conn->query($query);
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    }
}

// Update Surgery
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $surgerydate = $_POST['surgerydate'];
    $surgerydesc = $_POST['surgerydesc'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $stmt = $conn->prepare("UPDATE surgery SET surgerydate=?, surgerydesc=?, starttime=?, endtime=? WHERE ID=?");
    $stmt->bind_param("ssssi", $surgerydate, $surgerydesc, $starttime, $endtime, $id);
    
    if ($stmt->execute()) {
        echo "Surgery record updated successfully";
    } else {
        echo "Error updating surgery record";
    }
}

$conn->close();
?>
