<?php

require 'connection.php';
session_start();

function isNotEmpty($i){
    if(!empty($_POST['fruits'.$i]))
        return true;
    $GLOBALS['message'] = "Empty Fields!";
    return false;
}

function isIsset($i){
    if(isset($_POST['fruits'.$i]))
        return true;
    $GLOBALS['message'] =  "Doesn't set Fields!";
    return false;
}

$used = array();
$generate = array();
$fruits = file("../fruits.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if(isset($_SESSION['round'])){
    $round = $_SESSION['round'];
    for($i = 1; $i <= $round; $i++){
        if(isNotEmpty($i) && isIsset($i))
            $used[] = $_POST['fruits'.$i];
        else
            header("Location: ../finish.php?message=" . urlencode($GLOBALS['message']));
    }
    for($i = 0; $i < count($used); $i++){
        $ok = 0;
        $first;
        $second;
        while(!$ok){
            $first = array_rand($fruits);
            $second = array_rand($fruits);
            $ok1 = 1;
            for($j = 0; $j < count($used); $j++){
                if($used[$j] == $fruits[$first] || $used[$j] == $fruits[$second])
                    $ok1 = 0;
            }
            $ok2 = 1;
            if(count($generate)){
                for($j = 0; $j < count($generate); $j++){
                    if($generate[$j] == $first || $generate[$j] == $second || $fruits[$first] == $fruits[$second])
                        $ok2 = 0;
                }
            }
            if($ok1 && $ok2)
                $ok = 1;
        }
        $generate[] = $fruits[$first];
        $generate[] = $fruits[$second];
    }

    $level;
    $time = $_SESSION['time'];
    $user_id = $_SESSION['id'];
    if($round == 3)
        $level = "easy";
    else if($round == 5)
        $level = "medium";
    else if($round == 7)
        $level = "hard";

    $sqlStatement = "INSERT INTO games (user_id, timer, level, rounds)
    VALUES ('$user_id', '$time', '$level', '$round')";

    $result = mysqli_query($con,$sqlStatement);
    //am creat doar games dar tb sa fac si restu cu runde si tot celu + sa fac si graphql ala
    
}




