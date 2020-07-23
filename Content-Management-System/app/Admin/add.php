<?php

	require '../../vendor/autoload.php';

	use \CMS\CMS;
	use Carbon\Carbon;
	use CMS\Includes\Models\Article;

	session_start();

	$CMS = CMS::getInstance();

	if (!isset($_SESSION['logged_in'])) {
		header('Location: index.php');
	}

	if (isset($_POST['title'], $_POST['content'])) {
		$title = htmlspecialchars($_POST['title']);
		$content = nl2br(htmlspecialchars($_POST['content']));

		if (empty($title) || empty($content)) {
			$error = 'All fields are required!';
		} else {
			$newArticle = new Article;
			$newArticle->setTitle($title);
			$newArticle->setContent($content);

			$date = Carbon::now();
			$newArticle->setTime($date);

			$CMS->addArticle($newArticle);

			header('Location: index.php');
		}
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
			<h4>Add Article</h4>

			<?php  if(isset($error)) {?>
					<small style="color: #aa0000;">
						<?php echo $error;?>
					</small>
					<br><br>

			<?php }?>

			<form action="add.php" method="post" autocomplete="off">
				<input type="text" name="title" placeholder="Title"><br><br>
				<textarea rows="15" cols="50" name="content" placeholder="Content"></textarea><br><br>
				<input type="submit" value="Add Article">
			</form>
			<br>
			<small><a href="index.php">&larr;Back</a></small>
		</div>

	</body>
</html>