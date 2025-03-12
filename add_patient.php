<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM patient ORDER BY id DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['contact']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['height']}</td>
                            <td>{$row['weight']}</td>
                            <td>{$row['bedno']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
            $sno++;
        }
    } else {
        $tableData = "<tr><td colspan='11' style='text-align: center;'>No patients available</td></tr>";
    }

    header('Content-Type: application/json');
    echo json_encode(["tableData" => $tableData, "count" => $count]);
    exit();
}

// Insert Patient
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name']) && !isset($_POST['update'])) {
    $stmt = $conn->prepare("INSERT INTO patient (name, age, contact, address, height, weight, bedno, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssisss", $_POST['name'], $_POST['age'], $_POST['contact'], $_POST['address'], $_POST['height'], $_POST['weight'], $_POST['bedno'], $_POST['username'], $_POST['password']);
    $stmt->execute();
}

// Delete Patient
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM patient WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
}

// Fetch Patient for Editing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $query = "SELECT * FROM patient WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}

// Update Patient
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE patient SET name=?, age=?, contact=?, address=?, height=?, weight=?, bedno=?, username=?, password=? WHERE id=?");
    $stmt->bind_param("sisssisssi", $_POST['name'], $_POST['age'], $_POST['contact'], $_POST['address'], $_POST['height'], $_POST['weight'], $_POST['bedno'], $_POST['username'], $_POST['password'], $_POST['id']);
    $stmt->execute();
}

$conn->close();
?>