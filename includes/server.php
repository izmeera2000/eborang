<?php

require 'settings.php';

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();



require('database.php');

//email

include_once('functions/email/email.php');

//file
include_once('functions/file/upload.php');
include_once('functions/file/delete.php');

//routes

include_once('functions/routes/student.php');
include_once('functions/routes/general.php');

//permohonan

include('functions/permohonan/pelepasan.php');
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




