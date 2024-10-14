<?php
/*
* Visual Composer Site Logo Element & Shortcode
*
* @file           vc_elements/vc_site_logo.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.9
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Site Logo
*/
 
 // Element HTML
    function gusta_site_logo_html( $atts ) {
         
        $css = $el_class = $logo_type = $alignment = $logo_height = $css_animation = $output = '';
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'logo_image' => '',
			'logo_height' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => 'left',
			'mobile_display_inline' => '',
			'custom_link' => 'false',
			'custom_url' => '',
			'alignment' => 'left',
			'el_class' => ''
		), $atts, 'gusta_site_logo');
		extract($att);
		
		$logo_url='';
		if ($logo_image):
			$logo_url_array = wp_get_attachment_image_src( $logo_image, 'full' );
			if (is_array($logo_url_array)):
				$logo_url = $logo_url_array[0];
			endif;
		endif;
		
		if ($logo_url==''):
		$logo_url = SMART_SECTIONS_PLUGIN_URL . 'assets/img/placeholder-logo.png';
		endif;


		$logo_html = ($logo_url!='' ? '<img src="' . $logo_url . '" alt="' . get_bloginfo( 'name' ) . '" />' : '<h1>'.get_bloginfo( 'name' ).'</h1>' );

		$mobile_disp = gusta_mobile_display($att);
		
		if ($custom_link=='true'):
			$linked = gusta_serialize_link ($custom_url, $logo_html, '', false);
		else:
			$linked = '<a href="' . home_url() . '/" title="' . get_bloginfo( 'name' ) . '" rel="home">'.$logo_html.'</a>';
		endif;

		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div id="'.$vc_id.'" class="ss-element gusta-site-logo ' . esc_attr( $el_class ) .'"><div class="gusta-logo">'.$linked.'</div></div></div>';

		$output .= gusta_clear($att);
		
		return $output;
         
    }
    add_shortcode('gusta_site_logo', 'gusta_site_logo_html');

    // Element Mapping
		$params = array (
			gusta_vc_id('logo'),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Logo Image', 'mb_framework' ),
				'param_name' => 'logo_image',
				'description' => __( "Upload your custom logo. If you don't upload a logo, site name will be displayed.", 'mb_framework' ),
				'weight' => 0
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Logo Height', 'mb_framework' ),
				'param_name' => 'logo_height',
				'description' => __( 'In pixels (i.e. 100px)', 'mb_framework' ),
				'weight' => 0
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Custom Link', 'mb_framework' ),
				'param_name' => 'custom_link',
				'description' => __( 'Default home page url will be set if you select no.', 'mb_framework' ),
				'value' => array(
					'No' => 'false',
					'Yes' => 'true'
				),
				'std' => array ( 0 => 'false' ),
			),
			$array[] = array(
				'type' => 'vc_link',
				'heading' => __( 'Custom URL', 'mb_framework' ),
				'param_name' => 'custom_url',
				'admin_label' => false,
				'dependency' => array ('element' => 'custom_link', 'value' => 'true'),
				'weight' => 0
			)
		);
		
		$params = gusta_element_display($params);
		$params[] = gusta_vc_extra_class_name();
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Site Logo Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Site Logo", 'mb_framework'), // add a name
				"base" => "gusta_site_logo", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
     
     
    unset($params);