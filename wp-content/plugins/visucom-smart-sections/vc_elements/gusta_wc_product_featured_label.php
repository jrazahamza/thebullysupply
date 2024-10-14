<?php
/*
* Smart Sections Product Featured Label Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_featured_label.php
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
Element Description: Gusta Product Featured Label
*/

    // Element HTML
    function gusta_product_featured_label_html( $atts ) {
		ob_start();
		global $parent, $product;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'featured_label' => __('Featured', 'mb_framework'),
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_product_featured_label');
		extract($att);
		
		if ($the_post):

			if (get_post_type($the_post)=='product'):
				
				//print_r ($product);
				
				if ( $product->is_featured() ) :
		
					$mobile_disp = gusta_mobile_display($att);
			
					echo '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div class="'.$vc_id.' gusta-product-featured-label ss-element '.$el_class.'">';
				
					echo '<span>' . $featured_label . '</span>'; 
			
					echo '</div></div>';
			
					echo gusta_clear($att);
					
				endif;
				
			endif;
				
		endif;
		
		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_product_featured_label', 'gusta_product_featured_label_html' );



		$params = array (
			gusta_vc_id('product-featured-label'),
			array(
				'type' => 'textfield',
				'admin_label' => false,
				'heading' => __( 'Featured Label', 'mb_framework' ),
				'param_name' => 'featured_label',
				'std' => __('Featured', 'mb_framework'),
			),
		);
		
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Label', 'mb_framework' ), 'el_slug' => 'label', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Featured Label", "mb_framework"), // add a name
				"base" => "gusta_wc_product_featured_label", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);