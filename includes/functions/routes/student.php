<?php





function permohonan_perlepasan()
{
    include('includes/server.php');
    checkLogin();
    $role = checkRole();

    $breadcrumbs = [
        ['title' => 'Home', 'url' => ''],
        ['title' => 'Permohonan', 'url' => '/permohonan'],
        ['title' => 'perlepasan', 'url' => '/perlepasan'],
    ];
    echo "<script>console.log(" . json_encode($role) . ");</script>";

    if ($role === 'student') {

    //     include 'views/system/admin/dashboard.php';

    // } elseif ($role == 'guide') {
    //     include 'views/system/guide/dashboard.php';

    // } else {

 
        $result = publishToBeamsInterests(
          ['2'],
          'Permohonan Request',
          'A student has request',
          'https://yourapp.com/orders/456'
        );
     
  


    
        // echo "<script>console.log(" . json_encode($_SESSION['user_details']) . ");</script>";
        include 'views/system/student/permohonan/perlepasan.php';

    }
}






function permohonan_request()
{
    include('includes/server.php');
 

}
function permohonan_auth()
{
    include('includes/server.php');
 

}
 