<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/**
* Template Name: login-template
*
**/

if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"]>0){ 
   header("location: /dashboard/");
}

$youremail = '';
$password = '';
$errorMessage='';

if(isset($_POST['submit'])){
    $youremail = $_POST['youremail'];
    $password = $_POST['password'];
    
    $check=mysqli_query($con,"SELECT * FROM `account` where (`username`='".$youremail."' or `email`='".$youremail."') and `password`='".$password."' ");      
    $checkResult = mysqli_fetch_array($check);
    if($checkResult['id']){
        if($checkResult['status']=='1'){
            setcookie("user_id",$checkResult['id'], time() + (86400 * 30), "/");
            setcookie("user_role",$checkResult['role'], time() + (86400 * 30), "/");
            if(!empty($_POST["remember"])){
                setcookie("youremail",$_POST["youremail"], time() + (86400 * 30), "/");
                setcookie("password",$_POST["password"], time() + (86400 * 30), "/");
            }else{
                setcookie("youremail","");
                setcookie("password","");
            }
            header('Location: /dashboard/');
        }else{
            $errorMessage="Your account is inactive. Kindly contact admin to active your account!";
        }
    }else{
        $errorMessage="Invalid login credentials!";
    }

}

get_header(); 
?>


<section class="ruk-register-form">
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
			
			<!-- Modal Popup for Register Form -->
            <div class="container" id="signup-container" style="display: none;">
                <div class="logo">
                    <img src="/wp-content/uploads/2024/10/thepully-logo.png" alt="The Bally Supply Logo">
                </div>
                <h2>Register</h2>
                <p class="description">Ready to become part of the exclusive club? Fill in the details below, and let the journey begin!</p>
                
                <form name="signup" class="register-form" action="" method="post">
                    <div class="form-group">
                        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                        <span class="toggle-password" onclick="togglePassword('confirm-password')">👁️</span>
                    </div>
                    <button type="submit" name="signup" class="btn">Sign Up</button>
                </form>

                <div class="or-divider">or</div>

                <div class="social-buttons">
                    <button class="social-btn google"><img src="/wp-content/uploads/2024/10/google-icon.png" alt="google"/></button>
                    <button class="social-btn facebook"><img src="/wp-content/uploads/2024/10/facebook-icon.png" alt="facebook"/></button>
                    <button class="social-btn apple"><img src="/wp-content/uploads/2024/10/app-icon.png" alt="apple"/></button>
                </div>

                <p class="footer-text">
                    Already have an account? <a href="#" id="show-login">Sign in</a>
                </p>
            </div>
			
			
			<div class="container" id="login-container">
                <div class="logo">
                    <img src="/wp-content/uploads/2024/10/thepully-logo.png" alt="The Bally Supply Logo">
                </div>
                <h2>Login</h2>
                <p class="description">Ready to become part of the exclusive club? Fill in the details below, and let the journey begin!</p>
                
                <form name="login" method="post" class="formValidationQuery">
                    <div class="form-group">
                        <input type="email" id="youremail" name="youremail" placeholder="Email Address" value="<?php if(isset($_COOKIE["youremail"])) { echo $_COOKIE["youremail"]; } ?>" required />
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" required />
                        <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                    </div>
                    <button type="submit" name="login" class="btn">Sign In</button>
                </form>

                <div class="or-divider">or</div>

                <div class="social-buttons">
                    <button class="social-btn google"><img src="/wp-content/uploads/2024/10/google-icon.png" alt="google"/></button>
                    <button class="social-btn facebook"><img src="/wp-content/uploads/2024/10/facebook-icon.png" alt="facebook"/></button>
                    <button class="social-btn apple"><img src="/wp-content/uploads/2024/10/app-icon.png" alt="apple"/></button>
                </div>

                <p class="footer-text">
                    Already have an account? <a href="#" id="show-signup">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
</section>


<!-- <section class="loginForm ruk-login-bg">
        <div class="row login-content">
			<div class="col-md-4 login-left">
				<a href="https://thebullysupply.com/"><img src="https://thebullysupply.com/wp-content/uploads/2024/09/Group-1.png"></a>
			<img src="https://thebullysupply.com/wp-content/uploads/2024/09/image-44.png">
			</div>
			<div class="col-md-8 login-right">
            <form name="login" method="post" class="formValidationQuery">
              <fieldset class="parent_register_field">
                <legend>Login</legend>
                <div class="form-outline">
                  <label class="form-label" for="youremail">Username/Email</label>
                  <input type="text" id="youremail" name="youremail" value="<?php if(isset($_COOKIE["youremail"])) { echo $_COOKIE["youremail"]; } ?>" class="form-control" required />
                </div>
                <div class="form-outline">
                  <label class="form-label" for="password">Password</label>
                  <span class="password"><input type="password" id="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="form-control" required /><i class="fa fa-eye show"></i><i class="fa fa-eye-slash hide" style="display:none;"></i></span>
                </div>
                <div class="form-outline">
                    <div><input type="checkbox" name="remember" <?php if(isset($_COOKIE["youremail"])) { ?> checked <?php } ?> id="remember" />
                        <label for="remember-me">Remember me</label>
                    </div>
                <p class="not-registered forgot"><a href="/forgot/" class="omnCamp omnrg_login">Forgot password?</a></p>
                <button type="submit" name="submit" class="register-btn">Sign In</button>
                <p class="not-registered">Dont have an account?<a href="/register/" class="omnCamp omnrg_login">Register</a></p>
                <?php if($errorMessage!=''){ ?>
                    <p class="message-error"><?php echo $errorMessage; ?></p>
                <?php } ?>
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
    </section> -->
 
<?php get_footer(); ?>

<script>
	
document.getElementById('signup-container').style.display = 'none';
document.getElementById('login-container').style.display = 'block';

document.getElementById('show-login').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('signup-container').style.display = 'none';
    document.getElementById('login-container').style.display = 'block';
});

document.getElementById('show-signup').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('login-container').style.display = 'none';
    document.getElementById('signup-container').style.display = 'block';
});

	

// Function to toggle password visibility
function togglePassword(fieldId) {
    var input = document.getElementById(fieldId);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

// Modal functionality
const modal = document.getElementById("register-modal");
const openModal = document.getElementById("open-modal");
const closeModal = document.querySelector(".close");

// Open the modal when 'Register' link is clicked
openModal.addEventListener("click", function(e) {
    e.preventDefault();
	console.log('open modal');
    modal.style.display = "flex";  // Show modal as flex
});

// Close the modal when 'x' is clicked
closeModal.addEventListener("click", function() {
    modal.style.display = "none";
});

// Close the modal if clicking outside the content area
window.addEventListener("click", function(e) {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});	
	
</script>
