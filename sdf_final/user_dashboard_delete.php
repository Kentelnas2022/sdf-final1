<?php
class DatabaseConnection {
    private $conn;

    public function __construct() {
        include 'dbcon.php'; // Include your database connection
        $this->conn = $conn;
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tb_add WHERE id=$id";
        $result = $this->conn->query($sql);

        if ($result) {
            header("location: ./user_dashboard.php");
            exit;
        } else {
            echo "Error: " . $this->conn->error;
        }
    }
}

// Usage
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $dbConnection = new DatabaseConnection();
    $dbConnection->deleteTask($id);
}
?>
