<?php

use Phalcon\Mvc\Controller;

class OrdersController extends Controller
{
    public function indexAction()
    {
        $data = $this->mongo->order->find();
        $this->view->orders = $data;
    }
}
