<?php

namespace App;

/*
 * Implements a template for responding
 * to certain user interactions
 */

class Response
{
	protected $body;

	// The HTTP status code - by default, presumed the page loaded successfully

	protected $statusCode = 200;

	// Array to store the used headers for a given path

	protected $headers = [];

	/*
	 * Sets the body of a response object to a string so it can be echo'ed later
	 * @param {string}		response	The response that needs to be treated
	 * @return {Response} The current Response instance with the set body
	 */

	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	/*
	 * Getter for the body property of the class
	 * @return {string} The body of the current Response instance
	 */

	public function getBody()
	{
		return $this->body;
	}

	/*
	 * Sets the status code to a given value
	 * @param {int}		statusCode		The status code to be set
	 * @return {Response} The current Response instance with the set status code
	 */

	public function withStatus($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/*
	 * Getter for the statusCode property of the class
	 * @return {int} The current status code of the Response instance
	 */

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/*
	 * Delivers the response as JSON type content
	 * @param {string}		body 	The body that needs to be JSON encoded
	 * @return {Response} The current Response instance with the now JSON encoded body
	 */

	public function withJson($body)
	{
		$this->withHeader('Content-Type', 'application/json');
		$this->body = json_encode($body);

		return $this;
	}

	/*
	 * Adds a header to the array of stored headers
	 * @param {string}		name 	The name of the header to be added
	 * @param {string}		value 	The value of the header to be added
	 * @return {Response} The current Response instance with the added header
	 */

	public function withHeader($name, $value)
	{
		$this->headers[] = [$name, $value];
		return $this;
	}

	/*
	 * Returns the list of stored headers
	 * @return {array} An array of the currently stored headers for the Response instance
	 */

	public function getHeaders()
	{
		return $this->headers;
	}
}

