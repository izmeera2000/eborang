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
            $status = '3'; // Accepted by student
            publishToBeamsInterests([ (string) $student_id ], 'Permohonan Accepted', 'Permohonan diterima', "{$rootPath}/permohonan/senarai");
            sendPusherEvent('guard', 'pelepasan', ['message' => 'Hello world!']);
        } else {
            $status = '2'; // Accepted by LECT
            publishToBeamsInterests([ (string) $kb_id ], 'Permohonan Request', 'A student has request', "{$rootPath}/permohonan/senarai");
            publishToBeamsInterests([ (string) $student_id ], 'Permohonan Accepted Oleh Lecturer', 'Permohonan diterima', "{$rootPath}/permohonan/senarai");
        }
    }
    // Handle Decline case
    elseif (isset($_POST['permohonan_auth_decline'])) {
        $status = '0'; // Declined

        // Save the decline reason if provided
        if ($declineReason) {
            // You may need to update a `decline_reason` column in your database
            $sql2 = "UPDATE permohonan SET reason = '$declineReason' WHERE id = '$id'";
            mysqli_query($conn, $sql2);
        publishToBeamsInterests([ (string) $student_id ], 'Permohonan Declined', $declineReason, "{$rootPath}/permohonan/senarai");

        } else{
        publishToBeamsInterests([ (string) $student_id ], 'Permohonan Declined', 'Permohonan dibatalkan', "{$rootPath}/permohonan/senarai");

        }



    }

    // Update the main database record with the final status
    $sql = "UPDATE permohonan SET status = '$status'";
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
