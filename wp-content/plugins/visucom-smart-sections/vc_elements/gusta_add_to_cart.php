<?php
/*
* Visual Composer Add to Cart Element & Shortcode
*
* @file           vc_elements/gusta_add_to_cart.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Add to Cart
*/
 
// Element HTML
    function gusta_add_to_cart_html( $atts ) {
		ob_start();
		global $parent, $product;
		$the_post = $parent;
		if (!$product): $product = wc_get_product($the_post->ID); endif;
		if ($product): $the_post=get_post($product->get_id()); endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = $the_date = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'add_to_cart_detail' => 'simple_button',
			'element_tag' => 'p',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_add_to_cart');
		extract($att);
		
		$post_id='';
		if ($the_post):
			$post_id = $the_post->ID;
		endif;
		
		if ($post_id):
			$link_class='';
			
			if (isset($animation) && $animation!='none'):
				$el_class = ' ani-'.$animation.'';
			endif;
			
			$mobile_disp = gusta_mobile_display($att);
			
			echo '<div class="gusta-add-to-cart gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.' woocommerce"><div class="'.$vc_id.' ss-element product gusta-add-to-cart '.$visibility.' '.$el_class.'">';
			
			if ($add_to_cart_detail=='detailed'):
				if ($product):
					woocommerce_template_single_add_to_cart ();
					//do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
				endif;
			else:
				echo '<a href="'.site_url().'/?add-to-cart='.$post_id.'" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.$post_id.'" aria-label="'.__('Add to Cart', 'mb_framework').'" rel="nofollow">'.__('Add to Cart', 'mb_framework').'</a>';
			endif;
			
			echo '</div></div>';
			
			echo gusta_clear($att);
			
			$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
			
			
		endif;
        
    }

    add_shortcode( 'gusta_add_to_cart', 'gusta_add_to_cart_html' );
	


    // Element Mapping
		
		$params = array (
			gusta_vc_id('add-to-cart'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Add to Cart Detail', 'mb_framework' ),
				'param_name' => 'add_to_cart_detail',
				'admin_label' => true,
				'value' => array(
					__('Simple Button', 'mb_framework')   => 'simple_button',
					__('Detailed', 'mb_framework')   => 'detailed'
				),
				'description' => __( 'If you select "Detailed", all the options for variation products will be displayed.', 'mb_framework' ),
				'std' => 'button'
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
				"name" => __("Add to Cart Button", "mb_framework"), // add a name
				"base" => "gusta_add_to_cart", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
     
     unset($params);