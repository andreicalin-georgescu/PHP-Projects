<?php

namespace Todo\Models;

use Carbon\Carbon;

class Task
{
	protected $id;
	protected $complete = false;
	protected $description;
	protected $due;

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setComplete($complete = true) {
		$this->complete = $complete;
	}

	public function getComplete() {
		return (bool)$this->complete;
	}

	public function setDue(Carbon $due) {
		$this->due = $due;
	}

	public function getDue() {
		if (!$this->due instanceof Carbon) {
			return new Carbon($this->due);
		}
		return $this->due;
	}

	public function getId() {
		return $this->id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}
}
