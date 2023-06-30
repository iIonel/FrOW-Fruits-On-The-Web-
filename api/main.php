<?php

require_once '../models/database.php';
require_once '../models/game.php';
require_once '../models/round.php';
require_once '../models/answer.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once '../api/create-game/create-game.php';
    $createGame = new CreateGame();
    $createGame->setFruits(file("fruits-names.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    
    $response = $createGame->generateGame();
    //echo $response;
    header("Location: ../views/home.php");
}
else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['level'])){
    
    require_once '../api/select-game/select-game.php';
    $level = $_GET['level'];
    
    $myLevel = new Level();
    $response = $myLevel->allLobbies($level);
    //echo $response;
    header("Location: ../views/lobbys.php?response=".urlencode($response));
    session_start();
    $_SESSION['select_game'] = 1;
}
else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ID'])){
    
    require_once '../api/select-game/play-game.php';
    $id = $_GET['ID'];
    
    $game = new StartGame();
    $response = $game->allRounds($id);
    //echo $response;
    header("Location: ../views/round.php?response=".urlencode($response));
    session_start();
    $_SESSION['start_game'] = 1;
}
else if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
    
    require_once '../api/update-game/update.php';
    $update = new Update();
}
