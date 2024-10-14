<?php
/*
* Visual Composer Author Info Box Element & Shortcode
*
* @file           vc_elements/gusta_author_info_box.php
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
Element Description: Gusta Author Info Box
*/

	// Element HTML
    function gusta_author_info_box_html( $atts ) {
        $css = $el_class = $output = '';
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'select_author' => '',
			'image_size' => '',
			'author_sub_title' => 'email',
			'show_social_media_links' => '1',
			'social_align' => 'left',
			'show_author_bio' => '1',
			'social_media_links_size' => '',
			'social_media_icon_color' => '',
			'social_media_icon_bg_color' => '',
			'social_media_icon_hover_color' => '',
			'social_media_icon_hover_bg_color' => '',
			'tg_author_image_tg_normal_tg_advanced_css' => '',
			'tg_author_image_tg_normal_tg_advanced_css' => '',
			'el_class' => ''
		), $atts, 'gusta_author_info_box');
		extract($att);
		
		$output .= '<div id="'.$vc_id.'" class="'.$el_class.' ss-element gusta-author-info vc-author-info-box">';
		
		if (!isset($select_author)):
			global $wp_query;
			$object = $wp_query->get_queried_object();
			$select_author = $object->post_author;
		endif;
		
		$output .= '<div class="gusta-author-info-image">
			'.get_avatar( get_the_author_meta( 'email', $select_author ) , $image_size, 'mystery', get_the_author_meta( 'display_name', $select_author ), array( 'class' => 'img-responsive' ) );
			if ((strpos($tg_author_image_tg_normal_tg_advanced_css, 'overlay') !== false) || (strpos($tg_author_image_tg_normal_tg_advanced_css, 'overlay') !== false)) {
				$output .= '<div class="gusta-overlay"></div>';
			}
			$output .= '</div>
			<h4>'.get_the_author_meta( 'display_name', $select_author ).'</h4>';
			
			if ($author_sub_title != 'disable'):
				$auth_url = get_the_author_meta( $author_sub_title, $select_author );
				$auth_url_link = ($author_sub_title=='email' ? 'mailto:'.$auth_url : $auth_url);
				$output .= '<span><a href="'.$auth_url_link.'" target="_blank">'.$auth_url.'</a></span>';
			endif;
			if ($show_author_bio):
				$output .= '<p>'.get_the_author_meta( 'description', $select_author ).'</p>';
			endif;
			$output .= '<div class="gusta-align-'.$social_align.' gusta-author-social">
				<div class="ss-element gusta-social-media-links layout-horizontal">
					<ul>';
					
					if ($show_social_media_links):
						$output .= gusta_user_social_links ($select_author, $social_media_links_size);
					endif;
					
					$output .= '</ul>
				</div>
			</div>
		</div>';
			
		return $output;
         
    }

    add_shortcode('gusta_author_info_box', 'gusta_author_info_box_html');
     
    // Element Mapping

		/*$author_array = get_users();
		$authors = array();
		$authors['Post Author'] = '';
		foreach ($author_array as $author):
		$authors[$author->data->display_name] = $author->data->ID;
		endforeach;*/

		$params = array(
			gusta_vc_id('author-info'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Enter Author ID', 'mb_framework' ),
				'param_name' => 'select_author',
				'admin_label' => true,
				"value" => '',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'mb_framework' ),
				'description' => __( 'Size of the image (max is 512). Enter an integer value (i.e. 100).', 'mb_framework' ),
				'param_name' => 'image_size',
				'dependency' => 0,
				'admin_label' => true,
				'std' => '96',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Show Author Subtitle?', 'mb_framework' ),
				'param_name' => 'author_sub_title',
				'description' => __('Select what to show on the subtitle section.', 'mb_framework').get_the_ID(),
				'value' => array(
					'Show Email Link' => 'email',
					'Show Website Link' => 'url',
					'Don\'t Show Subtitle' => 'disable'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Show Author Bio?', 'mb_framework' ),
				'param_name' => 'show_author_bio',
				'value' => array(
					'Yes' => '1',
					'No' => ''
				),
				'std' => array ( 0 => '1' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Show Social Media Links?', 'mb_framework' ),
				'param_name' => 'show_social_media_links',
				'value' => array(
					'Yes' => '1',
					'No' => ''
				),
				'std' => array ( 0 => '1' ),
				'group' => __( 'Icons', 'mb_framework' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Social Media Links Alignment', 'mb_framework' ),
				'param_name' => 'social_align',
				"value" => array(
					'Left'   => 'left',
					'Right'   	=> 'right',
					'Center'   => 'center',
					'Justify'   => 'justify',
				),
				"std" => 'left',
				'group' => __( 'Icons', 'mb_framework' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Social Media Links Size', 'mb_framework' ),
				'param_name' => 'social_media_links_size',
				'value' => array(
					'Medium' => '',
					'Small' => 'small',
					'Big' => 'big'
				),
				'std' => '',
				'dependency' => array( "element" => "show_social_media_links", "value" => "1" ),
				'group' => __( 'Icons', 'mb_framework' ),
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Icon Color', 'mb_framework' ),
				'param_name' => 'icons_color',
				'edit_field_class' => 'vc_col-xs-4',
				'group' => __( 'Icons', 'mb_framework' ),
				'dependency' => array( "element" => "show_social_media_links", "value" => "1" )
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Icons Hover Color', 'mb_framework' ),
				'param_name' => 'iconshovercolor',
				'edit_field_class' => 'vc_col-xs-4',
				'group' => __( 'Icons', 'mb_framework' ),
				'dependency' => array( "element" => "show_social_media_links", "value" => "1" )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Icons Size', 'mb_framework' ),
				'description' => __( 'In pixels (i.e. 15px).', 'mb_framework' ),
				'param_name' => 'icons_size',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-4',
				'group' => __( 'Icons', 'mb_framework' ),
				'dependency' => array( "element" => "show_social_media_links", "value" => "1" )
			),
			gusta_vc_extra_class_name()
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Icons', 'mb_framework' ), 'el_slug' => 'social_icons', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
			array (	'sub_group' => __( 'Image', 'mb_framework' ), 'el_slug' => 'author_image', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
			array (	'sub_group' => __( 'Title', 'mb_framework' ), 'el_slug' => 'author_title', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Sub-Title', 'mb_framework' ), 'el_slug' => 'author_sub_title', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Bio', 'mb_framework' ), 'el_slug' => 'bio', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
		));


		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Author Info Box", "mb_framework"), // add a name
				"base" => "gusta_author_info_box", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
			)
		);

		unset($params);
   