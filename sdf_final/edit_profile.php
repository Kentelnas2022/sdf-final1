<?php
class UserProfile {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function getUserProfile($userId) {
        $sql = "SELECT * FROM tb_reglog WHERE id = '$userId'";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            echo "Error fetching user data: " . mysqli_error($this->conn);
            exit;
        }

        return mysqli_fetch_assoc($result);
    }

    public function updateUserProfile($userId, $username, $email) {
        $update_sql = "UPDATE tb_reglog SET username = '$username', email = '$email' WHERE id = '$userId'";
        if (mysqli_query($this->conn, $update_sql)) {
            header("Location: profile.php");
            exit;
        } else {
            echo "Error updating profile: " . mysqli_error($this->conn);
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

$user_id = $_SESSION["user_id"];
$userProfile = new UserProfile($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userProfile->updateUserProfile($user_id, $username, $email);
}

$row = $userProfile->getUserProfile($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
h2 {
    text-align:center;
}
        .header {
            background-color: #333;
            color: white;
            text-align: right;
            padding: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .header a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid white;
            border-radius: 4px;
            
        }

        .header a:hover {
            background-color: lightblue;
            color: red;
        }

        .container {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 6px;
           
        }

        .container h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    
    </style>
</head>
<body>
    <div class="header">
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="">
            <input type="text" name="username" value="<?php echo $row["username"]; ?>"><br>
            <input type="email" name="email" value="<?php echo $row["email"]; ?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
