<?php

class Level{
    private $db;
    public function __construct() {
        $this->db = new Database();
        $this->db->getConnection();
    }
    public function allLobbies($level){
        $sqlStatement = "SELECT * FROM games WHERE level = ?";
        $stmt = $this->db->getDb()->prepare($sqlStatement);
        $stmt->bind_param("s", $level);
        $stmt->execute();
        $result = $stmt->get_result();
        $all = array();
    
        while($row = $result->fetch_assoc()){
    
            $all[] = array(
                'id' => $row['id'],
                'timer' => $row['timer'],
                'level' => $row['level'],
                'rounds' => $row['rounds'],
                'users' => $row['users']
            );
        }
    
        header('Content-Type: application/json');
        return json_encode($all);
    }
}
