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

<div id="footer-outer" <?php nectar_footer_attributes(); ?>>
	
	<?php
	
	nectar_hook_after_footer_open();
	
	get_template_part( 'includes/partials/footer/call-to-action' );
	
	get_template_part( 'includes/partials/footer/main-widgets' );
	
	get_template_part( 'includes/partials/footer/copyright-bar' );
	
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