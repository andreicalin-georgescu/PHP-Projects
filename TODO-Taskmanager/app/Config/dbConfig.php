<?php

/*
 * Singleton class to manage the connection to the database
 * so as to prevent eventual data concurrency issues
 */

namespace Todo\Config;

use PDO;

class dbConfig {
	private static $instance = NULL;

	private $driver;
	private $host;
	private $dbname;
	private $port;
	private $username;
	private $password;

	/*
	 * Constructor uses external configuration file
	 * for further ease of updating
	 */

	private function __construct() {
		$config = require_once('conf.php');

		$this->driver = $config['driver'];
		$this->host = $config['host'];
		$this->dbname = $config['dbname'];
		$this->port = $config['port'];
		$this->username = $config['username'];
		$this->password = $config['password'];

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
