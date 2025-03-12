<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM visitfeedback ORDER BY ID DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                            <td>{$row['feedback']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $tableData = "<tr><td colspan='5' style='text-align: center;'>No feedback available</td></tr>";
    }

    header('Content-Type: application/json');
    echo json_encode(["tableData" => $tableData, "count" => $count]);
    exit();
}

// Insert Feedback
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['date']) && isset($_POST['feedback']) && !isset($_POST['update'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO visitfeedback (date, time, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $date, $time, $feedback);
    $stmt->execute();
}

// Delete Feedback
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM visitfeedback WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch Feedback for Editing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM visitfeedback WHERE ID = $id";
    $result = $conn->query($query);
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    }
}

// Update Feedback
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("UPDATE visitfeedback SET date=?, time=?, feedback=? WHERE ID=?");
    $stmt->bind_param("sssi", $date, $time, $feedback, $id);
    
    if ($stmt->execute()) {
        echo "Feedback updated successfully";
    } else {
        echo "Error updating feedback";
    }
}

$conn->close();
?>