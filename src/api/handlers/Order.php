<?php

namespace Api\Handlers;

use Phalcon\Di\Injectable;

class Order extends Injectable
{
    function placeorder()
    {
        if ($this->request->getPost()) {
            $data = array(
                "customer_name" => $this->request->getPost('name'),
                "product_quantity" => $this->request->getPost('quantity')
            );

            $this->mongo->order->insertOne($data);
        }
    }
}
