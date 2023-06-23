<?php

session_start();

if (isset($_POST['rules'])) {
    header("Location: ../rules.php");
}

if (isset($_POST['play'])) {
    header("Location: ../difficulty.php");
}

if (isset($_POST['leaderboard'])) {
    header("Location: ../leaderboard.php");
}

if (isset($_POST['create'])) {
    header("Location: ../create.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: ../login.php");
}