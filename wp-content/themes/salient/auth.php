<?php

include ('connection.php');


// login
$youremail = '';
$password = '';
$errorMessage = '';

if (isset($_POST['login'])) {
    $youremail = $_POST['youremail'];
    $password = $_POST['password'];

    // Database connection code yahan add karein
    $check = mysqli_query($con, "SELECT * FROM `account` WHERE (`username`='" . $youremail . "' OR `email`='" . $youremail . "') AND `password`='" . $password . "'");      
    $checkResult = mysqli_fetch_array($check);
	
	
	 if (!$check) {
		 $errorMessage = "Error in query: " . mysqli_error($con);
		 echo "<p style='color: red;'>$errorMessage</p>";
		 return;
	 }

    if ($checkResult['id']) {
        if ($checkResult['status'] == '1') {
            setcookie("user_id", $checkResult['id'], time() + (86400 * 30), "/");
            setcookie("user_role", $checkResult['role'], time() + (86400 * 30), "/");

            if (!empty($_POST["remember"])) {
                setcookie("youremail", $_POST["youremail"], time() + (86400 * 30), "/");
                setcookie("password", $_POST["password"], time() + (86400 * 30), "/");
            } else {
                setcookie("youremail", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            header('Location: /post-an-ad/');
        } else {
            $errorMessage = "Your account is inactive. Kindly contact admin to activate your account!";
        }
    } else {
        $errorMessage = "Invalid login credentials!";
    }
}



// register
$username='';
$useremail='';
$contactNumber='';
$password='';
$confirmPassword='';
$errorMessage='';

if(isset($_POST['signup'])){

	$username = $_POST['fullname'];
	$useremail = $_POST['email'];
// 	$contactNumber = $_POST['contactNumber'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	
	$createNewUser=true;
	
	if($password!=$confirmPassword){
	    $createNewUser=false;
		$errorMessage="Password and confirm password not match!";
	}

	$userNameCheck=mysqli_query($con,"SELECT * FROM `account` where `username`='".$username."' ");      
	$userNameCheckResult = mysqli_fetch_array($userNameCheck);
	if($createNewUser && $userNameCheckResult['id']){
		$createNewUser=false;
		$errorMessage="The username already exists. Please try another unique username!";
	}
	$userEmailCheck=mysqli_query($con,"SELECT * FROM `account` where `email`='".$useremail."' ");      
	$userEmailCheckResult = mysqli_fetch_array($userEmailCheck);
	if($createNewUser && $userEmailCheckResult['id']){
		$createNewUser=false;
		$errorMessage="The email already exists. Please try another email address!";
	}

	if($createNewUser){

		$insert=mysqli_query($con," INSERT INTO `account`(`username`, `email`, `contact`, `password`, `firstname`, `lastname`, `newsletter`, `profile`, `state`, `status`, `role`) 
        VALUES ('".$username."','".$useremail."','".$contactNumber."','".$password."','','','','','','1','vendor') ");
        
        $userID = mysqli_insert_id($con);
        
		if($userID){
			
			mysqli_query($con," INSERT INTO `address`(`userID`, `street`, `city`, `state`, `postal`, `country`, `shipStreet`, `shipCity`, `shipState`, `shipPostal`, `shipCountry`, `status`) 
			VALUES ('".$userID."','','','','','','','','','','',1) ");
			
			mysqli_query($con," INSERT INTO `shop`(`userID`, `name`, `email`, `phone`, `company`, `description`, `street`, `city`, `state`, `slug`, `profile`, `status`) 
			VALUES ('".$userID."','','','','','','','','','','',1) ");
			
			setcookie("user_id",$userID, time() + (86400 * 30), "/");
            setcookie("user_role",'vendor', time() + (86400 * 30), "/");
            
            header('Location: /form/');
	
		}else{
		    $errorMessage="Registration has failed!";
		}		

	}

}

?>