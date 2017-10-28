<?php 
require("./getPost.php");
$postId = $_GET['id'];
$postNumber = 0;
$postNumber = update($postId);
?>

<html>
	<head>
		<link href="main.css" rel="Stylesheet" type="text/css">
		<script src="https://use.fontawesome.com/9afece952d.js"></script>
	</head>
	<body>
		<div id="top">
			<div id="header-text">
				<center>
					<h1> Blog Title - Blog Subtitle </h1>
					<h3><a href="history.php">Post History</a></h3>
				</center>
			</div>
		</div>
		<div id="content">
			<div id="blog-text" class="shadow">
			<?php getNavButtons($postNumber); ?>
				<div id="blog-text-offset">
					<?php 
					getPost($postNumber);
					?>
				</div>
			</div>
		</div>
		<div id="bottom">
			<center>
				<a href="GITHUB_LINK"><i class="fa fa-github"></i></a>
				<a href="LINKEDIN_LINK"><i class="fa fa-linkedin"></i></a>
				<a href="INSTAGRAM_LINK"><i class="fa fa-instagram"></i></a>
				<a href="REDDIT_LINK"><i class="fa fa-reddit"></i></a>
				<a href="TWITTER_LINK"><i class="fa fa-twitter"></i></a>
			</center>
		</div>
	</body>
</html>