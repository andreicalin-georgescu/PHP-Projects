<?php

require 'vendor/autoload.php';

use Todo\Models\Task;

$task = new Task;
$task->setDescription('Learn oop');
$task->setDue(new DateTime('+ 2 days'));
var_dump($task);