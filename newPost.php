<?php

$username = $_POST["username"];
$password = $_POST["password"];

$database="";
$host = "";
$databaseUsername = "";
$databasePassword = "";

//connect to database

$link = mysqli_connect($host, $databaseUsername, $databasePassword, $database);

/* check connection */

if (mysqli_connect_errno()) {
	//mysql didn't connect properly reload register page with error message
    header('Location: /index.html');
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
		header("Location: /index.html");
		exit();

	}

} catch(mysqli_sql_exception $e) {

  //An error occured logging in
  //Redirect user and rollback transaction

  if(isset($link)) {

    $link->rollback();

  }

  header('Location: /index.html');
  exit();

}

$content = $_POST["content"];
$title = $_POST["title"];

//open blogPosts.json and add the newest post.

$myfile = fopen("blogPosts.json", "r") or die("Unable to open file!");

$fileContents = "";

while(!feof($myfile)) {

	$buffer = fgets($myfile);

	if (strpos($buffer, ']') !== FALSE) {

		list($before, $after) = explode(']', $buffer);

		$fileContents = $fileContents.$before;
		$fileContents = $fileContents.', {"title":"'.$title.'", "contents":"'.$content.'"}]';
		$fileContents = $fileContents.$after;

	}
	else {

		$fileContents =  $fileContents.$buffer;

	}
}

fclose($myfile);

$editedFile = fopen("blogPosts.json", "w") or die("Unable to edit file!");
fwrite($editedFile, $fileContents);

echo "New Blog Post Added";

?>