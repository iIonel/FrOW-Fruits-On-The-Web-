<?php

require 'connection.php';

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

function validPassword($password, $confirmPassword){
    if($password != $confirmPassword){
        $GLOBALS['message'] =  "Invalid Confirm Password!";
        return false;
    }
    if(strlen($password) < 8){
        $GLOBALS['message'] =  "Password must be at least 8 characters long!";
        return false;
    }
    if(!preg_match("/[a-zA-Z]/", $password)){
        $GLOBALS['message'] =  "Password must contain at least one letter!";
        return false;
    }
    if(!preg_match("/\d/", $password)){
        $GLOBALS['message'] =  "Password must contain at least one digit!";
        return false;
    }

    return true;
}

function validFirstName($firstName){
    if(strlen($firstName) < 3){
        $GLOBALS['message'] =  "Fisrt Name must be at least 3 characters long!";
        return false;
    }
    if(preg_match("/\d/", $firstName)){
        $GLOBALS['message'] =  "First Name must contain letters!";
        return false;
    }
    return true;
}

function validLastName($lastName){
    if(strlen($lastName) < 3){
        $GLOBALS['message'] =  "Last Name must be at least 3 characters long!";
        return false;
    }
    if(preg_match("/\d/", $lastName)){
        $GLOBALS['message'] =  "Last Name must contain letters!";
        return false;
    }
    return true;
}

function validUsername($username, $con){
    if(strlen($username) < 5){
        $GLOBALS['message'] =  "Username must be at least 5 characters long!";
        return false;
    }
    $query =  "SELECT * FROM users WHERE username ='$username'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $GLOBALS['message'] =  "Username is already taken!";
        return false;
    }
    return true;
}

function validEmail($email, $con){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $GLOBALS['message'] =  "Invalid Email!";
        return false;
    }
    $query =  "SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $GLOBALS['message'] =  "Email is already taken!";
        return false;
    }
    return true;
}

if(isNotEmpty() && isIsset()){
    
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $score = 0;

    if(validPassword($password, $confirmPassword) && validEmail($email, $con) && validUsername($username, $con) && validFirstName($firstName) && validLastName($lastName)){

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sqlStatement = "INSERT INTO users (first_name, last_name, username, email, password, score) VALUES('$firstName', '$lastName', '$username', '$email', '$hashPassword', '$score')";
        $result = mysqli_query($con, $sqlStatement);
        $GLOBALS['message'] = "You have successfully registered!";
        header("Location: ../register.php?message=" . urldecode($GLOBALS['message']));
    }
    else{
        header("Location: ../register.php?message=" . urldecode($GLOBALS['message']));
    }
}
else {
    header("Location: ../register.php?message=" . urldecode($GLOBALS['message']));
}