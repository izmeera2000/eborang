<?php

use Pusher\PushNotifications\PushNotifications;



function publishToBeamsInterests(array $interests, string $title, string $body, string $deepLink): ?array
{

    $beamsClient = new PushNotifications([
        "instanceId" => $_ENV['pusher_9_id'],
        "secretKey" => $_ENV['pusher_9_key']
    ]);

    $beamsClient->publishToInterests(
        $interests,
        [
            'web' => [
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'deep_link' => $deepLink,
                ],
            ],
        ]
    );


}
