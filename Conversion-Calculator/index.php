<!-- Based on PHP Essentials Course on https://codecourse.com -->
<!-- used: https://exchangeratesapi.io currency converter API & Guzzle-->

<?php
$currencies = require 'config/currencies.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Currency conversion</title>
	</head>
	<body>
		<form action="convert.php" method="get">
			<input type="text" name="value" id="value">

			<select name="from" id="from">
				<?php foreach ($currencies as $currency): ?>
					<option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
				<?php endforeach; ?>
			</select>
			to
			<select name="to" id="to">
				<?php foreach ($currencies as $currency): ?>
					<option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
				<?php endforeach; ?>
			</select>

			<button type="submit">Convert</button>
		</form>
	</body>
</html>
