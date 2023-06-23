<?php
    session_start();
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
    <form method="POST" action="./includes/game-create/set-game.php">
        <h1>Create Lobby Game</h1>
        <label for="time"></label>
        <input type="number" name="time" id="time" placeholder="Time (seconds)" min="10" max="30">
        <label for="difficulty"></label>
        <input type="number" name="difficulty" id="difficulty" placeholder="Difficulty" min="1" max="3">
        <button type="submit">Create</button>
        <a href="home.php">Back to Home?</a>
        <?php
            if(isset($_GET['message']))
                echo '<p class="error-message">' . $_GET['message'] . '</p>';
        ?>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>