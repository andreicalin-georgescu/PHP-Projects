<?php

/*
 * Wrapper class to abstract the operations
 * Uses singleton pattern to ensure a single,
 * application-wide task manager
 */

namespace Todo;

use Todo\Models\Task;
use Todo\Config\dbConfig;
use Todo\Storage\Contracts\TaskStorageInterface;
use Todo\Storage\MySqlDatabaseTaskStorage;

class TaskManager
{
	private static $instance = NULL;
	protected $storage;

	private function __construct()
	{
		$dbConnection = DbConfig::getInstance()->getConnection();
		$this->storage = new MySqlDatabaseTaskStorage($dbConnection);
	}

	/* Return the manager instance regardless
	 * of calling class
	 */
	
	public static function getInstance() 
	{
		if (self::$instance === NULL) {
			self::$instance = new TaskManager();
		}

		return self::$instance;
	}

	public function addTask(Task $task)
	{
		return $this->storage->store($task);
	}

	public function updateTask(Task $task)
	{
		return $this->storage->update($task);
	}

	public function deleteTask(int $taskId)
	{
		return $this->storage->delete($taskId);
	}

	public function getTask($id)
	{
		return $this->storage->get($id);
	}

	public function getAllTasks()
	{
		return $this->storage->getAll();
	}
}
