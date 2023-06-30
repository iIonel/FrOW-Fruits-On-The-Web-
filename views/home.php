<?php
   session_start();
   if (!isset($_SESSION['jwt_token'])) {
       header("Location: login.php");
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
    <form method="POST" class="container" action="../controllers/home/routes.php">
            <?php
                echo "<h2>Welcome, {$_SESSION['username']} !</h2>";
            ?>
            <button type="submit" name="rules">Rules</button>
            <button type="submit" name="play">Play</button>
            <button type="submit" name="leaderboard">LeaderBoard</button>
            <button type="submit" name="create">Create Game</button>
            <button type="submit" name="logout">Logout</button>
            <?php
                echo "<h4>Score: {$_SESSION['score']} points!</h4>";
            ?>
            <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>
