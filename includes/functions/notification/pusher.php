<?php

use Pusher\PushNotifications\PushNotifications;

 

function publishToBeamsInterests(array $interests, string $title, string $body, string $deepLink): ?array
{
 
    $beamsClient = new PushNotifications([
        "instanceId" => $_ENV['pusher_9_id'],
        "secretKey" => $_ENV['pusher_9_key']
    ]);

    try {
        $response = $beamsClient->publishToInterests(
            $interests,
            [
                'web' => [
                    'notification' => [
                        'title'     => $title,
                        'body'      => $body,
                        'deep_link' => $deepLink,
                    ],
                ],
            ]
        );

        // stdClass → array
        return json_decode(json_encode($response), true);
    } catch (\Exception $e) {
        error_log('Beams publish error: ' . $e->getMessage());
        return null;
    }
}
