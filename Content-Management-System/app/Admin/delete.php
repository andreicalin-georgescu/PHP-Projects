<?php

	require '../../vendor/autoload.php';

	use \CMS\CMS;
	use CMS\Includes\Models\Article;

	session_start();

	$CMS = CMS::getInstance();

	if (!isset($_SESSION['logged_in'])) {
		header('Refresh:5; url=index.php', true, 303);
		echo 'You are not logged in. Redirecting to login page...';
		exit();
	}

	$articles = $CMS->getAllArticles();

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$CMS->deleteArticle($id);

		header('Location: delete.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="../Assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="../../index.php" id="logo"> CMS </a>
			<br>
			<h4>Select an Article to Delete:</h4>

			<form action="delete.php" method="get">
				<select onchange="this.form.submit();" name="id">
					<?php foreach ($articles as $article) {?>
						<option value="<?php echo $article->getId();?>">
							<?php echo $article->getTitle();?>
						</option>
					<?php }?>
				</select>
			</form>
			<br>
			<small><a href="index.php">&larr;Back</a></small>
		</div>
	</body>
</html>