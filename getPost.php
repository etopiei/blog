<?php

function getPost($postNumber) {
	if($postNumber != 0) {
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$postNumber" . ".post";
		$myFile = fopen($filename, "r") or die ("Can't open file.");
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
	//if postId > 0 and <= fileCount update
	if($fileCount > 0) {
		$postReturn = $fileCount;
	}
	if($postId > 0 && $postId <= $fileCount) {
		$postReturn = $postId;		
	}
	return $postReturn;
}

?>