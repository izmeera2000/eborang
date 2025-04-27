<?php

if (isset($_POST['senarai_permohonan_calendar'])) {
    $start_utc = $_POST['start'];
    $end_utc = $_POST['end'];

    $role = $_POST['role'];
    $user_id = $_POST['user_id'];

    $bengkel = isset($_POST['bengkel']) ? $_POST['bengkel'] : null;  // If not set, set as null


    // Convert to date format for SQL
    $start_date = date('Y-m-d', strtotime($start_utc));
    $end_date = date('Y-m-d', strtotime($end_utc));



    $today = date('Y-m-d');  // Get today's date in Y-m-d format

    $events = [];

    // Fetch permohonan dates within the given range
    $sql = "SELECT pd.*, p.status, p.user_id , p.permohonan_type,p.status,p.days,p.time_slip,p.file,p.place,p.purpose,p.lecturer_id,p.kb_id,ud.name as student_name, ud.ndp,ud.image as student_image 
            FROM permohonan_dates pd
            LEFT JOIN permohonan p ON pd.permohonan_id = p.id
            LEFT JOIN user_details ud ON p.user_id = ud.id
            WHERE (pd.date BETWEEN '$start_date' AND '$end_date') ";

    if ($role != '4' && $role != '1') {
        $sql .= " AND ud.bengkel = '$bengkel'";
    }

    if ($role == 3) {
        $sql .= " AND p.status = '1'";
        $sql .= " AND p.lecturer_id = '$user_id' ";
    }
    
    if ($role == 2) {
        $sql .= " AND p.status = '2'";
        $sql .= " AND p.kb_id = '$user_id' ";

    }
    if ($role == 5) {
        $sql .= " AND p.user_id = '$user_id' ";

    }

    $result = $conn->query($sql);

    // Store events grouped by permohonan_id
    $event_groups = [];

    while ($row = $result->fetch_assoc()) {
        $event_date = $row['date'];
        $start_time = $row['time_start'];
        $end_time = $row['time_end'];
        $status = $row['status'];
        $permohonan_id = $row['permohonan_id'];

        $permohonan_type = $row['permohonan_type'];
        $status = $row['status'];
        $days = $row['days'];
        $time_slip = $row['time_slip'];
        $file = $rootPath . "/assets/uploads/permohonan/" . $permohonan_id . "/" . $row['file'];
        $place = $row['place'];
        $purpose = $row['purpose'];
        $lecturer_id = $row['lecturer_id'];
        $kb_id = $row['kb_id'];


        $student_name = $row['student_name'];
        $ndp = $row['ndp'];

        if ($row['student_image'] == NULL) {
            $student_image = "$rootPath/assets/img/user/nopic.png";
        } else {
            $student_image = $row['student_image'];


        }


        // Get the file extension
        $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Variable to hold the file type
        $file_type = '';

        // Determine the file type based on the file extension
        switch ($file_extension) {
            case 'pdf':
                // If the file extension is PDF, set the file type to iframe (for viewing in an iframe)
                $file_type = "iframe";
                break;

            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                // If the file is an image, set the file type to image
                $file_type = "image";
                break;

            default:
                // If the file type is unknown, output a message
                $file_type = "unknown";
                break;
        }

        // Output the result (for demonstration purposes)


        // Determine class based on status
        $className = 'bg-gradient-warning';
        if ($status == 0) {
            $className = 'bg-gradient-danger';
        } elseif ($status == 2) {
            $className = 'bg-gradient-info';
        } elseif ($status == 3) {
            $className = 'bg-gradient-success';
        } else {

        }

        if ($event_date < $today) {
            $className .= " opacity-7";
        }

        // If the permohonan_id already exists, check the dates and merge the times correctly
        if (!isset($event_groups[$permohonan_id])) {
            // Check if end time is 00:00:00, and if so, set to 23:59:59
            if ($end_time == "00:00:00") {
                $end_time = "23:59:59";
            }

            $event_groups[$permohonan_id] = [
                'title' => "#" . $permohonan_id . " ($ndp) $student_name",
                'start' => trim(sprintf('%s %s', $event_date, $start_time)),
                'end' => trim(sprintf('%s %s', $event_date, $end_time)),
                'permohonan_id' => $permohonan_id,
                'className' => $className,
                'permohonan_type' => $permohonan_type,
                'status' => $status,
                'days' => $days,
                'time_slip' => $time_slip,
                'file' => $file,
                'file_type' => $file_type,
                'place' => $place,
                'purpose' => $purpose,
                'lecturer_id' => $lecturer_id,
                'kb_id' => $kb_id,
                'student_name' => $student_name,
                'ndp' => $ndp,
                'student_image' => $student_image,
            ];
        } else {
            // Check the start time - only update if the current event starts earlier
            $existing_start_time = $event_groups[$permohonan_id]['start'];
            $new_start_time = trim(sprintf('%s %s', $event_date, $start_time));
            if (strtotime($new_start_time) < strtotime($existing_start_time)) {
                $event_groups[$permohonan_id]['start'] = $new_start_time;
            }

            // Check the end time - only update if the current event ends later
            $existing_end_time = $event_groups[$permohonan_id]['end'];
            $new_end_time = trim(sprintf('%s %s', $event_date, $end_time));

            // If the new end time is 00:00:00, set it to 23:59:59
            if ($end_time == "00:00:00") {
                $new_end_time = trim(sprintf('%s 23:59:59', $event_date));
            }

            if (strtotime($new_end_time) > strtotime($existing_end_time)) {
                $event_groups[$permohonan_id]['end'] = $new_end_time;
            }
        }
    }

    // Convert event groups to a simple array
    foreach ($event_groups as $event) {
        $events[] = $event;
    }

    echo json_encode($events);
    exit;
}



//request perlepasan / tambah


if (isset($_POST['permohonan_request'])) {



    // Make sure to sanitize the inputs
    $user_id = $_POST['user_id'];
    $permohonan_type = "perlepasan";
    $status = 1;
    $dates = $_POST['dates'];
    $start_times = $_POST['time_start'];
    $end_times = $_POST['time_end'];
    $days = count($dates);
    $time_slip = 0; // or calculate if needed

    $filename = basename($_FILES['bukti']["name"]);
    $place = $_POST['tempat'];
    $purpose = $_POST['tujuan'];
    $lecturer_id = $_POST['lecturer_id'];


    // Insert into `permohonan`
    $sql = "INSERT INTO permohonan (user_id, permohonan_type, status, days, time_slip,file,place,purpose,lecturer_id) 
          VALUES ('$user_id', '$permohonan_type', '$status', '$days', '$time_slip','$filename','$place','$purpose','$lecturer_id')";
    if (mysqli_query($conn, $sql)) {
        $permohonan_id = mysqli_insert_id($conn);

        // Insert into `permohonan_dates`
        for ($i = 0; $i < count($dates); $i++) {
            $date = mysqli_real_escape_string($conn, $dates[$i]);
            $time_start = mysqli_real_escape_string($conn, $start_times[$i]);
            $time_end = mysqli_real_escape_string($conn, $end_times[$i]);

            $sql2 = "INSERT INTO permohonan_dates (permohonan_id, date, time_start, time_end)
                   VALUES ($permohonan_id, '$date', '$time_start', '$time_end')";
            mysqli_query($conn, $sql2);
        }


        $result = uploadFile('bukti', 'assets/uploads/permohonan/' . $permohonan_id . '/');

        if ($result['success']) {
            echo "File uploaded: " . $result['file_path'];
        } else {
            echo "Error: " . $result['message'];
        }

        // Redirect after success
        header("Location: " . $basePath2 . "/permohonan/perlepasan");
        exit();
    }
}


