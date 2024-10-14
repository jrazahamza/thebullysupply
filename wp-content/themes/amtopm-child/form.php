<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/*
* Template Name: Form
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

$errorMessage='';
if(isset($_POST['submit'])){
    
    $vendorName = $_POST['vendorName'];
    $vendorEmail = $_POST['vendorEmail'];
    $vendorPhone = $_POST['vendorPhone'];
    $vendorCompany = $_POST['vendorCompany']; 
    
    $insert=mysqli_query($con," UPDATE `shop` SET `name`='".$vendorName."',`email`='".$vendorEmail."',`phone`='".$vendorPhone."',`company`='".$vendorCompany."' WHERE `userID`='".$_COOKIE["user_id"]."' ");
        
    if($insert){
			
		header('Location: /dashboard/');

	}else{
	    $errorMessage="Record insert failed!";
	}
}

get_header();
?>
<section id="form-id" class="form-class">
    <div class="container-fluid">
        <div class="row">
            <div class="flex-form-class">
                <div class="flex-form-class-item flex-form-class-item01">
                    <div class="form-top-contennt">
                        <h2>Welcome to our Vendor Onboarding Page</h2>
                        <p>Take the first step towards growing your business and reaching a targeted audience of bully dog enthusiasts. Fill out the registration form below to become a vendor with The Bully Supply and get your free $350 Ad Credit today. We can't wait to welcome you to our community!</p>
                    </div>
                    <div class="vendor-contact-form">
                        <form method="post" id="vendor-contact-form-id" class="vendor-contact-form-class formValidationQuery">
                            <div class="vendor-form-block vendor-form-block01">
                                <input type="text" name="vendorName" id="full-name" placeholder="Full Name" required />
                            </div>
                            <div class="vendor-form-block vendor-form-block02">
                                <input type="email" name="vendorEmail" id="work-email" placeholder="Work Email" required />
                            </div>
                            <div class="vendor-form-block vendor-form-block03">
                                <input type="text" name="vendorPhone" id="phone-number" placeholder="Phone Number" required />
                            </div>
                            <div class="vendor-form-block vendor-form-block04">
                                <input type="text" name="vendorCompany" id="company" placeholder="Company" required />
                            </div>
                            <?php if($errorMessage!=''){ ?>
                            <p class="message-error"><?php echo $errorMessage; ?></p>
                          	<?php } ?>
                            <div class="vendor-form-block-btn">
                                <input type="submit" name="submit" value="Submit"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex-form-class-item flex-form-class-item02">
                    <div class="form-top-contennt">
                        <h2>Ready To Get Started?</h2>
                        <p>Are you passionate about bully dogs and their well-being? Do you offer products or services tailored to the unique needs of these beloved breeds? If so, we invite you to join our community of dedicated vendors!</p>
                        <p>At The Bully Supply, we're committed to providing bully dog enthusiasts with a curated selection of top-quality products and services. By registering as a vendor with us, you'll have the opportunity to showcase your offerings to a targeted audience of passionate pet owners and breed enthusiasts.</p>
                    </div>
                    <div class="accordion-div">
                        <h3>Why Register as a Vendor with Us?</h3>
                        <div class="accordions-class">
                            <div class="accordion-items">
                                <h4>Targeted Audience<span class="arrow-icon-class"><i class="fa fa-chevron-down"></i></span></h4>
                                <div class="accordion-content">
                                    <p>at The Bully Supply, we're committed to providing bully dog enthusiasts with a curated selection of top-quality products and services. By registering as a vendor with us, you'll have the opportunity to showcase your offerings to a targeted audience of passionate pet owners and breed enthusiasts.</p>
                                </div>
                            </div>
                            <div class="accordion-items">
                                <h4>Exposure and Visibility<span class="arrow-icon-class"><i class="fa fa-chevron-down"></i></span></h4>
                                <div class="accordion-content">
                                    <p>at The Bully Supply, we're committed to providing bully dog enthusiasts with a curated selection of top-quality products and services. By registering as a vendor with us, you'll have the opportunity to showcase your offerings to a targeted audience of passionate pet owners and breed enthusiasts.</p>
                                </div>
                            </div>
                            <div class="accordion-items">
                                <h4>Marketing Support<span class="arrow-icon-class"><i class="fa fa-chevron-down"></i></span></h4>
                                <div class="accordion-content">
                                    <p>at The Bully Supply, we're committed to providing bully dog enthusiasts with a curated selection of top-quality products and services. By registering as a vendor with us, you'll have the opportunity to showcase your offerings to a targeted audience of passionate pet owners and breed enthusiasts.</p>
                                </div>
                            </div>
                            <div class="accordion-items">
                                <h4>Easy Setup<span class="arrow-icon-class"><i class="fa fa-chevron-down"></i></span></h4>
                                <div class="accordion-content">
                                    <p>at The Bully Supply, we're committed to providing bully dog enthusiasts with a curated selection of top-quality products and services. By registering as a vendor with us, you'll have the opportunity to showcase your offerings to a targeted audience of passionate pet owners and breed enthusiasts.</p>
                                </div>
                            </div>
                          </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".accordion-items.active .accordion-content").show();

        jQuery(".accordion-items h4").click(function() {
            if (!jQuery(this).parent().hasClass("active")) {
                jQuery(".accordion-items").removeClass("active");
                jQuery(".accordion-content").slideUp();
                jQuery(this).next(".accordion-content").slideDown();
                jQuery(this).parent().addClass("active");
            }
        });
    });
</script>



<?php
get_footer();
?>