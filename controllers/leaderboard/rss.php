<?php

class LeaderboardController {
    private $leaderboard;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->db ->getConnection();

        $this->leaderboard = new Leaderboard();
    }

    public function showLeaderboard() {

        $users = $this->leaderboard->getUsers($this->db->getDb());
        $file = 'leaderboard.xml';
        $this->leaderboard->createRssFeed($users, $file);
        $output = $this->leaderboard->parseRssFeed($file);

        return $output;
    }
}
