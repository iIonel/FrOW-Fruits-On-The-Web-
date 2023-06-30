<?php

class Answer{
    private $id;
    private $roundId;
    private $answer;

    /**
     * @param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }

     /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setRoundId($id){
        $this->roundId = $id;
    }

     /**
     * @return mixed
     */
    public function getRoundId(){
        return $this->roundId;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer){
        $this->answer = $answer;
    }

     /**
     * @return mixed
     */
    public function getAnswer(){
        return $this->answer;
    }

    public function save($db) {

        $sqlStatement = "INSERT INTO answers (round_id, answer) VALUES (?, ?)";
        
        $round_id = $this->getRoundId();
        $answer = $this->getAnswer();

        $stmt = $db->prepare($sqlStatement);
        $stmt->bind_param("is",$round_id, $answer);
        $stmt->execute();
    }
}
