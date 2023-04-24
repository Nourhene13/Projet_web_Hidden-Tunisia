<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twilio\Rest\Client;

class SmsController extends AbstractController
{
    public function sendSms()
    {
        $sid = 'AC9d715264162be10af49fe4aeaaa07683';
        $token = '8e65c434fd28702db1c123ecabf00046';
        $client = new Client($sid, $token);

        $message = $client->messages->create(
            "+21694309914",
            [
                'from' => "+16812069787",
                'body' => 'Reservation Confirmée'
            ]
        );
    }
}
