<?php

require 'settings.php';

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

 
 


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
include_once('functions/routes/bppl.php');

//permohonan

include('functions/permohonan/perlepasan.php');
include('functions/permohonan/auth.php');


//profile
include_once('functions/profile/update.php');

//staff
include_once('functions/staff/senarai.php');
include_once('functions/staff/tambah.php');



//auth

include('functions/auth/login.php');
include('functions/auth/register.php');
include_once('functions/auth/validation.php');


//notification
include_once('functions/notification/sweetalert.php');

//qr
include_once('functions/qr/generate.php');




