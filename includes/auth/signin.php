<?php
require '../connection.php';

function isNotEmpty(){
    if(!empty($_POST['username']) && !empty($_POST['password']))
        return true;
    $GLOBALS['message'] = "Empty Fields!";
    return false;
}

function isIsset(){
    if(isset($_POST['username']) && isset($_POST['password']))
        return true;
    $GLOBALS['message'] =  "Doesn't set Fields!";
    return false;
}

if(isNotEmpty() && isIsset()){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlStatement = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sqlStatement);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashPassword = $row['password'];

        if (password_verify($password, $hashPassword)) {
            
            include_once '../../models/user.php';
            $user = new User($con);
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setFirstName($row['first_name']);
            $user->setLastName($row['last_name']);
            $user->setEmail($row['email']);
            $user->setPassword($password);
            $user->setConfirmPassword($password);
            $user->setScore($row['score']);

            session_start();
            $_SESSION['id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['score'] = $user->getScore(); 
            header("Location: ../../home.php");
        } 
        else {
            $GLOBALS['message'] = "Invalid Password!";
            header("Location: ../../login.php?message=" . urlencode($GLOBALS['message']));
        }
    } 
    else {
        $GLOBALS['message'] = "Invalid Username!";
        header("Location: ../../login.php?message=" . urlencode($GLOBALS['message']));
    }
}
else{
    header("Location: ../../login.php?message=" . urlencode($GLOBALS['message']));
}