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
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <div class="container">
        <h1>Rules</h1>
        <p>In order to play the game you need to select between three different difficulty level: easy, medium, hard.
            <br> For the easy difficulty you get 3 rounds, for the medium 5 rounds and for hard difficulty 7 rounds.
            <br> <br>In each round you have to pick the correct fruit from the given image. By getting 100% accuaracy
            you receive a score based on the game mode: <br> <br>easy - 1000points (Difficulty 1), <br> medium - 2000points (Difficulty 2), <br> hard -
            3000points (Difficulty 3). <br> <br>Based on your score you can appear in the top 10 players leaderboard.</p>
        <a href="home.php">Back to Home?</a>
        <h4>Try a new learning experience through play!</h4>
    </div>
</body>

</html>
