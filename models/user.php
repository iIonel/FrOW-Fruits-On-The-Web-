<?php

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $username;
    private $email;
    private $password;
    private $confirmPassword;
    private $score;
    private $hashPassword;

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

     /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return mixed 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

     /**
     * @return mixed 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

     /**
     * @return mixed 
     */
    public function getPassword() {
        return $this->password;
    }

    
    /**
     * @param mixed $hashPassword
     */
    public function setHashPassword($hashedPassword) {
        $this->hashPassword = $hashedPassword;
    }

     /**
     * @return mixed 
     */
    public function getHashPassword() {
        return $this->hashPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword) {
        $this->confirmPassword = $confirmPassword;
    }

     /**
     * @return mixed 
     */
    public function getConfirmPassword() {
        return $this->confirmPassword;
    }

      /**
     * @param mixed $score
     */
    public function setScore($score) {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * @param $db
     * @return bool
     */
    public function save($db) {
        $this->hashPassword = password_hash($this->getPassword(), PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, username, email, password, score) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $this->getFirstName(), $this->getLastName(), $this->getUsername(), $this->getEmail(), $this->getHashPassword(), $this->getScore());
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $db
     * @return object
     */
    public function getUserFromData($db) {
        $username = $this->getUsername();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    /**
     * @param $db
     * @return int 
     */
    public function getIdFromData($db) {
        $username = $this->getUsername();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id = $row['id'];
        return $id;
    }

    /**
     * @param $db
     * @return string
     */
    public function getHashPasswordFromData($db) {
        $username = $this->getUsername();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashPassword = $row['password'];
        return $hashPassword;
    }

    /**
     * @param $db
     * @return int
     */
    public function getScoreFromData($db){
        $username = $this->getUsername();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $score = $row['score'];
        return $score;
    }   
}
