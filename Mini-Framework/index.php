<?php

require 'vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

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

$app->get('/', function () {
	echo 'Home';
});

$app->post('/signup', function () {
	echo 'Sign Up';
});

$app->map('/users', function () {
	echo 'Users';
}, ['GET', 'POST']);

$app->run();