<?php
session_start();
include 'dbconn.php'; // Ensure this file has a valid DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Check in the employeedetails table
        $sql1 = "SELECT id, Name, empUserName FROM employeedetails WHERE  empUserName = ? AND empPassword = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ss", $username, $password);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        // Check in the login table
        $sql2 = "SELECT id, name, username FROM login WHERE  username = ? AND password = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ss", $username, $password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result1->num_rows == 1) {
            // User found in employeedetails table
            $user = $result1->fetch_assoc();
            $_SESSION['empUserName'] = $user['empUserName'];
            $_SESSION['Name'] = $user['Name'];
            $_SESSION['empId'] = $user['id']; // Changed from empId to id

            header("Location: employeedash.php");
            exit();
        } elseif ($result2->num_rows == 1) {
            // User found in login table
            $user = $result2->fetch_assoc();
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["name"] = $user['name'];

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid Username or Password!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Both fields are required!";
        header("Location: login.php");
        exit();
    }
}
?>
