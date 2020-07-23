<?php
	use CMS\CMS;

	require 'vendor/autoload.php';

	$CMS = CMS::getInstance();

	$articles = $CMS->getAllArticles();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="app/Assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo"> CMS </a>

			<ol>
				<?php
				foreach ($articles as $article) {?>
					<li>
						<a href="app/article.php?id=<?php echo $article->getId();?>">
							<?php echo $article->getTitle();?>
						</a>
						- <small> posted <?php echo $article->getTime()->diffForHumans(); ?></small>
					</li>
				<?php } ?>
			</ol>
			<br>
			<small><a href="app/Admin/index.php">admin</a></small>
		</div>
	</body>
</html>