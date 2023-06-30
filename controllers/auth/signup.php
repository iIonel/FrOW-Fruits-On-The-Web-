<?php

require_once '../../models/user.php';
require_once '../../models/database.php';

class RegistrationController {
    private $user;
    private $db;
    private $message;

    public function __construct() {
        $this->user = new User();
        $this->db = new Database();
        $this->db->getConnection();
    }

    public function registerUser() {
        $this->setParam();
        if ($this->validForRegister()) {
            if ($this->user->save($this->db->getDb())) {
                $this->setMessage("You have successfully registered!");
                header("Location: ../../views/register.php?message=" . urldecode($this->getMessage()));
                exit;
            }
        } else {
            header("Location: ../../views/register.php?message=" . urldecode($this->getMessage()));
            exit;
        }
    }

    private function validForRegister() {
        if ($this->validFirstName() && $this->validLastName() && $this->validUsername() && $this->validEmail() && $this->validPassword()) {
            return true;
        }
        return false;
    }

    private function validPassword() {
        if ($this->user->getPassword() != $this->user->getConfirmPassword()) {
            $this->setMessage("Invalid Confirm Password!");
            return false;
        }
        if (strlen($this->user->getPassword()) < 8) {
            $this->setMessage("Password must be at least 8 characters long!");
            return false;
        }
        if (!preg_match("/[a-zA-Z]/", $this->user->getPassword())) {
            $this->setMessage("Password must contain at least one letter!");
            return false;
        }
        if (!preg_match("/\d/", $this->user->getPassword())) {
            $this->setMessage("Password must contain at least one digit!");
            return false;
        }
        return true;
    }

    private function validFirstName() {
        if (strlen($this->user->getFirstName()) < 3) {
            $this->setMessage("First Name must be at least 3 characters long!");
            return false;
        }
        if (preg_match("/\d/", $this->user->getFirstName())) {
            $this->setMessage("First Name must contain letters!");
            return false;
        }
        return true;
    }

    private function validLastName() {
        if (strlen($this->user->getLastName()) < 3) {
            $this->setMessage("Last Name must be at least 3 characters long!");
            return false;
        }
        if (preg_match("/\d/", $this->user->getLastName())) {
            $this->setMessage("Last Name must contain letters!");
            return false;
        }
        return true;
    }

    private function validUsername() {
        if (strlen($this->user->getUsername()) < 5) {
            $this->setMessage("Username must be at least 5 characters long!");
            return false;
        }

        $stmt = $this->db->getDb()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $this->user->getUsername());
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->setMessage("Username is already taken!");
            return false;
        }
        return true;
    }

    private function validEmail() {
        if (!filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->setMessage("Invalid Email!");
            return false;
        }

        $stmt = $this->db->getDb()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $this->user->getEmail());
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->setMessage("Email is already taken!");
            return false;
        }
        return true;
    }

    private function setMessage($message) {
        $this->message = $message;
    }

    private function getMessage() {
        return $this->message;
    }

    private function setParam() {
        $this->user->setFirstName($_POST['first-name']);
        $this->user->setLastName($_POST['last-name']);
        $this->user->setUsername($_POST['username']);
        $this->user->setEmail($_POST['email']);
        $this->user->setPassword($_POST['password']);
        $this->user->setConfirmPassword($_POST['confirm-password']);
        $this->user->setScore(0);
    }
}

$registrationController = new RegistrationController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registrationController->registerUser();
}
