<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/**
* Template Name: register-template
*
**/

$username='';
$useremail='';
$contactNumber='';
$password='';
$confirmPassword='';
$errorMessage='';

if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$useremail = $_POST['useremail'];
	$contactNumber = $_POST['contactNumber'];
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

get_header(); 
?>

<section class="loginForm ruk-login-bg">
        <div class="row login-content">
			<dvi class="col-md-4 login-left">
				<a href="https://thebullysupply.com/"><img src="https://thebullysupply.com/wp-content/uploads/2024/09/Group-1.png"></a>

				<img src="https://thebullysupply.com/wp-content/uploads/2024/09/image-44.png">
			</dvi>
			<div class="col-md-8 login-right">
            <form name="login" method="post" class="formValidationQuery">
              <fieldset class="parent_register_field">
                <legend>Registration</legend>
                
                <?php if($errorMessage!=''){ ?>
                <p class="message-error"><?php echo $errorMessage; ?></p>
              	<?php } ?>

              	<?php if($successMessage!=''){ ?>
                    <p class="message-success"><?php echo $successMessage; ?></p>
                <?php } ?>

                <div class="form-outline second">
		        	<label for="username">Username</label>
			        <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="form-control" required>
		        </div>

		        <div class="form-outline second left">
		        	<label for="useremail">Email</label>
			        <input type="email" id="useremail" name="useremail" value="<?php echo $useremail; ?>" class="form-control" required>
		        </div>

		        <div class="form-outline second">
		        	<label for="contactNumber">Contact Number</label>
			        <input type="tel" id="contactNumber" name="contactNumber" value="<?php echo $contactNumber; ?>" class="form-control" required>
		        </div>

		        <div class="form-outline second left">
		        	<label for="password">Password</label>
			        <span class="password"><input type="password" id="password" name="password" value="<?php echo $password; ?>" class="form-control" required><i class="fa fa-eye show"></i><i class="fa fa-eye-slash hide" style="display:none;"></i></span>
		        </div>
		        
		        <div class="form-outline second left">
		        	<label for="confirmPassword">Confirm Password</label>
			        <span class="password"><input type="password" id="confirmPassword" name="confirmPassword" value="<?php echo $confirmPassword; ?>" class="form-control" required><i class="fa fa-eye show"></i><i class="fa fa-eye-slash hide" style="display:none;"></i></span>
		        </div>
		        
		        <div class="form-outline">
		            <button type="submit" name="submit" class="register-btn">Register</button>
		            <p class="not-registered">Already have an account?<a href="/login/" class="omnCamp omnrg_login">Login</a></p>
		        </div>
              </fieldset>
            </form>

		  <div class="social-icons-container">
			<div class="social-icons-line">
			  <span>or</span>
			</div>

			<div class="login-options">
			  <div class="login-btn">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google">
			  </div>
			  <div class="login-btn">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Facebook-icon-1.png/512px-Facebook-icon-1.png" alt="Facebook">
			  </div>
			  <div class="login-btn">
				<img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple">
			  </div>
			</div>
		  </div>

  
		</div>
    </div>
</section>

<?php get_footer(); ?>
<script>

</script>