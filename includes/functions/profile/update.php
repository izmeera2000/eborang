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

     if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        // Handle the profile picture upload
        $uploadResult = uploadFile('profile_picture',  'assets/img/user/' . $user_id . '/');
 
        if ($uploadResult['success']) {
            // Check if the user already has a profile picture
            if (!empty($_SESSION['user_details']['image'])) {
                // Delete the old image from the directory
                $oldImagePath = 'assets/img/user/' . $_SESSION['user_details']['id'] . '/' . $_SESSION['user_details']['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old file
                }
            }

            // Update the image in the database
            $newImageName = $uploadResult['file_name']; // Get the new uploaded file name
       

        }  
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
        $query = "INSERT INTO user_details (user_id, name, ic, phone, ndp, kursus, semester, bengkel,birth_date)
              VALUES ('$user_id', '$nama', '$ic', '$phone', '$ndp', '$kursus', '$semester', '$bengkel', '$birth_date')";
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
                       semester = '$semester' ,
                       image = '$newImageName'
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
 if (isset($newImageName) && !empty($newImageName)) {

            // Update the session with the new image name
            $_SESSION['user_details']['image'] = $newImageName;
        }

    }


 


    header("Location: " . $basePath2 . "/profile");
    exit();
    


}


 if (isset($_POST['updatepassword'])) {
    $errors = array();

    // Get current user ID from session (assuming user is logged in)
    $user_id = $_SESSION['user_details']['id'];

    // Get posted form data
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if the new password and confirm password match
    if ($new_password != $confirm_password) {
        $errors['password'] = "Passwords do not match!";
    }

    // Check if the current password is correct
    if (empty($errors)) {
        // Fetch the user's current hashed password from the database
        $user_check_query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if (!$user || !password_verify($current_password, $user['password'])) {
            $errors['current_password'] = "Current password is incorrect!";
        }
    }

    // If there are no errors, update the password
    if (count($errors) == 0) {
        // Hash the new password using bcrypt (password_hash automatically uses bcrypt)
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $query = "UPDATE users SET password='$new_password_hash' WHERE id='$user_id'";
        mysqli_query($conn, $query);
 

        // Redirect to the profile page with success message
    header("Location: " . $basePath2 . "/profile");
        exit();
    }
}
 