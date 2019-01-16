<?php
/**
 * Created by PhpStorm.
 * User: chongieball
 * Date: 16/01/19
 * Time: 22.29
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
date_default_timezone_set('Asia/Jakarta');

require __DIR__ .'/../app/bootstrap.php';

$app->run();