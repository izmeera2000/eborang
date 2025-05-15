<?php



function staff_tambah() 
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Staff', 'url' => '/staff'],
        ['title' => 'Tambah', 'url' => '/tambah'],
    ];
    echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";



    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
    include 'views/system/bppl/staff/tambah.php';

}

function staff_senarai() 
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Staff', 'url' => '/staff'],
        ['title' => 'Senarai', 'url' => '/senarai'],
    ];


    echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";



    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {
    // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
    include 'views/system/bppl/staff/senarai.php';

}



function staff_senarai_db() 
{
    include('includes/server.php');
 

}