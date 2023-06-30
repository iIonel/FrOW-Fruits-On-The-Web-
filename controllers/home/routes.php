<?php
class HomeController {
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['rules'])) {
             
                header("Location: ../../views/rules.php");
                exit();
            } elseif (isset($_POST['play'])) {
            
                header("Location: ../../views/difficulty.php");
                exit();
            } elseif (isset($_POST['leaderboard'])) {
              
                header("Location: ../../views/leaderboard.php");
                exit();
            } elseif (isset($_POST['create'])) {
              
                header("Location: ../../views/create.php");
                exit();
            } elseif (isset($_POST['logout'])) {
           
                session_start();
                unset($_SESSION['jwt_token']);
                session_destroy();
                header("Location: ../../views/login.php");
                exit();
            }
        }
    }
}

$homeController = new HomeController();
$homeController->handleRequest();
