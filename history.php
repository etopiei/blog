<?php 
require("./getPost.php");
?>

<html>
	<?php require("./header.php"); ?>
		<div id="content">
			<div id="blog-text">
				<br>
				<div id="blog-text-offset">
						<center>
						<h4> Post History </h4>
						<?php printPostList();?>
						</center>
				</div>
			</div>
		</div>
	<?php require("./footer.php"); ?>
</html>