<?php

if (isset($_POST['login'])) {
    $errors = array();

    echo "<script>console.log('test');</script>";

    $login = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (count($errors) == 0) {
        // Sanitize input for the login form (assuming $login is the user's email)
        $login = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to select user details based on the provided email
        $query = "SELECT a.id, a.username, a.email, a.role, b.name AS nama, b.ic, b.phone, b.birth_date, 
              b.ndp, b.kursus, b.semester, b.bengkel, b.image, a.password 
              FROM users a 
              LEFT JOIN user_details b ON b.user_id = a.id
              WHERE a.email='$login' LIMIT 1";

        $results = mysqli_query($conn, $query);

        if (mysqli_num_rows($results) == 1) {
            // Fetch the user details from the result
            $user = mysqli_fetch_assoc($results);

            // Check if the entered password matches the stored hashed password
            if (password_verify($password, $user['password'])) {
                // Password is correct, store user details in session

                $_SESSION['user_details'] = $user;

                unset($_SESSION['user_details']['password']);

                // Redirect to the dashboard
                header("Location: " . $basePath2 . "/dashboard");
                exit();
            } else {
                // If password is incorrect
                $errors['login'] = "Wrong password. Please try again.";
                echo "<script>console.log('error');</script>";
            }
        } else {
            // If no user found with that email
            $errors['login'] = "User doesn't exist or wrong password";
            echo "<script>console.log('error');</script>";
        }
    }


}