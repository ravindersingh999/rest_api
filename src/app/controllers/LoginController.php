<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        if ($this->request->getPost('login')) {
            $data = array(
                "email" => $this->request->getPost('email'),
                "password" => $this->request->getPost('password')
            );
            // $users = $this->mongo->users->findOne(["email" => $data['email'], "password" => $data['password'], "role" => "user"]);
            $admin = $this->mongo->users->findOne(["email" => $data['email'], "password" => $data['password'], "role" => "admin"]);

            if (empty($data['email']) || empty($data['password'])) {
                $this->view->loginmsg = "Please fill all fields";
            }
            if ($admin) {
                $this->response->redirect('/app/admin/index');
            }
            if (!$admin) {
                $this->view->loginmsg = "Wrong Credentials";
            }
            // if ($users) {
            //     $this->response->redirect('/frontend/products/index');
            // }
            // if (!$users) {
            //     $this->view->loginmsg = "User does not exist";
            // }
        }
    }
}
