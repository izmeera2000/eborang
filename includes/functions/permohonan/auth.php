<?php


if (isset($_POST['permohonan_auth_accept']) || isset($_POST['permohonan_auth_decline'])) {

    // Get POST variables
    $id = $_POST['permohonan_id'];
    $role = $_POST['role'];
    $bengkel = $_POST['bengkel'];
    $student_id = $_POST['student_id'];

    // Fetch the KB ID for role 2 (assuming role 2 is related to "bengkel")
    $sql2 = "SELECT ud.*, u.role 
             FROM user_details ud
             LEFT JOIN users u ON ud.user_id = u.id  
             WHERE ud.bengkel = '$bengkel' AND u.role = '2'";
    $result2 = mysqli_query($conn, $sql2);
    $kb_id = ($row2 = mysqli_fetch_assoc($result2)) ? $row2['user_id'] : null;

    // Initialize status and decline reason
    $status = null;
    $declineReason = isset($_POST['declineReason']) ? mysqli_real_escape_string($conn, $_POST['declineReason']) : null;

    // Handle Accept case
    if (isset($_POST['permohonan_auth_accept'])) {
        if ($role == '2') {
            $status = '3';


            //student yg hantaq

            publishToBeamsInterests(
                [$student_id ],    
                'Permohonan Accepted ',
                'Permohonan diterima',
                  "{$rootPath}/permohonan/senarai",
            
            );

            //guard refresh calendar
            sendPusherEvent('guard', 'pelepasan', ['message' => 'Hello world!']);
        } else {

            $status = '2';

             publishToBeamsInterests(
                [$kb_id ],     
                'Permohonan Request',
                'A student has request',
                  "{$rootPath}/permohonan/senarai",
            
            );

            publishToBeamsInterests(
                [$student_id ],    
                'Permohonan Accepted Oleh Lecturer',
                'Permohonan diterima',
                  "{$rootPath}/permohonan/senarai",
            
            );

        }


    } elseif (isset($_POST['permohonan_auth_decline'])) {
        $status = '0';

        publishToBeamsInterests(
            [$student_id ],    // or ['2'] for testing
            'Permohonan Accepted',
            'Permohonan dibatalkan',
              "{$rootPath}/permohonan/senarai",
        
        );

    } else {


    }




    $sql = "UPDATE permohonan SET 
 
    status = '$status'";

    if ($role == '3') {
        $sql .= ", kb_id = '$kb_id'"; // If the role is 3, include the KB ID
    }
    $sql .= " WHERE id = '$id'";

    // Execute the update query
    mysqli_query($conn, $sql);

    // Redirect to the list page
    header("Location: " . $basePath2 . "/permohonan/senarai");
    exit();
}
