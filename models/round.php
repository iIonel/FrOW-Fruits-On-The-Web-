<?
class Round{
    private $con;
    private $table = "rounds";
    private $id;
    private $nr;
    private $answer;
    private $image;
    private $answers;

    //CONSTRUCTOR
    public function __construct($con,$nr,$answer,$image,$answers){
        $this->con = $con;
        $this->answer = $answer;
        $this->answers = $answers;
    }

    //SETTERS
    public function setId($id){
        $this->id = $id;
    }

    //GETTERS
    public function getId(){
        return $this->id;
    }
    public function getNr(){
        return $this->nr;
    }
    public function getAnswer(){
        return $this->answer;
    }
    public function getAnswers(){
        return $this->answers;
    }
}