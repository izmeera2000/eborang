<?php

if (isset($_POST['updateprofile'])) {
    $errors = array();

    echo "<script>console.log('test');</script>";

    echo "<script>console.log(" . json_encode($_POST) . ");</script>";


    if (!empty($_POST['user_id'])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    }

    if (!empty($_POST['nama'])) {
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    }


    // Check if 'ic' is not empty and sanitize it
    if (!empty($_POST['ic'])) {
        $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    }

    // Check if 'birth_date' is not empty and sanitize it
    if (!empty($_POST['birth_date'])) {
        $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    }

    // Check if 'email' is not empty and sanitize it
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }

    // Check if 'phone' is not empty and sanitize it
    if (!empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    }

    // Check and sanitize 'ndp'
    if (!empty($_POST['ndp'])) {
        $ndp = mysqli_real_escape_string($conn, $_POST['ndp']);
    }

    // Check and sanitize 'bengkel'
    if (!empty($_POST['bengkel'])) {
        $bengkel = mysqli_real_escape_string($conn, $_POST['bengkel']);
    }

    // Check and sanitize 'kursus'
    if (!empty($_POST['kursus'])) {
        $kursus = mysqli_real_escape_string($conn, $_POST['kursus']);
    }

    // Check and sanitize 'semester'
    if (!empty($_POST['semester'])) {
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    }






    $user_check_query = "SELECT * FROM user_details WHERE  id='$user_id'    LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user_details = mysqli_fetch_assoc($result);

    if (!$user_details) { // if user exists




        // Create the SQL query to insert data into the user_details table
        $query = "INSERT INTO user_details (user_id, name, ic, phone, ndp, kursus, semester, bengkel)
              VALUES ('$user_id', '$nama', '$ic', '$phone', '$ndp', '$kursus', '$semester', '$bengkel')";
        mysqli_query($conn, $query);

        // Check each value individually before updating the session
        if (!empty($nama)) {
            $_SESSION['user_details']['nama'] = $nama;
        }
        if (!empty($ic)) {
            $_SESSION['user_details']['ic'] = $ic;
        }
        if (!empty($birth_date)) {
            $_SESSION['user_details']['birth_date'] = $birth_date;
        }

        if (!empty($phone)) {
            $_SESSION['user_details']['phone'] = $phone;
        }
        if (!empty($ndp)) {
            $_SESSION['user_details']['ndp'] = $ndp;
        }
        if (!empty($bengkel)) {
            $_SESSION['user_details']['bengkel'] = $bengkel;
        }
        if (!empty($kursus)) {
            $_SESSION['user_details']['kursus'] = $kursus;
        }
        if (!empty($semester)) {
            $_SESSION['user_details']['semester'] = $semester;
        }


    } else {

        $query = "UPDATE user_details SET 
                       name = '$nama', 
                       ic = '$ic', 
                       birth_date = '$birth_date', 
                        phone = '$phone', 
                       ndp = '$ndp', 
                       bengkel = '$bengkel', 
                       kursus = '$kursus', 
                       semester = '$semester' 
                   WHERE user_id = '$user_id'";
        mysqli_query($conn, $query);


        // Check each value individually before updating the session
        if (!empty($nama)) {
            $_SESSION['user_details']['nama'] = $nama;
        }
        if (!empty($ic)) {
            $_SESSION['user_details']['ic'] = $ic;
        }
        if (!empty($birth_date)) {
            $_SESSION['user_details']['birth_date'] = $birth_date;
        }

        if (!empty($phone)) {
            $_SESSION['user_details']['phone'] = $phone;
        }
        if (!empty($ndp)) {
            $_SESSION['user_details']['ndp'] = $ndp;
        }
        if (!empty($bengkel)) {
            $_SESSION['user_details']['bengkel'] = $bengkel;
        }
        if (!empty($kursus)) {
            $_SESSION['user_details']['kursus'] = $kursus;
        }
        if (!empty($semester)) {
            $_SESSION['user_details']['semester'] = $semester;
        }



    }





}