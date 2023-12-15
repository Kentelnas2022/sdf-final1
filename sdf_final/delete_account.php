<?php
class AccountDeletion {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function deleteUserAccount($userId) {
        $delete_reglog = "DELETE FROM tb_reglog WHERE id = '$userId'";
        if (mysqli_query($this->conn, $delete_reglog)) {
            session_destroy();
            header("Location: reglog.php");
            exit;
        }
    }
}

// Usage
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: reglog.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdf_final-main";

if (isset($_POST["confirm"])) {
    $accountId = $_SESSION["user_id"];

    $accountDeletion = new AccountDeletion($servername, $username, $password, $dbname);
    $accountDeletion->deleteUserAccount($accountId);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
</head>
<body>
    <div class="container">
        <h2>Delete Account</h2>
        <p>Are you sure you want to delete your account?</p>
        <form method="post" action="">
            <input type="submit" name="confirm" value="Yes">
            <a href="profile.php">No, go back</a>
        </form>
    </div>
</body>
</html>
