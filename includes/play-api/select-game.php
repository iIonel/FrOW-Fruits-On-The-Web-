<?php

require '../connection.php';

function allLobbies($con, $level){
    $sqlStatement = "SELECT * FROM games WHERE level = '$level'";
    $result = mysqli_query($con,$sqlStatement);
    $all = array();
    while($row = mysqli_fetch_assoc($result)){

        $user_id = $row['user_id'];
        $sqlStatement = "SELECT * FROM users WHERE id = '$user_id'";
        $result_user = mysqli_query($con,$sqlStatement);
        $row_user = mysqli_fetch_assoc($result_user);
        $username = $row_user['username'];

        $all[] = array(
            'id' => $row['id'],
            'timer' => $row['timer'],
            'level' => $row['level'],
            'username' => $username,
            'rounds' => $row['rounds'],
            'users' => $row['users']
        );
    }
    header('Content-Type: application/json');
    return json_encode(($all));
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $level;
    if(isset($_GET['level'])){
        $level = $_GET['level'];
    }
    $response = allLobbies($con,$level);
    header("Location: ../../lobbys.php?response=".urlencode($response));
    session_start();
    $_SESSION['select_game'] = 1;
}