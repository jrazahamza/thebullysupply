<?php
/*
* Visual Composer Post Featured Image Element & Shortcode
*
* @file           vc_elements/gusta_post_featured_image.php
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
Element Description: Gusta Post Featured Image
*/

// Element HTML
    function gusta_post_featured_image_html( $atts ) {
		global $parent, $post, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $linked = $img_url = ''; 
		$post_listing_loop = true;
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'image_size' => 'large',
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
			'placeholder_image' => '',
			'el_class' => '',
			'tg_featured_image_tg_normal_tg_advanced_css' => '',
			'tg_featured_image_tg_hover_tg_advanced_css' => '',
		), $atts, 'gusta_post_featured_image');
		extract($att);

		$crop = false;
		if (strpos($image_size, 'x') !== false):
			$crop = true;
			$img_size = explode('x',$image_size);
		endif;
		
		if ($the_post && has_post_thumbnail($the_post)):
			$image_id = get_post_thumbnail_id($the_post);
		else:
			if ($the_post && get_post_meta($the_post->ID, 'gusta_taxonomy_featured_image', true)!='' && !$post_listing_loop):
				$image_id = get_post_meta($the_post->ID, 'gusta_taxonomy_featured_image', true); 
			elseif ($the_post && get_the_author_meta('gusta_taxonomy_featured_image', $the_post->ID)!='' && !$post_listing_loop):
				$image_id = get_the_author_meta('gusta_taxonomy_featured_image', $the_post->ID);
			endif;
		endif;
		
		if ($product):
			$image_id = get_post_thumbnail_id($product->get_id());
		endif;

		if (isset($the_post->taxonomy) && $the_post->taxonomy=='product_cat'):
			$image_id = get_woocommerce_term_meta( $the_post->term_id, 'thumbnail_id', true ); 
		endif;
		
		if (!isset($image_id) || $image_id=='' || !$image_id):
			$image_id = $placeholder_image;
		endif;
		
		if ($image_id!=''):
			if ($crop):
				$image = gusta_resize($image_id, '', $img_size[0], $img_size[1], true);
				if ($image):
					$img_url = $image['url'];
				endif;
			else:
				$image = wp_get_attachment_image_src( $image_id, $image_size, false );
				$img_url = $image[0];
			endif;
		endif;
		
		if (!$img_url):
			$img_url = SMART_SECTIONS_PLUGIN_URL . 'assets/img/placeholder.png';
		endif;
		
		$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
		
		$the_featured_image = $img_url;
		
		if ($the_featured_image):
		
			if (isset($animation) && $animation!=''): $el_class .= ' ani-'.$animation.''; endif;
			$the_featured_image = '<img src="'.$the_featured_image.'" alt="'.$image_alt.'" />';
			if ((strpos($tg_featured_image_tg_normal_tg_advanced_css, 'overlay') !== false) || (strpos($tg_featured_image_tg_hover_tg_advanced_css, 'overlay') !== false)) {
				$the_featured_image .= '<div class="gusta-overlay"></div>';
			}
			$link_class='linked ss-element gusta-featured-image '.$vc_id.' '.$visibility.' '.$el_class.'';
			$linked = gusta_link($att, $the_post, $the_featured_image, $link_class, $no_follow);
		
			if (strpos($linked, '<a') === false):
				$linked = '<div class="ss-element gusta-featured-image '.$vc_id.' '.$visibility.' '.$el_class.'">'.$the_featured_image.'</div>';
			endif;
			
			$mobile_disp = gusta_mobile_display($att);
			
			$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'">'.$linked.'</div>';
			
			$output .= gusta_clear($att);
			
		endif;
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_featured_image', 'gusta_post_featured_image_html' );
     
    // Element Mapping
        global $post;
		
		$params = array (
			gusta_vc_id('featured-image'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'mb_framework' ),
				'description' => __( 'Enter image size for the featured image. Example: thumbnail, medium, large, full or tg-landscape (Smart Sections defined size - 800x600). Alternatively enter image size in pixels: 200x100 (Width x Height).', 'mb_framework' ),
				'param_name' => 'image_size',
				'admin_label' => false,
				'std' => 'large'
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Placeholder Image', 'mb_framework' ),
				'description' => __( 'If the post does not have a featured image, this image will be displayed instead.', 'mb_framework' ),
				'param_name' => 'placeholder_image',
				'admin_label' => false,
				'weight' => 0
			)
		);

		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Featured Image', 'mb_framework' ), 'el_slug' => 'featured_image', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Featured Image", "mb_framework"), // add a name
				"base" => "gusta_post_featured_image", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);
    