<?php

require 'connection.php';

function getUsers($con){
    $users = array();

    $sqlStatement = "SELECT username, score FROM users ORDER BY score DESC";
    $result = mysqli_query($con, $sqlStatement);

    $count = 1;
    while($row = $result->fetch_assoc()){
        $users[] = array(
            "position" => $count,
            "username" => $row['username'],
            "score" => $row['score']
        );
        $count++;
    }

    return $users;
}

function createRssFeed($users, $file){
    $rss = '<?xml version="1.0" encoding="UTF-8"?>';
    $rss .= '<rss version="2.0">';
    $rss .= '<channel>';
    $rss .= '<title>Leaderboard</title>';
    $rss .= '<link>https://leaderboard.com</link>';
    $rss .= '<description>Latest Scores</description>';
    foreach ($users as $user) {
        $rss .= '<item>';
        $rss .= '<title>#'. $user['position']. '.' . $user['username'] . '</title>';
        $rss .= '<description>Score:'. ' ' . $user['score'] . '</description>';
        $rss .= '</item>';
    }
    $rss .= '</channel>';
    $rss .= '</rss>';

    file_put_contents($file, $rss);
}


$users = getUsers($con);
createRssFeed($users, 'leaderboard.xml');
