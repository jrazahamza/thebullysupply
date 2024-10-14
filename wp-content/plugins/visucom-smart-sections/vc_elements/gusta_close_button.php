<?php
/*
* Visual Composer Section Close Button Element & Shortcode
*
* @file           vc_elements/gusta_close_button.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.3.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Section Close Button
*/
 
// Element HTML
    function gusta_close_button_html( $atts ) {
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'button_size' => '',
			'alignment' => 'right',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'toggle_icon' => 'fontawesome',
			'toggle_icon_fontawesome' => 'fa fa fa-times',
			'toggle_icon_openiconic' => 'vc-oi vc-oi-dial',
			'toggle_icon_typicons' => 'typcn typcn-adjust-brightness',
			'toggle_icon_entypo' => 'entypo-icon entypo-icon-note',
			'toggle_icon_linecons' => 'vc_li vc_li-heart',
			'toggle_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'toggle_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'toggle_icon_material' => 'vc-material vc-material-cake',
			'text_near_icon' => '',
			'hide_icon' => 'show',
			'icon_position' => '',
			'el_class' => ''
		), $atts, 'gusta_close_button');
		extract($att);
		
		vc_icon_element_fonts_enqueue( $toggle_icon );

		$the_toggle_icon = $att['toggle_icon_'.$toggle_icon];
		$the_text = ($text_near_icon ? ' <span>'.$text_near_icon.'</span>' : '');
		$has_span = ($the_text!='' ? ' gusta-has-span' : '');
		
		if ($button_size!=''): $button_size = ' gusta-'.$button_size; endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output .= '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><button id="'.$vc_id.'" aria-label="close button" class="' . esc_attr( $el_class ) . ' ss-element gusta-close-button gusta-icon-link'.$has_span.$button_size.'">';
		
		if (!(isset($hide_icon) && $hide_icon=='hide')):
			$icon_button = '<i class="'.$the_toggle_icon.' gusta-icon"></i>';
			if (isset($icon_position) && $icon_position=='right'):
				$the_text = $the_text.$icon_button;
			else:
				$the_text = $icon_button.$the_text;
			endif;
		endif;

		$output .= $the_text;
		$output .= '</button></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
         
    }

    add_shortcode('gusta_close_button', 'gusta_close_button_html');
     
    // Element Mapping
    	
		$params = array();
		
		$params[] = gusta_vc_id('close-button');
		
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
			'type' => 'textfield',
			'heading' => __( 'Close Text', 'mb_framework' ),
			'param_name' => 'text_near_icon',
			'description' => __( 'If you wish to display only the icon, leave this field empty.', 'mb_framework' ),
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
			'heading' => __('Close Icon', 'mb_framework'), 
			'param_name' => 'toggle_icon', 
			'dependency' => array ('element' => 'hide_icon', 'value' => 'show'),
			'std' => 'fa fa-times',
			'group' => __('Icon', 'mb_framework'), 
			'enable_hover' => 1,
			'enable_active' => 0
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
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Button Text', 'mb_framework' ), 'el_slug' => 'near_icon', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Button Container', 'mb_framework' ), 'el_slug' => 'icon_container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Section Close Button", "mb_framework"), // add a name
				"base" => "gusta_close_button", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );              

        unset($params);                  
    