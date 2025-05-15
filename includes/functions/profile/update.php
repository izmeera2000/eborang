<?php

if (isset($_POST['updateprofile'])) {
    $errors = array();

    echo "<script>console.log('testaa');</script>";
    echo "<script>console.log(" . json_encode($_POST) . ");</script>";

    // Only handle user_id (this is required)
    if (!empty($_POST['user_id'])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    } else {
        // If user_id is missing, return or handle the error
        die('User ID is required.');
    }

    // Make all other fields optional by checking if they are set and not empty
    $nama = !empty($_POST['nama']) ? mysqli_real_escape_string($conn, $_POST['nama']) : 'NULL';
    $ic = !empty($_POST['ic']) ? mysqli_real_escape_string($conn, $_POST['ic']) : 'NULL';
    $birth_date = !empty($_POST['birth_date']) ? mysqli_real_escape_string($conn, $_POST['birth_date']) : 'NULL';
    $email = !empty($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : 'NULL';
    $phone = !empty($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : 'NULL';
    $ndp = !empty($_POST['ndp']) ? mysqli_real_escape_string($conn, $_POST['ndp']) : 'NULL';
    $bengkel = !empty($_POST['bengkel']) ? mysqli_real_escape_string($conn, $_POST['bengkel']) : 'NULL';
    $kursus = !empty($_POST['kursus']) ? mysqli_real_escape_string($conn, $_POST['kursus']) : 'NULL';
    $semester = !empty($_POST['semester']) ? mysqli_real_escape_string($conn, $_POST['semester']) : 'NULL';

    // Handle the profile picture upload, making sure it’s optional
    $newImageName = 'NULL';  // Default is NULL (no image)

    // Check if a file is actually uploaded and there is no error
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // Proceed with file upload handling
        $uploadResult = uploadFile('profile_picture', 'assets/img/user/' . $user_id . '/');

        if ($uploadResult['success']) {
            // If a new profile picture is uploaded, delete the old one
            if (!empty($_SESSION['user_details']['image'])) {
                $oldImagePath = 'assets/img/user/' . $_SESSION['user_details']['id'] . '/' . $_SESSION['user_details']['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old file
                }
            }

            // Get the new uploaded image name
            $newImageName = $uploadResult['file_name'];
        }
    }



    // Check if the user exists in the database
    $user_check_query = "SELECT * FROM user_details WHERE user_id='$user_id' LIMIT 1 ";
    $result = mysqli_query($conn, $user_check_query);
    $user_details = mysqli_fetch_assoc($result);

    if (!$user_details) { // if the user does not exist, insert a new record

        // Prepare the insert query, including image if a new one is uploaded
        $query = "INSERT INTO user_details (user_id, name, ic, phone, ndp, kursus, semester, bengkel, birth_date" .
            ($newImageName !== 'NULL' && !empty($newImageName) ? ", image" : "") .
            ") VALUES ('$user_id', '$nama', '$ic', '$phone', '$ndp', '$kursus', '$semester', '$bengkel', '$birth_date'" .
            ($newImageName !== 'NULL' && !empty($newImageName) ? ", '$newImageName'" : "") .
            ")";
        mysqli_query($conn, $query);

        // Update session data if available
        $_SESSION['user_details'] = array_merge($_SESSION['user_details'], array_filter([
            'nama' => $nama,
            'ic' => $ic,
            'birth_date' => $birth_date,
            'phone' => $phone,
            'ndp' => $ndp,
            'bengkel' => $bengkel,
            'kursus' => $kursus,
            'semester' => $semester,
            // Only include 'image' if it has a new value
            'image' => ($newImageName !== 'NULL' && !empty($newImageName)) ? $newImageName : null
        ]));


    } else {
        // If user exists, update the existing record

        // Prepare the query with dynamic image field handling
        $query = "UPDATE user_details SET 
            name = '$nama', 
            ic = '$ic', 
            birth_date = '$birth_date', 
            phone = '$phone', 
            ndp = '$ndp', 
            bengkel = '$bengkel', 
            kursus = '$kursus', 
            semester = '$semester'";

        // Add the image field if there's a new image
        if ($newImageName !== 'NULL' && !empty($newImageName)) {
            $query .= ", image = '$newImageName'"; // Only add image if there is a new one
        }

        $query .= " WHERE user_id = '$user_id'";

        // Execute the query
        mysqli_query($conn, $query);



        // Update session data if available
        $_SESSION['user_details'] = array_merge($_SESSION['user_details'], array_filter([
            'nama' => $nama,
            'ic' => $ic,
            'birth_date' => $birth_date,
            'phone' => $phone,
            'ndp' => $ndp,
            'bengkel' => $bengkel,
            'kursus' => $kursus,
            'semester' => $semester,
            // Only add 'image' if there's a new image
            'image' => ($newImageName !== 'NULL' && !empty($newImageName)) ? $newImageName : null
        ]));



    }

    // Redirect to profile page
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
