<?php 
require("./getPost.php");
$postNumber = 0;
if (isset($_GET['id'])) {
	$postNumber = update($_GET['id']);
}
?>

<html>
	<head>
		<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/main.css" rel="Stylesheet" type="text/css">
		<script src="https://use.fontawesome.com/9afece952d.js"></script>
	</head>
	<body>
		<div id="top">
			<div id="header-text">
				<center>
					<h1> Blog Title </h1>
					<h5> Blog Subtitle </h5>
				</center>
			</div>
		</div>
		<div id="content">
			<div id="blog-text">
				<div id="blog-text-offset">
					<?php 
					if (preg_match('/post\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
						getPost($matches[1]);
						$postNumber = $matches[1];
					} else {
						$postNumber = getNumberOfPosts();
						header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . '/post/' . $postNumber);
						exit();
					}
					?>
				</div>
				<?php getNavButtons($postNumber); ?>
				<center>
					<h3><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/history.php">Post History</a></h3>
				</center>
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
