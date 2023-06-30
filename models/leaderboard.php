<?php
class Leaderboard {

    /**
     * @param $db
     * @return array
     */
    public function getUsers($db) {
        $users = array();

        $sqlStatement = "SELECT username, score FROM users ORDER BY score DESC";
        $result = mysqli_query($db, $sqlStatement);

        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $users[] = array(
                "position" => $count,
                "username" => $row['username'],
                "score" => $row['score']
            );
            $count++;
        }

        return $users;
    }

    /**
     * @param $db
     * @param $file
     * @return void
     */
    public function createRssFeed($users, $file) {
        $rss = '<?xml version="1.0" encoding="UTF-8"?>';
        $rss .= '<rss version="2.0">';
        $rss .= '<channel>';
        $rss .= '<title>Leaderboard</title>';
        $rss .= '<link>https://leaderboard.com</link>';
        $rss .= '<description>Latest Scores</description>';
        foreach ($users as $user) {
            $rss .= '<item>';
            $rss .= '<title>#' . $user['position'] . '.' . $user['username'] . '</title>';
            $rss .= '<description>Score:' . ' ' . $user['score'] . '</description>';
            $rss .= '</item>';
        }
        $rss .= '</channel>';
        $rss .= '</rss>';

        file_put_contents($file, $rss);
    }

    /**
     * @param $rss
     * @return string
     */
    public function parseRssFeed($rss) {
        $output = '';
        $document = new DOMDocument();
        $document->load($rss);

        $channel = $document->getElementsByTagName('channel')->item(0);
        $items = $channel->getElementsByTagName('item');

        foreach ($items as $item) {
            $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
            $description = $item->getElementsByTagName('description')->item(0)->nodeValue;
            $output .= '<div style="display: flex">';
            $output .= '<h2>' . $title .  '</h2>';
            $output .= '<h3 style="margin-left:3rem; margin-top:1.5rem">' . $description . '</h3>';
            $output .= '</div>';
            $output .= '<hr style="width:85%;text-align:left;margin-left:0">';
        }

        return $output;
    }
}
