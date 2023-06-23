<?php
    session_start();
    if(!isset($_SESSION['difficulty']))
        header("Location: home.php");
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
    <form method="POST" action="./includes/game-create/create-game.php">
        <h1>Finish Your Game</h1>
        <?php
            $difficulty = $_SESSION['difficulty'];
            unset($_SESSION['difficulty']);
            $f = array(
                "Apple", 
                "Coconut", 
                "Grape", 
                "Kiwi", 
                "Lemon", 
                "Mango", 
                "Plum", 
                "Watermelon",
            );
            $round;
            if($difficulty == 1)
               $round = 3;
            else if($difficulty == 2)
                $round = 5;            
            else 
                $round = 7;
            echo '<ul class="board">';
            for ($i = 1; $i <= $round; $i++) {
                echo '<h2 style="margin-top:1rem">Round' . ' ' . $i . '</h2>';
                echo '<h3>Select a correct answer:</h3>';
                echo '<input type="text" name="fruits' . $i . '" list="fruits"/>';
                echo '<datalist id="fruits">';
                
                for ($j = 0; $j < count($f); $j++) {
                    echo "<option value=\"$f[$j]\"></option>";
                }
                
                echo '</datalist>';
            }
            
            echo '</ul>';
            $_SESSION['round'] = $round;
        ?>
        <button type="submit">Finish</button>
        <a href="home.php">Back to Home?</a>
        <?php
            if(isset($_GET['message']))
                echo '<p class="error-message">' . $_GET['message'] . '</p>';
        ?>
        <h4>Try a new learning experience through play!</h4>
    </form>
</body>

</html>