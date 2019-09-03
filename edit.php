<?php
$username = $_POST['username'];
$password = $_POST['password'];
$postId = $_POST['postNumber'];
$content = $_POST['content'];
$edited = isset($content);

$BLOG_PASSWORD="";
$BLOG_USERNAME="";

if ($password !== $BLOG_PASSWORD || $username !== $BLOG_USERNAME) {
	//user is bogus, kick them out.
	header("Location: /index.php");
	exit();
}

$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$postId" . ".post";

if($edited) {
	//update the file.
	$myFile = fopen($filename, "w");
	fwrite($myFile, $content);
	fclose($myFile);
	echo "<p>Edit Complete!</p><a href='/'>Click here to return home</a>";
} else {
	//allow editing the file
	$myFile = fopen($filename, "r");
	$fileContents = fread($myFile, filesize($filename));
	fclose($myFile);
	
	echo "<html>";
	echo "<head>";
	echo "<link href='https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />";
	echo "<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/js/froala_editor.pkgd.min.js'></script>";
	echo "</head>";
	echo "<body>";
	echo "<form id='editForm' action='edit.php' method='post'>";
	echo "Username: <input type='text' name='username'>";
	echo "Password: <input type='password' name='password'>";
	echo "<input type='hidden' name='postNumber' value='" . $postId  . "'>";
	echo "<textarea name='content' form='editForm'>" . $fileContents  . "</textarea>";
	echo "<input type='submit' name='submit'>";
	echo "</form>";
	echo "</body>";
	echo "</html>";
}

?>