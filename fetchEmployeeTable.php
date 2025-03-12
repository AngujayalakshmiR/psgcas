<?php
include("dbconn.php");

$sql = "SELECT * FROM employeedetails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        $fullAddress = $row['empAdd'] . ", " . $row['empDistrict'] . ", " . $row['empState'] . ", " . $row['empCountry'] . " - " . $row['empPincode'];

        echo "<tr>";
        echo "<td>" . $sno++ . "</td>";
        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Designation']) . "</td>";
        echo "<td>" . htmlspecialchars($row['empPhNo']) . "</td>";
        echo "<td>" . htmlspecialchars($fullAddress) . "</td>";
        echo "<td><i class='fas fa-camera-retro photo-icon' onclick='openImageModal(\"" . htmlspecialchars($row['empPic']) . "\")'></i></td>";
        echo "<td><i class='fas fa-id-card aadhar-icon' onclick='openImageModal(\"" . htmlspecialchars($row['empAadhar']) . "\")'></i></td>";
        echo "<td><i class='fas fa-id-badge pan-icon' onclick='openImageModal(\"" . htmlspecialchars($row['empPan']) . "\")'></i></td>";
    
        echo "<td class='action-buttons'>
            <button class='btn-action btn-edit' data-id='" . $row['ID'] . "'><i class='fas fa-edit'></i></button>
            <button class='btn-action btn-delete delete-btn' data-id='" . $row['ID'] . "'>
                <i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i>
            </button>
        </td>";
    
        echo "</tr>";
    } 
} else {
    echo "<tr><td colspan='9'>No employees found</td></tr>";
}
?>
