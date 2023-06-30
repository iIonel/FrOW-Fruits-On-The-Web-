<?php
    session_start();
    $_SESSION['in_game'] = 1;
    if(!isset($_SESSION['jwt_token']))
        header("Location: login.php");
    if(!isset($_SESSION['start_game']))
        header("Location: home.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits On The Web!</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <div class="top-container">
            <div class="round">
                <h2>Round: </h2>
            </div>
            <div class="time">
                <h2>Time: </h2>
            </div>
        </div>
        <div class ="gameSection">
            <img id="photo">
            <button class="answer" id="btn0"></button>
            <button class="answer" id="btn1"></button>
            <button class="answer" id="btn2"></button>
        </div>
        <a href="home.php">Back to Home?</a>
        <h4>Try a new learning experience through play!</h4>
    </div>
</body>

</html>