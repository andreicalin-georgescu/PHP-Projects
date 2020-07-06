<?php

namespace Todo\Interact;

require '../../vendor/autoload.php';

use DateTime;
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
	$dueDate = new DateTime();
	$timestamp = strtotime($_POST['taskDue']);
	$dueDate->setTimestamp($timestamp);
} else {
	$dueDate = new DateTime($manager->getTask($task->getId())->getDue()->format('Y-m-d H:i:s'));
}

if (!isset($_POST['taskDescription']))
{
	return false;
}

if (!empty($_POST['taskDescription'])) {
	// Escape the description field

	$description = htmlspecialchars($_POST['taskDescription']);
} else {
	$description = 'no description';
}

if (isset($_POST['taskComplete'])) {
	($_POST['taskComplete'] === 'Complete') ? $task->setComplete(1) : $task->setComplete(0);
	
}

$task->setDescription($description);
$task->setDue($dueDate);

$manager->updateTask($task);

header ('Location: /index.php');
