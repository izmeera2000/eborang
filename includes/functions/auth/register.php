<?php

if (isset($_POST['register'])) {
  $errors = array();

  echo "<script>console.log('test');</script>";


  // if (empty($_POST['username'])) {
  //   $errors['username'] = "username required";
  // } else {
  //   $username = mysqli_real_escape_string($conn, $_POST['username']);

  // }

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

    $user_check_query = "SELECT * FROM users WHERE  email='$email'    LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
      // if ($user['username'] === $username) {

      //   $errors['username'] = "username already registered";
      // }

      if ($user['email'] === $email) {
        $errors['email'] = "Email already registered";

      }


    }

  }

if (count($errors) == 0) {
    // Hash the password using password_hash() instead of md5
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);

    // Insert the user details into the database with the hashed password
    $query = "INSERT INTO users ( email, password, role) 
              VALUES(  '$email', '$password_hash', '$role')";
    mysqli_query($conn, $query);

    // Store the user's session details (note that we don't store the password in the session for security reasons)
    $_SESSION['user_details'] = [
        'email' => $email,
        'role' => $role,
    ];

    // Redirect to login page
    header("Location: " . $basePath2 . "/login");
    exit();
}




}