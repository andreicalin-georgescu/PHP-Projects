<?php

require 'vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['RouteNotFoundErrorHandler'] = function () {
	// update to respond with a status code using responses
	die('404: No route found');
};

$container['MethodNotAllowedErrorHandler'] = function () {
	// update to respond with a status code using responses
	die('This method is not allowed');
};

$container['config'] = function () {
	return [
		'db_driver' => 'mysql',
		'host' => '127.0.0.1',
		'db_name' => 'project',
		'port' => '8889',
		'db_user' => 'root',
		'db_pass' => 'root'
	];
};

$container['db'] = function ($c) {
	return new PDO(
		$c->config['db_driver'] . ':host=' . $c->config['host'] .';dbname=' . $c->config['db_name'] .';port=' . $c->config['port'],
		$c->config['db_user'],
		$c->config['db_pass']
	);
};

$app->get('/', [App\Controllers\HomeController::class, 'index']);

$app->run();
