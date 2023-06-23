<?
class Game{
    private $con;
    private $table = "games";
    private $id;
    private $user_id;
    private $timer;
    private $level;
    private $rounds_nr;
    private $users;
    private $rounds;

    //CONSTRUCTOR
    public function __construct($con,$user_id,$timer,$level, $rounds_nr,$users, $rounds){
        $this->con = $con;
        $this->user_id = $user_id;
        $this->timer = $timer;
        $this->level = $level;
        $this->rounds_nr = $rounds_nr;
        $this->users = $users;
        $this->rounds = $rounds;
    }

    //SETTERS
    public function setId($id){
        $this->id = $id;
    }
    
    //GETTERS
    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function getTimer(){
        return $this->timer;
    }
    public function getLevel(){
        return $this->level;
    }
    public function getRoundsNr(){
        return $this->rounds_nr;
    }
    public function getUsers(){
        return $this->users;
    }
    public function getRounds(){
        return $this->rounds;
    }
}