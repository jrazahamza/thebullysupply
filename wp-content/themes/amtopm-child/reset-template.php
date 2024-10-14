<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/**
* Template Name: reset-template
*
**/

if(!isset($_GET["query"])){ 
   header("location: /login/");
}
$forgot=mysqli_query($con,"SELECT * FROM `forgot` where code='".$_GET['query']."' ");      
$forgotData=mysqli_fetch_array($forgot);
if(!$forgotData['id']){
    header("location: /login/");
}

$password = '';
$confirmPassword='';
$errorMessage='';

if(isset($_POST['submit'])){
    $userID = $_POST['user'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if($password==$confirmPassword){

    	mysqli_query($con,"UPDATE `account` SET `password`='".$password."' WHERE `id`=".$userID." ");
		mysqli_query($con,"DELETE FROM `forgot` WHERE userID='".$userID."' ");
		$check=mysqli_query($con,"SELECT * FROM `account` where `id`=".$userID." ");      
		$checkResult = mysqli_fetch_array($check);
	    setcookie("user_id",$checkResult['id'], time() + (86400 * 30), "/");
        setcookie("user_role",$checkResult['role'], time() + (86400 * 30), "/");
        header('Location: /dashboard/');

    }else{
    	$errorMessage='Password and confirm password not matched!';
    }
}

get_header(); 
?>

<section class="loginForm">
    <div class="container">
        <div class="row">
            <form name="login" method="post" class="formValidationQuery">
              <input type="hidden" name="user" value="<?php echo $forgotData['userID']; ?>">
              <fieldset class="parent_register_field">
                <legend>Reset Password</legend>
                <div class="form-outline">
                  <label class="form-label" for="password">Password</label>
                  <span class="password"><input type="password" id="password" name="password" class="form-control" required /><i class="fa fa-eye show"></i><i class="fa fa-eye-slash hide" style="display:none;"></i></span>
                </div>
                <div class="form-outline">
                  <label class="form-label" for="password">Confirm Password</label>
                  <span class="password"><input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required /><i class="fa fa-eye show"></i><i class="fa fa-eye-slash hide" style="display:none;"></i></span>
                </div>
                <div class="form-outline">
                    <?php if($errorMessage!=''){ ?>
                        <p class="message-error"><?php echo $errorMessage; ?></p>
                    <?php } ?>
                    <button type="submit" name="submit" class="register-btn">Reset</button>
                </div>
              </fieldset>
            </form>
        </div>
    </div>    
</section>

<?php get_footer(); ?>
<script>

</script>