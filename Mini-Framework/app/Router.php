<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotAllowedException;

/*
 * Translates certain URIs into readable pages
 */

class Router
{
	// Stored routes

	protected $routes = [];

	// The known methods for the stored path

	protected $methods = [];
	protected $path;

	/*
	 * Sets the current path to specified string
	 * @param {string}		path		The desired path
	 */

	public function setPath($path = '/')
	{
		$this->path = $path;
	}

	/*
	 * Adds new entry to list of known routes
	 * @param {string}		uri			Specifies the URI value
	 * @param {string}		handler 	The action intended when arriving at the specified URI
	 * @param {array}		methods 	The accepted methods
	 */

	public function addRoute($uri, $handler, array $methods = ['GET'])
	{
		$this->routes[$uri] = $handler;
		$this->methods[$uri] = $methods;
	}

	/*
	 * Returns the appropiate response for the stored path
	 */

	public function getResponse()
	{
		// Check if the route is valid

		if (!isset($this->routes[$this->path])) {
			throw new RouteNotFoundException('No route registered for' . $this->path);
		}

		// Check if the current request method is not in the array of the current route

		if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
			throw new MethodNotAllowedException;
		}
		return $this->routes[$this->path];
	}
}
