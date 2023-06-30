<?php

class Database {
    private $db;
    private $CONFIG = [
        'servername' => "localhost",
        'username' => "root",
        'password' => '',
        'db' => 'frow'
    ];

    /**
     * @return void 
     */
    public function getConnection() {
        $this->db = null;
        try {
            $this->db = new mysqli(
                $this->CONFIG["servername"],
                $this->CONFIG["username"],
                $this->CONFIG["password"],
                $this->CONFIG["db"]
            );
        } catch (Exception $e) {
            echo "Connection failed: " . $e;
        }
    }

     /**
     * @return mixed 
     */
    public function prepare($query) {
        return $this->db->prepare($query);
    }

     /**
     * @return mixed 
     */
    public function getDb() {
        return $this->db;
    }
}
