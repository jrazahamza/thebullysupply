<?php
/*
* Visual Composer Post Author Element & Shortcode
*
* @file           vc_elements/gusta_post_author.php
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
Element Description: Gusta Post Author
*/

// Element HTML
    function gusta_post_author_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $linked = $the_permalink = $the_author = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'date_format' => 'M j, Y',
			'element_tag' => 'p',
			'label_text' => '',
			'add_label_icon' => '',
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
			'label_icon' => 'fontawesome',
			'label_icon_fontawesome' => 'fa fa fa-user',
			'label_icon_openiconic' => 'vc-oi vc-oi-dial',
			'label_icon_typicons' => 'typcn typcn-adjust-brightness',
			'label_icon_entypo' => 'entypo-icon entypo-icon-note',
			'label_icon_linecons' => 'vc_li vc_li-heart',
			'label_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'label_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'label_icon_material' => 'vc-material vc-material-cake',
			'el_class' => '',
		), $atts, 'gusta_post_author');
		extract($att);
		
		if ($the_post):
			if (property_exists($the_post, 'post_author')):
				$the_author = get_the_author_meta( 'display_name', $the_post->post_author );
			endif;
		endif;
		
		if ($the_author==''):
			if (property_exists('the_post', 'display_name')):
				$the_author = $the_post->display_name;
			endif;
		endif;
		
		$label = '';
		if (isset($add_label_icon) && $add_label_icon=='true'):
			$label .= '<i class="'.$att['label_icon_'.$label_icon].' label-icon"></i> ';
			vc_icon_element_fonts_enqueue( $label_icon );
		endif;
		if (isset($label_text) && $label_text!=''): $label .= '<span class="label-text">'.$label_text.'</span> '; endif;
		
		if ($label!=''):
			$the_author = '<span class="gusta-label">'.$label.'</span>'.$the_author;
		endif;
		
		$link_class='';
		$linked = gusta_link($att, $the_post, $the_author, $link_class, $no_follow);
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' ss-element gusta-post-author '.$visibility.' '.$el_class.'">'.$linked.'</'.$element_tag.'></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
        
    }

    add_shortcode('gusta_post_author','gusta_post_author_html');

    // Element Mapping
    	$params = array (
			gusta_vc_id('author'),
			gusta_element_tag(),
		);

		$params = gusta_label($params, 'fa fa-user');
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params = gusta_add_link($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Label Text', 'mb_framework' ), 'el_slug' => 'label_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Author', 'mb_framework' ), 'el_slug' => 'author', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Author", "mb_framework"), // add a name
				"base" => "gusta_post_author", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

		unset($params);