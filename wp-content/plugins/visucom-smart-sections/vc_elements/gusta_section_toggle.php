<?php
/*
* Visual Composer Section Toggle Element & Shortcode
*
* @file           vc_elements/gusta_section_toggle.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.5
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Section Toggle
*/

// Element HTML
    function gusta_section_toggle_html( $atts ) {
		global $toggle_sections_added;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'section' => '',
			'hide_by_default' => '',
			'button_size' => '',
			'alignment' => 'right',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => 'right',
			'mobile_display_inline' => '',
			'toggle_icon' => 'fontawesome',
			'toggle_icon_fontawesome' => 'fa fa fa-bars',
			'toggle_icon_openiconic' => 'vc-oi vc-oi-dial',
			'toggle_icon_typicons' => 'typcn typcn-adjust-brightness',
			'toggle_icon_entypo' => 'entypo-icon entypo-icon-note',
			'toggle_icon_linecons' => 'vc_li vc_li-heart',
			'toggle_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'toggle_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'toggle_icon_material' => 'vc-material vc-material-cake',
			'toggle_iconactive' => 'fontawesome',
			'toggle_iconactive_fontawesome' => 'fa fa-times',
			'toggle_iconactive_openiconic' => 'vc-oi vc-oi-dial',
			'toggle_iconactive_typicons' => 'typcn typcn-adjust-brightness',
			'toggle_iconactive_entypo' => 'entypo-icon entypo-icon-note',
			'toggle_iconactive_linecons' => 'vc_li vc_li-heart',
			'toggle_iconactive_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'toggle_iconactive_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'toggle_iconactive_material' => 'vc-material vc-material-cake',
			'text_near_icon' => '',
			'toggle_on_hover' => '',
			'hide_icon' => 'show',
			'icon_position' => '',
			'el_class' => ''
		), $atts, 'gusta_section_toggle');
		extract($att);
		
		vc_icon_element_fonts_enqueue( $toggle_icon );
		vc_icon_element_fonts_enqueue( $toggle_iconactive );

		$the_toggle_icon = $att['toggle_icon_'.$toggle_icon];
		$the_toggle_iconactive = $att['toggle_iconactive_'.$toggle_iconactive];
		$the_text = ($text_near_icon ? ' <span>'.rawurldecode( base64_decode( $text_near_icon ) ).'</span>' : '');
		$has_span = ($the_text!='' ? ' gusta-has-span' : '');
		
		$target_element_id = 'section-'.$section;
		
		$data_toggle = ($target_element_id ? ' data-toggle="'.$target_element_id.'"' : '');
		
		$section_width = get_post_meta($section, 'gusta_section_width_height_gusta_section_width', true);
		$section_height = get_post_meta($section, 'gusta_section_width_height_gusta_section_height', true);
		$data_disable_scroll = ($section_width=="100%" && $section_height=="100%" ? ' data-disable-scroll="true"' : '');
		
		if ($button_size!=''): $button_size = ' gusta-'.$button_size; endif;
		
		$active_class = '';
		if ($hide_by_default==''): $active_class = ' active'; endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output .= '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><button id="'.$vc_id.'" class="' . esc_attr( $el_class ) . ' ss-element gusta-section-toggle '.$toggle_on_hover.' gusta-icon-link'.$has_span.$button_size.$active_class.'"'.$data_toggle.$data_disable_scroll.'>';
		
		if (!(isset($hide_icon) && $hide_icon=='hide')):
			$icon_button = '<i class="'.$the_toggle_icon.' gusta-icon"></i><i class="'.$the_toggle_iconactive.' gusta-active-icon"></i>';
			if (isset($icon_position) && $icon_position=='right'):
				$the_text = $the_text.$icon_button;
			else:
				$the_text = $icon_button.$the_text;
			endif;
		endif;

		$output .= $the_text;
		$output .= '</button></div>';
		
		$output .= gusta_clear($att);
		
		/*
		if (isset($section) && $section!=''):
			$overlapping = (get_post_meta($section, 'gusta_overlapping_section', true) ? ' section-overlapping' : '');
			$sections_array = array();
			
			$section_areas = array ('above_header', 'header', 'below_header', 'above_content', 'content', 'archive', 'below_content', 'above_footer', 'footer', 'below_footer', 'sticky');
			
			foreach ($section_areas as $area):
				$sec = get_gusta_option('gusta_'.$area.'_sections', gusta_get_template(), 'section');
				if ($sec!=''):
					if ($sections_array):
						array_merge($sections_array, $sec);
					else:
						$sections_array = $sec;
					endif;
				endif;
			endforeach;
			
			if (!in_array($section, $sections_array)):
				$output .= '<div id="section-'.$section.'" class="ss-element gusta-section-vc-element'.$overlapping.' ' . esc_attr( $css_class ) .'"><div class="section-container">';
				
				$args = array(
				   'post_type' => 'gusta_section',
				   'p' => $section
				);
				$gusta_section_query = new WP_Query( $args );
				foreach ($gusta_section_query->posts as $section):
					$output .= do_shortcode($section->post_content);
					if( current_user_can('editor') || current_user_can('administrator') ) :
						$output .= '<div class="edit-link edit-'.$section->post_name.'" title="'.ucwords(__('Edit', 'mb_framework')).' '.$section->post_title.'">
							<a href="'.get_edit_post_link( $section->ID ).'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>';
					endif;
				endforeach;				
			endif;
		endif;*/
		
		return $output;
         
    }
    add_shortcode( 'gusta_section_toggle', 'gusta_section_toggle_html' );
     
    // Element Mapping
    	
		$params = array();
		
		$params[] = gusta_vc_id('section-toggle');
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Section', 'mb_framework' ),
			'param_name' => 'section',
			'description' => __( 'Select the section to display when clicked on the toggle button. Please note that you have to add the selected section to your page.', 'mb_framework' ),
			'weight' => 0,
			'admin_label' => true,
			"value" => gusta_get_sections(null,true),
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Hide by Default', 'mb_framework' ),
			'param_name' => 'hide_by_default',
			'description' => __( 'If you check this box, the section will be hidden on page load.', 'mb_framework' ),
			'value' => array(
				__('Yes', 'mb_framework')   => 'yes',
			),
			'admin_label' => true,
			'std' => ''
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Button Size', 'mb_framework' ),
			'param_name' => 'button_size',
			'value' => array(
				'Medium' => '',
				'Small' => 'small',
				'Big' => 'big'
			),
			'std' => ''
		);
		$params = gusta_element_display($params, 'right');
		$params[] = array(
			'type' => 'textarea_raw_html',
			'heading' => __( 'Toggle Text', 'mb_framework' ),
			'param_name' => 'text_near_icon',
			'description' => __( 'If you wish to display only the icon, leave this field empty.', 'mb_framework' ),
			'std' => '',
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Toggle Section on Click or Hover', 'mb_framework' ),
			'param_name' => 'toggle_on_hover',
			'admin_label' => false,
			'dependency' => 0,
			'value' => array(
				__('On Click', 'mb_framework')   => '',
				__('On Hover', 'mb_framework')   => 'gusta-toggle-on-hover',
			),
			'std' => '',
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Icon', 'mb_framework' ),
			'param_name' => 'hide_icon',
			'admin_label' => false,
			'dependency' => 0,
			'value' => array(
				__('Show', 'mb_framework')   => 'show',
				__('Hide', 'mb_framework')   => 'hide',
			),
			'std' => 'show',
		);
		$params = gusta_add_icon_field ( $params, array (
			'heading' => __('Toggle Icon', 'mb_framework'), 
			'param_name' => 'toggle_icon', 
			'dependency' => array ('element' => 'hide_icon', 'value' => 'show'),
			'std' => 'fa fa-bars',
			'group' => __('Icon', 'mb_framework'), 
			'enable_hover' => 1,
			'enable_active' => 1
		));
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Icon Position', 'mb_framework' ),
			'param_name' => 'icon_position',
			'admin_label' => false,
			'dependency' => array ('element' => 'hide_icon', 'value' => 'show'),
			'group' => __( 'Icon', 'mb_framework' ),
			'value' => array(
				__('Left', 'mb_framework')   => '',
				__('Right', 'mb_framework')   => 'right'
			),
			'std' => ''
		);
		
		$params[] = gusta_vc_extra_class_name();
		$params[] = vc_map_add_css_animation();
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Toggle Text', 'mb_framework' ), 'el_slug' => 'near_icon', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Icon Container', 'mb_framework' ), 'el_slug' => 'icon_container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Section Toggle", "mb_framework"), // add a name
				"base" => "gusta_section_toggle", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
     
     unset($params);