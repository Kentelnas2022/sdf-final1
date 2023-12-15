<?php
session_start();

include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and validate admins input
    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        //authenticate if admin
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
  
        header("Location: admin_reglog.php?error=Invalid credentials");
        exit();
    }
} else {

    header("Location: admin_reglog.php");
    exit();
}

//Directs to admin page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== TRUE) {
    header("Location: admin_reglog.php");
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin accounts from the database
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);

$admins = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}

// Close the database connection
$conn->close();
?>
