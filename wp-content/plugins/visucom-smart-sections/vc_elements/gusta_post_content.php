<?php
/*
* Visual Composer Post Content Element & Shortcode
*
* @file           vc_elements/gusta_post_content.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.1
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Content
*/

// Element HTML
    function gusta_post_content_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = $the_content = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'el_class' => ''
		), $atts, 'gusta_post_content');
		extract($att);
		
		if ($the_post):
			$the_content = wpautop($the_post->post_content);
		endif;
		
		if (strpos($the_content, 'post_content') === false):
			
			$output = '<div class="'.$vc_id.' ss-element gusta-post-content '.$el_class.'">'.do_shortcode($the_content).'</div>';
			
		else:
			
			$output = '<div class="gusta_notice">'.__('Hey Silly! Inserting the "Post Content" inside the "Post Content" will create a loop hole in space which will swallow the Earth! Sorry, we can\'t let that happen! :)', 'mb_framework').'<div>';
			
		endif;
		
		return $output;
        
    }

    add_shortcode( 'gusta_post_content', 'gusta_post_content_html' );
     
    // Element Mapping
        global $post, $post_type;

		$params = array (
			gusta_vc_id('content'),
			gusta_vc_extra_class_name(),
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Content Container', 'mb_framework' ), 'el_slug' => 'content', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Content", "mb_framework"), // add a name
				"base" => "gusta_post_content", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset ($params);    