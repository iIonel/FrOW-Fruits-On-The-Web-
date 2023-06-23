<?php

$con = mysqli_connect('localhost', 'root', '', 'frow');
if(!$con){
    die('Connection Refused!');
}

function update($con, $score, $id, $player_id){

    $sqlStatement = "SELECT * FROM rooms WHERE user_id = '$player_id' AND game_id = '$id'";
    $result = mysqli_query($con,$sqlStatement);
    $row = mysqli_num_rows($result);
    if($row == 0){
        $sqlStatement = "INSERT INTO rooms (user_id, game_id) VALUES ('$player_id','$id')";
        $result = mysqli_query($con,$sqlStatement);


        $sqlStatement = "SELECT * FROM users WHERE id ='$player_id'";
        $result = mysqli_query($con,$sqlStatement);
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'] + $score;

        $sqlStatement = "UPDATE users SET score = '$actualScore' WHERE id = '$player_id'";
        $result = mysqli_query($con,$sqlStatement);

        $sqlStatement = "SELECT * FROM games WHERE id ='$id'";
        $result = mysqli_query($con,$sqlStatement);
        $row = mysqli_fetch_assoc($result);
        $actualPlayers = $row['users'] + 1;
            
        $sqlStatement = "UPDATE games SET users = '$actualPlayers' WHERE id = '$id'";
        $result = mysqli_query($con,$sqlStatement);
        $sqlStatement = "SELECT * FROM users WHERE id ='$player_id'";
        $result = mysqli_query($con,$sqlStatement);
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'];
        $_SESSION['score'] = $actualScore;
    }
    else{
        $sqlStatement = "SELECT * FROM users WHERE id ='$player_id'";
        $result = mysqli_query($con,$sqlStatement);
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'];
        $_SESSION['score'] = $actualScore;
    }

}