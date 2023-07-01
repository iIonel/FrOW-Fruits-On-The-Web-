<?php

class StartGame{
    private $db;
    public function __construct(){
        $this->db = new Database();
        $this->db->getConnection();
    }
    public function allRounds($id){
        $sqlStatement = "SELECT * FROM games WHERE id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_game = mysqli_fetch_assoc($result);
        $game_id = $row_game['id'];

        $all = array();
        $rounds = array();
        $sqlStatement = "SELECT * FROM rounds WHERE game_id = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("i", $game_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row_round = mysqli_fetch_assoc($result)) {

            $round_id = $row_round['id'];
            $round_no = $row_round['round_number'];
            $image_path = $row_round['image_path'];

            $sqlStatement = "SELECT * FROM answers WHERE round_id = ?";
            $stmt = $this->db->getDb()->prepare($sqlStatement);
            $stmt->bind_param("i", $round_id);
            $stmt->execute();
            $result_answer = $stmt->get_result();

            $answers = array();
            while ($row_answer = mysqli_fetch_assoc($result_answer)) {
                $answer_id = $row_answer['id'];
                $answers[] = array(
                    'answer_id' => $answer_id,
                    'answer' => $row_answer['answer']
                );
            }

            $rounds[] = array(
                'round_id' => $round_id,
                'round_no' => $round_no,
                'answer' => $row_round['answer'],
                'image' => $image_path,
                'answers' => $answers
            );

            unset($answers);
        }

        $all[] = array(
            'id' => $row_game['id'],
            'timer' => $row_game['timer'],
            'level' => $row_game['level'],
            'users' => $row_game['users'],
            'rounds' => $rounds,
        );

        header('Content-Type: application/json');
        return json_encode($all);
    }
}
