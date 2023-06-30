<?php
    session_start();
    if(!isset($_SESSION['jwt_token']))
        header("Location: login.php");
    if(!isset($_SESSION['start_game']))
        header("Location: home.php");
    if(isset($_SESSION['in_game']) && !isset($_GET['gameId']))
        header("Location: home.php");
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, 'home.php');
        }
    </script>
    <div id="last" class="container">
        <h1>Congratulations!</h1>
        <?php
            require '../api/update-game/update.php';
            require '../models/database.php';
            $id = $_GET['gameId'];
            $score = $_GET['score'];
            $difficulty = $_GET['difficulty'];
            $players = $_GET['players'];
            $update = new Update();
            $update->update($score,$id,$_SESSION['id']);
            $players++;
            echo '<h2>You won +'.$score.' '. 'points!</h2>';
            echo '<p>Lobby ID: #'.$id.'<br> Players: '.$players.'<br> Difficulty:'.' '.$difficulty.' '.'</p>';
            unset($_SESSION['start_game']);
        ?>
        <a href="home.php">Back to Home?</a>
        <h4>Try a new learning experience through play!</h4>
    </div>
</body>

</html>