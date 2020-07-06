<?php

namespace Todo\Interact;
require '../../vendor/autoload.php';

use Todo\Models\Task;
use Todo\TaskManager;

$manager = TaskManager::getInstance();

if (!isset($_POST['taskId'])) {
	return false;
}

if (empty($_POST['taskId'])) {
	header('Refresh:5; url=http://localhost:8888/index.php', true, 303);
	echo 'No id specified. Redirecting to Home...';
	die();
}

$task = $manager->getTask($_POST['taskId']);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>GetTask</title>
	</head>
	<body>
		<table>
		<tr>
			<th> ID </th>
			<th> Description </th>
			<th> Due Date </th>
			<th> Status </th>
		</tr>
		<tr>
			<td> <?php echo ($task) ? $task->getId() : '0'; ?></td>
			<td> <?php echo ($task) ? $task->getDescription() : 'none'; ?></td>
			<td> <?php echo ($task) ? $task->getDue()->format('Y-m-d H:i:s') : date('Y-m-d'); ?></td>
			<td> <?php echo ($task->getComplete()) ? 'Complete' : 'Due'; ?></td>
		</tr>
		</table>
		<br>
		<form action="/app/Interact/UpdateTask.php" method="post" autocomplete="off">
			<div class="taskDescr">
					<label for="taskDescription">Task Description:</label><br>
					<input type="text" id="taskDescription" name="taskDescription"><br>
				</div>
				<div class="taskDue">
					<label for="taskDue">Task Due Date:</label><br>
					<input type="datetime-local" id="taskDue" name="taskDue"><br>
				</div>
				<br>
				<div class="taskComplete">
					<p>Task Complete?</p>
					<div>
						<input type="radio" id="taskComplete" name="taskComplete" value="Complete">
						<label for="Complete">Complete</label>
					</div>
					<div>
						<input type="radio" id="taskNotComplete" name="taskComplete" value="Due" checked>
						<label for="NotComplete">Due</label>
					</div>
				</div>
				<div class="button">
					<input type="submit" name="updateTask" value="Update the task">
					<input type="submit" name="deleteTask" formaction="/app/Interact/DeleteTask.php" value="Delete the task"><br>
					<input type="submit" name="goIndex" formaction="/index.php" value="Go to Home">
					<input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
				</div>
		</form>
	</body>
</html>
