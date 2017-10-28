<?php
$username = $_POST['username'];
$password = $_POST['password'];
$postId = $_POST['postNumber'];
$content = $_POST['content'];
$edited = isset($content);

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

$filename = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . "$postId" . ".post";

if($edited) {
	//update the file.
	$myFile = fopen($filename, "w");
	fwrite($myFile, $content);
	fclose($myFile);
} else {
	//allow editing the file
	$myFile = fopen($filename, "r");
	$fileContents = fread($myFile, filesize($filename));
	fclose($myFile);
	
	echo "<html>";
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