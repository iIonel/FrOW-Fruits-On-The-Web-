<?php
    session_start();
    if(!isset($_SESSION['id']))
        header("Location: login.php");
    if(!isset($_SESSION['select_game']))
       header("Location: home.php");
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
        <form method="GET" class="container" action="./includes/play-api/play-game.php">
                <h1>Select lobby!</h1>
                <ul class="board">
                    <?php
                        $json = $_GET['response'];
                        $response = json_decode($json,true);
                        if(!empty($response)){
                            foreach($response as $game){
                                $id = $game['id'];
                                $timer = $game['timer'];
                                $level = $game['level'];
                                $username = $game['username'];
                                $rounds = $game['rounds'];
                                $users = $game['users'];
                                
                                require './includes/connection.php';
                                $user_id = $_SESSION['id'];
                                $sqlStatement = "SELECT * FROM rooms WHERE user_id = '$user_id' AND game_id = '$id'";
                                $result = mysqli_query($con,$sqlStatement);
                                $row = mysqli_num_rows($result);
                                if($row == 0){
                                    echo '<div style="display: flex">';
                                    echo '<h3>Lobby ID#' .$id. '</h3>';
                                    echo '<h4 style="margin-left:1rem">Time:' .$timer. '</h4>';
                                    echo '</div>';
                                    echo '<button type="submit" name="ID" value="'.$id.'" style="margin-left:1.5rem">Select</button>';
                                    echo '<hr style="width:85%;text-align:left;margin-left:0">';
                                }
                                else{
                                    echo '<div style="display: flex">';
                                    echo '<h3 style="color: rgb(255, 145, 0);">Lobby ID#' .$id. '</h3>';
                                    echo '<h4 style="margin-left:1rem;color: rgb(255, 145, 0);">Time:' .$timer. '</h4>';
                                    echo '</div>';
                                    echo '<button type="submit" name="ID" value="'.$id.'" style="margin-left:1.5rem">Select</button>';
                                    echo '<hr style="width:85%;text-align:left;margin-left:0">';
                                }
                            }
                        }
                        else{
                            echo "<h3>No lobbies!</h3>";
                        }
                        unset($_SESSION['select_game']);
                    ?>
                </ul>
                <a href="home.php">Back to Home?</a>
                <h4>Try a new learning experience through play!</h4>
        </form>
    </body>

    </html>