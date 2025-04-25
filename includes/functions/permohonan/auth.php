<?php


if (isset($_POST['permohonan_auth_accept']) || isset($_POST['permohonan_auth_decline'])) {


    $id = $_POST['permohonan_id'];
 


    if (isset($_POST['permohonan_auth_accept'])) {
        $status = '2';
    } elseif (isset($_POST['permohonan_auth_decline'])) {
        $status = '0';
    } else {


    }

    $sql = "UPDATE permohonan SET 
 
    status = '$status'
  WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);


}