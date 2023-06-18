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
    <form method="POST" action="./includes/create-game.php">
        <h1>Finish Your Game</h1>
        <?php
            session_start();
            $difficulty = $_SESSION['difficulty'];

            $fruits = file("fruits.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $round;
            if($difficulty == 1)
               $round = 3;
            else if($difficulty == 2)
                $round = 5;            
            else 
                $round = 7;
            echo '<ul class="board">';
            for($i = 1; $i <= $round; $i++){
                echo '<h2 style="margin-top:1rem">Round'.' '.$i.'</h2>';
                echo '<h3>Select a correct answer:</h3>';
                echo'<input type="text" name="fruits' . $i . '" list="fruits"/>';
                echo'<datalist id="fruits">';
                    foreach ($fruits as $fruit) 
                    echo "<option value=\"$fruit\"></option>";
                echo'</datalist>';
            }
            echo'</ul>';
            $_SESSION['round'] = $round;
        ?>
        <button type="submit">Finish</button>
        <a href="home.php">Back to Home?</a>
        <?php
            if(isset($_GET['message'])){
                $errorMessage = urldecode($_GET['message']);
                echo '<p class="error-message">' . $errorMessage . '</p>';
            }
        ?>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>