<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST['taskId'];
    $taskDetails = $_POST['taskDetails'];
    $newActualHrs = floatval($_POST['actualHrs']);

    if ($newActualHrs <= 0) {
        echo "Error: Actual hours must be greater than zero.";
        exit;
    }

    // Fetch the existing task
    $query = "SELECT name, date, actualHrs FROM dailyupdates WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    if (!$task) {
        echo "Error: Task not found.";
        exit;
    }

    $employeeName = $task['name'];
    $taskDate = $task['date'];
    $existingActualHrs = floatval($task['actualHrs']);

    // Fetch total hours excluding this task
    $query = "SELECT COALESCE(SUM(actualHrs), 0) AS totalActualHrs FROM dailyupdates WHERE name = ? AND date = ? AND id != ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $employeeName, $taskDate, $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $totalActualHrs = floatval($row['totalActualHrs']);

    // Calculate new total hours
    $adjustedTotalHrs = $totalActualHrs + $newActualHrs;

    if ($adjustedTotalHrs > 8) {
        echo "Error: Total working hours cannot exceed 8 hours in a day.";
        exit;
    }

    // Update task
    $query = "UPDATE dailyupdates SET taskDetails = ?, actualHrs = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdi", $taskDetails, $newActualHrs, $taskId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: Could not update task.";
    }
}
?>
