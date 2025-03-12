<?php
include 'dbconn.php'; // Include your database connection file

if (isset($_POST['date'])) {
    $selectedDate = $_POST['date'];

    $sql = "SELECT * FROM dailyupdates WHERE date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $count = $result->num_rows; // Get total entries for selected date
    $sno = 1; // Serial Number starts from 1

    $tableData = ""; // Initialize table data

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $actualHrs = trim($row['actualHrs']); // Trim any whitespace
            $status = ($actualHrs === '-' || empty($actualHrs)) 
                ? '<td><i class="fas fa-hourglass-half status-icon in-progress" style="font-size:12px;color:rgb(0, 148, 255);"></i>&nbsp;&nbsp;In Progress</td>' 
                : '<td><i class="fas fa-check-circle status-icon completed" style="font-size:12px;color:rgb(0, 148, 255);"></i>&nbsp;&nbsp;Completed</td>';

            $tableData .= "<tr>
                <td>{$sno}</td>  <!-- Updated Serial Number -->
                <td>{$row['name']}</td>
                <td>{$row['date']}</td>
                <td>{$row['companyName']} - {$row['projectTitle']}</td>
                <td>{$row['projectType']}</td>
                <td>{$row['totalDays']}</td>
                <td>{$row['taskDetails']}</td>
                <td>{$row['totalHrs']}</td>
                <td>{$row['actualHrs']}</td>
                $status
            </tr>";
            
            $sno++; // Increment Serial Number
        }
    } else {
        $tableData = "<tr><td colspan='10'>No records found for this date</td></tr>";
    }

    // Return JSON response
    echo json_encode(["count" => $count, "table" => $tableData]);
}
?>
