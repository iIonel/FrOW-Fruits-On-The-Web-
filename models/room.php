<?
class Room{
    private $id;
    private $user_id;
    private $game_id;

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
     * @param mixed $game_id
     */
    public function setGameId($game_id){
        $this->game_id = $game_id;
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
    public function getGameId(){
        return $this->game_id;
    }
}
