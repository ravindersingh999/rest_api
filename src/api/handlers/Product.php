<?php

namespace Api\Handlers;

use Phalcon\Di\Injectable;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Product extends Injectable
{
    function get($select = "", $where = "", $limit = 10, $page = 1)
    {
        $products = array(
            array('select' => $select, 'where' => $where, 'limit' => $limit, 'page' => $page),
            array('name' => 'Product 2', 'price' => 40)
        );
        return json_encode($products);
    }
    function getProducts($per_page = 10, $page = 1)
    {
        $collection = $this->mongo->products->find();
        // foreach ($collection as $k => $v) {
        //     echo '<pre>';
        //     echo $v->brand;
        $array = $collection->toArray();
        return json_encode($array);
    }
    function searchProducts($keyword = "")
    {
        $keywords = explode(" ", urldecode($keyword));
        $array = [];
        foreach ($keywords as $value) {
            $products = $this->mongo->products->find(
                [
                    'name' => [
                        '$regex' => $value,
                        '$options' => '$i'
                    ]
                ]
            );
            array_push($array, $products->toArray());
        }
        return json_encode($array);
        // print_r(json_encode($array));
        // die;
    }

    function gettoken()
    {
        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "exp" => time() * 24 + 3600,
            "role" => "admin"
        );

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $jwt;
    }
}
