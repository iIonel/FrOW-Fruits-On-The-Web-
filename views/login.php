<?php
   session_start();
   if (isset($_SESSION['jwt_token'])) {
       header("Location: home.php");
       exit();
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits On The Web!</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
    <form method="POST" action="../controllers/auth/signin.php">
        <h1>Log in</h1>
        <label for="username"></label>
        <input type="text" name="username" id="username" placeholder="Username">
        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Log in</button>
        <a href="register.php">Don`t have an account?</a>
        <a href="about.php">About!</a>
        <?php
            if(isset($_GET['message']))
                echo '<p class="error-message">' . $_GET['message'] . '</p>';
        ?>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>
</html>
