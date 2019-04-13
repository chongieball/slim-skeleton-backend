<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Slim\Container;
use Valitron\Validator;

$container = $app->getContainer();

$container['db'] = function (Container $container) {
	$setting = $container->get('settings');

	$config = new Configuration();

	$connect = DriverManager::getConnection($setting['db'],
		$config);

	return $connect;
};

$container['validator'] = function (Container $container) {
	$setting = $container->get('settings')['lang']['default'];
	$params = $container['request']->getParams();

	return new Validator($params, [], $setting);
};

$container['logger'] = function(Container $container) {
    $logger = new \Monolog\Logger('my_logger');
    return $logger;
};