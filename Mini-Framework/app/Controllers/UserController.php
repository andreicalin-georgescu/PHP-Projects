<?php

namespace App\Controllers;

use PDO;
use App\Models\User;

/*
 * Controller class to interact with the /users page
 */

class UserController
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}
	public function index($response)
	{
		$statement = $this->db->prepare("
			SELECT *
			FROM users
		");

		$statement->execute();
		$users = $statement->fetchAll(PDO::FETCH_CLASS, User::class);
		return $response->withJson($users);

	}
}
