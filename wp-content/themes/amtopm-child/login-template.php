<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include ('connection.php');
/**
* Template Name: login-template
*
**/

header('Location: /');


get_header(); 
?>
<!-- 
<section class="loginForm ruk-login-bg">
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
