<?php
    session_start();
    if(isset($_SESSION['start_game']))
        unset($_SESSION['start_game']);
    if(!isset($_SESSION['id']))
        header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits On The Web!</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
    <form method="POST" class="container" action="./includes/profile-home.php">
            <?php
                echo "<h1>Welcome, {$_SESSION['username']} !</h1>";
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