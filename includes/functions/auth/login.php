<?php

if (isset($_POST['login'])) {
    $errors = array();

    echo "<script>console.log('test');</script>";

    $login = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if (count($errors) == 0) {






        $password = md5($password);


        $query = "SELECT a.id,a.username,a.email,a.role,b.name,b.ic,b.image,b.passport,b.phone,b.address
                    FROM users a 
                    LEFT JOIN user_details b ON b.user_id = a.id
                     WHERE email='$login' AND password='$password'
                    ";
        $results = mysqli_query($conn, $query);

        if (mysqli_num_rows($results) == 1) {
            // $_SESSION['success'] = "You are now logged in";
            $user = mysqli_fetch_assoc($results);
 
            $_SESSION['user_details'] = $user;
 


            header("Location: " . $basePath2 . "/dashboard");
        } else {
            $errors['login'] = "User doesn't exist or wrong password";
            echo "<script>console.log('error');</script>";

        }
    }


}