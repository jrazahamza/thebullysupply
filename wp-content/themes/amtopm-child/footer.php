<?php
/**
* The template for displaying the footer.
*
* @package Salient WordPress Theme
* @version 12.2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nectar_options = get_nectar_theme_options();
$header_format  = ( !empty($nectar_options['header_format']) ) ? $nectar_options['header_format'] : 'default';

nectar_hook_before_footer_open();

?>

<!-- ruk custom footer  -->


<!-- Top Categories Section -->
<section class="categories-section py-5">
	<div classs="our-partners">
		<div class="container-ruk">
        <h2 class="text-left mb-5">Our Partners</h2>
		<div class="partners-logos d-flex justify-content-between">
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316255.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316256.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316257.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316258.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316259.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316255.png" /> </div>
		</div>
		</div>
	</div>
    <div class="container-ruk">
        <h2 class="text-left mb-5">OUR TOP CATEGORIES</h2>
        <div class="row ruk-row">
            <div class="col-md-2">
                <h3>Bully</h3>
                <ul>
                    <li>American Bulldog</li>
                    <li>American Bully</li>
                    <li>American Bully Classic</li>
                    <li>American Bully Extreme</li>
                    <li>American Bully Pocket</li>
                    <li>American Bully Standard</li>
                    <li>Bull Terrier</li>
                    <li>American Bully XL</li>
                    <li>American Pit Bull Terrier</li>
                    <li>American Staffordshire Terrier</li>
                    <li>Cane Corso</li>
                    <li>Doberman</li>
                    <li>More...</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Supplies</h3>
                <ul>
                    <li>Beds</li>
                    <li>Hoodies & Sweaters</li>
                    <li>Coats & Jackets</li>
                    <li>Costumes & Jersey</li>
                    <li>Carriers</li>
                    <li>Kennels</li>
                    <li>Car Accessories</li>
                    <li>Strollers & Bicycle Trailers</li>
                    <li>Collars</li>
                    <li>Leashes</li>
                    <li>More...</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Supplies</h3>
                <ul>
                    <li>Beds</li>
                    <li>Blankets</li>
                    <li>Furniture Covers</li>
                    <li>Bowls & Dishes</li>
                    <li>Elevated Bowls</li>
                    <li>Feeders</li>
                    <li>Travel Bowls</li>
                    <li>Cleaning Supplies</li>
                    <li>Memorials & Keepsakes</li>
                    <li>More...</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Food & Supplements</h3>
                <ul>
                    <li>Anxiety & Calming</li>
                    <li>Dry Food, Wet Food</li>
                    <li>Frozen, Freeze-Dried Food</li>
                    <li>Health Supplements</li>
                    <li>Treats</li>
                    <li>Vitamins & Multivitamins</li>
                    <li>More...</li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Care & Services</h3>
                <ul>
                    <li>Milk Replacers</li>
                    <li>Reproduction Equipment</li>
                    <li>Grooming & Spa</li>
                    <li>Transportation Services</li>
                    <li>Pregnancy Test</li>
                    <li>Ultrasound</li>
                    <li>Vaccinations & Heartworm Test</li>
                    <li>Veterinary Services</li>
                    <li>More...</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<!-- Newsletter Section -->
<div class="newsletter-section">
    <div class="newsletter-left">
        <h2>REGISTER NOW SO YOU DON'T MISS OUR PROGRAMS</h2>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email here...">
            <button type="submit">Subscribe</button>
        </form>
        <label class="checkbox-container">
            <input type="checkbox">
            By checking the box, you agree that you are at least 16 years of age.
        </label>
    </div>
    <div class="newsletter-right">
      <div class="newsletter-con">
        <h2>ARE YOU BULLY<br> CERTIFIED?</h2>
        <p class="get-your-go">Get your go-to brands at discount prices.</p>
        <p> Just for Pros</p>
        </div>
        <div class="right-button">
          <button class="bully-certified">Be a Bully Certified</button>          
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-links">
     <div class="footer-left">
       <div class="logo">
           <img src="/wp-content/uploads/2024/10/thebullysupply-logo.png" alt="The Bully Supply Logo">
       </div>
       <div class="social-links">
		   <ul>
			   <li><a href="mailto:support@thebullysupply.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> support@thebullysupply.com</a></li>
			   <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 6391 Elgin St. Celina, Delaware 10299</a></li>
		   </ul>
        <div class="social-icons">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
        </div>         
       </div>
    </div>
        <div class="footer-column">
            <h3>Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Blogs</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Categories</h3>
          <div class="sub-cta-list">
            <ul>
                <li><a href="#">Bullies</a></li>
                <li><a href="#">Pups</a></li>
                <li><a href="#">Studs</a></li>
                <li><a href="#">Breedings</a></li>
            </ul>
             <ul>
                <li><a href="#">Breeders</a></li>
                <li><a href="#">Supplies</a></li>
                <li><a href="#">Food </a></li>
                <li><a href="#">More</a></li>
            </ul>
            </div>
        </div>
        <div class="footer-column">
            <h3>Let Us Help</h3>
            <ul>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Vendor Onboarding</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 Bully Supply. All rights reserved.</p>
        <ul class="footer-terms">
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
    </div>
</footer>


<!-- end ruk custom footer -->



<div id="footer-outer" <?php nectar_footer_attributes(); ?>>
	
	
	<?php
	
	nectar_hook_after_footer_open();
	
// 	get_template_part( 'includes/partials/footer/call-to-action' );
	
// 	get_template_part( 'includes/partials/footer/main-widgets' );
	
// 	get_template_part( 'includes/partials/footer/copyright-bar' );
	
	?>
	
</div><!--/footer-outer-->

<?php

nectar_hook_before_outer_wrap_close();

get_template_part( 'includes/partials/footer/off-canvas-navigation' );

?>

</div> <!--/ajax-content-wrap-->

<?php
	
	// Boxed theme option closing div.
	if ( ! empty( $nectar_options['boxed_layout'] ) && 
	'1' === $nectar_options['boxed_layout'] && 
	'left-header' !== $header_format ) {

		echo '</div><!--/boxed closing div-->'; 
	}
	
	get_template_part( 'includes/partials/footer/back-to-top' );
	
	nectar_hook_after_wp_footer();
	nectar_hook_before_body_close();
	
	wp_footer();
?>
<script>
<?php
	$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $breed = isset($_GET['breed']) ? $_GET['breed'] : '';
    $priceMin = isset($_GET['min-price']) ? $_GET['min-price'] : '';
    $priceMax = isset($_GET['max-price']) ? $_GET['max-price'] : '';
    if($gender!=''){
    ?>
        jQuery('form[name="categoryFilter"] input.checkbox[value="<?php echo $gender; ?>"]').attr('checked','checked');
    <?php
    }
    if($color!=''){
    ?>
        jQuery('form[name="categoryFilter"] input.checkbox[value="<?php echo $color; ?>"]').attr('checked','checked');
    <?php     
    }
    if($breed!=''){
    ?>
        jQuery('form[name="categoryFilter"] input.checkbox[value="<?php echo $breed; ?>"]').attr('checked','checked');
    <?php      
    }
    if($priceMin!=''){
    ?>
        jQuery('form[name="categoryFilter"] input[name="min-price"]').val('<?php echo $priceMin; ?>');
    <?php    
    }
    if($priceMax!=''){
    ?>
        jQuery('form[name="categoryFilter"] input[name="max-price"]').val('<?php echo $priceMax; ?>');
    <?php    
    }
?>
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    jQuery(".formValidationQuery").validate();
    jQuery(".formValidationQuery1").validate();
    jQuery(".formValidationQuery2").validate();
    
    function readURL(input,id) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          jQuery('#'+id).attr('style', 'background-image:url('+e.target.result+')');
          jQuery('#'+id).hide();
          jQuery('#'+id).fadeIn(650);
          jQuery('#'+id).addClass('show');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    jQuery(".uploadImagePreviewer").change(function() {
      var id=jQuery(this).attr('data-preview')
      if(jQuery(this).val()!=''){
        readURL(this,id);
      }else{
        jQuery('#'+id).removeClass('show');  
        jQuery('#'+id).removeAttr('style');  
      }
    });
    
    jQuery(document).on('click','span.password i.show',function(){
        jQuery(this).parent().find('input').attr('type','text');
        jQuery(this).parent().find('i.show').hide();
        jQuery(this).parent().find('i.hide').show();
    });
    
    jQuery(document).on('click','span.password i.hide',function(){
        jQuery(this).parent().find('input').attr('type','password');
        jQuery(this).parent().find('i.hide').hide();
        jQuery(this).parent().find('i.show').show();
    });
    
    jQuery('.bannerSliders').slick({
        infinite: false,
        dots: false,
        arrows:false,
        autoplay: false
    });
    
    jQuery('.categoriesSlider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows:true,
        autoplay: true,
        autoplaySpeed: 3000,
		responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			infinite: true,
			dots: true
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
	  ]
    });
</script>
</body>
</html>