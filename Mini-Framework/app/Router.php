<?php

namespace App;

class Router
{
	// Stored routes

	protected $routes = [];
	protected $path;

	public function setPath($path = '/')
	{
		$this->path = $path;
	}

	public function addRoute($uri, $handler)
	{
		$this->routes[$uri] = $handler;
	}

	public function getResponse()
	{
		return $this->routes[$this->path];
	}
}
