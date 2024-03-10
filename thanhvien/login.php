<?php
    @include('header.php');
    error_reporting(0);

    if (isset($_POST['submit'])) {
        $ac_username = $_POST['ac_username'];
        $ac_password =  $_POST['ac_password'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="container">
<form action="" method="post" class="login-accnum">
            
            <div>
                <input type="text" name="ac_username" value="<?php echo $ac_username; ?>" required>
            </div>

            <div>
                <input type="text" name="ac_password" value="<?php echo $ac_password; ?>" required>
            </div>
            <div>
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text"><a href="forgot.php">Forgot your password?</a></p>
        </form>
    </div>
</body>
</html>