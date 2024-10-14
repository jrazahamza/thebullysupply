<?php
/*
* Visual Composer Text Element & Shortcode
*
* @file           vc_elements/gusta_text.php
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
Element Description: Gusta Text
*/

     

    // Element HTML
    function gusta_text_html( $atts ) {
		global $parent;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'text' => '',
			'element_tag' => 'p',
			'add_icon' => '',
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
			'label_icon_fontawesome' => 'fa fa-chevron-right',
			'label_icon_openiconic' => 'vc-oi vc-oi-dial',
			'label_icon_typicons' => 'typcn typcn-adjust-brightness',
			'label_icon_entypo' => 'entypo-icon entypo-icon-note',
			'label_icon_linecons' => 'vc_li vc_li-heart',
			'label_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'label_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'label_icon_material' => 'vc-material vc-material-cake',
			'icon_position' => '',
			'el_class' => ''
		), $atts, 'gusta_text');
		extract($att);
		

		
		if ((isset($text) && $text!='') || (isset($add_icon) && $add_icon=='true')):
		
			$el_class .= ' ss-element gusta-text '.$visibility.' ani-'.$animation;
			
			if (isset($add_icon) && $add_icon=='true'):
				$icon_button = '<span class="gusta-label"><i class="'.$att['label_icon_'.$label_icon].' label-icon" aria-hidden="true"></i></span>';
				if (isset($icon_position) && $icon_position=='right'):
					$text = $text.$icon_button;
				else:
					$text = $icon_button.$text;
				endif;
				vc_icon_element_fonts_enqueue( $label_icon );
			endif;
			
			$link_class='';
			$linked = gusta_link($att, $the_post, $text, $link_class, $no_follow);
			
			$mobile_disp = gusta_mobile_display($att);
			
			$output .= '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' ss-element gusta-text '.$visibility.' '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';

			$output .= gusta_clear($att);
			
		endif;
		
		return $output;
        
    }
     

	add_shortcode( 'gusta_text', 'gusta_text_html' );



		$params = array (
			gusta_vc_id('text'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Text', 'mb_framework' ),
				'param_name' => 'text',
				'admin_label' => true
			),
			gusta_element_tag('p'),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add Icon', 'mb_framework' ),
				'param_name' => 'add_icon',
				'admin_label' => false,
				'value' => array(
					__('Yes', 'mb_framework')   => 'true'
				)
			),
		);

		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_add_icon_field ( $params, array (
			'heading' => __('Text Icon', 'mb_framework'), 
			'param_name' => 'label_icon', 
			'dependency' => array ('element' => 'add_icon', 'value' => 'true'),
			'group' => __( 'Icon', 'mb_framework' ),
			'std' => 'fa fa-chevron-right',
			'enable_hover' => 1,
			'enable_active' => 0
		));

		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Icon Position', 'mb_framework' ),
			'param_name' => 'icon_position',
			'admin_label' => false,
			'dependency' => array ('element' => 'add_icon', 'value' => 'true'),
			'group' => __( 'Icon', 'mb_framework' ),
			'value' => array(
				__('Left', 'mb_framework')   => '',
				__('Right', 'mb_framework')   => 'right'
			),
			'std' => ''
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Icon', 'mb_framework' ), 'el_slug' => 'label_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
			array (	'sub_group' => __( 'Text', 'mb_framework' ), 'el_slug' => 'text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Text", "mb_framework"), // add a name
				"base" => "gusta_text", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);