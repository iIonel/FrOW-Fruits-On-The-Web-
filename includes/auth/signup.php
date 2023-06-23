<?php

require '../connection.php';
$message = '';

function isNotEmpty(){
    if(!empty($_POST['first-name']) && !empty($_POST['last-name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password']))
        return true;
    $GLOBALS['message'] = "Empty Fields!";
    return false;
}

function isIsset(){
    if(isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password']))
        return true;
    $GLOBALS['message'] =  "Doesnt set Fields!";
    return false;
}

if(isNotEmpty() && isIsset()){
    include_once '../../models/user.php';
    
    $user = new User($con);
    $user->setFirstName($_POST['first-name']);
    $user->setLastName($_POST['last-name']);
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $user->setConfirmPassword($_POST['confirm-password']);
    $user->setScore(0);

    if($user->validForRegister()){
        $hashPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $score = $user->getScore();
        $sqlStatement = "INSERT INTO users (first_name, last_name, username, email, password, score) VALUES('$firstName', '$lastName', '$username', '$email', '$hashPassword', '$score')";
        $result = mysqli_query($con, $sqlStatement);
        $GLOBALS['message'] = "You have successfully registered!";
        header("Location: ../../register.php?message=" . urldecode($GLOBALS['message']));
    }
    else{
        header("Location: ../../register.php?message=" . urldecode($user->getMessage()));
    }
}
else {
    header("Location: ../../register.php?message=" . urldecode($GLOBALS['message']));
}