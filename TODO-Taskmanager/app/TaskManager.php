<?php

namespace Todo;

use Todo\Models\Task;
use Todo\Storage\Contracts\TaskStorageInterface;

class TaskManager
{
	protected $storage;

	public function __construct(TaskStorageInterface $storage)
	{
		$this->storage = $storage;
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