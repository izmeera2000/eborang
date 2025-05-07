<?php

use Pusher\PushNotifications\PushNotifications;



function publishToBeamsInterests(array $interests, string $title, string $body, string $deepLink): ?array
{

    $beamsClient = new PushNotifications([
        "instanceId" => $_ENV['pusher_9_id'],
        "secretKey" => $_ENV['pusher_9_key']
    ]);

    try {
        // Capture the response
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

        // Convert stdClass → array and return
        return json_decode(json_encode($response), true);

    } catch (\Throwable $e) {
        error_log('[Beams] publish failed: ' . $e->getMessage());
        return null;
    }


}
