<?php

require 'vendor/autoload.php';

use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\MySqlDatabaseTaskStorage;
use Todo\Config\dbConfig;

$dbConnection = DbConfig::getInstance()->getConnection();

$storage = new MySqlDatabaseTaskStorage($dbConnection);
$manager = new TaskManager($storage);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Task Planner</title>
	</head>
	<body>
		<form action="" method="post">
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
				<input formaction="" method="post" type="submit" name="updateTask" value="Update existing task"><br>
			</div>
			
		</form>
		<br>
		<form action="" method="post">
			<div>
				<label for="taskId">Task ID:</label><br>
				<input type="number" id="taskId" name="taskId"><br>
			</div>
			<div class="button">
				<input type="submit" name="submitButton" value="Find task with this ID">
				<input type="submit" name="submitButton" value="Delete task with this ID">
			</div>
		</form>
		<br>
		<button class="button" name="getAll" value="getAll">Get all tasks</button><br>
	</body>
</html>
