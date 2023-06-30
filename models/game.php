<?php 

class Game{
    private $id;
    private $user_id;
    private $timer;
    private $level;
    private $rounds_nr;
    private $users;
    private $rounds;

    /**
     * @param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $timer
     */
    public function setTimer($timer){
        $this->timer = $timer;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level){
        $this->level = $level; 
    }

    /**
     * @param mixed $rounds_nr
     */
    public function setRoundsNr($rounds_nr){
        $this->rounds_nr = $rounds_nr;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users){
        $this->users = $users;
    }

    /**
     * @param mixed $rounds
     */
    public function setRounds($rounds){
        $this->rounds = $rounds;
    }

    /**
     * @return mixed 
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed 
     */
    public function getUserId(){
        return $this->user_id;
    }

    /**
     * @return mixed 
     */
    public function getTimer(){
        return $this->timer;
    }

    /**
     * @return mixed 
     */
    public function getLevel(){
        return $this->level;
    }

    /**
     * @return mixed 
     */
    public function getRoundsNr(){
        return $this->rounds_nr;
    }

    /**
     * @return mixed 
     */
    public function getUsers(){
        return $this->users;
    }

    /**
     * @return mixed 
     */
    public function getRounds(){
        return $this->rounds;
    }

    /**
     * @param $db
     * @return int
     */
    public function save($db) {

        $sqlStatement = "INSERT INTO games (timer, level, rounds, users) VALUES (?, ?, ?, ?)";

        $timer = $this->getTimer();
        $level = $this->getLevel();
        $rounds = $this->getRoundsNr();
        $users = $this->getUsers();

        $stmt = $db->prepare($sqlStatement);
        $stmt->bind_param("isii", $timer, $level, $rounds, $users);
        $stmt->execute();

        $gameId = $stmt->insert_id;
        $stmt->close();

        return $gameId;
    }
}
