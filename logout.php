<?php
session_start();
$_SESSION = []; // Clear all session variables
session_destroy(); // Destroy the session
setcookie(session_name(), "", time() - 3600, "/"); // Remove session cookie
header("Location: login.php");
exit();
?>
