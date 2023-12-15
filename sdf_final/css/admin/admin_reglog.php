<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form action="admin_auth.php" class="login-form" method="POST">
                <h1>Admin</h1>
                <input type="text" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit">Login</button>
                <p class="message">Not an Admin? <a href="reglog.php">Click here to go back</a></p>
            </form>
            
        </div>
    </div>
</body>
</html>
