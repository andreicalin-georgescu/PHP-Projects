<?php

require 'vendor/autoload.php';

use Todo\Models\Task;
use Todo\Storage\MySqlDatabaseTaskStorage;

try {
 	 $db = new PDO('mysql:host=127.0.0.1;dbname=todo;port=8889', 'root', 'root');
 } catch (PDOException $e) {
 	die('Something went wrong when connecting to the database.');
 }

$storage = new MySqlDatabaseTaskStorage($db);
