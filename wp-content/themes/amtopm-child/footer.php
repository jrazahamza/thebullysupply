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
$subSubSiteUrl = get_site_url();
?>
<style>
	@font-face {
  font-family: 'Novaklasse';
  src: url('/wp-content/themes/amtopm-child/fonts/novaklasse-semibold.otf');
  font-weight: normal;
  font-style: normal;
	}

	  /* Custom styles */
    .hero-section {
      background-color: #012c4b;
      color: #fff;
      padding: 60px 0;
      position: relative;
      overflow: hidden;
    }

    .hero-section .text-content {
      z-index: 1;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
      line-height: 1.2;
    }

    .hero-section p {
      font-size: 1rem;
      margin-top: 15px;
    }
/*     .hero-section .hero-image {
      position: absolute;
      top: 50%;
      right: 15%;
      transform: translateY(-50%);
      width: 200px;
    }
 */
.feature-section {
    margin-top: 22px;
}
    .feature-card {
      background-color: #012c4b;
      color: #fff;
      border: none;
      padding: 26px 42px;
      border-radius: 5px;
	  height:174px;
	text-align:left;
/*       transition: transform 0.3s ease; */
    }

/*     .feature-card:hover {
      transform: scale(1.05);
    } */

    .feature-card:nth-child(2) {
      background-color: #b21747;
    }

  .feature-card h5 {
    font-size: 14px;
    font-weight: 900;
    color: #fff;
    margin-top: 14px;
    text-transform: uppercase;
	font-family: 'Manrope';
    }

    .feature-card p {
      font-size: 11px;
      line-height: 20px;
    }

    .feature-card i {
      font-size: 2rem;
      margin-bottom: 10px;
    }
	.feature-card-bgcolor{
	 background-color:#8B1339;
	}
.hero-ruk-full {
    background-image:url('/wp-content/uploads/2024/11/bullybanner-1321316304.png');
    background-size:cover;
    background-repeat:no-repeat;
    background-position:left center;
/*    max-height:552px; */
}
.dog-listing-heading {
    display: flex;
    align-items: flex-start !important;
}

@media (min-width: 1800px) {
    .hero-ruk-full {
        height: 552px;
    }
}	
@media screen and (max-width: 425px) {

.dog-listing-heading h2 {
    font-size: 13px !important;
}
 .hero-ruk-full {
    background-image: url(/wp-content/uploads/2024/11/mobile1321316306.png) !important;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: left center;
    /* max-height: 552px; */
} 
 .hero-ruk-full h1 {
    font-size: 25px !important;
    font-weight: bold;
    max-width: 378px !important; 
   margin-top: -36px !important;
}
.hero-ruk-full  .entire-bully {
    width: 160px;
}  
}  
.footer-banner-col-1 {
    display: flex;
    align-items: center;
    height: 100%;
}
.hero-ruk-full h1 {
    color: #fff;
    font-family: Novaklasse;
    font-size:36px;
    font-weight:bold;
    max-width:654px;
    margin-top:40px;
}
.hero-ruk-full p{
    color:#C3CAD1;
    font-size:12px;
    width:704px;
}

.hero-ruk-full .single-hearo-img img {
    width: 645px;
	padding-top:60px;
}
	
	
.cta-footer-list {
  column-count: 4;
  column-gap: 20px; /* Adjust gap between columns as needed */
}
.cta-footer-list li {
    list-style: none;
}
.cta-footer-list li {
  break-inside: avoid; /* Prevent items from breaking between columns */
  margin-bottom: 10px; /* Adjust space between items as needed */
}
	li{
		list-style: none;
		text-decoration: none;
	}

.our-top-cta {
    margin-top: 24px;
}	
	

@media screen and (max-width: 768px) {
.newsletter-section {
    background: linear-gradient(to top, #0B1E3E 50%, #003459 50%);
}
 .newsletter-se-content {
    width: 100%;
    display: flex;
  flex-direction: column;
}
.newsletter-left, .newsletter-right {
    width: 100%;
}
}	
</style>


  <!-- Hero Section -->

  <section class="hero-section hero-ruk-full">    
    <div class="ruk-footer-banner-row container-footer">
      <div class="footer-banner footer-banner-col-1">
		<div class="text-left">		  
        <h1>Stay Tuned For The Launch Of Our New App!</h1>
        <p class="entire-bully">Entire Bully World in the pal of our hand</p>
		</div>
      </div>
<!-- 	 <div class="footer-banner footer-banner-col-2">
	  <div class="single-hearo-img">
      <img src="/wp-content/uploads/2024/11/mobile1321316318.png" alt="App Preview" class="hero-image d-none d-md-block">
	 </div>
    </div> -->
	 </div>	
  </section>


  <section class="feature-section">
    <div class="container-footer">
      <div class="row text-center feature-three-cards">
        <div class="col-md-4 mb-4">
          <div class="feature-card p-4">
            <div class="card-ruk-img">
				<img src="/wp-content/uploads/2024/10/findbully.png" alt="car-img" />
			  </div>
            <h5>Find Bully</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card fture2 p-4 feature-card-bgcolor">
            <div class="card-ruk-img">
				<img src="/wp-content/uploads/2024/10/call.png" alt="car-img" />
			  </div>
            <h5>Contact Seller</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card p-4">
            <div class="card-ruk-img">
				<img src="/wp-content/uploads/2024/10/Groups.png" alt="car-img" />
			  </div>
            <h5>Adopt Bully</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  
<!-- ruk custom footer  -->
					
<!-- Top Categories Section -->
<section class="categories-section py-5">
	<div classs="our-partners">
		<div class="container-footer">
        <h2 class="text-left">Our Partners</h2>
		<div class="partners-logos d-flex justify-content-between gap-2">
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316255.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316256.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316257.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316258.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316259.png" /> </div>
			<div class="logo"><img src="/wp-content/uploads/2024/10/Group-1321316255.png" /> </div>
		</div>
		</div>
	</div>
	
	<!-- 	new our top cta sec -->
<!-- 	<div class="container-footer">
        <h2 class="text-left mb-5">OUR TOP CATEGORIES</h2>
          
		<div class="row ruk-row">
				<div class="col-md-2 foo-cta-list-col">
					<h3>Bully</h3>
					<ul>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
				</div>			
				<div class="col-md-2 foo-cta-list-col">
					<h3>Supplies</h3>
					<ul>
                     	<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
				</div>
				<div class="col-md-2 foo-cta-list-col">
					<h3>Supplies</h3>
					<ul>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
				</div>
				<div class="col-md-2 foo-cta-list-col">
					<h3>Supplies</h3>
					<ul>
                     	<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
						<h3>Food & Supplements</h3>
					<ul>					
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>					
						<h3>Care & Services</h3>					
					<ul>						
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
				</div>			
				<div class="col-md-2 foo-cta-list-col">
					<h3>Care & Services</h3>
					<ul>
                     	<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
						<li class="cta-footer-list"><a href="#">American Bulldog</a></li>
					</ul>
				</div>			
		</div>
    </div> -->
	
	
	<div class="container-footer">
		<div class="our-top-cta">			
		<h2 class="text-left">OUR TOP CATEGORIES</h2>
		<ul class="cta-footer-list">
			<?php
			global $wpdb;
			$top_categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = 0 ORDER BY id ASC");
			foreach ($top_categories as $top_category) {
				echo '<h3>' . esc_html($top_category->name) . '</h3>';

				$first_level_subcategories = $wpdb->get_results($wpdb->prepare(
					"SELECT id, name FROM `categories` WHERE parent_id = %d ORDER BY name ASC",
					$top_category->id
				));

				foreach ($first_level_subcategories as $first_level_subcategory) {
					if (!in_array($first_level_subcategory->id, [33, 34, 35, 36])) {
						$second_level_subcategories = $wpdb->get_results($wpdb->prepare(
							"SELECT id, name FROM `categories` WHERE parent_id = %d ORDER BY name ASC",
							$first_level_subcategory->id
						));

						if (empty($second_level_subcategories)) {
							$firstLevelCategoryParam = urlencode($first_level_subcategory->name);
							echo '<li><a href="' . esc_url($subSubSiteUrl . '/category/?search_sub_sub_category=' . $firstLevelCategoryParam) . '">' . esc_html($first_level_subcategory->name) . '</a></li>';
						} else {
							foreach ($second_level_subcategories as $second_level_subcategory) {
								$subSubCategoryParam = urlencode($second_level_subcategory->name);
								echo '<li><a href="' . esc_url($subSubSiteUrl . '/category/?search_sub_sub_category=' . $subSubCategoryParam) . '">' . esc_html($second_level_subcategory->name) . '</a></li>';
							}
						}
					}
				}
			}
			?>
		</ul>
		</div>
	</div>

	
</section>



<!-- Newsletter Section -->
<div class="newsletter-section">
	<div class="container-footer">
		<div class="newsletter-se-content">
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
				<h2>ARE YOU BULLY CERTIFIED?</h2>
				<p class="get-your-go">Get your go-to brands at discount prices.</p>
				<p> Just for Pros</p>
				</div>
				<div class="right-button">
				  <button class="bully-certified">Be a Bully Certified</button>          
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer Section -->
<footer class="footer">
	<div class="container-footer">
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
                <li><a href="/about-us/">About</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="/blog/">Blogs</a></li>
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
                <li><a href="/contact-us/">Contact Us</a></li>
            </ul>
        </div>
    </div>
	</div>
	<div class="container-footer">
       <div class="footer-bottom">		
        <div class="copyright">
		   <p>© 2024 Bully Supply. All rights reserved.</p>
		</div>
        <ul class="footer-terms">
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
		</div>
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
// document.querySelector('.page-id-615').innerHTML = document.querySelector('.page-id-615').innerHTML.replace(/&nbsp;/g, ' ');

 $('.feature-three-cards').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
			dots: false,
			 responsive: [                
				{
                    breakpoint: 1124,
                    settings: {
                        slidesToShow: 2
                    }
                },				 
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

	
function filterCountries() {
    const searchInput = document.querySelector('.search-box').value.toLowerCase();
    const countryList = document.getElementById('country-list');
    const countries = countryList.getElementsByTagName('li');

    for (let i = 0; i < countries.length; i++) {
        const countryName = countries[i].innerText.toLowerCase();
        countries[i].style.display = countryName.includes(searchInput) ? '' : 'none';
    }
}
	
	
</script>
<script>
    jQuery(".formValidationQuery").validate();
    jQuery(".formValidationQuery1").validate();
    jQuery(".formValidationQuery2").validate();
    
	function readURL(input, id) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				jQuery('#' + id).css('background-image', 'url(' + e.target.result + ')');
				jQuery('#' + id).hide();
				jQuery('#' + id).fadeIn(650);
				jQuery('#' + id).addClass('show');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	jQuery(".uploadImagePreviewer").change(function() {
		var id = jQuery(this).attr('data-preview');

		if (jQuery(this).val() !== '') {
			readURL(this, id);
		} else {
			jQuery('#' + id).removeClass('show');
			jQuery('#' + id).removeAttr('style');
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