<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotAllowedException;

class App
{
	protected $container;

	/*
	 * App constructor
	 * Creates a new container and adds the router to it
	 */

	public function __construct()
	{
		$this->container = new Container([
			'router' =>function () {
				return new Router;
			}
		]);
	}

	/*
	 * Return the current App's container
	 */

	public function getContainer()
	{
		return $this->container;
	}

	/*
	 * Get method to satisfy GET HTTP requests
	 * @param {string}		uri			Specifies the URI value
	 * @param {string}		handler 	The action intended when arriving at the specified URI
	 */

	public function get($uri, $handler)
	{
		$this->container->router->addRoute($uri, $handler, ['GET']);
	}

	/*
	 * Post method to satisfy POST HTTP requests
	 * @param {string}		uri			Specifies the URI value
	 * @param {string}		handler 	The action intended when arriving at the specified URI
	 */

	public function post($uri, $handler)
	{
		$this->container->router->addRoute($uri, $handler, ['POST']);
	}

	/*
	 * Map method to satisfy an array of supported HTTP requests
	 * @param {string}		uri			Specifies the URI value
	 * @param {string}		handler 	The action intended when arriving at the specified URI
	 * @param {array}		methods 	The supported methods for the specified path
	 */

	public function map($uri, $handler, array $methods = ['GET'])
	{
		$this->container->router->addRoute($uri, $handler, $methods);
	}

	/*
	 * Function to execute the application
	 */

	public function run()
	{
		$router = $this->container->router;

		// If path is not set, set it to /

		$router->setPath($_SERVER['PATH_INFO'] ?? '/');

		try {
			$response = $router->getResponse();
		} catch (RouteNotFoundException $e) {

			// Use the error handler stored in the container

			if ($this->container->has('RouteNotFoundErrorHandler')) {
				$response = $this->container->RouteNotFoundErrorHandler;
			} else {

				// If none found, do nothing

				return;
			}
		} catch (MethodNotAllowedException $e) {
			if ($this->container->has('MethodNotAllowedErrorHandler')) {
				$response = $this->container->MethodNotAllowedErrorHandler;
			}
		}

		return $this->process($response);
	}

	// Runs the callable object (for now)

	protected function process($callable)
	{
		return $callable();
	}
}