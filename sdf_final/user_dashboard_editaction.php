<?php
class TaskUpdater {
    private $conn;

    public function __construct() {
        include 'dbcon.php'; // Include your database connection
        $this->conn = $conn;
    }

    public function updateTask($id, $title) {
        $sql = "UPDATE tb_add SET add_task='$title' WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            header("location: ./user_dashboard.php");
        }
    }
}

// Usage
if (isset($_POST['updateTask'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];

    $taskUpdater = new TaskUpdater();
    $taskUpdater->updateTask($id, $title);
}
?>
