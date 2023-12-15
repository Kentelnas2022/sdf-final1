<?php
class TaskManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addTask($task) {
        $sql = "INSERT INTO tb_add (add_task) VALUES ('$task')";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            header("location: ./user_dashboard.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($this->conn);
        }
    }
}

// Usage:
include 'dbcon.php'; // Assuming this includes your database connection

if (isset($_POST['addTask'])) {
    $taskManager = new TaskManager($conn); // $conn is assumed to be your database connection

    $add_task = $_POST['add_task'];
    $taskManager->addTask($add_task);
}
?>
