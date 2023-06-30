<?php
class Round{
    private $id;
    private $gameId;
    private $nr;
    private $answer;
    private $image;
    private $answers;

     /**
     * @param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }

     /**
     * @param mixed $id
     */
    public function setGameId($id){
        $this->gameId = $id;
    }

     /**
     * @param mixed $nr
     */
    public function setNr($nr){
        $this->nr = $nr;
    }

     /**
     * @param mixed $answer
     */
    public function setAnswer($answer){
        $this->answer = $answer;
    }

     /**
     * @param mixed $image
     */
    public function setImage($image){
        $this->image = $image;
    }

     /**
     * @param mixed $answers
     */
    public function setAnswers($answers){
        $this->answers = $answers;
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
    public function getGameId(){
        return $this->gameId;
    }

    /**
     * @return mixed
     */
    public function getNr(){
        return $this->nr;
    }

    /**
     * @return mixed
     */
    public function getAnswer(){
        return $this->answer;
    }

    /**
     * @return mixed
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getAnswers(){
        return $this->answers;
    }

    /**
     * @param $db
     * @return int
     */
    public function save($db) {

        $sqlStatement = "INSERT INTO rounds (game_id, round_number, answer, image_path) VALUES (?, ?, ?, ?)";

        $gameId = $this->getGameId();
        $roundNumber = $this->getNr();
        $answer = $this->getAnswer();
        $imagePath = $this->getImage();

        $stmt = $db->prepare($sqlStatement);
        $stmt->bind_param("iiss", $gameId, $roundNumber, $answer, $imagePath);
        $stmt->execute();

        $roundId = $stmt->insert_id;
        $stmt->close();

        return $roundId;
    }
}
