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
    <form class="container">
        <h2>LeaderBoard</h2>
        <ul class="board">
            <?php
              require './includes/rss-informations.php';
              $rss = './includes/leaderboard.xml'; 
              $parsedFeed = parseRssFeed($rss);
              echo $parsedFeed;
            ?>
        </ul>
        <a href="home.php">Back to Home?</a>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>