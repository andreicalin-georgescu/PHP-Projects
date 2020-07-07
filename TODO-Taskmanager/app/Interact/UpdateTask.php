<?php

namespace Todo\Interact;

require '../../vendor/autoload.php';

use Carbon\Carbon;
use Todo\TaskManager;
use Todo\Models\Task;

$manager = TaskManager::getInstance();

$task = new Task();

if (isset($_POST['taskId'])) {
	$task->setId($_POST['taskId']);
}

if (!isset($_POST['taskDue'])) 
{
	return false;
}

if (!empty($_POST['taskDue'])) {
	$timestamp = strtotime($_POST['taskDue']);
	$dueDate = Carbon::createFromTimeStamp($timestamp);
} else {
	$dueDate = new Carbon($manager->getTask($task->getId())->getDue()->toDateTimeString());
}

if (!isset($_POST['taskDescription'])) {
	return false;
}

if (!empty($_POST['taskDescription'])) {

	// Escape the description field

	$description = htmlspecialchars($_POST['taskDescription']);
} else {
	$description = $manager->getTask($task->getId())->getDescription();
}

if (isset($_POST['taskComplete'])) {
	($_POST['taskComplete'] === 'Complete') ? $task->setComplete(1) : $task->setComplete(0);
}

$task->setDescription($description);
$task->setDue($dueDate);

$manager->updateTask($task);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>UpdateTask</title>
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

			// Call function as soon as UpdateTask loads

			window.onload = submitForm();
		</script>
	</body>
</html>
