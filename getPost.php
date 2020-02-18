<?php

function getNavButtons($postNumber) {
	if($postNumber != 0) {
		$directory = "./posts/";
		$fileCount = 0;
		$files = glob($directory . "*");
		if($files) {
			$fileCount = count($files);		
		}
		if($postNumber != 1) {
			$prevPost = $postNumber - 1;
			echo "<a id='prev-link' href='http://" . $_SERVER['HTTP_HOST'] . "/post/" . $prevPost . "'> < Previous Post </a>";			
		}
		if($postNumber != $fileCount-1) {
			$nextPost = $postNumber + 1;
			echo "<a id='next-link' href='http://" . $_SERVER['HTTP_HOST'] . "/post/" . $nextPost . "'> Next Post > </a>"; 		
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
		echo "<a href='/post/" . $postNumber . "'>" . $currentTitle . "</a><br>";
	}
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
	if($postNumber != 0) {
		$title = getPostTitle($postNumber);
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$postNumber" . ".post";
		$myFile = fopen($filename, "r") or die ("Can't open file.");
		echo "<h2>" . "$title" . "</h2><br>";
		echo fread($myFile, filesize($filename));
		fclose($myFile);		
	} else {
		echo "No blog posts yet. Check back soon!";		
	}
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
		$postReturn = $fileCount-1;
	}
	if($postId > 0 && $postId <= $fileCount-1) {
		$postReturn = $postId;		
	}
	return $postReturn;
}

?>
