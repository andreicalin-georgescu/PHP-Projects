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

header('Location: /index.php');
