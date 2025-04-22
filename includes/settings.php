<?php


$is_local = ($_SERVER['HTTP_HOST'] === 'localhost');

// Set the correct base path
$basePath = $is_local ? 'E-Borang' : ''; // Local subfolder, empty for production
$basePath2 = $is_local ? '/E-Borang' : ''; // Local subfolder with slash, empty for production
 
$rootPath = $is_local ? '/E-Borang' : '' ;
$testPath ='http://localhost/E-Borang'; 
date_default_timezone_set('Asia/Kuala_Lumpur');
