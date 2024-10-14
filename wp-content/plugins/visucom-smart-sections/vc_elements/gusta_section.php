<?php
/*
* Visual Composer Section Element & Shortcode
*
* @file           vc_elements/gusta_section.php
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
Element Description: Gusta Section
*/
 
 // Element HTML
    function gusta_section_html( $atts ) {
        $css = $el_class = $output = '';
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'section' => '',
			'el_class' => ''
		), $atts, 'gusta_section');
		extract($att);
		
		$overlapping = (get_post_meta($section, 'gusta_overlapping_section', true) ? ' section-overlapping' : '');
		$bg_color = get_post_meta( $section, 'gusta_background_color', true );
		$bg_transparency = get_post_meta( $section, 'gusta_background_transparency', true );
		
		if (isset($section) && $section!=''):
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
				$output .= '<div id="section-'.$section.'" class="'.$vc_id.' ss-element gusta-section-vc-element'.$overlapping.' ' . esc_attr( $el_class ) .'"><div class="section-container">';
				
				$args = array(
				   'post_type' => 'gusta_section',
				   'p' => $section
				);
				$gusta_section_query = new WP_Query( $args );
				foreach ($gusta_section_query->posts as $section):
					$output .= do_shortcode(gusta_fix_shortcodes($section->post_content));
					if( current_user_can('editor') || current_user_can('administrator') ) :
						$output .= '<div class="edit-link edit-'.$section->post_name.'" title="'.ucwords(__('Edit', 'mb_framework')).' '.$section->post_title.'">
							<a href="'.admin_url('post.php?post='.$section->ID.'&action=edit').'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>';
					endif;
				endforeach;	
				$output .= '</div></div>';
			endif;
		else:
			$output .= '<div id="section-'.$section.'" class="'.$vc_id.' ss-element gusta-section-vc-element'.$overlapping.' ' . esc_attr( $css_class ) .'"><div class="section-container">';
			$output .= '<p>'.__('Select your section.', 'mb_framework').'</p>';
			$output .= '</div></div>';
		endif;
			
		return $output;
         
    }
    add_shortcode( 'gusta_section', 'gusta_section_html' );

    // Element Mapping
    	if (is_admin()):
		
			$params = array(
				gusta_vc_id('gusta-section'),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Section', 'mb_framework' ),
					'description' => __( 'Select the section you want to add to your page. Not in the list? Checkout "Sections" link in the left WP admin menu."', 'mb_framework' ),
					'param_name' => 'section',
					'admin_label' => true,
					"value" => gusta_get_sections('content') + gusta_get_sections('sidebar'),
				),
				gusta_vc_extra_class_name()
			);
			
			$params = gusta_styles_tab ( $params, array ( 
				array (	'sub_group' => __( 'Section Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
			));
			
			// Map the block with vc_map()
			vc_map( 
				array(
					"name" => __("Smart Section", 'mb_framework'), // add a name
					"base" => "gusta_section", // bind with our shortcode
					"content_element" => true, // set this parameter when element will has a content
					"is_container" => false, // set this param when you need to add a content element in this element
					'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
					"category" => "Smart Sections",
					"params" => $params
				)
			);
		endif;
     unset($params);