<?php
try {
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=cms;port=8889', 'root', 'root');
} catch (PDOException $e) {
	exit('Database error.');
}
?>