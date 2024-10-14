<?php
/*
* Visual Composer Product Title & Shortcode
*
* @file           vc_elements/gusta_wc_product_title.php
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
Element Description: Gusta Product Title
*/

    // Element HTML
    function gusta_product_title_html( $atts ) {
		global $parent;
		$the_post = $parent;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'element_tag' => 'h2',
			'letter_limit' => '',
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
			'el_class' => '',
		), $atts, 'gusta_wc_product_title');
		extract($att);
		
		$the_title='';
		if ($the_post):
			$the_title = ($the_post ? $the_post->post_title : '');
		endif;
		if ($the_title==''):
			$the_post=get_queried_object();
			$the_title = ($the_post ? $the_post->post_title : '');
		endif;
		if ($the_title=='' && is_home()): $the_title  = get_bloginfo( 'name' ); endif;
		if ($the_title==''): $the_title = get_the_archive_title(); endif;
		if (is_search() && $parent==''):
			$the_title = __('Search Results for "', 'mb_framework').get_search_query().__('"', 'mb_framework');
		endif;
		
		if ($letter_limit!="" && is_numeric($letter_limit) && strlen($the_title) > $letter_limit):
			$the_title = substr($the_title, 0, $letter_limit).'...';
		endif;
		
		$link_class='';
		$linked_class = '';
		$linked = gusta_link($att, $the_post, $the_title, $link_class);
		
		if (strpos($linked, '<a') !== false):
			$linked_class = ' linked';
		endif;
		
		$el_class .= ' '.$visibility;
		
		if (isset($animation) && $animation!=''): $el_class .= ' ani-'.$animation.''; endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' ss-element gusta-product-title '.$el_class. ' ' .$linked_class.'">'.$linked.'</'.$element_tag.'></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
    }


	add_shortcode( 'gusta_wc_product_title', 'gusta_product_title_html' );



		$params = array (
			gusta_vc_id('product-title'),
			gusta_element_tag('h2'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Letter Limit', 'mb_framework' ),
				'description' => __( 'The letters in the title after this number will not be displayed. Leave empty to show all the title.', 'mb_framework' ),
				'param_name' => 'letter_limit',
				'admin_label' => false,
				'std' => ''
			)
		);

		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Title', 'mb_framework' ), 'el_slug' => 'title', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Title", "mb_framework"), // add a name
				"base" => "gusta_wc_product_title", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				//'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);