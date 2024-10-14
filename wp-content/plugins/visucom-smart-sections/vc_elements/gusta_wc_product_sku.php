<?php
/*
* Visual Composer Product SKU & Shortcode
*
* @file           vc_elements/gusta_wc_product_sku.php
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
Element Description: Gusta Product SKU
*/

    // Element HTML
    function gusta_product_sku_html( $atts ) {
		ob_start();
		global $parent, $product;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_wc_product_sku');
		extract($att);
		
		if ($the_post):

			if (get_post_type($the_post)=='product'):
		
				$mobile_disp = gusta_mobile_display($att);
			
				echo '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div class="'.$vc_id.' gusta-product-sku ss-element '.$el_class.'">';
			
			
				if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : 
					echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'mb_framework' ); 
				endif;
			
				echo '</div></div>';
			
				echo gusta_clear($att);
				
			endif;
				
		endif;
		
		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_product_sku', 'gusta_product_sku_html' );


		$params = array (
			gusta_vc_id('product-sku'),
		);
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'SKU', 'mb_framework' ), 'el_slug' => 'sku', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product SKU", "mb_framework"), // add a name
				"base" => "gusta_wc_product_sku", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);