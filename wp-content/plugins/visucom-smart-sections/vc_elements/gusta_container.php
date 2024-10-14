<?php
/*
* Visual Composer Container Element & Shortcode
*
* @file           vc_elements/gusta_container.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.4
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function gusta_container_html( $atts, $content = null ) {
	
	$css = $el_class = $output = ''; 
	
	$att = shortcode_atts(array(
		'vc_id' => '',
		'position' => 'relative',
		'cover' => 'column',
		'tg_container_tg_normal_tg_advanced_css' => '',
		'tg_container_tg_hover_tg_advanced_css' => '',
		'el_class' => ''
	), $atts, 'gusta_container');
	extract($att);
	
	$output = '<div class="'.$vc_id.' ss-element gusta-container gusta-'.$position.' gusta-cover-'.$cover.' '.$el_class.'">'.do_shortcode($content);
	if ((strpos($tg_container_tg_normal_tg_advanced_css, 'overlay') !== false) || (strpos($tg_container_tg_hover_tg_advanced_css, 'overlay') !== false)) {
		$output .= '<div class="gusta-overlay"></div>';
	}
	$output .= '</div>';
	
	return $output;
        
    }

    
    add_shortcode( 'gusta_container', 'gusta_container_html' );

	$params = array (
		gusta_vc_id('container'),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Position', 'mb_framework' ),
			'description' => __( 'Determine the position of the container. More information about positions: ', 'mb_framework' ).'<br><a target="_blank" href="https://www.w3schools.com/css/css_positioning.asp">https://www.w3schools.com/css/css_positioning.asp</a>',
			'param_name' => 'position',
			'value' => array (
				'Relative' => 'relative',
				'Absolute Top Left' => 'absolute-top-left',
				'Absolute Top Center' => 'absolute-top-center',
				'Absolute Top Right' => 'absolute-top-right',
				'Absolute Middle Left' => 'absolute-middle-left',
				'Absolute Middle Center' => 'absolute-middle-center',
				'Absolute Middle Right' => 'absolute-middle-right',
				'Absolute Bottom Left' => 'absolute-bottom-left',
				'Absolute Bottom Center' => 'absolute-bottom-center',
				'Absolute Bottom Right' => 'absolute-bottom-right',
			),
			'admin_label' => false,
			'std' => 'relative'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Cover Row or Column', 'mb_framework' ),
			'description' => __( 'Determine whether this container will act according to its own column or the entire row.', 'mb_framework' ),
			'param_name' => 'cover',
			'value' => array (
				'Column' => 'column',
				'Row' => 'row'
			),
			'admin_label' => false,
			'std' => 'column'
		),
	);
	
	$params[] = gusta_vc_extra_class_name();
	
	$params = gusta_styles_tab ( $params, array ( 
		array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
	));

        //Register "container" content element. It will hold all your inner (child) content elements
    vc_map( array(
        "name" => __("Smart Container", "my-text-domain"),
        "base" => "gusta_container",
        "as_parent" => array(), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "is_container" => true,
		'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
		"category" => "Smart Sections",
        "params" => $params,
        "js_view" => 'VcColumnView'
    ) );
    
    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Gusta_Container extends WPBakeryShortCodesContainer {
        }
    }

    
    unset($params);
    
    ?>