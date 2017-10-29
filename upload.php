<?php
$username = $_POST['username'];
$password = $_POST['password'];
$blogPost = $_POST['blog-post'];
$title = $_POST['title'];

$database="DATABASE_NAME";
$host = "HOSTNAME";
$databaseUsername = "DATABASE_USERNAME";
$databasePassword = "DATABASE_PASSWORD";

//connect to database

$link = mysqli_connect($host, $databaseUsername, $databasePassword, $database);

/* check connection */

if (mysqli_connect_errno()) {
	//mysql didn't connect properly reload register page with error message
    header('Location: /index.php');
    exit();
}

/* activate reporting */

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT;

try {

	$stmt = $link->prepare("SELECT HashedPassword, Salt FROM Login WHERE Username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($res, $res2);
	while($stmt->fetch()) {
		$hashedPassword = $res;
		$salt = $res2;
	}

	$fullPassword = $password.$salt;
	$fullPassword = openssl_digest($fullPassword, 'sha512');

	if ($fullPassword == $hashedPassword) {

		//user has correct username
		//continue freely

	} else {

		//user is bogus, kick them out.
		header("Location: /index.php");
		exit();

	}

} catch(mysqli_sql_exception $e) {

  //An error occured logging in
  //Redirect user and rollback transaction

  if(isset($link)) {

    $link->rollback();

  }

  header('Location: /index.php');
  exit();

}

//get new filename
$directory = "./posts/";
$fileCount = 0;
$files = glob($directory . "*");
if($files) {
	$fileCount = count($files);
}
$fileCount += 1;
$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$fileCount" . ".post";

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

echo "New Blog Post Added.";

?>