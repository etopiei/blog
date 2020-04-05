<?php

require('./constants.php');

function getNavButtons($postNumber) {
	if($postNumber != 0) {
		$postCount = getNumberOfPosts();
		if($postNumber != 1) {
			$prevPost = $postNumber - 1;
			echo "<a id='prev-link' href='" . $base . "/post/" . $prevPost . "'> < Previous Post </a>";			
		}
		if($postNumber != $postCount) {
			$nextPost = $postNumber + 1;
			echo "<a id='next-link' href='" . $base . "/post/" . $nextPost . "'> Next Post > </a>"; 		
		}
	}
}

function printPostList() {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/metadata.post";
	$lines = file($filename);
	for($x = 0; $x < sizeof($lines); $x++) {
		$currentTitle = "";
		$parts = preg_split('/\s+/', $lines[$x], -1, PREG_SPLIT_NO_EMPTY);
		for($y = 1; $y < sizeof($parts); $y++) {
			$currentTitle = $currentTitle . " " . $parts[$y];		
		}
		$postNumber = $x + 1;
		echo "<a href='" . $base . "/post/" . $postNumber . "'>" . $currentTitle . "</a><br>";
	}
}

function getPostTime($postNumber) {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/metadata.post";
	$lines = file($filename);
	$postString = $lines[$postNumber-1];
	$words = preg_split('/\s+/', $postString, -1, PREG_SPLIT_NO_EMPTY);
	return DateTime::createFromFormat("U", $words[0]);
}

function getPostTitle($postNumber) {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/metadata.post";
	$lines = file($filename);
	$postString = $lines[$postNumber-1];
	$words = preg_split('/\s+/', $postString, -1, PREG_SPLIT_NO_EMPTY);
	$title = "";
	for($x = 1; $x < sizeof($words); $x++) {
		$title = $title . " " . $words[$x];
	}
	return $title;
}

function getPostDescription($postNumber) {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/description.post";
	$lines = file($filename);
	$postString = $lines[$postNumber-1];
	$words = preg_split('/\s+/', $postString, -1, PREG_SPLIT_NO_EMPTY);
	$desc = "";
	for($x = 1; $x < sizeof($words); $x++) {
		$desc = $desc . " " . $words[$x];
	}
	return $desc;
}

function getNumberOfPosts() {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/metadata.post";
	$lines = file($filename);
	return sizeof($lines);
}

function getPost($postNumber) {
	$result = "";
	if($postNumber != 0 && $postNumber <= getNumberOfPosts()) {
		$title = getPostTitle($postNumber);
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$postNumber" . ".post";
		$myFile = fopen($filename, "r") or die ("Can't open file.");
		$result .= "<h2>" . "$title" . "</h2><br>";
		$result .= fread($myFile, filesize($filename));
		fclose($myFile);		
	} else {
		$result .= "No blog posts yet. Check back soon!";		
	}
	return $result;
}

function update($postId) {
	$directory = "./posts/";
	$fileCount = 0;
	$postReturn = 0;
	$files = glob($directory . "*");
	if($files) {
		$fileCount = count($files);		
	}
	if($fileCount > 0) {
		$postReturn = $fileCount-2;
	}
	if($postId > 0 && $postId <= $fileCount-2) {
		$postReturn = $postId;		
	}
	return $postReturn;
}

?>
