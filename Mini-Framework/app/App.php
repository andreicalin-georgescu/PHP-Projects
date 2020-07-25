<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotAllowedException;

class App
{
	protected $container;

	/*
	 * App constructor
	 * Creates a new container and adds the router and response to it
	 */

	public function __construct()
	{
		$this->container = new Container([
			'router' =>function () {
				return new Router;
			},
			'response' => function () {
				return new Response;
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
	 * Method to execute the application
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

		return $this->respond($this->process($response));
	}

	/*
	 * Method to run a response received as callable
	 * @param {}		callable		The object intended to be executed
	 * @return {string} The result obtained after running the callable object
	 */

	protected function process($callable)
	{
		$response = $this->container->response;

		// Check if callable is array (presume it is a controller)

		if (is_array($callable)) {

			// If the first method from callable array is not an object
			// instantiate it

			if (!is_object($callable[0])) {
				$callable[0] = new $callable[0];
			}
			return call_user_func($callable, $response);
		}
		return $callable($response);
	}

	/*
	 * Checks the response and sets headers and takes additional steps
	 * @param {string, response_object}		response	The response that needs to be treated
	 * @return {string} The result obtained after running the callable object
	 */

	protected function respond($response)
	{
		// If the response is not a Response object, treat it as a string

		if (!$response instanceof Response) {
			echo $response;
			return;
		}

		// Set status code

		header(sprintf(
			'HTTP/%s %s %s',
			'1.1',
			$response->getStatusCode(),
			''
		));

		// Iterate through the headers and set them as individual headers

		foreach ($response->getHeaders() as $header) {
			header($header[0] . ': ' . $header[1]);
		}

		echo $response->getBody();
	}
}