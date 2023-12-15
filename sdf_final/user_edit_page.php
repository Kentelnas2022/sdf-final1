<?php
include 'dbconn.php';

class UserUpdater {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserDetails($id) {
        $sql = "SELECT * FROM user WHERE id='$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateUser($id, $name, $username, $password) {
        $sql = "UPDATE user SET name='$name', username='$username', password='$password' WHERE id='$id'";
        return $this->conn->query($sql);
    }
}

$userUpdater = new UserUpdater($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $users = $userUpdater->getUserDetails($id);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($userUpdater->updateUser($id, $name, $username, $password)) {
        header("Location: user_edit.php?id=$id");
    } else {
        echo "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style type="text/css">
        body {
            background-color: #D6EEEE;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form action="user_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
        <center>
            <h3><label>Name</label></h3>
            <input type="text" name="name" value="<?php echo $users['name']; ?>"> <br>
            <h3><label>username</label></h3>
            <input type="text" name="username" value="<?php echo $users['username']; ?>"> <br>
            <h3><label>password:</label></h3>
            <input type="text" name="password" value="<?php echo $users['password']; ?>"><br><br>
            <input type="submit" name="submit" value="Update User">
            <input type="submit" name="cancel" value="Cancel">
        </center>
    </form>
</body>
</html>
