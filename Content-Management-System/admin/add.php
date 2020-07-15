<?php
	session_start();
	require_once '../includes/connection.php';

	if (!isset($_SESSION['logged_in'])) {
		header('Location: index.php');
	}

	if (isset($_POST['title'], $_POST['content'])) {
		$title = htmlspecialchars($_POST['title']);
		$content = nl2br(htmlspecialchars($_POST['content']));

		if (empty($title) || empty($content)) {
			$error = 'All fields are required!';
		} else {
			$statement = $pdo->prepare("
				INSERT INTO articles(article_title, article_content, article_timestamp)
				VALUES (:article_title, :article_content, :article_timestamp)
			");

			$date = date('Y-m-d h:i:s');

			$statement->execute([
				'article_title' => $title,
				'article_content' => $content,
				'article_timestamp' => $date
			]);

			header('Location: index.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">

	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo"> CMS </a>
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