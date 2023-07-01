<?php 
class CreateGame{
    private $db;
    private $fruits;
    private $used;
    private $generate;
    private $message;
    private $game;  
    private $round;
    private $answer;

    public function __construct(){
        $this->db = new Database();
        $this->db->getConnection();
        $this->used = array();
        $this->generate = array();
    }

    public function setFruits($fruits){
        $this->fruits = $fruits;
    }

    private function isNotEmpty($i){
        if(!empty($_POST['fruits'.$i]))
            return true;
        $this->setMessage("Empty Fields!");
        return false;
    }

    private function isIsset($i){
        if(isset($_POST['fruits'.$i]))
            return true;
        $this->setMessage("Doesn't set Fields!");
        return false;
    }   

    public function generateGame(){
        session_start();
        if(isset($_SESSION['round'])){
            $round = $_SESSION['round'];
            for($i = 1; $i <= $round; $i++){
                if($this->isNotEmpty($i) && $this->isIsset($i)){
                    $this->used[] = $_POST['fruits'.$i];
                }
                else {
                    $this->setMessage("Incomplete or empty fields");
                    return;
                }
            }

            for($i = 0; $i < count($this->used); $i++){
                $ok = 0;
                $first;
                $second;
                while(!$ok){
                    $first = array_rand($this->fruits);
                    $second = array_rand($this->fruits);
                    $ok1 = 1;
                    for($j = 0; $j < count($this->used); $j++){
                        if($this->used[$j] == $this->fruits[$first] || $this->used[$j] == $this->fruits[$second])
                            $ok1 = 0;
                    }
                    $ok2 = 1;
                    if(count($this->generate)){
                        for($j = 0; $j < count($this->generate); $j++){
                            if($this->generate[$j] == $first || $this->generate[$j] == $second || $this->fruits[$first] == $this->fruits[$second])
                                $ok2 = 0;
                        }
                    }
                    if($ok1 && $ok2)
                        $ok = 1;
                }
                $this->generate[] = $this->fruits[$first];
                $this->generate[] = $this->fruits[$second];
            }
    
            $image_paths = array();
            for($i = 0; $i < count($this->used); $i++)
                $image_paths[] = '../images/game/'.strtolower($this->used[$i]).'.jpeg';
    
            $level = "";
            $time = $_SESSION['time'];
            if($round == 3)
                $level = "easy";
            else if($round == 5)
                $level = "medium";
            else if($round == 7)
                $level = "hard";

            $this->setGame($time,$level,$round);
            $game_id = $this->game->save($this->db->getDb());

            $gameData = array(
                'game' => array(
                    'time' => $time,
                    'level' => $level,
                    'rounds' => $round
                ),
                'rounds' => array()
            );

            for($i = 1; $i <= $round; $i++){
                $correct = $this->used[$i-1];
                $incorrectfirst;
                $incorrectsecond;
                switch($i){
                    case 1:
                        $incorrectfirst = $this->generate[0];
                        $incorrectsecond = $this->generate[1];
                        break;
                    case 2:
                        $incorrectfirst = $this->generate[2];
                        $incorrectsecond = $this->generate[3];
                        break;
                    case 3:
                        $incorrectfirst = $this->generate[4];
                        $incorrectsecond = $this->generate[5];
                        break;
                    case 4:
                        $incorrectfirst = $this->generate[6];
                        $incorrectsecond = $this->generate[7];
                        break;
                    case 5:
                        $incorrectfirst = $this->generate[8];
                        $incorrectsecond = $this->generate[9];
                        break;
                    case 6:
                        $incorrectfirst = $this->generate[10];
                        $incorrectsecond = $this->generate[11];
                        break;
                    case 7:
                        $incorrectfirst = $this->generate[12];
                        $incorrectsecond = $this->generate[13];
                        break;
                }
    
                $image = $image_paths[$i-1];
                $round_number = $i;
                
                $this->setRound($game_id,$round_number,$correct,$image);
                $roundId =  $this->round->save($this->db->getDb());
    
                $answers = array();
                $answers[] = $correct;
                $answers[] = $incorrectfirst;
                $answers[] = $incorrectsecond;
                shuffle($answers);
    
                $this->setAnswer($roundId,$answers,0);
                $this->answer->save($this->db->getDb());
                
                $this->setAnswer($roundId,$answers,1);
                $this->answer->save($this->db->getDb());
    
                $this->setAnswer($roundId,$answers,2);
                $this->answer->save($this->db->getDb());
        
                $roundData = array(
                    'round_number' => $round_number,
                    'correct_answer' => $correct,
                    'image' => $image,
                    'answers' => $answers
                );
    
                $gameData['rounds'][] = $roundData;
    
                unset($answers);
            }

            header('Content-Type: application/json');
            return json_encode($gameData);
        }
    }  

    private function setGame($time, $level, $round){
        $this->game = new Game();
        $this->game->setTimer($time);
        $this->game->setLevel($level);
        $this->game->setRoundsNr($round);
        $this->game->setUsers(0);
    }

    private function setRound($game_id, $round_number, $correct, $image){
        $this->round = new Round();
        $this->round->setGameId($game_id);
        $this->round->setNr($round_number);
        $this->round->setAnswer($correct);
        $this->round->setImage($image);
    }

    private function setAnswer($roundId,$answers,$i){
        $this->answer = new Answer();
        $this->answer->setRoundId($roundId);
        $this->answer->setAnswer($answers[$i]);
    }

    private function setMessage($message){
        $this->message = $message;
    }

    private function getMessage(){
        return $this->message;
    }
}
