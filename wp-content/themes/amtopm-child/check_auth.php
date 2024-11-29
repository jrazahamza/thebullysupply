<?php

include('connection.php'); // Include your database connection here


if (isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] != 0) {
    echo 'redirect';
} else {
    echo 'no';
}


// header('Content-Type: application/json'); // Set the response header to JSON

// $userEmailCheck = mysqli_query($con, "SELECT * FROM `account`");

// if ($userEmailCheck) {
//     $userEmailCheckResult = mysqli_fetch_array($userEmailCheck, MYSQLI_ASSOC);
    
//     echo 'yes'; // Encode data as JSON and output it
// } else {
//     echo json_encode(['error' => 'Database query failed']);
// }
?>
