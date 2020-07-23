<?php
	use CMS\CMS;

	require '../../vendor/autoload.php';

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
		$data = $CMS->getArticle($id);
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
			<h4>Update Article</h4>

			<h5>Updating Article: <?php echo $data->getTitle();?><br><br><small style="color: #aa0000;">At least one field is required!</small>
</h3>

			<form action="updateSelect.php" method="post" autocomplete="off">
				<input type="text" name="title" placeholder="New Title"><br><br>
				<textarea rows="15" cols="50" name="content" placeholder="New Content"></textarea><br><br>
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="submit" value="Update Article">
			</form>
			<br>
			<small><a href="index.php">&larr;Back</a></small>
		</div>
	</body>
</html>
