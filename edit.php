<?php

$username = $_POST["username"];
$password = $_POST["password"];
$contents = $_POST["contents"];

if (isset($contents)) {
	$editingDone = true;
} else {
	$editingDone = false;
}

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

	if ($fullPassword === $hashedPassword) {

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

if ($editingDone === false) {

	$content = $_POST["content"];
	$title = $_POST["title"];

	//open blogPosts.json and retrieve the correct

	$myfile = fopen("blogPosts.json", "r") or die("Unable to open file!");

	$fileContents = "";

	while(!feof($myfile)) {

		$buffer = fgets($myfile);
		$fileContents .= $buffer;
	}

	fclose($myfile);

	$html = "<html>";
	$html .= "<body>";
	$html .= "<br><form id='submitForEdit' action='edit.php' method='post'>";
	$html .= "Username: <input type='text' name='username'>";
	$html .= "Password: <input type='text' name='password'>";
	$html .= "<br><textarea name='contents' form='submitForEdit'>";
	$html .= $fileContents;
	$html .= "</textarea>";
	$html .= "<input type='submit' value='Submit' name='submit'>";
	$html .= "</body>";
	$html .= "</html>";
	echo $html;

} else {

	$editedFile = fopen("blogPosts.json", "w") or die("Unable to edit file!");
	fwrite($editedFile, $contents);
	echo "Editing Succesfull.";

}

exit();

?>
