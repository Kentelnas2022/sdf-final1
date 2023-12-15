<?php
class UserProfile {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function getUserData($userId) {
        $sql = "SELECT * FROM tb_reglog WHERE id = '$userId'";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            echo "Error fetching user data: " . mysqli_error($this->conn);
            exit;
        }

        return mysqli_fetch_assoc($result);
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

$userProfile = new UserProfile($servername, $username, $password, $dbname);
$user_id = $_SESSION["user_id"];
$row = $userProfile->getUserData($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
           <a class="navbar-brand" href="#">User Profile</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="user_dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="logout.php">Logout</a>
                  </li>
               </ul>
           </div>
       </div>
   </nav>
    </nav>

    <div class="container mt-5">
        <h2>User Profile</h2>
        <p><strong>Username:</strong> <?php echo $row["username"]; ?></p>
        <p><strong>Email:</strong> <?php echo $row["email"]; ?></p>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        <a href="delete_account.php" class="btn btn-danger">Delete Account</a>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
