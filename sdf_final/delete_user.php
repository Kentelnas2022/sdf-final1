<?php
include 'dbcon.php';


$id = $_GET['id'];


$sql = "DELETE FROM user WHERE id='$id'";


if ($conn->query($sql) === True) {
  header("Location: admin_dashboard.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();