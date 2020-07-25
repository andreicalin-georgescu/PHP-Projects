<?php

namespace App;

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
		$this->container->router->addRoute($uri, $handler);
	}

	public function run()
	{
		$router = $this->container->router;

		// If path is not set, set it to /

		$router->setPath($_SERVER['PATH_INFO'] ?? '/');

		$response = $router->getResponse();

		return $this->process($response);
	}

	// Runs the callable object (for now)

	protected function process($callable)
	{
		return $callable();
	}
}