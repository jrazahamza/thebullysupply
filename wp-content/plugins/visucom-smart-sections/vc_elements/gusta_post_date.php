<?php
/*
* Visual Composer Post Date Element & Shortcode
*
* @file           vc_elements/gusta_post_date.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.3.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Date
*/
 
// Element HTML
    function gusta_post_date_html( $atts ) {
		global $parent;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = $the_date = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'date_type'=> 'posted',
			'date_format' => 'M j, Y',
			'element_tag' => 'p',
			'label_text' => '',
			'add_label_icon' => '',
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
			'label_icon' => 'fontawesome',
			'label_icon_fontawesome' => 'fa fa fa-calendar-o',
			'label_icon_openiconic' => 'vc-oi vc-oi-dial',
			'label_icon_typicons' => 'typcn typcn-adjust-brightness',
			'label_icon_entypo' => 'entypo-icon entypo-icon-note',
			'label_icon_linecons' => 'vc_li vc_li-heart',
			'label_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'label_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'label_icon_material' => 'vc-material vc-material-cake',
			'el_class' => '',
		), $atts, 'gusta_post_date');
		extract($att);
		
		if ($the_post):
			if ($date_type=='updated'):
				$the_date = get_the_modified_time( $date_format, $the_post->ID );
			else:
				$the_date = get_the_date( $date_format, $the_post->ID );
			endif;
		endif;

		$label = '';
		if (isset($add_label_icon) && $add_label_icon=='true'):
			$label .= '<i class="'.$att['label_icon_'.$label_icon].' label-icon"></i> ';
			vc_icon_element_fonts_enqueue( $label_icon );
		endif;
		if (isset($label_text) && $label_text!=''): $label .= '<span class="label-text">'.$label_text.'</span> '; endif;
		
		if ($label!=''):
			$the_date = '<span class="gusta-label">'.$label.'</span>'.$the_date;
		endif;
		
		$link_class='';
		$linked = gusta_link($att, $the_post, $the_date, $link_class, $no_follow);
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' ss-element gusta-post-date '.$visibility.' '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_date', 'gusta_post_date_html' );
     
    // Element Mapping
        global $post;
		
		$params = array (
			gusta_vc_id('date'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Date Format', 'mb_framework' ),
				'description' => __( 'Type in the date format (i.e. M j, Y).', 'mb_framework' ).' <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">'.__( 'Learn more about date format', 'mb_framework' ).'</a>',
				'param_name' => 'date_format',
				'admin_label' => false,
				'std' => 'M j, Y'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Date Type', 'mb_framework' ),
				'param_name' => 'date_type',
				'admin_label' => false,
				'value' => array(
					__('Posted Date', 'mb_framework') 	=> 'posted',
					__('Updated Date', 'mb_framework') 	=> 'updated',
				),
				'std' => 'posted'
			)
		);

		$params = gusta_label($params, 'fa fa-calendar-o');
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Label', 'mb_framework' ), 'el_slug' => 'label_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Date', 'mb_framework' ), 'el_slug' => 'date', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Date", "mb_framework"), // add a name
				"base" => "gusta_post_date", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset ($params);