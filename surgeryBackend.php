<?php
include("dbconn.php");

// Fetch Surgery Data
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT ID, surgerydate, surgerydesc, starttime, endtime FROM surgery ORDER BY ID DESC";
    $result = mysqli_query($conn, $query);
    $surgeryData = "";
    $sno = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $surgeryData .= "<tr>
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

    echo json_encode(["tableData" => $surgeryData, "count" => mysqli_num_rows($result)]);
    exit;
}

// Insert Surgery Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["surgerydate"])) {
    $date = $_POST["surgerydate"];
    $desc = $_POST["surgerydesc"];
    $starttime = $_POST["starttime"];
    $endtime = $_POST["endtime"];

    $query = "INSERT INTO surgery (surgerydate, surgerydesc, starttime, endtime) VALUES ('$date', '$desc', '$starttime', '$endtime')";
    mysqli_query($conn, $query);
    echo "success";
    exit;
}

// Edit Surgery Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["id"];
    $query = "SELECT * FROM surgery WHERE ID = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
    exit;
}

// Update Surgery Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $date = $_POST["surgerydate"];
    $desc = $_POST["surgerydesc"];
    $starttime = $_POST["starttime"];
    $endtime = $_POST["endtime"];

    $query = "UPDATE surgery SET surgerydate='$date', surgerydesc='$desc', starttime='$starttime', endtime='$endtime' WHERE ID='$id'";
    mysqli_query($conn, $query);
    echo "success";
    exit;
}

// Delete Surgery Data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["id"];
    $query = "DELETE FROM surgery WHERE ID='$id'";
    mysqli_query($conn, $query);
    echo "success";
    exit;
}
?>
