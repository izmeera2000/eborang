<?php





function perlepasan_senarai()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Perlepasan', 'url' => '/perlepasan'],
        ['title' => 'Senarai', 'url' => '/senarai'],
    ];
    echo "<script>console.log(" . json_encode($role) . ");</script>";

    if ($role === 'guard') {

    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {


    
        // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
        include 'views/system/guard/perlepasan/senarai.php';

    }
}





 