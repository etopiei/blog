<?php

$title="";
$subtitle="";
$url="";

echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>' . $title . '</title>';
echo '<link>' . $url . '</link>';
echo '<description>' . $subtitle . '</description>';
echo '<language>en-us</language>';
echo '<copyright> Copyright (C) 2019 ' . url . '</copyright>';

    // Here iterate over all posts and create an item for them in feed.
    echo '<item>';
    echo '<title>' . $postTitle . '</title>';
    echo '<description>' . $postDescription . '</description>';
    echo '<link>' . $url . '?id=' . $postId . '</link>';
    echo '</item>';

echo '</channel>';
echo '</rss>';
?>