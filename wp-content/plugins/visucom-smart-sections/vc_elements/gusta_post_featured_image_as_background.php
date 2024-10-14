<?php
/*
* Visual Composer Post Featured Image as Background Element & Shortcode
*
* @file           vc_elements/gusta_post_featured_image_as_background.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.1
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Featured Image as Background
*/

// Element HTML
    function gusta_post_featured_image_as_background_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if ($the_post=='' && $product): $the_post=get_post($product->get_id()); endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $img_url = $linked = ''; 
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'image_size' => 'large',
			'cover' => 'column',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'add_link' => 'none',
			'link_custom_field_key' => '',
			'custom_url' => '',
			'link_target' => '',
			'no_follow' => '',
			'placeholder_image' => '',
			'tg_container_tg_normal_tg_advanced_css' => '',
			'tg_container_tg_hover_tg_advanced_css' => '',
			'el_class' => ''
		), $atts, 'gusta_post_featured_image_as_background');
		extract($att);
		
		$crop = false;
		if (strpos($image_size, 'x') !== false):
			$crop = true;
			$img_size = explode('x',$image_size);
		endif;
		
		if ($the_post):
			if (property_exists($the_post, 'ID')):
				if ($the_post && has_post_thumbnail($the_post->ID)):
					$image_id = get_post_thumbnail_id($the_post->ID);
				elseif ($parent==''):
					$the_post_for_image=get_queried_object();
					if ($the_post_for_image && has_post_thumbnail($the_post_for_image->ID) && !$post_listing_loop):
						$image_id = get_post_thumbnail_id($the_post_for_image->ID);
					endif;
				elseif ($the_post && get_post_meta($the_post->ID, 'gusta_taxonomy_featured_image', true)!='' && !$post_listing_loop):
					$image_id = get_post_meta($the_post->ID, 'gusta_taxonomy_featured_image', true); 
				elseif ($the_post && get_the_author_meta('gusta_taxonomy_featured_image', $the_post->ID)!='' && !$post_listing_loop):
					$image_id = get_the_author_meta('gusta_taxonomy_featured_image', $the_post->ID);
				endif;
			endif;
		endif;
		
		if ($product):
			$image_id = get_post_thumbnail_id($product->post->ID);
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
				$img_url = $image['url'];
			else:
				$image = wp_get_attachment_image_src( $image_id, $image_size, false );
				$img_url = $image[0];
			endif;
		endif;
		
		if (!$img_url):
			$img_url = SMART_SECTIONS_PLUGIN_URL . 'assets/img/placeholder.png';
		endif;
		
		if ($img_url):
			if (isset($animation) && $animation!='none'): $el_class .= ' ani-'.$animation.''; endif;
			$advanced_css = $tg_container_tg_normal_tg_advanced_css;
			$the_featured_image = '<div class="'.$vc_id.' ss-element gusta-image-as-background '.$visibility.' '.$el_class.' gusta-cover-'.$cover.'" style="background:url('.$img_url.');">';
			if ((strpos($tg_container_tg_normal_tg_advanced_css, 'overlay') !== false) || (strpos($tg_container_tg_hover_tg_advanced_css, 'overlay') !== false)) {
				$the_featured_image .= '<div class="gusta-overlay"></div>';
			}
			$the_featured_image .= '</div>';
			$link_class='gusta-image-as-background';
			if (isset($add_link) && $add_link != 'none'):
				$target_attr = (isset($link_target) && $link_target=='_blank' ? ' target="_blank"' : '');
				if ($add_link=='custom' && isset($custom_url) && $custom_url!=''):
					$linked = gusta_serialize_link ($custom_url, '&nbsp;', '', false);
				else:
					if ($add_link=='post'):
						$the_permalink = get_permalink($the_post->ID);
					elseif ($add_link=='author'):
						$author = $the_post->post_author;
						$the_permalink = get_author_posts_url($author);
					elseif ($add_link=='date'):
						$month = get_the_time('m', $the_post->post_date);
						$year = get_the_time('Y', $the_post->post_date);
						$the_permalink = get_month_link($month, $year);
					elseif ($add_link=='image'):
						$image = wp_get_attachment_image_src( $image_id, 'large', false );
						$the_permalink = $image[0];
						$link_class .= ' " data-lightbox="lightbox';
					elseif ($add_link=='custom_field'):
						$the_permalink = get_post_meta( $the_post->ID, $link_custom_field_key, true );
						if ($the_permalink==''): $the_permalink = get_field($link_custom_field_key, $the_post->ID); endif;
					endif;
					$linked = '<a class="'.$link_class.'"';
					if ($no_follow=='true'): $linked .= ' rel="nofollow"'; endif;
					$linked .= 'href="'.$the_permalink.'"'.$target_attr.'>&nbsp;</a>';
				endif;
				$linked = $the_featured_image.$linked;
			else:
				$linked = $the_featured_image;
			endif;
		endif;
		
		$output = $linked;
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_featured_image_as_background', 'gusta_post_featured_image_as_background_html' );
     
    // Element Mapping
        global $post;
		
		if (is_admin()):
			$params = array (
				gusta_vc_id('featured-image-bg'),
				array(
					'type' => 'textfield',
					'heading' => __( 'Image Size', 'mb_framework' ),
					'description' => __( 'Enter image size for the featured image. Example: thumbnail, medium, large, full or tg-landscape (Smart Sections defined size - 800x600). Alternatively enter image size in pixels: 200x100 (Width x Height).', 'mb_framework' ),
					'param_name' => 'image_size',
					'admin_label' => false,
					'std' => 'large'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Cover Row or Column', 'mb_framework' ),
					'description' => __( 'Determine weather this background image will cover its own column or the entire row.', 'mb_framework' ),
					'param_name' => 'cover',
					'value' => array (
						'Column' => 'column',
						'Row' => 'row'
					),
					'admin_label' => false,
					'std' => 'column'
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
			
			$params = gusta_visibility_hover_animation($params);
			$params = gusta_add_link($params);
			$params[] = gusta_vc_extra_class_name();
			
			$params = gusta_styles_tab ( $params, array ( 
				array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
			));
			
			// Map the block with vc_map()
			vc_map( 
				array(
					"name" => __("Post Featured Image as Background", "mb_framework"), // add a name
					"base" => "gusta_post_featured_image_as_background", // bind with our shortcode
					"content_element" => true, // set this parameter when element will has a content
					"is_container" => false, // set this param when you need to add a content element in this element
					'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
					"category" => __('Smart Sections', 'mb_framework'),
					"params" => $params
				)
			);               
		endif;
		unset($params);