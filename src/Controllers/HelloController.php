<?php
/**
 * Created by PhpStorm.
 * User: chongieball
 * Date: 16/01/19
 * Time: 23.05
 */

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class HelloController extends BaseController
{

    public function hello(Request $req, Response $res)
    {
        return $this->responseDetail("Hello", 200, "Hello");
    }
}