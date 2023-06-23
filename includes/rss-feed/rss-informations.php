<?php

function parseRssFeed($rss) {
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