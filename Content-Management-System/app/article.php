<?

require '../vendor/autoload.php';

use CMS\Includes\Models\Article;
use CMS\CMS;

$CMS = CMS::getInstance();

if (!isset($_GET['id'])) {
	header('Location: index.php');
	die('No Article id specified. Redirecting to index...');
}

$id = $_GET['id'];
$data = $CMS->getArticle($id);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS Mockup</title>
		<link rel="stylesheet" type="text/css" href="Assets/style.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo"> CMS </a>
			<h4> <?echo $data->getTitle();?> -
			<small>
				<?php echo $data->getTime()->diffForHumans();?>
			</small>
			</h4>

			<p>
				<?php echo $data->getContent();?>
			</p>

			<a href="/index.php">&larr;Back</a>
		</div>

	</body>
</html>