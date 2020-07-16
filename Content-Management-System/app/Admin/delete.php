<?php
	use \CMS\Includes\Article;
	use \CMS\Includes\Connection;

	require '../../vendor/autoload.php';

	session_start();

	$dbConnection = new Connection;
	$pdo = $dbConnection->getConnection();

	$article = new Article($pdo);


	if (!isset($_SESSION['logged_in'])) {
		header('Refresh:5; url=index.php', true, 303);
		echo 'You are not logged in. Redirecting to login page...';
		exit();
	}

	$articles = $article->fetchAll();

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$statement = $pdo->prepare("
			DELETE FROM articles
			WHERE article_id = :article_id
		");

		$statement->execute([
			'article_id' => $id
		]);

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
						<option value="<?php echo $article['article_id'];?>">
							<?php echo $article['article_title'];?>
						</option>
					<?php }?>
				</select>
			</form>
			<br>
			<small><a href="index.php">&larr;Back</a></small>
		</div>
	</body>
</html>