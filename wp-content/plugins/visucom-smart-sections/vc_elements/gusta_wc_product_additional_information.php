<?php
/*
* Visual Composer Product Additional Information Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_additional_information.php
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
Element Description: Gusta Product Additional Information
*/

    // Element HTML
    function gusta_product_additional_information_html( $atts ) {
		ob_start();
		global $parent, $product;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
	        $css = $el_class = $output = $the_permalink = $the_content = ''; unset ($dynamic_css);
			
		$att = shortcode_atts(array(
			'vc_id' => '',
			'el_class' => ''
		), $atts, 'gusta_wc_product_additional_information');
		extract($att);
		
		if ($the_post):

			if (get_post_type($the_post)=='product'):
		
				echo '<div id="'.$vc_id.'" class="ss-element gusta-product-additional-information '.$el_class.'">';
				
				if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
					//wc_get_template( 'single-product/tabs/additional-information.php' );
					do_action( 'woocommerce_product_additional_information', $product );
				}
				
				echo '</div>';
				
			endif;
			
		endif;
		
		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_product_additional_information', 'gusta_product_additional_information_html' );



		$params = array (
			gusta_vc_id('product-additional-information'),
			gusta_vc_extra_class_name(),
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Table Values', 'mb_framework' ), 'el_slug' => 'values', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Table Titles', 'mb_framework' ), 'el_slug' => 'titles', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'additional_information', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Additional Information", "mb_framework"), // add a name
				"base" => "gusta_wc_product_additional_information", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);