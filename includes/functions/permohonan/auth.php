<?php


if (isset($_POST['permohonan_auth_accept']) || isset($_POST['permohonan_auth_decline'])) {


    $id = $_POST['permohonan_id'];

    $role = $_POST['role'];
    $bengkel = $_POST['bengkel'];

    if (isset($_POST['permohonan_auth_accept'])) {

        if ($role == '2') {
            $status = '3';

        } else {

            $status = '2';
        }


    } elseif (isset($_POST['permohonan_auth_decline'])) {
        $status = '0';
    } else {


    }

    $sql2 = "SELECT ud.*, u.role 
    FROM user_details ud
    LEFT JOIN users  u ON ud.user_id = u.id  
    WHERE ud.bengkel = '$bengkel' 
    AND u.role = '2'";



    $result2 = mysqli_query($conn, $sql2);
    if ($row2 = mysqli_fetch_assoc($result2)) {
        $kb_id = $row2['user_id'];  // Set $kb_id from the result
    }


    $sql = "UPDATE permohonan SET 
 
    status = '$status'";

    if ($role == '3') {
        $sql .= " ,   kb_id = '$kb_id'   ";

    }

    $sql .= "  WHERE id = '$id'  ";



    $result = mysqli_query($conn, $sql);


    header("Location: " . $basePath2 . "/permohonan/senarai");
    exit();


}