<?php
/*
* Visual Composer Post Read More Button Element & Shortcode
*
* @file           vc_elements/gusta_post_read_more_button.php
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
Element Description: Gusta Post Read More Button
*/

// Element HTML
    function gusta_post_read_more_button_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'read_more_text' => __('Read More', 'mb_framework'),
			'button_size' => '',
			'add_icon_to_button' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'add_link' => 'post',
			'link_custom_field_key' => '',
			'custom_url' => '',
			'link_target' => '',
			'no_follow' => '',
			'button_icon' => 'fontawesome',
			'button_icon_fontawesome' => 'fa fa-chevron-right',
			'button_icon_openiconic' => 'vc-oi vc-oi-dial',
			'button_icon_typicons' => 'typcn typcn-adjust-brightness',
			'button_icon_entypo' => 'entypo-icon entypo-icon-note',
			'button_icon_linecons' => 'vc_li vc_li-heart',
			'button_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'button_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'button_icon_material' => 'vc-material vc-material-cake',
			'icon_position' => '',
			'el_class' => ''
		), $atts, 'gusta_post_read_more_button');
		extract($att);
		
		if (isset($read_more_text) && $read_more_text!=''):
			$read_more_text = ' <span>'.$read_more_text.'</span> ';
		endif;
		$has_span = ($read_more_text!='' ? ' gusta-has-span' : '');
		
		if ($button_size!=''): $button_size = ' gusta-'.$button_size; endif;
		
		$el_class .= ' ss-element gusta-read-more-button gusta-icon-link'.$has_span.$button_size.' '.$visibility.' ani-'.$animation;
		
		if (isset($add_icon_to_button) && $add_icon_to_button=='true'):
			$icon_button = '<i class="'.$att['button_icon_'.$button_icon].'" aria-hidden="true"></i>';
			if (isset($icon_position) && $icon_position=='right'):
				$read_more_text = $read_more_text.$icon_button;
			else:
				$read_more_text = $icon_button.$read_more_text;
			endif;
			vc_icon_element_fonts_enqueue( $button_icon );
		endif;
		
		$link_class = $vc_id.' '.$el_class.' linked';
		$linked = gusta_link($att, $the_post, $read_more_text, $link_class, $no_follow);
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'">'.$linked.'</div>';

		$output .= gusta_clear($att);
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_read_more_button', 'gusta_post_read_more_button_html' );
     
    // Element Mapping
        global $post;

		$params = array (
			gusta_vc_id('read-more-button'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Read More Text', 'mb_framework' ),
				'param_name' => 'read_more_text',
				'admin_label' => true,
				'std' => __('Read More', 'mb_framework')
			),
		);

		$params = gusta_button($params, 'fa fa-chevron-right');
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Read More Button', 'mb_framework' ), 'el_slug' => 'read_more_button', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Read More Button", "mb_framework"), // add a name
				"base" => "gusta_post_read_more_button", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);