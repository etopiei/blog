<?php
$username = $_POST['username'];
$password = $_POST['password'];
$blogPost = $_POST['blog-post'];
$title = $_POST['title'];

$BLOG_PASSWORD="";
$BLOG_USERNAME="";

if ($password !== $BLOG_PASSWORD || $username !== $BLOG_USERNAME) {
	//user is bogus, kick them out.
	header("Location: /index.php");
	exit();
}

//get new filename
$directory = "./posts/";
$fileCount = 0;
$files = glob($directory . "*");
if($files) {
	$fileCount = count($files);
}
$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$fileCount" . ".post";
$fileCount += 1;

//update meradata
$metaName = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "metadata.post";
$metaFile = fopen($metaName, "r");
$metaContents = fread($metaFile, filesize($metaName));
$metaContents = $metaContents . "\n" . "$fileCount" . " " . "$title";
fclose($metaFile);

$writeMeta = fopen($metaName, "w");
fwrite($writeMeta, $metaContents);
fclose($writeMeta);

//now write blog post to file
$myFile = fopen($filename, "w") or die ("Failed to write blog post to file.");
fwrite($myFile, $blogPost);
fclose($myFile);

echo "New Blog Post Added. <a href='/'> Click here to return home </a>";

?>