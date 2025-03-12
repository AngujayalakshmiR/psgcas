<?php
include("dbconn.php"); // Ensure database connection is included FIRST

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check if connection is successful
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $query = "DELETE FROM dailyupdatesmeals WHERE id = $id";
        mysqli_query($conn, $query);
        exit();
    }

    $datetime = $_POST["datetime"];
    $description = $_POST["description"];
    $status = "-";

    // File Upload
    $proofName = $_FILES["proof"]["name"];
    $proofTmpName = $_FILES["proof"]["tmp_name"];
    $proofDestination = "uploads/" . $proofName;
    move_uploaded_file($proofTmpName, $proofDestination);

    $query = "INSERT INTO dailyupdatesmeals (datetime, proof, description, status) VALUES ('$datetime', '$proofDestination', '$description', '$status')";
    mysqli_query($conn, $query);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT * FROM dailyupdatesmeals ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $data = [];
    $sno = 1;
    $tableData = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $tableData .= "<tr>
                        <td>{$sno}</td>
                        <td>{$row['datetime']}</td>
                        <td><a href='{$row['proof']}' target='_blank'>View</a></td>
                        <td>{$row['description']}</td>
                        <td>{$row['status']}</td>
                        <td><button class='btn btn-danger btn-delete' data-id='{$row['id']}'><i class='fas fa-trash-alt'></i></button></td>
                      </tr>";
        $sno++;
    }

    $data["count"] = $sno - 1;
    $data["tableData"] = $tableData;

    echo json_encode($data);
    exit();
}
?>
