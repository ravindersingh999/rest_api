<?php

namespace Api\Handlers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Phalcon\Di\Injectable;

class Order extends Injectable
{
    function placeorder()
    {
        if ($this->request->isPost()) {
            $token = $this->request->getQuery('token');
            $key = 'example_key';
            $decodedtoken = JWT::decode($token, new Key($key, 'HS256'));

            $data = array(
                "customer_id" => $decodedtoken->id,
                "customer_name" => $this->request->getPost('customer_name'),
                "product_name" => $this->request->getPost('product_name'),
                "product_quantity" => $this->request->getPost('quantity'),
                "status" => "paid"
            );

            $this->mongo->order->insertOne($data);
        }
    }

    function updateorder()
    {
        if ($this->request->isPut()) {
            $token = $this->request->getQuery('token');
            $key = 'example_key';
            $decodedtoken = JWT::decode($token, new Key($key, 'HS256'));
            $updated_status = $this->request->getPut('status');
            $id = $this->request->getPut('id');

            $this->mongo->order->updateOne(["_id" => new \MongoDB\BSON\ObjectID($id)], ['$set' => ['status'=> $updated_status]]);
        }
    }
}
