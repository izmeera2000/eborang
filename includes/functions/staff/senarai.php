<?php
if (isset($_POST['senarai_staff_list'])) {

    // Pagination and filters
    $start = isset($_POST['start']) && $_POST['start'] >= 0 ? (int) $_POST['start'] : 0;
    $length = isset($_POST['length']) && $_POST['length'] > 0 ? (int) $_POST['length'] : 5;
    $search_value = isset($_POST['search']['value']) ? trim($_POST['search']['value']) : '';
    $draw = isset($_POST['draw']) ? (int) $_POST['draw'] : 1;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;

    // Start building the SQL query
    $sql = "SELECT 
                u.id AS user_id,
                u.username,
                u.email,
                ur.name AS role,   
                ud.name AS user_name,
                ud.ic,
                ud.image AS user_image,
                ud.phone,
                ud.birth_date,
                ud.bengkel
            FROM users u
            LEFT JOIN user_details ud ON u.id = ud.user_id
            LEFT JOIN user_role ur ON u.role = ur.id";

    $whereClause = "";

    // Search functionality
    if (!empty($search_value)) {
        $search_value_escaped = $conn->real_escape_string($search_value);
        $whereClause .= " WHERE (";
        $whereClause .= "u.username LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "u.email LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "ud.name LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "ud.ic LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "ud.phone LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "ur.name LIKE '%$search_value_escaped%' OR ";
        $whereClause .= "ud.bengkel LIKE '%$search_value_escaped%')";
    }


    if (empty($whereClause)) {
        $whereClause .= " WHERE ";
    } else {
        $whereClause .= " AND ";
    }
    $whereClause .= " ur.name != 'student' ";

    if (empty($whereClause)) {
        $whereClause .= " WHERE ";
    } else {
        $whereClause .= " AND ";
    }
    $whereClause .= " user_id != '$user_id' ";

    $sql .= $whereClause;

    // Apply pagination (limit the results)
    $sql .= " LIMIT $start, $length";

    // Execute the query
    $result = $conn->query($sql);

    // Count filtered records
    $count_filtered_sql = "SELECT COUNT(DISTINCT u.id) AS total 
                           FROM users u
                           LEFT JOIN user_details ud ON u.id = ud.user_id
                           LEFT JOIN user_role ur ON u.role = ur.id";  // Ensure count query matches main query
    $count_filtered_sql .= $whereClause;
    $count_filtered_result = $conn->query($count_filtered_sql);
    $filtered_records = $count_filtered_result->fetch_assoc()['total'];

    // Count total records (without any filter)
    $count_total_sql = "SELECT COUNT(DISTINCT u.id) AS total 
                        FROM users u";  // No need for join in the total count query
    $count_total_result = $conn->query($count_total_sql);
    $total_records = $count_total_result->fetch_assoc()['total'];

    // Prepare the response data
    $user_data = [];

    while ($row = $result->fetch_assoc()) {
        // Prepare the user data to be returned
        $user_data[] = [
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'email' => $row['email'],
            'role' => $row['role'],  // Role is now fetched from user_role table
            'user_name' => $row['user_name'],
            'ic' => $row['ic'],
            'user_image' => $row['user_image'] ? $rootPath . "/assets/img/user/" . $row['user_id'] . "/" . $row['user_image'] : null,
            'phone' => $row['phone'],
            'birth_date' => $row['birth_date'],
            'bengkel' => $row['bengkel']
        ];
    }

    // JSON response
    $response = [
        'draw' => $draw,
        'recordsTotal' => (int) $total_records,
        'recordsFiltered' => (int) $filtered_records,
        'data' => $user_data
    ];

    echo json_encode($response);
    die();
}
