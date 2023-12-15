<?php

include 'dbcon.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc();

		session_start();
		$_SESSION['user_id'] = $user['id'];

	$conn->close();

	header("Location: admin_dashboard.php");
	} else {
		header("Location: user_login_page.php?error=Wrong Username/Password");
	}
	
