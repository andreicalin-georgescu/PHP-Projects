<?php

namespace Todo\Config;

use PDO;

class dbConfig {
	private static $instance = NULL;

	private $driver = 'mysql';
	private $host = '127.0.0.1';
	private $dbname = 'todo';
	private $port = '8889';
	private $username = 'root';
	private $password = 'root';

	private function __construct() {
		try {
		 	 $this->conn = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbname};port={$this->port}", "{$this->username}", "{$this->password}");
		 } catch (PDOException $e) {
		 	die('Something went wrong when connecting to the database.');
	 	}
	} 

	public static function getInstance() {
		if (self::$instance === NULL) {
			self::$instance = new dbConfig();
		}

		return self::$instance;
	}

	public function getConnection() {
		return $this->conn;
	}
}
