<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM dailyupdatesmedication ORDER BY id DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                    <td>{$row['datetime']}</td>
                    <td>{$row['description']}</td>
                    <td><img src='{$row['proof']}' width='50' height='50'></td>
                    <td>
                        <i class='fas fa-check-circle text-success action-icon' onclick='updateStatus({$row['ID']}, \"Taken\")' style='cursor: pointer; font-size: 18px;'></i>
                        <i class='fas fa-times-circle text-danger action-icon' onclick='updateStatus({$row['ID']}, \"Missed\")' style='cursor: pointer; font-size: 18px; margin-left: 10px;'></i>
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


$conn->close();
?>