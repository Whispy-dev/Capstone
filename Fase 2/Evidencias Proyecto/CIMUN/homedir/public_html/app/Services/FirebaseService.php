<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;

class FirebaseService
{
    protected Messaging $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(
            storage_path('app/firebase/cimun-chile-firebase-adminsdk-fbsvc-5c379e6de6.json')
        );

        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification(string $deviceToken, string $title, string $body, array $data = [])
    {
        $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(\Kreait\Firebase\Messaging\Notification::create($title, $body))
            ->withData($data);

        return $this->messaging->send($message);
    }
}