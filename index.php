<?php 
require("./constants.php");
require("./getPost.php");
$postNumber = 0;
if (isset($_GET['id'])) {
	$postNumber = update($_GET['id']);
}
?>
<html>
	<?php require("./header.php"); ?>
		<div id="content">
			<div id="blog-text">
				<div id="blog-text-offset">
					<?php 
					if (preg_match('/post\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
						echo getPost($matches[1]);
						$postNumber = $matches[1];
					} else {
						$postNumber = getNumberOfPosts();
						header('Location: ' . $base . '/post/' . $postNumber);
						exit();
					}
					?>
				</div>
				<?php 
					getNavButtons($postNumber);
					if ($comments_enabled) {
						echo '
						<script src="https://utteranc.es/client.js"
						repo="' . $repo_ref . '"
						issue-term="' . getPostTitle($postNumber) . '"
						theme="github-dark"
						crossorigin="anonymous"
						async>
						</script>';
					}
				?>
				<center>
					<h3><a href="<?php echo $base; ?>/history.php">Post History</a></h3>
				</center>
			</div>
		</div>
	<?php require("./footer.php"); ?>
</html>
