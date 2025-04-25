<?php





function permohonan_pelepasan()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Permohonan', 'url' => '/permohonan'],
        ['title' => 'Pelepasan', 'url' => '/pelepasan'],
    ];
    echo "<script>console.log(" . json_encode($role) . ");</script>";

    if ($role === 'student') {

    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {


    
        // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
        include 'views/system/student/permohonan/pelepasan.php';

    }
}



function permohonan_senarai()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Permohonan', 'url' => '/permohonan'],
        ['title' => 'Pelepasan', 'url' => '/pelepasan'],
    ];
    echo "<script>console.log(" . json_encode($role) . ");</script>";

    if ($role === 'student') {

 
        // include 'views/system/student/permohonan/pelepasan.php';

    }


    if ($role === 'lecturer') {

 
        include 'views/system/lect/permohonan/senarai.php';

    }
}



function permohonan_senarai_calendar()
{
    include('includes/server.php');
 

}
function permohonan_request()
{
    include('includes/server.php');
 

}

 