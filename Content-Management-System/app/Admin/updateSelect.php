<?php
	use CMS\CMS;
	use Carbon\Carbon;
	use CMS\Includes\Models\Article;


	require '../../vendor/autoload.php';

	session_start();

	$CMS = CMS::getInstance();


	if (!isset($_SESSION['logged_in'])) {
		header('Refresh:5; url=index.php', true, 303);
		echo 'You are not logged in. Redirecting to login page...';
		exit();
	}

	$articles = $CMS->getAllArticles();

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$data = $CMS->getArticle($id);
	}

	if (isset($_POST['title']) || isset($_POST['content'])) {
		if (empty($title) && empty($content)) {
			$error = 'At least one field is required!';
		}

		$title = $data->getTitle();
		$content = $data->getContent();

		if (!empty($_POST['title'])) {
			$title = htmlspecialchars($_POST['title']);
		}

		if (!empty($_POST['content'])) {
			$content = htmlspecialchars($_POST['content']);
		}

		$new_date = Carbon::now();

		// Update the new fields, otherwise leave old ones

		$newArticle = new Article;

		$newArticle->setTitle($title);
		$newArticle->setContent($content);
		$newArticle->setTime($new_date);
		$newArticle->setId($id);

		$CMS->updateArticle($newArticle);

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