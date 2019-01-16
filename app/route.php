<?php  

$namespace = 'App\Controllers';

$app->get('/', $namespace.'\HelloController:hello')->setName('api.hello');
