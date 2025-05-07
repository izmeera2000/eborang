<?php

use Pusher\PushNotifications\PushNotifications;

function publishToBeamsInterests(array $interests, string $title, string $body, string $deepLink): ?array
{
    // load your creds
    $instanceId = $_ENV['pusher_9_id']   ?? null;
    $secretKey  = $_ENV['pusher_9_key'] ?? null;

    if (! $instanceId || ! $secretKey) {
        error_log('[Beams] Missing credentials');
        return null;
    }

    // init client
    $beamsClient = new PushNotifications([
        'instanceId' => $instanceId,
        'secretKey'  => $secretKey,
    ]);

    // determine scheme + host
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host   = $_SERVER['HTTP_HOST'] ?? '';

    // build full URL only if deepLink is relative
    if (preg_match('#^https?://#i', $deepLink)) {
        $fullLink = $deepLink;
    } else {
        // ensure leading slash
        $path = '/' . ltrim($deepLink, '/');
        $fullLink = $scheme . $host . $path;
    }

    try {
        $response = $beamsClient->publishToInterests(
            $interests,
            [
                'web' => [
                    'notification' => [
                        'title'     => $title,
                        'body'      => $body,
                        'deep_link' => $fullLink,
                    ],
                ],
            ]
        );
        return json_decode(json_encode($response), true);
    } catch (\Throwable $e) {
        error_log('[Beams] publish failed: ' . $e->getMessage());
        return null;
    }
}


function sendPusherEvent($channel, $event, $data) {
    $options = [
        'cluster' => $_ENV['pusher_9a_cluster'],  // e.g., 'us2'
        'useTLS' => true
    ];

    $pusher = new Pusher\Pusher(
        $_ENV['pusher_9a_key'],      // Replace with your Pusher key
        $_ENV['pusher_9a_secret'],   // Replace with your Pusher secret
        $_ENV['pusher_9a_id'],   // Replace with your Pusher app ID
        $options
    );

    // Trigger the event
    return $pusher->trigger($channel, $event, $data);
}