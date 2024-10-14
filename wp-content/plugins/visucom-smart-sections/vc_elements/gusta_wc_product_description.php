<?php
/*
* Smart Sections Product Description Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_description.php
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
Element Description: Gusta Product Description
*/

    // Element HTML
    function gusta_product_description_html( $atts ) {
		global $parent;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
	        $css = $el_class = $output = $the_permalink = $the_content = ''; unset ($dynamic_css);
			
		$att = shortcode_atts(array(
			'vc_id' => '',
			'el_class' => ''
		), $atts, 'gusta_product_description');
		extract($att);
		
		if ($the_post):

			if (get_post_type($the_post)=='product'):
		
		
				$the_content = wpautop($the_post->post_content);
			
			
				if (strpos($the_content, 'post_content') === false):
				
					$output = '<div class="'.$vc_id.' ss-element gusta-product-description '.$el_class.'">'.do_shortcode($the_content).'</div>';
					
				else:
					
					$output = '<div class="gusta_notice">'.__('Sorry! You can not insert product description inside the post content or product description areas! :)', 'mb_framework').'<div>';
					
				endif;
				
			endif;
			
		endif;
		
		return $output;
    }


	add_shortcode( 'gusta_wc_product_description', 'gusta_product_description_html' );



		$params = array (
			gusta_vc_id('product-description'),
			gusta_vc_extra_class_name(),
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Description', 'mb_framework' ), 'el_slug' => 'description', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Description", "mb_framework"), // add a name
				"base" => "gusta_wc_product_description", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);