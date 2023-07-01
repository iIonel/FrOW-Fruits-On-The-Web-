<?php
class Update {
    private $db;

    public function __construct(){
        $this->db = new Database();
        $this->db->getConnection();
    }

    public function update($score, $id, $player_id){
        $sqlStatement = "SELECT * FROM rooms WHERE user_id = ? AND game_id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("ii", $player_id, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_num_rows($result);

        if ($row == 0){
           $this->updateNotExist($score, $id, $player_id);
        } else {
           $this->updateExist($score, $id, $player_id);
        }
    }

    public function updateExist($score, $id, $player_id){
        $sqlStatement = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'];
        $_SESSION['score'] = $actualScore;

        $gameDetails = $this->getGameDetails($id);
        $gameDetails['score'] = $actualScore;

        //echo json_encode($gameDetails);
    }

    public function updateNotExist($score, $id, $player_id){
        $sqlStatement = "INSERT INTO rooms (user_id, game_id) VALUES (?, ?)";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("ii", $player_id, $id);
        $stmt->execute();

        $sqlStatement = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'] + $score;

        $sqlStatement = "UPDATE users SET score = ? WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("ii", $actualScore, $player_id);
        $stmt->execute();

        $sqlStatement = "SELECT * FROM games WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $actualPlayers = $row['users'] + 1;
            
        $sqlStatement = "UPDATE games SET users = ? WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("ii", $actualPlayers, $id);
        $stmt->execute();

        $sqlStatement = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $actualScore = $row['score'];
        $_SESSION['score'] = $actualScore;

        $gameDetails = $this->getGameDetails($id);
        $gameDetails['score'] = $actualScore;

        //echo json_encode($gameDetails);
    }

    private function getGameDetails($id) {
        $sqlStatement = "SELECT * FROM games WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);

        $gameDetails = array(
            'id' => $row['id'],
            'score' => 0, 
            'players' => $row['users'],
            'difficulty' => $row['level']
        );

        return $gameDetails;
    }
}
