<?php 

namespace Listeners;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use GuzzleHttp\Client;

class NotificationsListeners extends Injectable
{
    public function update(Event $event,$product)
    {
        
    }
    public function insert(Event $event,$data)
    {
        $url = 'http://192.168.2.61:8080/';
            $client = new Client();
            $response=$client->request('POST', $url, ['form_params' => $data]);
            echo $response->getBody()->getContents();
            die;
    }
}