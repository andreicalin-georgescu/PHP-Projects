<?php

namespace Todo\Interact;

require '../../vendor/autoload.php';

use Todo\TaskManager;
use Todo\Task;

$manager = TaskManager::getInstance();

$tasks = $manager->getAllTasks();

foreach ($tasks as $task) {
	echo "<table>
		<tr>
			<th> ID </th>
			<th> Description </th>
			<th> Due Date </th>
			<th> Status </th>
		</tr>";

	echo "<tr><td>" , $task->getId() , "</td>";
	echo "<td>" , $task->getDescription() , "</td>"; 
	echo "<td>" , $task->getDue()->format('Y-m-d H:i:s') , "</td>"; 
	echo "<td>" , ($task->getComplete()) ? 'Complete' : 'Due' , "</td></tr></table>"; 		
} ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>GetAll</title>
	</head>
	<body>
		<form action="/index.php" autocomplete="off">
			<input type="submit" name="goIndex" value="Go to Home">
		</form>

	</body>
</html>