<?php

require 'vendor/autoload.php';

use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\MySqlDatabaseTaskStorage;
use Todo\Config\dbConfig;

$dbConnection = dbConfig::getInstance()->getConnection();

$storage = new MySqlDatabaseTaskStorage($dbConnection);
$manager = new TaskManager($storage);

var_dump($dbConnection);

