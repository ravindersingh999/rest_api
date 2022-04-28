<?php

use Phalcon\Mvc\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        $this->view->products = $this->mongo->products->find();
    }

    public function addproductAction()
    {
        $products = $this->mongo->products->find()->toArray();
        $productCount = count($products);
        // echo $productCount;
        // die;
        if ($this->request->getPost('addproduct')) {
            $data = array(
                'id' => $productCount + 1,
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock' => $this->request->getPost('stock'),
                'status'=>"inactive"
            );

            $this->mongo->products->insertOne($data);
            $this->view->addproductmsg = "<span class='text-success'>Product added successfully</span>";
        }
    }
}
