<?php

require 'vendor/autoload.php';

$client = new GuzzleHttp\Client;

if (!isset($_GET['to']) || !isset($_GET['value']) || !isset($_GET['from'])) {
	echo "Did not specify correct parameters. Will redirect to previous page.";
	header('index.php');
}

$response = $client->request('GET', 'https://api.exchangeratesapi.io/latest', [
	'query' => [
		'base' => $_GET['from'],
		'symbols' => $_GET['to']
	]
]);

$result = json_decode($response->getBody());

$converted = number_format($result->rates->{$_GET['to']} * $_GET['value'], 2);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Currency conversion</title>
	</head>
	<body>
		<?php echo htmlspecialchars($_GET['value'], ENT_QUOTES, 'UTF-8'); ?>
		<?php echo htmlspecialchars($_GET['from'], ENT_QUOTES, 'UTF-8'); ?> is
		<?php echo $converted; ?>
		<?php echo htmlspecialchars($_GET['to'], ENT_QUOTES, 'UTF-8'); ?>

	</body>
</html>