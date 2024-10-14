<?php
/*
* Visual Composer Post Excerpt Element & Shortcode
*
* @file           vc_elements/gusta_post_excerpt.php
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
Element Description: Gusta Post Excerpt
*/

// Element HTML
    function gusta_post_excerpt_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if ($the_post=='' && isset($product)): 
			if (is_tax()):
				$the_post=get_queried_object();
			else:
				$the_post=get_post($product->get_id()); 
			endif;
		endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
		$css = $el_class = $output = $the_permalink = $the_excerpt = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'element_tag' => 'p',
			'word_limit' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'add_link' => 'none',
			'link_custom_field_key' => '',
			'custom_url' => '',
			'link_target' => '',
			'no_follow' => '',
			'el_class' => ''
		), $atts, 'gusta_post_excerpt');
		extract($att);
		
		if ($word_limit==""): $word_limit = 99999999; endif;
		
		if ($the_post->name!=''): $the_excerpt = wp_trim_words( strip_shortcodes( strip_tags( $the_post->description ) ), $word_limit ); 
		elseif ($the_post):
			$the_excerpt = wp_trim_words($the_post->post_excerpt, $word_limit );
		endif;
		if ($the_excerpt=='' && $the_post->name==''): $the_excerpt = wp_trim_words( strip_shortcodes( strip_tags( get_the_content( '', true ) ) ), $word_limit ); endif;
		if ($the_excerpt=='' && $the_post->name==''): $the_excerpt  = get_the_archive_description(); endif;
		if ($the_excerpt=='' && is_home() && !$parent): $the_excerpt  = get_bloginfo( 'description' ); endif;
		
		if (is_author()):
			$the_excerpt = $the_post->description;
		endif;
		
		$link_class='';
		$linked = gusta_link($att, $the_post, $the_excerpt, $link_class, $no_follow);
		
		$el_class .= ' '.$visibility;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' ss-element gusta-post-excerpt '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_excerpt', 'gusta_post_excerpt_html' );
     
    // Element Mapping
        global $post;
		
    	$params = array (
			gusta_vc_id('excerpt'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Word Limit', 'mb_framework' ),
				'description' => __( 'The words in the content after this number will not be displayed. Leave empty to show all content (this feature will not work if the excerpt field is in use or Read More tag is added to the content).', 'mb_framework' ),
				'param_name' => 'word_limit',
				'admin_label' => false,
				'std' => ''
			)
		);

		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Excerpt', 'mb_framework' ), 'el_slug' => 'excerpt', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Excerpt", "mb_framework"), // add a name
				"base" => "gusta_post_excerpt", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				//'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);
     