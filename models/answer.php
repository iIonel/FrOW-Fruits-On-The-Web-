<?
class Answer{
    private $con;
    private $table = "answers";
    private $id;
    private $answer;

    //CONSTRUCTOR
    public function __construct($con,$answer){
        $this->con = $con;
        $this->answer = $answer;
    }

    //SETTERS
    public function setId($id){
        $this->id = $id;
    }

    //GETTERS
    public function getId(){
        return $this->id;
    }

    public function getAnswer(){
        return $this->answer;
    }
}