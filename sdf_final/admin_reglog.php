<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_reglog.css">
</head>
<body>
<style> body {
      padding: 0;
            margin: 0;
            background-image: url('https://e1.pxfuel.com/desktop-wallpaper/721/613/desktop-wallpaper-abstract-login-page-thumbnail.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

</style>
  <div class="hero">  
        <div class="form-box">
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['error']; ?>
                        </div>
                    <?php endif; ?>
                    <form action="admin_action.php" method="POST" id="login" class="input-group">
                        <div class="mb-3">
                            <input type="text" class="input-field" placeholder="Username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
                        </div>
                        <center><button type="submit" class="submit-btn">Login</button>
                        <p class="message">Not an Admin? <a href="reglog.php">Click here to go back</a></p>
</form>
                    </form>
                </div>

</body>
</html>


