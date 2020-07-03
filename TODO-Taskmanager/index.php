<?php

require 'vendor/autoload.php';

use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\MySqlDatabaseTaskStorage;
use Todo\Config\dbConfig;

$dbConnection = DbConfig::getInstance()->getConnection();

$storage = new MySqlDatabaseTaskStorage($dbConnection);
$manager = new TaskManager($storage);
