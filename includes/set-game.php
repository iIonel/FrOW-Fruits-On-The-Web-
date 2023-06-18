<?php

function isNotEmpty(){
    if(!empty($_POST['time']) && !empty($_POST['difficulty']))
        return true;
    $GLOBALS['message'] = "Empty Fields!";
    return false;
}

function isIsset(){
    if(isset($_POST['time']) && isset($_POST['difficulty']))
        return true;
    $GLOBALS['message'] =  "Doesn't set Fields!";
    return false;
}

if(isNotEmpty() && isIsset()){
    $time = $_POST['time'];
    $difficulty = $_POST['difficulty']; 
    session_start();
    $_SESSION['time'] = $time;
    $_SESSION['difficulty'] = $difficulty;   

    header("Location: ../finish.php");
} 
else{
    header("Location: ../create.php?message=" . urlencode($GLOBALS['message']));
}