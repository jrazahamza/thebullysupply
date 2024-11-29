<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

include('connection.php'); // Ensure your database connection here

    echo json_encode(['success' => false, 'errorMessage' => $_POST['signup']]);


try {
if(isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['fullname']);
    $useremail = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $createNewUser = true;
    $errorMessageSignup = '';

    // Password match validation
    if($password !== $confirmPassword) {
        $createNewUser = false;
        $errorMessageSignup = "Password and confirm password do not match!";
    }

    // Check if username exists
    $userNameCheck = mysqli_query($con, "SELECT id FROM `account` WHERE `username` = '$username'");
    if ($createNewUser && mysqli_num_rows($userNameCheck) > 0) {
        $createNewUser = false;
        $errorMessageSignup = "The username already exists. Please try another unique username!";
    }

    // Check if email exists
    $userEmailCheck = mysqli_query($con, "SELECT id FROM `account` WHERE `email` = '$useremail'");
    if ($createNewUser && mysqli_num_rows($userEmailCheck) > 0) {
        $createNewUser = false;
        $errorMessageSignup = "The email already exists. Please try another email address!";
    }

    // If valid, proceed with user creation
    if($createNewUser) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password
        $insert = mysqli_query($con, "INSERT INTO `account`(`username`, `email`, `password`, `status`, `role`) 
                                      VALUES ('$username', '$useremail', '$hashedPassword', 1, 'vendor')");

        $userID = mysqli_insert_id($con);

        if($userID) {
            mysqli_query($con, "INSERT INTO `address`(`userID`, `status`) VALUES ('$userID', 1)");
            mysqli_query($con, "INSERT INTO `shop`(`userID`, `status`) VALUES ('$userID', 1)");

            setcookie("user_id", $userID, time() + (86400 * 30), "/");
            setcookie("user_role", 'vendor', time() + (86400 * 30), "/");

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'errorMessage' => 'Registration has failed. Please try again later.']);
        }
    } else {
        echo json_encode(['success' => false, 'errorMessage' => $errorMessageSignup]);
    }
} else {
    echo json_encode(['success' => false, 'errorMessage' => 'Form submission error.']);
}
} catch (Exception $e) {
    // Log the error message and respond with a JSON error message
    error_log("Error in auth.php: " . $e->getMessage()); // Logs to the PHP error log
    echo json_encode(['success' => false, 'errorMessage' => $e->getMessage()]);
    exit;
}
exit;
?>
