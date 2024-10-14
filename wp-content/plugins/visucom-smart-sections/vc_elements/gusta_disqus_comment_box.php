<?php
/*
* Visual Composer Disqus Comment Box Element & Shortcode
*
* @file           vc_elements/vc_disqus_comment_box.php
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
Element Description: Gusta Disqus Comment Box
*/

// Element HTML
    function gusta_disqus_comment_box_html( $atts ) {
         
        $css = $el_class = $css_animation = $output = '';
		
		extract(shortcode_atts(array(
			'vc_id' => '',
			'disqus_shortname' => '',
			'el_class' => ''
		), $atts, 'gusta_disqus_comment_box'));
		
		$output = '<div id="'.$vc_id.'" class="ss-element gusta-disqus-comment-box ' . esc_attr( $el_class ) .'">';
		
		if (!isset($disqus_shortname) || $disqus_shortname==''):
		
			$output .= "<span class='gusta_notice'>".__('Enter Disqus Shortname', 'mb_framework')."</span>";
		
		else:
		
			//$this_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			
			$output .= "<div id='disqus_thread'></div><script> (function() { var d = document, s = d.createElement('script'); s.src = 'https://".$disqus_shortname.".disqus.com/embed.js'; s.setAttribute('data-timestamp', +new Date()); (d.head || d.body).appendChild(s); })(); </script>";
			
		endif;
		
		$output .= '</div>';

		return $output;
         
    }

    add_shortcode('gusta_disqus_comment_box', 'gusta_disqus_comment_box_html');
     
    // Element Mapping
        
		$params = array (
			gusta_vc_id('disqus-comment-box'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Disqus Shortname', 'mb_framework' ),
				'param_name' => 'disqus_shortname',
				'description' => __( "Enter your Disqus shortname. For example, if your Disqus URL is 'my_short_name.disqus.com', them your Disqus shortname is 'my_short_name'. Please note, currently, only one Disqus comment box can be added to a single page.", 'mb_framework' ),
				'weight' => 0,
				"std" => ''
			),
			gusta_vc_extra_class_name()
		);
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Disqus Comments Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Disqus Comment Box", 'mb_framework'), // add a name
				"base" => "gusta_disqus_comment_box", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
     

    unset($params);
    