<?php
    session_start();
    if(!isset($_SESSION['jwt_token']))
        header("Location: login.php");
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
    <form method="GET" class="container" action="../api/main.php">
            <h1>Select Game Level!</h1>
            <button type="submit" name="level" value="easy">Easy</button>
            <button type="submit" name="level" value="medium">Medium</button>
            <button type="submit" name="level" value="hard">Hard</button>
            <a href="home.php">Back to Home?</a>
            <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>
