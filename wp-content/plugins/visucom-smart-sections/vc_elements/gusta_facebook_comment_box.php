<?php
/*
* Visual Composer Facebook Comment Box Element & Shortcode
*
* @file           vc_elements/vc_facebook_comment_box.php
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
Element Description: Gusta Facebook Comment Box
*/

$facebook_script_added = 0;
// Element HTML
    function gusta_facebook_comment_box_html( $atts ) {
		global $facebook_script_added;
        $css = $el_class = $css_animation = $output = '';

		extract(shortcode_atts(array(
			'vc_id' => '',
			'appid' => '',
			'color_scheme' => 'light',
			'el_class' => ''
		), $atts, 'gusta_facebook_comment_box'));
		
		$output = '<div id="'.$vc_id.'" class="ss-element gusta-facebook-comment-box ' . esc_attr( $el_class ) .'">';
		
		if (!isset($appid) || $appid==''):
		
			$output .= "<span class='gusta_notice'>".__('Enter Facebook App ID', 'mb_framework')."</span>";
		
		else:
			$output .= "<div id='fb-root'></div> <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=".$appid."'; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";
			
			$this_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			$output .= '<div class="fb-comments" data-href="'.$this_page.'" data-width="100%" data-colorscheme="'.$color_scheme.'"></div>';
		
		endif;
		
		$output .= '</div>';

		return $output;
         
    }
    add_shortcode('gusta_facebook_comment_box', 'gusta_facebook_comment_box_html');
     
    // Element Mapping
		$params = array (
			gusta_vc_id('facebook-comment-box'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Facebook App ID', 'mb_framework' ),
				'param_name' => 'appid',
				'description' => __( "Enter the App ID of the app you have created on facebook.", 'mb_framework' ),
				'weight' => 0,
				"std" => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Color Scheme', 'mb_framework' ),
				'param_name' => 'color_scheme',
				'description' => __( 'The color scheme used by the comments plugin.', 'mb_framework' ),
				'weight' => 0,
				"value" => array(
					__('Light', 'mb_framework')   => 'light',
					__('Dark', 'mb_framework')   => 'dark'
				),
				"std" => 'light'
			),
			
			gusta_vc_extra_class_name()
		);
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Facebook Comments Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Facebook Comment Box", 'mb_framework'), // add a name
				"base" => "gusta_facebook_comment_box", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
 
    
    unset($params);
     