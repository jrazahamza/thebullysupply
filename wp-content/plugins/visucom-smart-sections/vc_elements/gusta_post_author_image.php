<?php
/*
* Visual Composer Post Author Image Element & Shortcode
*
* @file           vc_elements/gusta_post_author_image_image.php
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
Element Description: Gusta Post Author Image
*/

 // Element HTML
    function gusta_post_author_image_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $linked = $output = $the_permalink = $the_image = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'image_size' => '96',
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
			'tg_image_tg_normal_tg_advanced_css' => '',
			'tg_image_tg_hover_tg_advanced_css' => '',
			'el_class' => '',
		), $atts, 'gusta_post_author_image');
		extract($att);
		
		if ($the_post):
			$the_image = get_avatar( get_the_author_meta( 'email', $the_post->post_author ) , $image_size, 'mystery', get_the_author_meta( 'display_name', $the_post->post_author ) );
		endif;
		
		if ((strpos($tg_image_tg_normal_tg_advanced_css, 'overlay') !== false) || (strpos($tg_image_tg_hover_tg_advanced_css, 'overlay') !== false)) {
			$the_image .= '<div class="gusta-overlay"></div>';
		}
		
		$link_class=$vc_id.' ss-element gusta-post-author-image '.$visibility.''.$el_class;
		$linked = gusta_link($att, $the_post, $the_image, $link_class, $no_follow);
		
		if (strpos($linked, '<a') === false):
			$linked = '<div class="ss-element gusta-post-author-image '.$vc_id.' '.$visibility.' '.$el_class.'">'.$the_image.'</div>';
		endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'">'.$linked.'</div>';
		
		$output .= gusta_clear($att);
		
		return $output;
        
    }

    add_shortcode('gusta_post_author_image','gusta_post_author_image_html');
 
    // Element Mapping
		
		$params = array (
			gusta_vc_id('author-image'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'mb_framework' ),
				'description' => __( 'Size of the image (max is 512). Enter an integer value (i.e. 100).', 'mb_framework' ),
				'param_name' => 'image_size',
				'dependency' => 0,
				'admin_label' => true,
				'std' => '96',
			)
		);

		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Image', 'mb_framework' ), 'el_slug' => 'image', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Author Image", "mb_framework"), // add a name
				"base" => "gusta_post_author_image", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

		unset($params);