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

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$data = $article->fetchData($id);
	}

	if (isset($_POST['title']) || isset($_POST['content'])) {
		if (empty($title) && empty($content)) {
			$error = 'At least one field is required!';
		}

		$title = $data['article_title'];
		$content = $data['article_content'];

		if (!empty($_POST['title'])) {
			$title = htmlspecialchars($_POST['title']);
		}

		if (!empty($_POST['content'])) {
			$content = htmlspecialchars($_POST['content']);
		}

		$new_date = date('Y-m-d h:i:s');

		// Update the new fields, otherwise leave old ones

		$statement = $pdo->prepare("
			UPDATE articles
			SET
				article_title = :article_title,
				article_content = :article_content,
				article_timestamp = :article_timestamp
			WHERE article_id = :article_id
		");

		$statement->execute([
			'article_title' => $title,
			'article_content' => $content,
			'article_timestamp' => $new_date,
			'article_id' => $id
		]);

		header('Location: updateSelect.php');
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
			<h4>Select an Article to Update:</h4>

			<form action="updateArticle.php" method="get">
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