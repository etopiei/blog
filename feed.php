<?php

require('getPost.php');

$title="TITLE_HERE";
$subtitle="SUB_HERE";
$url="URL_HERE";

echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>' . $title . '</title>';
echo '<link>' . $url . '</link>';
echo '<description>' . $subtitle . '</description>';
echo '<language>en-us</language>';
echo '<copyright> Copyright (C) 2020 "' . $url . '"</copyright>';

    // Here iterate over all posts and create an item for them in feed.
    $num_posts = getNumberOfPosts();
	for($x = 0; $x < $num_posts; $x++) {
        echo '<item>';
        echo '<title>' . getPostTitle($x + 1) . '</title>';
        echo '<description>' . getPostDescription($x + 1) . '</description>';
        echo '<link>' . $url . '/post/' . ($x + 1) . '</link>';
        echo '</item>';
    }

echo '</channel>';
echo '</rss>';
?>