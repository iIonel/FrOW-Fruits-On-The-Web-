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
    <div class="container">
        <h2>About</h2>
        <p>Fruits On The Web belongs to Arcade and it is often associated with Clicker Games and Tap Games.This game
            has been published on 2023-04-08 and updated on 2023-04-09. (version 1.0.0.2 Beta) </p>
        <a href="login.php">Back to Login?</a>
        <h4>Try a new learning experience through play!</h4>
    </div>
</body>

</html>
