<?php

if (isset($_POST['staff_getlist'])) {

    // DataTables parameters from POST request
    $start = isset($_POST['start']) ? (int) $_POST['start'] : 0;   // Paging start
    $length = isset($_POST['length']) ? (int) $_POST['length'] : 10;  // Number of rows per page
    $search = isset($_POST['search']) ? $_POST['search'] : ''; // Global search value
    $order = isset($_POST['order'][0]['column']) ? (int) $_POST['order'][0]['column'] : 0; // Sorting column index
    $order_direction = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc'; // Sorting direction
    $table_name = "users";
    $role_table = "user_role"; // The table you are joining with

    // Column names for sorting
    $columns = ['id', 'username', 'email', 'role', 'name']; // Modify according to your table structure
    $columns_str = implode(', ', $columns);

    // Escape search string to prevent SQL injection
    // $search = $conn->real_escape_string($search);

    // Build the SQL query with INNER JOIN
    $search_condition = " WHERE 1=1  ";
    if ($search) {
        $search_condition = " AND 
                                (users.id LIKE '%$search%' 
                             OR users.username LIKE '%$search%' 
                             OR users.email LIKE '%$search%' 
                             OR user_role.name LIKE '%$search%') "; // Assuming 'role_name' is the column in the user_role table
    }
    $search_condition .= " AND user_role.name  != 'user'  ";
    // Build the order by clause
    $order_by = " ORDER BY " . $columns[$order] . " " . $order_direction;

    // Paginate the result
    $sql = "SELECT users.id, users.username, users.email, user_role.name 
            FROM $table_name AS users
            INNER JOIN $role_table AS user_role ON users.role = user_role.id
            $search_condition 
            $order_by LIMIT $start, $length";

    // Execute the query
    $result = $conn->query($sql);

    // Fetch the data and build the output array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Get the total number of records after filtering (for pagination)
    $sql_filtered_total = "SELECT COUNT(*) AS total 
                           FROM $table_name AS users
                           INNER JOIN $role_table AS user_role ON users.role = user_role.id
                           $search_condition";
    $result_filtered_total = $conn->query($sql_filtered_total);
    $row_filtered_total = $result_filtered_total->fetch_assoc();
    $filtered_records = $row_filtered_total['total'];

    // Get the total number of records without filtering (for pagination)
    $sql_total = "SELECT COUNT(*) AS total 
                  FROM $table_name AS users
                  INNER JOIN $role_table AS user_role ON users.role = user_role.id";
    $result_total = $conn->query($sql_total);
    $row_total = $result_total->fetch_assoc();
    $total_records = $row_total['total'];

    // Output the data in DataTables format
    echo json_encode([
        'draw' => isset($_POST['draw']) ? (int) $_POST['draw'] : 1,  // Draw counter for DataTables
        'recordsTotal' => $total_records, // Total records in the database (unfiltered)
        'recordsFiltered' => $filtered_records, // Total records after search filter
        'data' => $data, // Data rows to be displayed
        'POST' => $search,
    ]);

    exit();
}
