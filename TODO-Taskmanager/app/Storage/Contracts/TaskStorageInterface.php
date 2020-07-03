<?php

namespace Todo\Storage\Contracts;

use Todo\Models\Task;

interface TaskStorageInterface
{
	public function store(Task $task);
	public function update(Task $task);
	public function delete(int $taskId);
	public function get($id);
	public function getAll();
}