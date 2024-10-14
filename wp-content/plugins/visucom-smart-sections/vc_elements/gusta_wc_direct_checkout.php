<?php
/*
* Visual Composer Direct Checkout Element & Shortcode
*
* @file           vc_elements/gusta_wc_direct_checkout.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2020 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Direct Checkout
*/

    // Element HTML
    function gusta_direct_checkout_html( $atts ) {
		ob_start();
		global $parent;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'direct_checkout_text' => __( "Buy Now", 'mb_framework' ),
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_wc_direct_checkout');
		extract($att);
		
		if ($the_post):
		
			$post_id = $the_post->ID;

			if (get_post_type($the_post)=='product'):
		
				$mobile_disp = gusta_mobile_display($att);
			
				echo '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div class="'.$vc_id.' gusta-direct-checkout ss-element '.$visibility.' ani-'.$animation.' '.$el_class.'">';
			
			
				?>
				<form name="gusta_quick_checkout_form" class="gusta_quick_checkout_form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" method="GET">
						<button type="text" class="single_direct_checkout_button gusta_direct_checkout button alt" ><?php echo  $direct_checkout_text ?></button>
						<input type="hidden" name="product_id" value="<?php echo $post_id; ?>" />
						<input type="hidden" name="add-to-cart" value="<?php echo $post_id; ?>" />
						<input type="hidden" name="variation_id" class="gusta-variation-id" value="" />
						<input type="hidden" name="quantity" class="gusta-quantity" value="1" />
				</form>
				<?php
			
				echo '</div></div>';
			
				echo gusta_clear($att);
				
			endif;
				
		endif;
		
		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_direct_checkout', 'gusta_direct_checkout_html' );



		$params = array (
			gusta_vc_id('direct-checkout'),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Direct Checkout Text', 'mb_framework' ),
				'param_name' => 'direct_checkout_text',
				'std' => __('Buy Now', 'mb_framework'),
			),
		);
		
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Button', 'mb_framework' ), 'el_slug' => 'button', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Direct Checkout Button", "mb_framework"), // add a name
				"base" => "gusta_wc_direct_checkout", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);