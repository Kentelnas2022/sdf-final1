<?php
include 'dbcon.php';

class UserLogin {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function performLogin($username, $password) {
        $sql = "SELECT * FROM tb_reglog WHERE username ='$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $this->conn->close();
                header('Location: user_dashboard.php');
                exit(); // Stop further execution after redirect
            } else {
                $this->redirectWithError("Middle");
            }
        } else {
            $this->redirectWithError("Bottom");
        }
    }

    private function redirectWithError($errorType) {
        header("Location: reglog.php?error=$errorType");
        exit(); // Stop further execution after redirect
    }
}

// Example usage:
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$userLogin = new UserLogin($conn);
$userLogin->performLogin($username, $password);
?>
