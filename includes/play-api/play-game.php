<?php

require '../connection.php';

function allRounds($con, $id){

    $sqlStatement = "SELECT * FROM games WHERE id = '$id'";
    $result = mysqli_query($con,$sqlStatement);
    $row_game = mysqli_fetch_assoc($result);
    $game_id = $row_game['id'];

    $user_id = $row_game['user_id'];
    $sqlStatement = "SELECT * FROM users WHERE id = '$user_id'";
    $result_user = mysqli_query($con,$sqlStatement);
    $row_user = mysqli_fetch_assoc($result_user);
    $username = $row_user['username'];

    $all = array();
    $rounds = array();
    $sqlStatement = "SELECT * FROM rounds WHERE game_id = '$game_id'";
    $result = mysqli_query($con,$sqlStatement);


    while($row_round = mysqli_fetch_assoc($result)){

        $round_id = $row_round['id'];
        $round_no = $row_round['round_number'];
        $image_path = $row_round['image_path'];

        $sqlStatement = "SELECT * FROM answers WHERE round_id = '$round_id'";
        $result_answer = mysqli_query($con,$sqlStatement);
        
        $answers = array();
        while($row_answer = mysqli_fetch_assoc($result_answer)){
            $answer_id = $row_answer['id'];
            $answers[] = array(
                'answer_id' => $answer_id,
                'answer' => $row_answer['answer']
            );  
        }

        $rounds[] = array(
            'round_id' => $round_id,
            'round_no' => $round_no,
            'answer' => $row_round['answer'],
            'image' => $image_path,
            'answers' => $answers
        );  

        unset($answers);
    }

    $all[] = array(
        'id' => $row_game['id'],
        'timer' => $row_game['timer'],
        'level' => $row_game['level'],
        'username' => $username,
        'users' => $row_game['users'],
        'rounds' => $rounds,
    );

    header('Content-Type: application/json');
    return json_encode(($all));
}


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id;
    if(isset($_GET['ID'])){
        $id = $_GET['ID'];
    }
    
    $response = allRounds($con,$id);
    header("Location: ../../round.php?response=".urlencode($response));
    session_start();
    $_SESSION['start_game'] = 1;
}
