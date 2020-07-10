<?php

namespace Todo\Interact;

require '../../vendor/autoload.php';

use Carbon\Carbon;
use Todo\Models\Task;
use Todo\TaskManager;

$manager = TaskManager::getInstance();

if (!isset($_POST['taskDue'])) {
	return false;
}

$timestamp = strtotime($_POST['taskDue']);
$dueDate = Carbon::createFromTimeStamp($timestamp);

if (!isset($_POST['taskDescription'])) {
	return false;
}

// Escape the description field

$description = htmlspecialchars($_POST['taskDescription']);
	
$task = new Task();
$task->setDescription($description);
$task->setDue($dueDate);

$manager->addTask($task);

// Redirect to main page

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>SubmitTask</title>
	</head>
	<body>
		<form id="getAllHiddenForm" action="/index.php" method="post">
			<input type="hidden" name="getAll" value="Get All Tasks">
			<input type="submit" name="submission_button" value="Click here if the site is taking too long to redirect!">
		</form>
		<script type="text/javascript">
			function submitForm() {
				document.getElementById('getAllHiddenForm').submit();
			}

			// Call function as soon as SubmitTask loads

			window.onload = submitForm();
		</script>
	</body>
</html>
