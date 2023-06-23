<?php

class User{
    private $con;
    private $table = "users";
    private $id;
    private $first_name;
    private $last_name;
    private $username;
    private $email;
    private $password;
    private $confirmPassword;
    private $score;
    private $message;

    //CONSTRUCTOR
    public function __construct($con){$this->con = $con;}


    //SETTERS
    public function setId($id){
        $this->id = $id;
    }
    public function setFirstName($first){
        $this->first_name = $first;
    }
    public function setLastName($last){
        $this->last_name = $last;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setConfirmPassword($confirmPassword){
        $this->confirmPassword = $confirmPassword;
    }
    public function setScore($score){
        $this->score = $score;
    }


    //GETTERS
    public function getId(){
        return $this->id; 
    }
    public function getFirstName(){
        return $this->first_name;
    }
    public function getLastName(){
        return $this->last_name;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getScore(){
        return $this->score;
    }
    public function getMessage(){
        return $this->message;    
    }


    //VALIDATE
    public function validPassword(){
        if($this->password != $this->confirmPassword){
            $this->message = "Invalid Confirm Password!";
            return false;
        }
        if(strlen($this->password) < 8){
            $this->message =  "Password must be at least 8 characters long!";
            return false;
        }
        if(!preg_match("/[a-zA-Z]/", $this->password)){
            $this->message = "Password must contain at least one letter!";
            return false;
        }
        if(!preg_match("/\d/", $this->password)){
            $this->message =  "Password must contain at least one digit!";
            return false;
        }
        return true;
    }
    
    public function validFirstName(){
        if(strlen($this->first_name) < 3){
            $this->message =  "Fisrt Name must be at least 3 characters long!";
            return false;
        }
        if(preg_match("/\d/", $this->first_name)){
            $this->message =  "First Name must contain letters!";
            return false;
        }
        return true;
    }
    
    public function validLastName(){
        if(strlen($this->last_name) < 3){
            $this->message =  "Last Name must be at least 3 characters long!";
            return false;
        }
        if(preg_match("/\d/", $this->last_name)){
            $this->message =  "Last Name must contain letters!";
            return false;
        }
        return true;
    }
    
    public function validUsername(){
        if(strlen($this->username) < 5){
            $this->message =  "Username must be at least 5 characters long!";
            return false;
        }
        $query =  "SELECT * FROM users WHERE username ='$this->username'";
        $result = mysqli_query($this->con, $query);
        if(mysqli_num_rows($result) > 0){
            $this->message =  "Username is already taken!";
            return false;
        }
        return true;
    }
    
    public function validEmail(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->message =  "Invalid Email!";
            return false;
        }
        $query =  "SELECT * FROM users WHERE email ='$this->email'";
        $result = mysqli_query($this->con, $query);
        if(mysqli_num_rows($result) > 0){
            $this->message =  "Email is already taken!";
            return false;
        }
        return true;
    }
    
    public function validForRegister(){
        if($this->validEmail() && $this->validFirstName() && $this->validLastName() && $this->validPassword() && $this->validUsername())
            return true;
        return false;
    }

}