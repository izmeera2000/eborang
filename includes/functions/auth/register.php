<?php

if (isset($_POST['register'])) {
    $errors = array(); 

    echo "<script>console.log('test');</script>";


    if (empty($_POST['username'])) {
        $errors['username'] = "username required";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);

    }

    if (empty($_POST['email'])) {
        $errors['email'] = "email required";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

    }

    if (empty($_POST['password1'])) {
        $errors['password1'] = "password required";
    } else {
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);

    }

    if (empty($_POST['password2'])) {
        $errors['password2'] = "confirm password required";
    } else {
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    }

    if (!isset($_POST['agree_terms'])) {
        $errors['agree_terms'] = "must agree";
         
    }

  $role = 5;

  if (!empty($_POST['password1']) && !empty($_POST['password2'])) {

    if ($password1 != $password2) {
      $errors['password1'] = "Passwords dont match";
      $errors['password2'] = "Passwords dont match";
    }

  }


  if (isset($username) && isset($email)) {

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'    LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
      if ($user['username'] === $ndp) {

        $errors['username'] = "username already registered";
      }

      if ($user['email'] === $email) {
        $errors['email'] = "Email already registered";

      }

 
    }

  }

  if (count($errors) == 0) {
    $password = md5($password1);

    $query = "INSERT INTO users (username,email,password,role) 
                          VALUES('$username','$email','$password','$role')";
    mysqli_query($conn, $query);


    $_SESSION['user_details'] = [
        'username' => $username,
        'email' => $email,
        'role' => $role,

    ];
    header("Location: " . $basePath2 . "/login");


  }



}