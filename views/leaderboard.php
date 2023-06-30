<?php
    session_start();
    if (!isset($_SESSION['jwt_token'])) {
        header("Location: login.php");
        exit();
    }

    require_once '../controllers/leaderboard/rss.php';
    require_once '../models/database.php';
    require_once '../models/leaderboard.php';
    $leaderboardController = new LeaderboardController();
    $parsedFeed = $leaderboardController->showLeaderboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits On The Web!</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <form class="container">
        <h2>LeaderBoard</h2>
        <ul class="board">
            <?php
                echo $parsedFeed;
            ?>
        </ul>
        <a href="home.php">Back to Home?</a>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>
