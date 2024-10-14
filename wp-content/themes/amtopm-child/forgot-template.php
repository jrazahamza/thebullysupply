<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/**
* Template Name: forgot-template
*
**/

$youremail = '';
$errorMessage='';
$successMessage='';

if(isset($_POST['submit'])){
    $youremail = $_POST['youremail'];
    
    $check=mysqli_query($con,"SELECT * FROM `account` where `username`='".$youremail."' or `email`='".$youremail."' ");      
    $checkResult = mysqli_fetch_array($check);
    if($checkResult['id']){

    	$random=date('i').(mt_rand()).date('h').date('s');
		mysqli_query($con,"INSERT INTO `forgot` (`userID`, `code`) VALUES ('".$checkResult['id']."','".$random."') ");

    	$to = $checkResult['email'];
        $subject = "Forgot Password Request";
        $txt = '<table style="background-color:#fff;max-width:670px;margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody><tr>
                <td style="height:80px">&nbsp;</td>
            </tr>
            <tr>
                <td>
                     <center><a href="https://thebullysupply.com/" title="logo" style="text-align:center;display:block" target="_blank" >
                         <center><img width="60" src="https://thebullysupply.com/wp-content/uploads/2024/05/logo.png" title="logo" alt="The Bully Supply" style="width:250px;margin:0px auto 25px" data-image-whitelisted="" class="CToWUd" > </center>
                    </a></center> 
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#ffffff;border-radius:6px;text-align:center;border:1px solid #eaeaea">
                        <tbody><tr>
                            <td style="height:25px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding:0 35px">
                                <h1 style="color:#1e1e2d;font-weight:500;margin:0px 0px 10px;font-size:30px">Forgot Password Request</h1>
                                <p style="color:#455056;font-size:15px;line-height:24px;margin:0;text-align:center;padding:20px 0px">
                                    <b style="display:block;margin-bottom:5px">Welcome  '.$checkResult['username'].'</b>
                                    <label style="display:block">Please click the below link to reset your password.<br><a href="https://bully.cloudstandly.com/reset?query='.$random.'">https://thebullysupply.com/reset?query='.$random.'</a></label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:40px">&nbsp;</td>
                        </tr>
                    </tbody></table>
                </td>
            </tr><tr>
                <td style="height:20px">&nbsp;</td>
            </tr>
            <tr>
                <td style="height:80px">&nbsp;</td>
            </tr>
        </tbody></table>';
        $headers  = "From: info@cloudstandly.com \r\n";
		$headers .= "Reply-To: info@cloudstandly.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to,$subject,$txt,$headers);

        $successMessage="Password reset link successfuly send to your email address";
    }else{
        $errorMessage="Email/Username not found in our record!";
    }

}

get_header(); 
?>

<section class="loginForm">
    <div class="container">
        <div class="row">
            <form name="login" method="post" class="formValidationQuery">
              <fieldset class="parent_register_field">
                <legend>Forgot Password</legend>
                <div class="form-outline">
                  <label class="form-label" for="youremail">Username/Email</label>
                  <input type="text" id="youremail" name="youremail"  value="<?php $youremail; ?>" class="form-control" required />
                </div>
                <div class="form-outline">
                <button type="submit" name="submit" class="register-btn">Submit</button>
                <p class="not-registered">Not registered yet?<a href="/register/" class="omnCamp omnrg_login">Register Now!</a></p>
                
                <?php if($successMessage!=''){ ?>
                    <p class="message-success"><?php echo $successMessage; ?></p>
                <?php } ?>

                <?php if($errorMessage!=''){ ?>
                    <p class="message-error"><?php echo $errorMessage; ?></p>
                <?php } ?>
                </div>
              </fieldset>
            </form>
        </div>
    </div>    
</section>


<?php get_footer(); ?>
<script>

</script>