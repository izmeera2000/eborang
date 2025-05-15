<?php



if (isset($_POST['staffadd'])) {
    $errors = array();

    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $ic = mysqli_real_escape_string($conn, $_POST['ic']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $bengkel = mysqli_real_escape_string($conn, $_POST['bengkel']);

    // Check if required fields are empty
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    }


    // Check if the email already exists
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['email'] === $email) {
            $errors['email'] = "Email is already registered.";
        }


        if ($role == '2') {
            // Check if role is 2 for the same bengkel
            $role_check_query = "SELECT * FROM users WHERE email='$email' AND role=2 AND bengkel='$bengkel' LIMIT 1";
            $role_check_result = mysqli_query($conn, $role_check_query);
            $role_check = mysqli_fetch_assoc($role_check_result);

            if ($role_check) {
                $errors['role'] = "User with the same email and role 2 already exists in this bengkel.";
            }
            
        }


    }

 



  


    // If there are no errors, proceed with user creation
    if (count($errors) == 0) {
        // Hash the password
        $password_hash = password_hash($ic, PASSWORD_DEFAULT);

        // Insert user into the 'users' table
        $insert_user_query = "INSERT INTO users (email, password, role) 
                              VALUES('$email', '$password_hash', '$role')";
        mysqli_query($conn, $insert_user_query);

        // Get the user ID of the newly inserted user
        $user_id = mysqli_insert_id($conn);

        // Insert user details into the 'user_details' table

        $newImageName = 'NULL';  // Default image is NULL

        // Handle profile picture upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = uploadFile('profile_picture', 'assets/img/user/' . $user_id . '/');
            if ($uploadResult['success']) {
                $newImageName = $uploadResult['file_name'];
            }
        }

        // Insert user details into the 'user_details' table
        $insert_details_query = "INSERT INTO user_details (user_id, name, ic, phone, ndp, kursus, semester, bengkel, birth_date, image) 
                                 VALUES ('$user_id', '$nama', '$ic', '$phone', '$ndp', '$kursus', '$semester', '$bengkel', '$birth_date', '$newImageName')";
        mysqli_query($conn, $insert_details_query);

        // Store the user's session details (without password)
        $user_details = [
            'id' => $user_id,
            'email' => $email,
            'role' => $role,
            'nama' => $nama,
            'ic' => $ic,
            'phone' => $phone,
            'birth_date' => $birth_date,
            'bengkel' => $bengkel,
            'image' => $newImageName
        ];

        $_SESSION['user_details'] = $user_details;

        // Redirect to the dashboard or login page
        // header("Location: " . $basePath2 . "/staff/senarai");
         die();
    }
}

