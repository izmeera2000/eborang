<?php
if (isset($_POST['createstaff'])) {
    // Get the values from the form
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ic = $_POST['ic'];
    $passport = $_POST['passport'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];




    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape input values to prevent SQL injection (basic sanitization)
    $username = $conn->real_escape_string($username);
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $ic = $conn->real_escape_string($ic);
    $passport = $conn->real_escape_string($passport);
    $phone = $conn->real_escape_string($phone);
    $address = $conn->real_escape_string($address);
    $role = (int) $role; // Make sure role is treated as an integer

    $password = md5("selama_" . $username);

    $var = array(
        "name" => $name,
        "role" => $role,
         
    );

    
    // Build the SQL query
    $sql = "INSERT INTO users (username, email,password, role) 
            VALUES ('$username', '$email', '$password','$role')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    $user_id = mysqli_insert_id($conn); // Get the inserted person ID
    
    $sql_details = "INSERT INTO user_details (user_id, ic,phone, address,name) 
            VALUES ('$user_id', '$ic', '$phone','$address','$name')";
        mysqli_query($conn, $sql_details);
        
        // sendEmail($email, "Welcome To Our Staff", 'register_staff', $var);


    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    header("Location: " . $basePath2 . "/staff" . "/addnew");
    exit();



}
