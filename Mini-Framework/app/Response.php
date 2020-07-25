<?php

namespace App;

class Response
{
	protected $body;

	/*
	 * Sets the body of a response object to a string so it can be echo'ed later
	 * @param {string}		response	The response that needs to be treated
	 * return {Response} The current Response instance with the set body
	 */

	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	/*
	 * Getter for the body property of the class
	 * return {string} The body of the current Response instance
	 */

	public function getBody()
	{
		return $this->body;
	}
}
