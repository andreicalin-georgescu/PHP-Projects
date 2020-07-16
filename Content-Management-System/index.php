<?php
	use \CMS\Includes\Article;
	use \CMS\Includes\Connection;

	require 'vendor/autoload.php';

	$dbConnection = new Connection;
	$pdo = $dbConnection->getConnection();

	$article = new Article($pdo);
	$articles = $article->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="app/assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo"> CMS </a>

			<ol>
				<?php
				foreach ($articles as $article) {?>
					<li>
						<a href="app/article.php?id=<?php echo $article['article_id'];?>">
							<?php echo $article['article_title'];?>
						</a>
						- <small> posted <?php echo $article['article_timestamp']; ?></small>
					</li>
				<?php } ?>
			</ol>
			<br>
			<small><a href="app/Admin/index.php">admin</a></small>
		</div>

	</body>
</html>