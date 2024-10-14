<?php
/*
* Visual Composer Related Function
*
* @file           includes/vc.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Make pages and section post types editable by visual composer by default */
if(!function_exists('gusta_vc_editor')):
	function gusta_vc_editor () {
		$list = array(
			'page',
			'gusta_section'
		);
		vc_set_default_editor_post_types( $list );
	}
	add_action( 'vc_before_init', 'gusta_vc_editor' );
endif;

/* Remove Post Content Element from other post types rather than Smart Section 
if (is_admin() && gusta_get_post_type()!='gusta_section'):
	vc_remove_element( 'gusta_post_content' );
endif;*/


/* Remove "Edit with Visual Composer" Links */
if(!function_exists('gusta_vc_remove_frontend_links')):
	function gusta_vc_remove_frontend_links() {
		if(gusta_get_post_type() === "gusta_section" ):
			vc_disable_frontend();
		endif;
	}
	add_action( 'vc_after_init', 'gusta_vc_remove_frontend_links' );
endif;

/* VC Element Param Functions */

/* Unique Id for each element */
if(!function_exists('gusta_vc_id')):
	function gusta_vc_id($element=null, $atts=null) {
		if (isset($atts)): extract ($atts); endif;
		$element = (isset($element) ? $element : 'el');
		$el_name = (isset($el_name) ? $el_name.' ' : '');
		$el_slug = (isset($el_slug) ? $el_slug.'_' : '');
		$el_slug2 = str_replace("_", "-", $el_slug);
		$vc_id = uniqid(mt_rand());
		$data = array(
			'type' => 'textfield',
			'heading' => __( $el_name.'Unique ID', 'mb_framework' ),
			'description' => __( 'In order for '.$el_name.'Custom Style to work, this field should have a unique value.', 'mb_framework' ),
			'param_name' => $el_slug.'vc_id',
			'admin_label' => false,
			'weight' => 0,
			"value" => $element.'-'.$el_slug2.$vc_id
		);
		if (isset($dependency) && $dependency!=0): $data['dependency'] = $dependency; endif;
		if (isset($group) && $group!=''): $data['group'] = $group; endif;
		return apply_filters( 'gusta_vc_id', $data, $element, $atts );
	}
endif;

/* Gusta Element Tag */
if(!function_exists('gusta_element_tag')):
	function gusta_element_tag($std='p') {
		$data = array(
			'type' => 'dropdown',
			'heading' => __( 'Element Tag', 'mb_framework' ),
			'param_name' => 'element_tag',
			'admin_label' => false,
			'value' => array(
				'p' => 'p',
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
				'div' => 'div',
			),
			'std' => $std
		);
		return apply_filters( 'gusta_element_tag', $data );
	}
endif;

/* Gusta Label */
if(!function_exists('gusta_label')):
	function gusta_label($array, $icon_std) {
		$array[] = array (
			'type' => 'textfield',
			'heading' => __( 'Label Text', 'mb_framework' ),
			'param_name' => 'label_text',
			'edit_field_class' => 'vc_col-xs-6',
			'admin_label' => true,
		);
		$array[] = array (
			'type' => 'checkbox',
			'heading' => __( 'Add Label Icon', 'mb_framework' ),
			'param_name' => 'add_label_icon',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'value' => array(
				__('Yes', 'mb_framework')   => 'true',
			)
		);
		$array = gusta_add_icon_field ( $array, array (
			'heading' => __('Label Icon', 'mb_framework'), 
			'param_name' => 'label_icon', 
			'dependency' => array ('element' => 'add_label_icon', 'value' => 'true'),
			'group' => __('Label Icon', 'mb_framework'), 
			'std' => $icon_std,
			'enable_hover' => 1,
			'enable_active' => 0
		));
		return $array;
	}
endif;

/* Gusta Button */
if(!function_exists('gusta_button')):
	function gusta_button($array, $icon_std) {
		$array[] = array (
			'type' => 'dropdown',
			'heading' => __( 'Button Size', 'mb_framework' ),
			'param_name' => 'button_size',
			'value' => array(
				'Medium' => '',
				'Small' => 'small',
				'Big' => 'big'
			),
			'std' => ''
		);
		$array[] = array (
			'type' => 'checkbox',
			'heading' => __( 'Add Icon to Button', 'mb_framework' ),
			'param_name' => 'add_icon_to_button',
			'admin_label' => false,
			'value' => array(
				__('Yes', 'mb_framework')   => 'true'
			)
		);
		$array = gusta_add_icon_field ( $array, array (
			'heading' => __('Button Icon', 'mb_framework'), 
			'param_name' => 'button_icon', 
			'dependency' => array ('element' => 'add_icon_to_button', 'value' => 'true'),
			'group' => __( 'Icon', 'mb_framework' ),
			'std' => $icon_std,
			'enable_hover' => 1,
			'enable_active' => 0
		));
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Icon Position', 'mb_framework' ),
			'param_name' => 'icon_position',
			'admin_label' => false,
			'dependency' => array ('element' => 'add_icon_to_button', 'value' => 'true'),
			'group' => __( 'Icon', 'mb_framework' ),
			'value' => array(
				__('Left', 'mb_framework')   => '',
				__('Right', 'mb_framework')   => 'right'
			),
			'std' => ''
		);
		return $array;
	}
endif;

/* Gusta Element Display */
if(!function_exists('gusta_element_display')):
	function gusta_element_display($array, $align_std='left') {
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Alignment', 'mb_framework' ),
			'param_name' => 'alignment',
			"value" => array(
				'Left'   => 'left',
				'Right'   	=> 'right',
				'Center'   => 'center',
				'Hide'   => 'hide',
			),
			'edit_field_class' => 'vc_col-xs-6',
			"std" => $align_std,
		);
		$array[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Display Inline', 'mb_framework' ),
			'param_name' => 'display_inline',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-3',
			'value' => array(
				__('Yes', 'mb_framework')   => 'gusta-inline',
			)
		);
		$array[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Custom for Mobile', 'mb_framework' ),
			'param_name' => 'mobile_display',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-3',
			'value' => array(
				__('Yes', 'mb_framework')   => 'true',
			)
		);
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Mobile Alignment', 'mb_framework' ),
			'param_name' => 'mobile_alignment',
			"value" => array(
				'Left'   => 'left',
				'Right'   	=> 'right',
				'Center'   => 'center',
				'Hide'   => 'hide',
			),
			'edit_field_class' => 'vc_col-xs-6',
			'dependency' => array ('element' => 'mobile_display', 'not_empty' => true),
			"std" => $align_std,
		);
		$array[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Mobile Display Inline', 'mb_framework' ),
			'param_name' => 'mobile_display_inline',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'dependency' => array ('element' => 'mobile_display', 'not_empty' => true),
			'value' => array(
				__('Yes', 'mb_framework')   => 'gusta-mobile-inline',
			)
		);
		return $array;
	}
endif;

/* Gusta Visibility & Hover Animation */
if(!function_exists('gusta_visibility_hover_animation')):
	function gusta_visibility_hover_animation($array) {
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Visibility', 'mb_framework' ),
			'description' => __( 'This feature works only in post listing card design sections.', 'mb_framework' ),
			'param_name' => 'visibility',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'value' => array(
				__('Show by default, show on hover', 'mb_framework')   => 'show-show',
				__('Hide by default, show on hover', 'mb_framework')   => 'hide-show',
				__('Show by default, hide on hover', 'mb_framework')   => 'show-hide',
			),
			'std' => 'show-show'
		);
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Animation', 'mb_framework' ),
			'param_name' => 'animation',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'value' => array(
				__('fade', 'mb_framework') => 'fade',
				__('fadeUp', 'mb_framework') => 'fadeUp',
				__('fadeDown', 'mb_framework') => 'fadeDown',
				__('fadeRight', 'mb_framework') => 'fadeRight',
				__('fadeLeft', 'mb_framework') => 'fadeLeft',
				__('zoomIn', 'mb_framework') => 'zoomIn',
				__('zoomOut', 'mb_framework') => 'zoomOut',
				__('zoomInUp', 'mb_framework') => 'zoomInUp',
				__('zoomOutUp', 'mb_framework') => 'zoomOutUp',
				__('zoomInDown', 'mb_framework') => 'zoomInDown',
				__('zoomOutDown', 'mb_framework') => 'zoomOutDown',
				__('zoomInRight', 'mb_framework') => 'zoomInRight',
				__('zoomOutRight', 'mb_framework') => 'zoomOutRight',
				__('zoomInLeft', 'mb_framework') => 'zoomInLeft',
				__('zoomOutLeft', 'mb_framework') => 'zoomOutLeft'
			),
			'std' => 'fade'
		);
		return $array;
	}
endif;

/* Gusta Add Link */
if(!function_exists('gusta_add_link')):
	function gusta_add_link($array) {
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Add Link', 'mb_framework' ),
			'param_name' => 'add_link',
			'admin_label' => true,
			'value' => array(
				__('None', 'mb_framework')   => '',
				__('Post Link', 'mb_framework')   => 'post',
				__('Term Link', 'mb_framework')   => 'term',
				__('Post Author', 'mb_framework')   => 'author',
				__('Date Archive (Month)', 'mb_framework')   => 'date',
				__('Large Image (Lightbox)', 'mb_framework')   => 'image',
				__('Custom URL', 'mb_framework')   => 'custom',
				__('Custom Field', 'mb_framework')   => 'custom_field',
			),
			'std' => ''
		);
		$array[] = array(
			'type' => 'textfield',
			'heading' => __( 'Link Custom Field Key', 'mb_framework' ),
			'param_name' => 'link_custom_field_key',
			'dependency' => array ('element' => 'add_link', 'value' => 'custom_field'),
			'admin_label' => false,
		);
		$array[] = array(
			'type' => 'vc_link',
			'heading' => __( 'Custom URL', 'mb_framework' ),
			'param_name' => 'custom_url',
			'admin_label' => false,
			'dependency' => array ('element' => 'add_link', 'value' => 'custom'),
			'weight' => 0
		);
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', 'mb_framework' ),
			'param_name' => 'link_target',
			'admin_label' => false,
			'dependency' => array ('element' => 'add_link', 'value' => array ( 'post','term','author','date', 'custom_field' )),
			'value' => array(
				__('Existing Tab', 'mb_framework')   => '',
				__('New Tab', 'mb_framework')   => '_blank'
			),
			'std' => ''
		);
		$array[] = array(
			'type' => 'dropdown',
			'heading' => __( 'No Follow', 'mb_framework' ),
			'param_name' => 'no_follow',
			'admin_label' => false,
			'dependency' => array ('element' => 'add_link', 'value' => array ( 'post','term','author','date', 'custom_field' )),
			'value' => array(
				__('Disable', 'mb_framework')   => '',
				__('Enable', 'mb_framework')   => 'true'
			),
			'std' => ''
		);
		return $array;
	}
endif;

/* Extra Class Name */
if(!function_exists('gusta_vc_extra_class_name')):
	function gusta_vc_extra_class_name() {
		$data = array(
			'type' => 'textfield',
			'heading' => __( 'Extra Class Name', 'mb_framework' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mb_framework' ),
			'admin_label' => true,
			'weight' => 0
		);
		return apply_filters( 'gusta_vc_extra_class_name', $data );
	}
endif;

/* Add Custom VC Params */
//include( SMART_SECTIONS_PLUGIN_PATH . 'vc_params/vc_button.php' ); //Button Param
if (file_exists(get_theme_file_path().'/smart-sections/vc_params/vc_icon_picker.php')): include( get_theme_file_path().'/smart-sections/vc_params/vc_icon_picker.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'vc_params/vc_icon_picker.php'); endif; //Icon Picker Param
if (file_exists(get_theme_file_path().'/smart-sections/vc_params/vc_advanced_css.php')): include( get_theme_file_path().'/smart-sections/vc_params/vc_advanced_css.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'vc_params/vc_advanced_css.php'); endif; //Advanced CSS
if (file_exists(get_theme_file_path().'/smart-sections/vc_params/vc_text_styles.php')): include( get_theme_file_path().'/smart-sections/vc_params/vc_text_styles.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'vc_params/vc_text_styles.php'); endif; //Text Styles

/* Shortcode HTML based functions*/

/* Mobile Alignment and Display */
if(!function_exists('gusta_mobile_display')):
	function gusta_mobile_display($atts) {
		if ($atts): extract($atts); endif;
		$mobile_disp = ' ';
		if (isset($mobile_display) && $mobile_display!=''):
			if (!isset($mobile_alignment) || $mobile_alignment==''): 
				$mobile_alignment = "left";
			endif;
			$mobile_disp .= 'gusta-mobile-align-'.$mobile_alignment.' '; 
			$mobile_disp .= $mobile_display_inline;
		endif;
		return $mobile_disp;
	}
endif;

/* Clear class both desktop and mobile to post if displayed inline or not */
if(!function_exists('gusta_clear')):
	function gusta_clear($atts) {
		if ($atts): extract($atts); endif;
		$c_class = $output = '';
		if ($display_inline==''): $c_class = 'gusta-clear '; endif;
		if (isset($mobile_display_inline) || $mobile_display_inline==''): if ($display_inline==''): $c_class .= 'gusta-mobile-clear'; endif; endif; 
		if ($c_class!=''): $output .= '<div class="'.$c_class.'"></div>'; endif;
		return $output;
	}
endif;

/* Gusta Link */
if(!function_exists('gusta_link')):
	function gusta_link($atts, $the_post, $input, $link_class, $no_follow=false) {
		if ($atts): extract($atts); endif;
		$the_permalink = $target_attr = $linked = '';
		if (isset($add_link) && $add_link != 'none'):
			$target_attr = (isset($link_target) && $link_target=='_blank' ? ' target="_blank"' : '');
			if ($add_link=='custom' && isset($custom_url) && $custom_url!=''):
				$linked = gusta_serialize_link ($custom_url, $input, $link_class, false);
			else:
				if (isset($the_post->term_id) && $add_link=='term'):
					$the_permalink = get_term_link($the_post->term_id);
				elseif ($the_post && $add_link=='post'):
					$the_permalink = get_permalink($the_post->ID);
				elseif ($add_link=='author'):
					$author = $the_post->post_author;
					$the_permalink = get_author_posts_url($author);
				elseif ($add_link=='date'):
					$month = get_the_time('m', $the_post->post_date);
					$year = get_the_time('Y', $the_post->post_date);
					$the_permalink = get_month_link($month, $year);
				elseif ($add_link=='image'):
					$the_permalink = get_the_post_thumbnail_url($the_post);
					$link_class .= ' " data-lightbox="lightbox" data-title="';
				elseif ($add_link=='custom_field'):
					$the_permalink = get_post_meta( $the_post->ID, $link_custom_field_key, true );
					//if ($the_permalink==''): $the_permalink = get_field($link_custom_field_key, $the_post->ID); endif;
				endif;
				if ($link_class!=''): $link_class = ' class="'.$link_class.'"'; endif;
				$linked = '<a'.$link_class;
				if ($no_follow=='true'): $linked .= ' rel="nofollow"'; endif;
				$linked .= ' href="'.$the_permalink.'"'.$target_attr.'>'.$input.'</a>';
			endif;
		else:
			$linked = $input;
		endif;
		return $linked;
	}
endif;

if(!function_exists('gusta_add_vc_id_to_shortcodes')):
	function gusta_add_vc_id_to_shortcodes ( $content ) {
		$shortcodes = array();
		$shortcodes = explode ("[", $content);
		$content = '';
		$i=0;
		
		$available = array (
			'gusta_navigation',
			'gusta_section_toggle',
			'gusta_close_button',
			'gusta_breadcrumb',
			'gusta_section',
			'gusta_author_info_box',
			'gusta_search_box',
			'gusta_social_media_links',
			'gusta_social_sharing_box',
			'gusta_site_logo',
			'gusta_post_filter',
			'gusta_post_listing',
			'gusta_taxonomy_listing',
			'gusta_post_carousel',
			'gusta_facebook_comment_box',
			'gusta_disqus_comment_box',
			'gusta_post_title',
			'gusta_post_excerpt',
			'gusta_post_date',
			'gusta_post_content',
			'gusta_post_author',
			'gusta_post_author_image',
			'gusta_post_categories',
			'gusta_post_tags',
			'gusta_post_taxonomies',
			'gusta_post_read_more_button',
			'gusta_post_custom_field',
			'gusta_text',
			'gusta_container',
			'gusta_post_featured_image',
			'gusta_post_featured_image_as_background',
			'gusta_cart_icon',
			'gusta_add_to_cart',
			'gusta_product_price',
			'gusta_wc_product_title',
			'gusta_wc_product_images',
			'gusta_wc_product_description',
			'gusta_wc_product_short_description',
			'gusta_wc_product_additional_information',
			'gusta_wc_product_sku',
			'gusta_wc_product_categories',
			'gusta_wc_product_tags',
			'gusta_wc_product_rating',
			'gusta_wc_product_reviews',
			'gusta_wc_product_sale_label',
			'gusta_wc_product_featured_label',
			'gusta_wc_direct_checkout',
			'gusta_wc_product_upsells',
		);
		
		$vc_ids = array();
		
		foreach ($shortcodes as $shortcode):
			if (strpos($shortcode, ']') !== false):
				if (strpos($shortcode, 'vc_id') !== false):
					$exp = explode("vc_id=",$shortcode);
					$vc_id = str_replace(array("]",'"'), array("",""), strstr( stripslashes($exp[1]) . ' ', ' ', true ));
					if ($vc_id==''):
						$new_vc_id = "el-".uniqid(mt_rand());
						$vc_ids[] = $new_vc_id;
						$content .= '['.str_replace(array(addslashes('vc_id="'), 'vc_id="'), array(addslashes('vc_id="'.$new_vc_id), 'vc_id="'.$new_vc_id), $shortcode);
					elseif (in_array($vc_id, $vc_ids)):
						$new_vc_id = "el-".uniqid(mt_rand());
						$vc_ids[] = $new_vc_id;
						$content .= '['.str_replace($vc_id, $new_vc_id, $shortcode);
					else:
						$vc_ids[] = $vc_id;
						$content .= '['.$shortcode;
					endif;
				else:
					$shr = explode("]", $shortcode);
					$sh = str_replace("]", "", strstr( $shr[0] . ' ', ' ', true ));
					if (in_array($sh, $available)):
						if ($shortcode[0] == '/'):
							$content .= '['.$shortcode;
						else:
							$vc_id = "el-".uniqid(mt_rand());
							$vc_ids[] = $vc_id;
							$content .= '['.str_replace(']', ' vc_id="'.$vc_id.'"]', $shortcode);
						endif;
					else:
						$content .= '['.$shortcode;
					endif;
				endif;
			else:
				$content .= $shortcode;
			endif;
			$i++;
		endforeach;
		return $content;
	}
	add_filter( 'content_save_pre', 'gusta_add_vc_id_to_shortcodes', 99999999, 1 );
endif;
?>