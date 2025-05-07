<?php


function home()
{
    include('includes/server.php');
    include 'views/public/home.php';
}


function login()
{
    include('includes/server.php');
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";

    include 'views/system/auth/login.php';
}

function register()
{

    include('includes/server.php');
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";

    include 'views/system/auth/register.php';
}




function logout()
{

    include('includes/server.php');
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";

    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    global $basePath2;

    header("Location: " . $basePath2 . "/login");
    exit();
}




function notFound($requestUri)
{
    http_response_code(404);
    echo "404 Not Found";
    echo $requestUri;

}


function unAuth()
{
    http_response_code(401);
    echo "Unauthorized";
    // echo $requestUri;

}



function register_2()
{

    include('includes/server.php');
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";

    include 'views/system/register2.php';
}








function dashboard()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Dashboard', 'url' => '/dashboard'],
    ];
    echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";

    if ($role == 'student') {
 
        include 'views/system/student/dashboard.php';

    }

    if ($role == 'guard') {

        include 'views/system/guard/dashboard.php';

    }
  
    if ($role == 'kb') {
 
        include 'views/system/kb/dashboard.php';

    }

    if ($role == 'lecturer') {
 
        include 'views/system/lect/dashboard.php';

    }

    
    if ($role == 'bppl') {
 
        include 'views/system/bppl/dashboard.php';

    }
}






function profile()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Profile', 'url' => '/profile'],
    ];
    echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";



    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
    include 'views/system/user/profile.php';

}

function profile_update()
{
    include('includes/server.php');





    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
    // header("Location: " . $basePath2 . "/profile");
    // exit();
}




function permohonan_senarai()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Permohonan', 'url' => '/permohonan'],
        ['title' => 'Perlepasan', 'url' => '/perlepasan'],
    ];
    echo "<script>console.log(" . json_encode($role) . ");</script>";




    if ($role === 'student') {

 
        // include 'views/system/student/permohonan/perlepasan.php';

    }


    if ($role === 'lecturer') {

 
        include 'views/system/lect/permohonan/senarai.php';

    }

    if ($role === 'kb') {

 
        include 'views/system/kb/permohonan/senarai.php';

    }

    if ($role === 'bppl') {

 
        include 'views/system/kb/permohonan/senarai.php';

    }
}



function permohonan_senarai_calendar()
{
    include('includes/server.php');
 

}