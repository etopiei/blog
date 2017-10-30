<html>
	<head>
		<link rel="Stylesheet" href="main.css" type="text/css">
		<script src="https://use.fontawesome.com/9afece952d.js"></script>
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
			<div id="blog-text">
				<div id="upload-area">
					<center>
						<form id="uploadForm" action="upload.php" method="post">
							Username: <input class="formElem" type="text" name="username"></input><br>
							Password: <input class="formElem" type="password" name="password"></input><br>
							Title: <input class="formElem" type="text" name="title"></input><br><br>
							New Post: <br><textarea name="blog-post" id="new-blog" class="formElem" form="uploadForm"></textarea><br>
							<input class="formElem" type="submit" name="submit"></input>
						</form>
					</center>
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