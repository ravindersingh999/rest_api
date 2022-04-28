<?php

use Phalcon\Mvc\Controller;

class OrdersController extends Controller
{
    public function indexAction()
    {
        $data = $this->mongo->order->find();
        $this->view->orders = $data;
    }
    public function changestatusAction()
    {
        $id=$this->request->getPost("id");
        $status=$this->request->getPost("status");
        $this->mongo->order->updateOne(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set'=>["status"=>$status]]);
        echo "status changed";
    }
}
