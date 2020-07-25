<?php

namespace App\Controllers;

/*
 * Controller class that interacts with the home page
 */

class HomeController
{
	public function index($response)
	{
		return $response->setBody('Home');
	}
}
