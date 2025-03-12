<?php 
session_start();
include 'dbconn.php'; // Ensure this file has a valid DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Prepare SQL statement for login table
        $sql2 = "SELECT id, name, username, password FROM login WHERE username = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $username);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows == 1) {
            $user = $result2->fetch_assoc();
            
            // Check password
            if ($password === $user['password']) {  // Change this to `password_verify($password, $user['password'])` if passwords are hashed.
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
