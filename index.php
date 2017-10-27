<?php 
require("./getPost.php");
$postId = $_GET['id'];
$postNumber = 0;
$postNumber = update($postId);
?>

<html>
	<head>
		<link href="main.css" rel="Stylesheet" type="text/css">
	</head>
	<body>
		<div id="top">
			<div id="header-text">
				<center>
					<h1> Blog Title </h1>
					<h3> blog subtitle </h3>
				</center>
			</div>
		</div>
		<div id="content">
			<div id="blog-text" class="shadow">
				<div id="blog-text-offset">
					<?php 
					getPost($postNumber);
					?>
				</div>
			</div>
		</div>
		<div id="bottom">
			<center>
				<p>Social Media Links Here</p>
			</center>
		</div>
	</body>
</html>