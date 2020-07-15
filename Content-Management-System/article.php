<?
	require_once 'includes/connection.php';
	require_once 'includes/article.php';

$article = new Article;

if (!isset($_GET['id'])) {
	header('Location: index.php');
	die('No Article id specified. Redirecting to index...');
}

$id = $_GET['id'];
$data = $article->fetchData($id);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo"> CMS </a>
			<h4> <?echo $data['article_title'];?> -
			<small>
				<?php echo $data['article_timestamp'];?>
			</small>
			</h4>

			<p>
				<?php echo $data['article_content'];?>
			</p>

			<a href="index.php">&larr;Back</a>
		</div>

	</body>
</html>