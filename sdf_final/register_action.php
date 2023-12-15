<?php
include 'dbcon.php';

class UserRegistration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registerUser($username, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $check_query = "SELECT * FROM tb_reglog WHERE username='$username' OR email='$email'";
        $result = $this->conn->query($check_query);
        
        if ($result->num_rows > 0) {
            $this->showErrorMessage();
            exit();
        }

        $sql = "INSERT INTO tb_reglog (username, email, password) VALUES ('$username', '$email', '$password_hash')";

        if ($this->conn->query($sql) === TRUE) {
            $this->redirectToSuccess();
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    private function showErrorMessage() {
        echo "<p style='font-size: 24px; color: #D5DEEF; position:absolute; top:50%; left:50%;transform: translate(-50%,50%);'>Error: Username or email already exists. <b><a href ='reglog.php'>Click here to register again.</a></b></p>";
    }

    private function redirectToSuccess() {
        header('location: register_success.php');
    }
}

// Example usage:
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$userRegistration = new UserRegistration($conn);
$userRegistration->registerUser($username, $email, $password);
?>
