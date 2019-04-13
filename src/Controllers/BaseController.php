<?php
/**
 * Created by PhpStorm.
 * User: chongieball
 * Date: 16/01/19
 * Time: 22.30
 */

namespace App\Controllers;

use Slim\Container;


abstract class BaseController
{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    /**
     * Give Description About Response
     * @param  int|200    $status   HTTP status code
     * @param  string     $message
     * @param  array      $data     [description]
     * @param  array|null $meta     additional data
     * @return $this->response->withHeader('Content-type', 'application/json')->withJson($response, $response['status']);
     */
    protected function responseDetail($message, $status = 200, $data = null, array $meta = null, $isNumericCheck = false)
    {
        if ($status < 400 && empty($data)) {
            $status = 204;
            $message = "No Data";
        }

        $response = [
            'httpcode'	=> $status,
            'message'	=> $message,
            'data'		=> $data,
            'meta'		=> $meta,
        ];

        if (is_null($data) && is_null($meta)) {
            array_pop($response);
        } elseif (!$meta) {
            array_pop($response);
        }

        if (!$isNumericCheck) {
            return $this->response->withHeader('Content-type', 'application/json')->withJson($response, $response['httpcode']);
        } else {
            return $this->response->withHeader('Content-type', 'application/json')->withJson($response, $response['httpcode'], JSON_NUMERIC_CHECK);
        }

    }

    protected function responseDetailJsonNumeric($message, $status = 200, $data = null, array $meta = null) {
        return $this->responseDetail($message, $status, $data, $meta, true);
    }

    protected function responseDetailDataTable($responsePagination) {
        return $this->response->withHeader('Content-type', 'application/json')->withJson($responsePagination, 200);
    }

    protected function validateRequest(array $rules) {
        $this->validator->rules($rules);

        if ($this->validator->validate()) return 1;
        else return $this->responseDetail(array_values($this->validator->errors())[0][0], 400);
    }

    protected function modelToResponseDetail($modelReturn) {
        return $this->responseDetail($modelReturn['message'], $modelReturn['httpcode'], $modelReturn['data']);
    }
}