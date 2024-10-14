<?php
/*
* Visual Composer Post Custom Field Element & Shortcode
*
* @file           vc_elements/gusta_post_custom_field.php
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
Element Description: Gusta Post Custom Field
*/

// Element HTML
    function gusta_post_custom_field_html( $atts ) {
		global $parent;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = $the_custom_field = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'custom_field_key' => '',
			'field_output' => 'formatted',
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
			'label_icon_fontawesome' => 'fa fa fa-chevron-circle-right',
			'label_icon_openiconic' => 'vc-oi vc-oi-dial',
			'label_icon_typicons' => 'typcn typcn-adjust-brightness',
			'label_icon_entypo' => 'entypo-icon entypo-icon-note',
			'label_icon_linecons' => 'vc_li vc_li-heart',
			'label_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'label_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'label_icon_material' => 'vc-material vc-material-cake',
			'el_class' => '',
		), $atts, 'gusta_post_custom_field');
		extract($att);
		
		if ($the_post):
			$the_custom_field  = (property_exists($the_post, 'ID') ? get_field($custom_field_key, $the_post->ID) : '');
			if ($the_custom_field==''): $the_custom_field  = (property_exists($the_post, 'term_id') ? get_field($custom_field_key, $the_post->term_id) : ''); endif;
			if ($the_custom_field==''): $the_custom_field = (property_exists($the_post, 'ID') ? get_post_meta( $the_post->ID, $custom_field_key, true ) : ''); endif;
			if ($the_custom_field==''): $the_custom_field  = (property_exists($the_post, 'term_id') ? get_term_meta( $the_post->term_id, $custom_field_key, true ) : ''); endif;
			if ($the_custom_field==''): $the_custom_field  = (property_exists($the_post, 'ID') ? get_user_meta( intval($the_post->ID), $custom_field_key, true ) : ''); endif;
			if ($the_custom_field==''): $the_custom_field  = (property_exists($the_post, 'post_author') ? get_user_meta( intval($the_post->post_author), $custom_field_key, true ) : ''); endif;
		endif;
		
		if ($custom_field_key!=''):

			$label = '';
			if (isset($add_label_icon) && $add_label_icon=='true'):
				$label .= '<i class="'.$att['label_icon_'.$label_icon].' label-icon"></i> ';
				vc_icon_element_fonts_enqueue( $label_icon );
			endif;
			if (isset($label_text) && $label_text!=''): $label .= '<span class="label-text">'.$label_text.'</span> '; endif;
		
			$link_class='';
			$linked = gusta_link($att, $the_post, $the_custom_field, $link_class, $no_follow);
			
			if (isset($animation) && $animation!='none'):
				$el_class .= ' ani-'.$animation.'';
			endif;
		else:
			$linked = '<i class="'.$att['label_icon_'.$label_icon].' label-icon"></i> <span class="label-text">'.$label_text.'</span> ';
		endif;
		
		$linked = '<span class="ss-element-item">'.$linked.'</span>';
		
		$mobile_disp = gusta_mobile_display($att);

		if ($label!=''):
			$linked = '<span class="gusta-label">'.$label.'</span>'.$linked;
		endif;
		
		$el_class .= ' '.$visibility;
		
		if ($the_custom_field!=''):
			if ($field_output == "only_value"):
				$output = $the_custom_field;
			elseif ($field_output == "as_image"):
					$the_custom_field_image = wp_get_attachment_image( $the_custom_field, 'full' );
					if ($the_custom_field_image): 
						$the_custom_field = $the_custom_field_image; 
					else:
						$the_custom_field = '<img src="'.$the_custom_field.'" />';
					endif;
					$linked = gusta_link($att, $the_post, $the_custom_field, $link_class);
					$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' gusta-post-custom-field ss-element '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';
					$output .= gusta_clear($att);
			else:
				$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' gusta-post-custom-field ss-element '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';

				$output .= gusta_clear($att);
			endif;
		endif;
		
		$output = do_shortcode($output);
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_custom_field', 'gusta_post_custom_field_html' );

	// Element Mapping
        global $post;
		
        $params = array (
			gusta_vc_id('custom-field'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Custom Field Key', 'mb_framework' ),
				'param_name' => 'custom_field_key',
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Output', 'mb_framework' ),
				'description' => __( 'If you want to output only the value, select "Only Value". If you want to display the value formatted, select "Formatted"', 'mb_framework' ),
				'param_name' => 'field_output',
				'admin_label' => false,
				'value' => array(
					__('Formatted', 'mb_framework') 	=> 'formatted',
					__('Only Value', 'mb_framework') 	=> 'only_value',
					__('As Image', 'mb_framework') 	=> 'as_image',
				),
				'std' => 'formatted'
			),
			gusta_element_tag('p'),
		);
		
		$params = gusta_label($params, 'fa fa-chevron-circle-right');
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Label Text', 'mb_framework' ), 'el_slug' => 'label_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Custom Field', 'mb_framework' ), 'el_slug' => 'custom_field', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Custom Field", "mb_framework"), // add a name
				"base" => "gusta_post_custom_field", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

		unset($params);