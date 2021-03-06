<?php

namespace CMS\Includes;
use PDO;

class Connection
{
	protected $conn;

	public function __construct()
	{
		try {
		$this->conn = new PDO('mysql:host=127.0.0.1;dbname=cms;port=8889', 'root', 'root');
		} catch (PDOException $e) {
			exit('Database error.');
		}
	}

	public function getConnection() {
		return $this->conn;
	}
}
