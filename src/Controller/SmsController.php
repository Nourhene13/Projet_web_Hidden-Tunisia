<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twilio\Rest\Client;

class SmsController extends AbstractController
{
    public function sendSms()
    {
        $sid = 'AC1de31d1832309cb62902cbe7f62f48ee';
        $token = 'b6acb98a42a9f1a1e6dc6d148de56a23';
        $client = new Client($sid, $token);

        $message = $client->messages->create(
            "+21694309914",
            [
                'from' => "+16813846369",
                'body' => 'Reservation Confirmée'
            ]
        );
    }
}
