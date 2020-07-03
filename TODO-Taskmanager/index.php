<?php

require 'vendor/autoload.php';
use Todo\TaskManager;

$manager = TaskManager::getInstance();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Task Planner</title>
	</head>
	<body>
		<form action="app/Interact/SubmitTask.php" method="post" autocomplete="off">
			<div class="taskDescr">
				<label for="taskDescription">Task Description:</label><br>
				<input type="text" id="taskDescription" name="taskDescription"><br>
			</div>
			<div class="taskDue">
				<label for="taskDue">Task Due Date:</label><br>
				<input type="datetime-local" id="taskDue" name="taskDue"><br>
			</div>
			<div class="button">
				<input type="submit" name="submitNewTask" value="Submit new task">
			</div>
			
		</form>
		<br>
		<form action="" method="post" autocomplete="off">
			<div>
				<label for="taskId">Task ID:</label><br>
				<input type="number" id="taskId" name="taskId"><br>
			</div>
			<div class="button">
				<input type="submit" name="submitButton" value="Find task with this ID">
				<input formaction="" method="post" type="submit" name="updateTask" value="Update task with this ID">
				<input type="submit" name="submitButton" value="Delete task with this ID">
			</div>
		</form>
		<br>
		<button class="button" name="getAll" value="getAll">Get all tasks</button><br>
	</body>
</html>
