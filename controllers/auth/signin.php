<?php

require_once '../../models/user.php';
require_once '../../models/database.php';
require_once 'config.php'; 
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;

class LoginController {
    private $user;
    private $db;
    private $message;

    public function __construct() {
        $this->user = new User();
        $this->db = new Database();
        $this->db->getConnection();
    }

    public function loginUser() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $this->setParam();
            $userDetails = $this->user->getUserFromData($this->db->getDb());

            if ($userDetails) {
                $hashPassword = $this->user->getHashPasswordFromData($this->db->getDb());

                if (password_verify($this->user->getPassword(), $hashPassword)) {
                   
                    $token = $this->generateToken($userDetails['id']);

                    session_start();
                    $_SESSION['jwt_token'] = $token;
                    $_SESSION['id'] = $this->user->getIdFromData($this->db->getDb());
                    $_SESSION['username'] = $this->user->getUsername();
                    $_SESSION['score'] = $this->user->getScoreFromData($this->db->getDb()); 
                    
                    header("Location: ../../views/home.php");
                    exit();
                } else {
                    $this->setMessage("Invalid password");
                }
            } else {
                $this->setMessage("Invalid username");
            }
        } else {
            $this->setMessage("Empty fields");
        }

        header("Location: ../../views/login.php?message=" . urlencode($this->message));
        exit();
    }

    private function generateToken($userId) {
        $payload = [
            'user_id' => $userId,
            'exp' => time() + 3600, 
        ];
        $token = JWT::encode($payload, JWT_SECRET_KEY, 'HS256');
        return $token;
    }

    private function setMessage($message) {
        $this->message = $message;
    }

    private function setParam() {
        $this->user->setUsername($_POST['username']);
        $this->user->setPassword($_POST['password']);
    }
}

$loginController = new LoginController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginController->loginUser();
}
