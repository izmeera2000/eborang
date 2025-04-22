<?php

require 'settings.php';

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();



 require('database.php') ;

 //email
 
 include_once('functions/email/email.php');

  //routes
 
  include_once('functions/routes/admin.php');
  // include_once('functions/routes/guide.php');
  include_once('functions/routes/user.php');
  include_once('functions/routes/public.php');
 
 
 

 //admin

 include('functions/staff/list.php');
 include('functions/staff/add.php');
 
 //guide

 
//auth

 include('functions/auth/login.php');
 include('functions/auth/register.php');


