<?php

require 'settings.php';

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

 
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




require('database.php');
include_once('functions/notification/pusher.php');
 
//email

include_once('functions/email/email.php');


//file
include_once('functions/file/upload.php');
include_once('functions/file/delete.php');

//routes

include_once('functions/routes/student.php');
include_once('functions/routes/general.php');
include_once('functions/routes/guard.php');

//permohonan

include('functions/permohonan/perlepasan.php');
include('functions/permohonan/auth.php');


//profile
include_once('functions/profile/update.php');



//auth

include('functions/auth/login.php');
include('functions/auth/register.php');
include_once('functions/auth/validation.php');


//notification
include_once('functions/notification/sweetalert.php');

//qr
include_once('functions/qr/generate.php');




