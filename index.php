<?php
// Simple Router with Functions
session_start();

include('includes/server.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Remove basePath from the request URI if it exists
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
    $requestUri = trim($requestUri, '/');

}

$requestMethod = $_SERVER['REQUEST_METHOD'];















// Route Definitions
$routes = [
    '' => 'dashboard',
    'dashboard' => 'dashboard',
    'login' => 'login',
    'register' => 'register',
    'logout' => 'logout',
    'profile' => 'profile',

    //student
    'permohonan/perlepasan' => 'permohonan_perlepasan',

    //semua
    'permohonan/senarai' => 'permohonan_senarai',


    //guard
    'perlepasan/senarai' => 'perlepasan_senarai',



    //fucntions

    //permohonan
        'permohonan/senarai_calendar' => 'permohonan_senarai_calendar',
        'permohonan/request' => 'permohonan_request',
        'permohonan/auth' => 'permohonan_auth',
 
    //userprofile
    'profile/update' => 'profile_update',

];


switch (true) {
    case isset($routes[$requestUri]):
        // Route exists, execute the corresponding function
        call_user_func($routes[$requestUri]);
        break;
 
    default:
        // If none of the above conditions match, call notFound()
        notFound($requestUri);
        break;
}

?>