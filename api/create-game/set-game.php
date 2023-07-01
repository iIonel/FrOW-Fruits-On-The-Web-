<?php

class SetGame{
    private $message;

    private function isNotEmpty(){
        if(!empty($_POST['time']) && !empty($_POST['difficulty']))
            return true;
        $this->setMessage("Empty Fields!");
        return false;
    }
    
    private function isIsset(){
        if(isset($_POST['time']) && isset($_POST['difficulty']))
            return true;
        $this->setMessage("Doesn't set Fields!");
        return false;
    }

    public function isGoodSet(){
        if($this->isNotEmpty() && $this->isIsset()){

            $time = $_POST['time'];
            $difficulty = $_POST['difficulty']; 
            
            session_start();
            $_SESSION['time'] = $time;
            $_SESSION['difficulty'] = $difficulty;   
        
            header("Location: ../../views/finish.php");
        } 
        else{
            header("Location: ../../views/create.php?message=" . urlencode($this->getMessage()));
        }
    }

    private function setMessage($message){
        $this->message = $message;
    }

    private function getMessage(){
        return $this->message;
    }
}

$setGame = new SetGame();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $setGame->isGoodSet();
}
