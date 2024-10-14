<?php
/*
* Dynamic CSS Functions
*
*
* @file           includes/css.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Enqueues Dynamic Style CSS 
if ( !function_exists( 'gusta_enqueue_dynamic_styles' ) ):
	function gusta_enqueue_dynamic_styles() {
		wp_register_style( 'gusta-dynamic', SMART_SECTIONS_PLUGIN_URL . 'assets/css/dynamic.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'gusta-dynamic' );
	}
	add_action( 'wp_enqueue_scripts', 'gusta_enqueue_dynamic_styles', 9999 );
endif;


/* Saves the dynamic css to dynamic.css file 
if ( !function_exists( 'gusta_open_dynamic_status' ) ):
	function gusta_open_dynamic_status () {
		update_option('gusta_save_css', 1); 
	}
	add_action('acf/save_post', 'gusta_open_dynamic_status', 9999);
endif;


/* Write and update dynamic css 
if ( !function_exists( 'gusta_write_dynamic_css' ) ):
	function gusta_write_dynamic_css() {
		if (!is_admin()):
			if (get_option('gusta_save_css')==1):
				$css_file = SMART_SECTIONS_PLUGIN_PATH . '/assets/css/dynamic.css';
				
				if (is_writable($css_file)): 
					if ($open_css_file = fopen($css_file, "w")):				
						
						$write_css = preg_replace( '/\s+/', ' ', 
							gusta_my_web_fonts() . 
							/* gusta_get_display_layouts() . 
							get_option('options_gusta_dynamic_css'));
						
						fwrite($open_css_file, $write_css);
						fclose($open_css_file);
						
					endif;
				endif;
				update_option('gusta_save_css', 0); 
			endif;
		endif;
	}
	add_action('init', 'gusta_write_dynamic_css');
endif;*/

//$posts = mysql_query("select `ID`, `post_content` from `wp_posts`");

/* Post Dynamic CSS Inline if dynamic.css is not writable 
if ( !function_exists( 'gusta_inline_dynamic_css' ) ):
	function gusta_inline_dynamic_css () {
		
		$css_file = SMART_SECTIONS_PLUGIN_PATH . '/assets/css/dynamic.css';
		if (get_option('gusta_save_css')!=1 || !is_writable($css_file)):
		
			$write_css = preg_replace( '/\s+/', ' ', 
				gusta_my_web_fonts() . 
				/* gusta_get_display_layouts() . 
				get_option('options_gusta_dynamic_css') );
				
			echo '<style id="gusta_inline_css">'.$write_css.'</style>';
		endif;
	}
	add_action( 'wp_head', 'gusta_inline_dynamic_css' );
endif;*/

/* Post CSS of the Section Layout Width Options 
function gusta_get_display_layouts () {
	
	$layouts = array(
		array (
			'field'		=>	'gusta_large_desktop_display_layout',
			'from'		=>	'1200px',
			'to'		=>	'',
			'default'	=>	gusta_get_theme_var('xl')
		),
		array (
			'field'		=>	'gusta_default_display_layout',
			'from'		=>	'992px',
			'to'		=>	'1199px',
			'default'	=>	gusta_get_theme_var('lg')
		),
		array (
			'field'		=>	'gusta_tablet_portrait_landscape_small_desktop_display_layout',
			'from'		=>	'768px',
			'to'		=>	'991px',
			'default'	=>	gusta_get_theme_var('md')
		),
		array (
			'field'		=>	'gusta_landscape_phone_portrait_tablet_display_layout',
			'from'		=>	'576px',
			'to'		=>	'767px',
			'default'	=>	gusta_get_theme_var('sm')
		),
		array (
			'field'		=>	'gusta_portrait_landscape_phone_display_layout',
			'from'		=>	'',
			'to'		=>	'575px',
			'default'	=>	gusta_get_theme_var('xs')
		)
	);
	$output = "";
	
	foreach ($layouts as $layout):
		extract ($layout);
		$width = get_option('options_'.$field);
		if ($width==''): $width = $default; endif;
		$output .= " @media only screen";
		if ($from):
			$output .= ' and (min-width : ' . $from . ')';
		endif;
		if ($to):
			$output .= ' and (max-width : ' . $to . ')';
		endif;
		$output .= ' { .gusta-section .container { max-width: '.$width.' !important; } }';
	endforeach;
	
	return $output;
} */

/* Enqueue custom vc section styles 
if ( !function_exists( 'gusta_add_sections_custom_css' ) ):
	function gusta_add_sections_custom_css() {

		$args = array(
			'post_type' => 'gusta_section',
			'post_status' => 'publish',
			'posts_per_page' => -1
		);
		$sections_query = new WP_Query($args);

		$output = "";
		
		// Starting the loop
		while ($sections_query->have_posts()) : $sections_query->the_post();
			$post_ID = get_the_ID();

			$section_shortcodes_custom_css = get_post_meta( $post_ID, '_wpb_shortcodes_custom_css', true );
			$section_post_custom_css = get_post_meta( $post_ID, '_wpb_post_custom_css', true );
			$output .= $section_shortcodes_custom_css.$section_post_custom_css;
				
			if (get_post_meta($post_ID, 'gusta_display_this_section_when', true)):
				$i=0;
				$loop=true;
				while ( $loop == true ):
					$min_width = get_post_meta($post_ID, 'gusta_display_this_section_when_'.$i.'_gusta_min_width', true);
					$max_width = get_post_meta($post_ID, 'gusta_display_this_section_when_'.$i.'_gusta_max_width', true);
					if (($min_width) || ($max_width)):
						$output .= ' @media only screen';
						if ($min_width):
							$output .= ' and (min-width : ' . $min_width . ')';
						endif;
						if ($max_width):
							$output .= ' and (max-width : ' . $max_width . ')';
						endif;
						if (get_post_meta( $post_ID, 'gusta_sticky_section', true )!='1'):
							$output .= ' { #section-'.$post_ID.' { display: block; } }';
						endif;
						$i++;
					else:
						$loop=false;
					endif;
				endwhile;
			else:
				$output .= ' #section-'.$post_ID.' { display: block; } ';
			endif;
		endwhile;
		
		$output_trimmed =  preg_replace( '/\s+/', ' ', $output );
		
		wp_reset_query();
		return $output_trimmed;
	}
endif;*/


/* Displays the inline css of shortcodes */
if ( !function_exists( 'gusta_inline_shortcode_css' ) ):
	function gusta_inline_shortcode_css ( $dynamic_css, $post_id=null, $type=null, $card_design_class=null ) {
		global $post;
		
		$preview_id = $content = '';
		
		if ($type=='section-inner' || $type=='section'):
			$content = get_post_field('post_content', $post_id);
		else:
			if ($post):
				if (is_singular()):
					$content = $post->post_content;
				endif;
			endif;
		endif;
		
		if ($post_id==''): $post_id = $preview_id; endif;
		
		$shortcodes = array (
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
		
		if (!$dynamic_css): $dynamic_css = array(); endif;
		
		if ($content!=''):
		
			$r = $content;
			
			foreach ($shortcodes as $shortcode):
				if (strpos($r, "[".$shortcode) !== false):
					
					$loop=true;
					$i=0;
					while ($loop==true):
						$atts=array();
						$shatts = gusta_get_string_between($r, '['.$shortcode.' ', ']');
						$atts = shortcode_parse_atts($shatts);
						
						$r = str_replace('['.$shortcode.' '.$shatts.']', '', $r);
						$r = str_replace('['.$shortcode.']', '', $r);
						
						if ($shatts): 
							extract($atts); 
							
							if (file_exists(get_theme_file_path().'/smart-sections/includes/css/'.$shortcode.'.php')):
								include(get_theme_file_path() . '/smart-sections/includes/css/'.$shortcode.'.php');
							elseif (file_exists(SMART_SECTIONS_PLUGIN_PATH . 'includes/css/'.$shortcode.'.php')):
								include(SMART_SECTIONS_PLUGIN_PATH . 'includes/css/'.$shortcode.'.php');
							endif;
							
						unset ($atts);
						endif;
						
						if (strpos($r, "[".$shortcode) === false):
							$loop=false;
						endif;
						$i++;
						if ($i==50) : $loop=false; endif;
					
					endwhile;
				endif;
			endforeach;
		endif;
		wp_reset_query();
		return ($dynamic_css);
	}
endif;


/* This function parses all the inline dynamic css of shortcode inside content of the page and the included sections. */
if ( !function_exists( 'gusta_parse_dynamic_css' ) ):
	function gusta_parse_dynamic_css () {
		global $post, $header_selector, $content_selector, $footer_selector;
		$parse_css = $sections_css = '';
		$dynamic_css = array();
		$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css );
		$dynamic_css["body.gusta-vertical-header-left"] = $dynamic_css["body.gusta-vertical-header-right"] = '';
		//$dynamic_css[gusta_get_theme_var('header').",".gusta_get_theme_var('content').",".gusta_get_theme_var('footer')] = 'display: none;';
		if (!(is_preview() && (get_post_type()=="gusta_section"))):
			if (gusta_get_theme_var('container') != 'container'):
				$container = gusta_get_theme_var('container');
			else:
				$container = 'container';
			endif;
			$section_areas = array ('header', 'above_content', 'content', 'archive', 'below_content', 'footer', 'sticky');

			foreach ($section_areas as $area):
				$section_array = get_gusta_option('gusta_'.$area.'_sections', gusta_get_template(), 'section');
				
				if ($section_array):
					if (!is_array($section_array)) : $section_array = explode(',',$section_array); endif;

					foreach ($section_array as $section):
						
						$gusta_section_purpose = get_post_meta($section, 'gusta_section_purpose', true);
						
						if (!isset($dynamic_css["#section-".$section])):
							$dynamic_css["#section-".$section] = '';
						endif;
						
						if (in_array($gusta_section_purpose, array('vertical','sidebar'))):
							$overlapping = (get_post_meta($section, 'gusta_overlapping_section', true) ? ' section-overlapping' : '');
							$sticky = (get_post_meta($section, 'gusta_sticky_section', true) ? ' section-sticky' : '');
						endif;
						
						if ($gusta_section_purpose=='sticky'): $sticky = true; else: $sticky = false; endif;
						
						$transparency = floatval(get_post_meta($section, 'gusta_section_background_gusta_section_background_transparency', true)) / 100;
						$transparency = ($transparency ? $transparency : 1);
						$bg_color_opt = get_post_meta($section, 'gusta_section_background_gusta_section_background_color', true);
						$background_color = ( $bg_color_opt ? gusta_hextorgbcss($bg_color_opt, $transparency) : '');
						
						$section_height = $section_width = '';
						if ($gusta_section_purpose=='vertical'):
							$section_width = get_post_meta($section, 'gusta_ver_section_width', true);
						endif;
						if ($sticky):
							$section_width = get_post_meta($section, 'gusta_section_width_height_gusta_section_width', true);
							$section_height = get_post_meta($section, 'gusta_section_width_height_gusta_section_height', true);
							$section_order = get_post_meta($section, 'gusta_sticky_section_layer_order', true);
							if ($section_order!=1000 && $section_order!=''):
								$dynamic_css["#section-".$section] .= 'z-index: '.$section_order.' !important;';
							endif;
						endif;
						
						$vertical_css = '';
						if ($gusta_section_purpose=='vertical'):
							$align = get_post_meta($section, 'gusta_ver_section_alignment', true);
							if ($align==''): $align = 'left'; endif;
							if ($section_width==''): $section_width = '320px'; endif;
							$vertical_css .= ' body[class*="gusta-vertical-header"]>.'.gusta_get_theme_var ('container').' { -webkit-transition: max-width 350ms; -o-transition: max-width 350ms; transition: max-width 350ms; }';
							if ($align=='left'):
								$vertical_css .= ' body.gusta-vertical-header-left:not(.gusta-body-zero-margin) { margin-left: '.$section_width.' !important; max-width: calc(100% - '.$section_width.') !important; } body.gusta-vertical-header-left:not(.gusta-body-zero-margin) '.gusta_get_theme_var ('content').' .'.gusta_get_theme_var ('container').' { max-width:100% !important; padding-left: 15px !important; padding-right: 15px !important; } #gusta-sticky>.'.gusta_get_theme_var ('container').' { margin: 0 auto !important; }';
							else:
								$vertical_css .= ' body.gusta-vertical-header-right:not(.gusta-body-zero-margin) { margin-right: '.$section_width.' !important; max-width: calc(100% - '.$section_width.') !important; } body.gusta-vertical-header-right:not(.gusta-body-zero-margin) '.gusta_get_theme_var ('content').' .'.gusta_get_theme_var ('container').' { max-width:100% !important; padding-left: 15px !important; padding-right: 15px !important; }  #gusta-sticky>.'.gusta_get_theme_var ('container').' { margin: 0 auto !important; }';
							endif;
						endif;
					
						$f_min_width = get_post_meta($section, 'gusta_display_this_section_when_0_gusta_min_width', true);
						$f_max_width = get_post_meta($section, 'gusta_display_this_section_when_0_gusta_max_width', true);
						
						if ($f_min_width || $f_max_width):
							$i=0;
							$loop=true;	
							while ( $loop == true ):
								$sections_hide = "";
								$min_width = get_post_meta($section, 'gusta_display_this_section_when_'.$i.'_gusta_min_width', true);
								$max_width = get_post_meta($section, 'gusta_display_this_section_when_'.$i.'_gusta_max_width', true);
								$h_min_width = str_replace("px", '', $min_width);
								if (!$h_min_width): $h_min_width = 0; endif;
								$h_min_width = $h_min_width - 1;
								$h_min_width = $h_min_width . "px";
								$h_max_width = str_replace("px", '', $max_width);
								if (!$h_max_width): $h_max_width = 0; endif;
								$h_max_width = $h_max_width . "px";
								if (($min_width) && ($max_width)):
									$sections_css .= ' @media screen and (min-width : ' . $min_width . ') and (max-width : ' . $max_width . ')';
									$sections_hide_1 .= ' @media screen and (min-width : ' . $h_max_width . ')';
									$sections_hide_2 .= ' @media screen and (max-width : ' . $h_min_width . ')';
									$sections_css .= ' {';
									$sections_hide_1 .= ' {';
									$sections_hide_2 .= ' {';
									$sections_css .= $vertical_css;
									$sections_css .= ' #section-'.$section.' { display: block; } }';
									$sections_hide_1 .= ' #section-'.$section.' { display: none !important; } }';
									$sections_hide_2 .= ' #section-'.$section.' { display: none !important; } }';
									$sections_css .= $sections_hide_1 . $sections_hide_2;
									$i++;
									
								elseif (($min_width) || ($max_width)):
									$sections_css .= ' @media screen';
									$sections_hide .= ' @media screen';
									if ($min_width):
										$sections_css .= ' and (min-width : ' . $min_width . ')';
										$sections_hide .= ' and (max-width : ' . $h_min_width . ')';
									endif;
									if ($max_width):
										$sections_css .= ' and (max-width : ' . $max_width . ')';
										$sections_hide .= ' and (min-width : ' . $h_max_width . ')';
									endif;
									$sections_css .= ' {';
									$sections_hide .= ' {';
									$sections_css .= $vertical_css;
									$sections_css .= ' #section-'.$section.' { display: block; } }';
									$sections_hide .= ' #section-'.$section.' { display: none !important; } }';
									$sections_css .= $sections_hide;
									$i++;
								else:
									$loop=false;
								endif;
							endwhile;
						else:
							$sections_css .= $vertical_css;
							$sections_css .= ' #section-'.$section.' { display: block; }';
						endif;
						
						$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $section, 'section' );

						$dynamic_css["#section-".$section] .= ($background_color ? 'background-color: '.$background_color.' !important;' : '');

						if (!isset($dynamic_css["#section-".$section.">.".$container.""])): $dynamic_css["#section-".$section.">.".$container.""] = ''; endif;
						
						if ($section_width!=''):
							if ($section_width!='100%'):
								$dynamic_css["#section-".$section.">.".$container.""] .= 'width: 100% !important; max-width: 100% !important; padding: 0;';
								if (gusta_theme_name()!='jupiter'):
									$dynamic_css["#section-".$section.">.".$container.""] .= 'padding-left: 15px !important; padding-right: 15px !important;';
								endif;
							endif;
							$dynamic_css["#section-".$section] .= 'width: 100% !important; max-width: '.$section_width.' !important;';
						endif;
						
						$dynamic_css["#section-".$section] .= (get_post_meta($section, 'gusta_scroll_inside', true) ? ' overflow-y: auto !important; overflow-x: hidden !important;' : '');
						
						if ($section_height!=''):
							$dynamic_css["#section-".$section] .= 'height: '.$section_height.' !important;';
						endif;
						
						$section_shortcodes_custom_css = get_post_meta( $section, '_wpb_shortcodes_custom_css', true );
						$section_post_custom_css = get_post_meta( $section, '_wpb_post_custom_css', true );
						$sections_css .= $section_shortcodes_custom_css.$section_post_custom_css;
						
					endforeach;
				endif;
			endforeach;
		endif;
		
		/*if (is_preview() && get_post_type()=="gusta_section"):
			$dynamic_css[gusta_get_theme_var('content')] = 'display: none !important;';
		endif;*/
		
		if (!isset($dynamic_css['.'.$container])): $dynamic_css['.'.$container] = ''; endif;
		$dynamic_css['.'.$container] .= 'box-sizing: border-box !important;';
		
		$dynamic_css['.'.$container.' .gusta-section>.'.$container] = 'padding: 0; margin: 0;';
		
		$gusta_above_header_sections = get_gusta_option('gusta_above_header_sections', gusta_get_template(), 'section');
		$gusta_header_sections = get_gusta_option('gusta_header_sections', gusta_get_template(), 'section');
		$gusta_archive_sections = get_gusta_option('gusta_archive_sections', gusta_get_template(), 'section');
		$gusta_content_sections = get_gusta_option('gusta_content_sections', gusta_get_template(), 'section');
		$gusta_footer_sections = get_gusta_option('gusta_footer_sections', gusta_get_template(), 'section');
		
		if ($gusta_header_sections):
			$dynamic_css[$header_selector] = 'display: none;';
		endif;
		
		if ($gusta_archive_sections || $gusta_content_sections):
			$dynamic_css[$content_selector] = 'display: none;';
		endif;
		
		$dynamic_css[$footer_selector] = 'display: none;';
		
		/*$mega_menus = gusta_get_meta_values( 'gusta_mega_menu_section' );
		
		$mega_menu_css = '';
		foreach ( $mega_menus as $mega_menu ):
			if ($mega_menu!=''):
				$mega_menu_css .= get_post_meta( $mega_menu, '_wpb_shortcodes_custom_css', true );
				$mega_menu_css .= get_post_meta( $mega_menu, '_wpb_post_custom_css', true );
				$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $mega_menu, 'section-inner' );
			endif;	
		endforeach;*/
		
		$responsive = array();
		foreach ($dynamic_css as $var => $val):
			if (strpos($var, '@') !== false):
				unset($dynamic_css[$var]);
				$responsive[$var] = $val;
			endif;
		endforeach;
		
		$dynamic_css = array_merge($dynamic_css, $responsive);
		
		foreach ($dynamic_css as $var => $val):
			if ($val): $parse_css .= ' '. $var . ' { ' . $val . ' }'; endif;
		endforeach;				
		
		$parse_css .= $sections_css;
		$parse_css .= gusta_get_theme_var('extra_css');
		$parse_css .= gusta_my_web_fonts();
		
		$parse_css = trim ( preg_replace( '/\s+/', ' ', $parse_css) );

		if ($parse_css!=''): echo '
<style id="gusta_inline_css">'.$parse_css.'</style>
'; endif;
	}
	add_action ( 'wp_head', 'gusta_parse_dynamic_css', 9999 );
endif;

/* Parses the dynamic CSS shortcode attributes */
if ( !function_exists( 'gusta_show_dynamic_css' ) ):
	function gusta_show_dynamic_css ( $atts ) {
		/*
		'el_class' => '',
		'dynamic_css' => '',
		'shatts' => '',
		'el_slug' => '',
		'text_class' => '',
		'text_active_class' => '',
		'enable_hover' => '',
		'hover_class' => ''
		'enable_active' => '',
		'active_class' => ''
		'after_class' => ''
		'hover_after_class' => ''
		'active_after_class' => '' 
		*/

		extract ($atts);
		if ($el_class!='#'):

			if (!isset($shatts['tg_'.$el_slug."_tg_normal_tg_advanced_css"])): $shatts['tg_'.$el_slug."_tg_normal_tg_advanced_css"]=""; endif;
			if (!isset($shatts['tg_'.$el_slug."_tg_normal_tg_background_image"])): $shatts['tg_'.$el_slug."_tg_normal_tg_background_image"]=""; endif;
			if (!isset($dynamic_css[$el_class])): $dynamic_css[$el_class]=""; endif;
			
			$el_css = $shatts['tg_'.$el_slug."_tg_normal_tg_advanced_css"];
			
			$bg=false;
			if ($el_slug=='container'): $bg = true; endif;
			
			$el_css = gusta_box_shadow_css ($el_css);
			$el_css = gusta_background_css ($el_css, $shatts['tg_'.$el_slug."_tg_normal_tg_background_image"], $bg);
			
			if ($el_css!=""): ($dynamic_css[$el_class] ? $dynamic_css[$el_class] .= $el_css : $dynamic_css[$el_class] = $el_css); endif;
			
			if (strpos($shatts['tg_'.$el_slug."_tg_normal_tg_advanced_css"], 'overlay') !== false) {
				if (!isset($overlay_class)): $overlay_class = $el_class.' .gusta-overlay'; endif;
				$overlay_css = gusta_overlay_css ($shatts['tg_'.$el_slug."_tg_normal_tg_advanced_css"]);
				$dynamic_css[$overlay_class]=$overlay_css;
			}

			if ($enable_hover):
				if (!isset($shatts['tg_'.$el_slug."_tg_hover_tg_advanced_css"])) { $shatts['tg_'.$el_slug."_tg_hover_tg_advanced_css"]=""; }
				if (!isset($shatts['tg_'.$el_slug."_tg_hover_tg_background_image"])) { $shatts['tg_'.$el_slug."_tg_hover_tg_background_image"]=""; }
				
				if (!isset($hover_class)): $hover_class=""; endif;
				
				$el_hover_class = ($hover_class!='' ? $hover_class : $el_class.':hover');
				
				if (!isset($dynamic_css[$el_hover_class])): $dynamic_css[$el_hover_class]=""; endif;
				
				$el_hover_css = $shatts['tg_'.$el_slug."_tg_hover_tg_advanced_css"];
				$el_hover_css = gusta_box_shadow_css ($el_hover_css);
				$el_hover_css = gusta_background_css ($el_hover_css, $shatts['tg_'.$el_slug."_tg_hover_tg_background_image"], $bg);
				
				if ($el_hover_css!=""): ($dynamic_css[$el_hover_class] ? $dynamic_css[$el_hover_class] .= $el_hover_css : $dynamic_css[$el_hover_class] = $el_hover_css); endif;
				
				if (strpos($shatts['tg_'.$el_slug."_tg_hover_tg_advanced_css"], 'overlay') !== false) {
					if (!isset($overlay_hover_class)): $overlay_hover_class = $el_hover_class.' .gusta-overlay'; endif;
					$overlay_hover_css = gusta_overlay_css ($shatts['tg_'.$el_slug."_tg_hover_tg_advanced_css"]);
					$dynamic_css[$overlay_hover_class]=$overlay_hover_css;
				}
			endif;

			if ($enable_active):
				if (!isset($shatts['tg_'.$el_slug."_tg_active_tg_advanced_css"])) { $shatts['tg_'.$el_slug."_tg_active_tg_advanced_css"]=""; }
				if (!isset($shatts['tg_'.$el_slug."_tg_active_tg_background_image"])) { $shatts['tg_'.$el_slug."_tg_active_tg_background_image"]=""; }
				
				$el_active_class = $active_class;
				
				if (!isset($dynamic_css[$el_active_class])): $dynamic_css[$el_active_class]=""; endif;
				
				$el_active_css = $shatts['tg_'.$el_slug."_tg_active_tg_advanced_css"];
				$el_active_css = gusta_box_shadow_css ($el_active_css);
				$el_active_css = gusta_background_css ($el_active_css, $shatts['tg_'.$el_slug."_tg_active_tg_background_image"]);
				
				if ($el_active_css!=""): ($dynamic_css[$el_active_class] ? $dynamic_css[$el_active_class] .= $el_active_css : $dynamic_css[$el_active_class] = $el_active_css); endif;
			endif;
		endif;

		return $dynamic_css;
	}
endif;

/* Gradient CSS 
if ( !function_exists( 'gusta_gradient_css' ) ):
	function gusta_gradient_css ($advanced_css) {
		$overlay = gusta_get_string_between ($advanced_css, 'overlay:', ' !important;');
		$gradient_direction = gusta_get_string_between ($advanced_css, 'gradient_direction:', ' !important;');
		if (!$gradient_direction): $gradient_direction='top'; endif;
		$percentage_from = gusta_get_string_between ($advanced_css, 'gradient_percentage_from:', ' !important;');
		if (!$percentage_from): $percentage_from='0%'; endif;
		$percentage_to = gusta_get_string_between ($advanced_css, 'gradient_percentage_to:', ' !important;');
		if (!$percentage_to): $percentage_to='100%'; endif;
		$overlay_color = gusta_get_string_between ($advanced_css, 'overlay-color:', ' !important;');
		$gradient_color = gusta_get_string_between ($advanced_css, 'gradient-color:', ' !important;');
		$addcss = "";
		if ($overlay=='gradient'):
			$type = 'linear-gradient';
			switch ($gradient_direction) {
				case 'top': $direction = 'to bottom'; break;
				case 'left': $direction = 'to right'; break;
				case 'top-left': $direction = '135deg'; break;
				case 'bottom-left': $direction = '45deg'; break;
				case 'radial': $direction = 'ellipse at center'; $type = 'radial-gradient'; break;
			}
			
			if (!$direction): $direction='to bottom'; endif;
			if (!$overlay_color): $overlay_color = 'rgba(255,255,255,0)'; endif;
			if (!$gradient_color): $gradient_color = 'rgba(255,255,255,0)'; endif;
			
			$addcss .= ' background: '.$type.'('.$direction.', '.gusta_hextorgbcss($overlay_color, 1).' '.$percentage_from.', '.gusta_hextorgbcss($gradient_color, 1).' '.$percentage_to.') !important;';

		else:
			if ($overlay_color):
				$addcss = ' background: '.$overlay_color.' !important;';
			else:
				$addcss = '';
			endif;
		endif;
		
		$newcss = str_replace ('overlay:'.$overlay.' !important;','',$advanced_css);
		$newcss = str_replace ('overlay-color:'.$overlay_color.' !important;','',$newcss);
		$newcss = str_replace ('gradient-color:'.$gradient_color.' !important;','',$newcss);
		$newcss = str_replace ('gradient_direction:'.$gradient_direction.' !important;','',$newcss);
		$newcss = str_replace ('gradient_percentage_from:'.$percentage_from.' !important;','',$newcss);
		$newcss = str_replace ('gradient_percentage_to:'.$percentage_to.' !important;','',$newcss);
		
		$return = array();
		
		$return["gradient_css"] = $addcss;
		$return["new_tg_advanced_css"] = $newcss;
		
		return $return;
	}
endif;*/


/* Box Shadow CSS */
if ( !function_exists( 'gusta_box_shadow_css' ) ):
	function gusta_box_shadow_css ($advanced_css) {
		$box_shadow = gusta_get_string_between ($advanced_css, 'box-shadow:', ' !important;');
		$shadow_color = gusta_get_string_between ($advanced_css, 'box-shadow-color:', ' !important;');
		if ($shadow_color && $box_shadow):
			$new_box_shadow = $box_shadow.' '.$shadow_color;
			$newcss = str_replace ('box-shadow-color:'.$shadow_color.' !important;','',$advanced_css);
			$newcss = str_replace ('box-shadow:'.$box_shadow.' !important;','box-shadow:'.$new_box_shadow.' !important;',$newcss);
			return $newcss;
		else:
			return $advanced_css;
		endif;
	}
endif;

/* Overlay CSS*/
if ( !function_exists( 'gusta_overlay_css' ) ):
	function gusta_overlay_css ($advanced_css) {
		$overlay = gusta_get_string_between ($advanced_css, 'overlay:', ' !important;');
		$gradient_direction = gusta_get_string_between ($advanced_css, 'gradient_direction:', ' !important;');
		if (!$gradient_direction): $gradient_direction='top'; endif;
		$percentage_from = gusta_get_string_between ($advanced_css, 'gradient_percentage_from:', ' !important;');
		if (!$percentage_from): $percentage_from='0%'; endif;
		$percentage_to = gusta_get_string_between ($advanced_css, 'gradient_percentage_to:', ' !important;');
		if (!$percentage_to): $percentage_to='100%'; endif;
		$overlay_color = gusta_get_string_between ($advanced_css, 'overlay-color:', ' !important;');
		$gradient_color = gusta_get_string_between ($advanced_css, 'gradient-color:', ' !important;');
		
		$return = '';
		
		if ($overlay_color):
			$return .= 'background:';
			$type = 'linear-gradient';
			switch ($gradient_direction) {
				case 'top': $direction = 'to bottom'; break;
				case 'left': $direction = 'to right'; break;
				case 'top-left': $direction = '135deg'; break;
				case 'bottom-left': $direction = '45deg'; break;
				case 'radial': $direction = 'ellipse at center'; $type = 'radial-gradient'; break;
			}
			
			if (!$direction): $direction='to bottom'; endif;
			if (!$overlay_color): $overlay_color = 'rgba(255,255,255,0)'; endif;
			if (!$gradient_color): $gradient_color = $overlay_color; endif;
			
			$return .= ' '.$type.'('.$direction.', '.gusta_hextorgbcss($overlay_color, 1).' '.$percentage_from.', '.gusta_hextorgbcss($gradient_color, 1).' '.$percentage_to.')';
			$return .= ' !important;';
		endif;
		
		return $return;
	}
endif;

/* Background CSS */
if ( !function_exists( 'gusta_background_css' ) ):
	function gusta_background_css ($advanced_css, $background_image, $bg=false) {
		$bg_style = gusta_get_string_between ($advanced_css, 'background-style:', ' !important;');
		$return = str_replace("background-style:".$bg_style." !important;","",$advanced_css);
		if ($bg_style=="cover"):
			$return .= 'background-size:cover !important; background-repeat:no-repeat !important;';
		elseif ($bg_style=="contain"):
			$return .= 'background-size:contain !important; background-repeat:no-repeat !important;';
		elseif ($bg_style=="no-repeat"):
			$return .= 'background-repeat:no-repeat !important;';
		elseif ($bg_style=="repeat"):
			$return .= 'background-repeat:repeat !important;';
		endif;
		$overlay = gusta_get_string_between ($advanced_css, 'overlay:', ' !important;');
		$gradient_direction = gusta_get_string_between ($advanced_css, 'gradient_direction:', ' !important;');
		if (!$gradient_direction): $gradient_direction='top'; endif;
		$percentage_from = gusta_get_string_between ($advanced_css, 'gradient_percentage_from:', ' !important;');
		if (!$percentage_from): $percentage_from='0%'; endif;
		$percentage_to = gusta_get_string_between ($advanced_css, 'gradient_percentage_to:', ' !important;');
		if (!$percentage_to): $percentage_to='100%'; endif;
		$overlay_color = gusta_get_string_between ($advanced_css, 'overlay-color:', ' !important;');
		$gradient_color = gusta_get_string_between ($advanced_css, 'gradient-color:', ' !important;');
		$bg_return = '';
		
		if ($overlay_color!='' || $background_image):
			$bg_return .= ' background-image:';
			if ($overlay_color && $bg==false):
				$type = 'linear-gradient';
				switch ($gradient_direction) {
					case 'top': $direction = 'to bottom'; break;
					case 'left': $direction = 'to right'; break;
					case 'top-left': $direction = '135deg'; break;
					case 'bottom-left': $direction = '45deg'; break;
					case 'radial': $direction = 'ellipse at center'; $type = 'radial-gradient'; break;
				}
				
				if (!$direction): $direction='to bottom'; endif;
				if (!$overlay_color): $overlay_color = 'rgba(255,255,255,0)'; endif;
				if (!$gradient_color): $gradient_color = $overlay_color; endif;
				
				$bg_return .= ' '.$type.'('.$direction.', '.gusta_hextorgbcss($overlay_color, 1).' '.$percentage_from.', '.gusta_hextorgbcss($gradient_color, 1).' '.$percentage_to.')';
			endif;
			
			if ($background_image):
				if ($overlay_color): $bg_return .= ', '; endif;
				$bg_return .= "url('".wp_get_attachment_url($background_image)."')";
			else:
				if ($bg!=false):
					$bg_return = '';
				endif;
			endif;
			
			if ($bg_return!=''):
				$return .= $bg_return . ' !important;';
			endif;
		endif;
		
		$return = str_replace ('overlay:'.$overlay.' !important;','',$return);
		$return = str_replace ('overlay-color:'.$overlay_color.' !important;','',$return);
		$return = str_replace ('gradient-color:'.$gradient_color.' !important;','',$return);
		$return = str_replace ('gradient_direction:'.$gradient_direction.' !important;','',$return);
		$return = str_replace ('gradient_percentage_from:'.$percentage_from.' !important;','',$return);
		$return = str_replace ('gradient_percentage_to:'.$percentage_to.' !important;','',$return);
		
		return $return;
	}
endif;

/* Border Radius CSS 
if ( !function_exists( 'gusta_border_radius_css' ) ):
	function gusta_border_radius_css ($advanced_css) {
		$top_left = gusta_get_string_between ($advanced_css, 'border-top-left-radius:', ' !important;');
		$top_right = gusta_get_string_between ($advanced_css, 'border-top-right-radius:', ' !important;');
		$bottom_right = gusta_get_string_between ($advanced_css, 'border-bottom-right-radius:', ' !important;');
		$bottom_left = gusta_get_string_between ($advanced_css, 'border-bottom-left-radius:', ' !important;');
		
		$return = '';
		$return .= ($top_left!='' ? 'border-top-left-radius:'.$top_left.' !important;' : '');
		$return .= ($top_right!='' ? 'border-top-right-radius:'.$top_right.' !important;' : '');
		$return .= ($bottom_right!='' ? 'border-bottom-right-radius:'.$bottom_right.' !important;' : '');
		$return .= ($bottom_left!='' ? 'border-bottom-left-radius:'.$bottom_left.' !important;' : '');
		
		return $return;
	}
endif;*/



/* Parses Text Style shortcode attribute of element to Dynamic CSS */
if ( !function_exists( 'gusta_show_dynamic_text_css' ) ):
	function gusta_show_dynamic_text_css ( $atts ) {
		/*
		'el_class' => '',
		'dynamic_css' => '',
		'shatts' => '',
		'el_slug' => '',
		'enable_hover' => '',
		'hover_class' => '',
		'enable_active' => '',
		'active_class' => ''
		*/
		
		extract ($atts);
		
		if (!isset($shatts['tg_'.$el_slug."_tg_normal_tg_text_style"])): $shatts['tg_'.$el_slug."_tg_normal_tg_text_style"]=""; endif;
		if (!isset($dynamic_css[$el_class])): $dynamic_css[$el_class]=""; endif;
		
		$el_text_css = $shatts['tg_'.$el_slug.'_tg_normal_tg_text_style'];

		$mobile = gusta_mobile_css ($el_text_css, $el_class);
		
		$el_text_css = $mobile["new"];
		if ($mobile["media"]!=""):
			if (!array_key_exists("@media screen and (max-width: 479px)", $dynamic_css)):
				$dynamic_css["@media screen and (max-width: 479px)"] = '';
			endif;
			$dynamic_css["@media screen and (max-width: 479px)"] .= $mobile["media"];
		endif;
				
		if ($el_text_css!=""): ($dynamic_css[$el_class] ? $dynamic_css[$el_class] .= $el_text_css : $dynamic_css[$el_class] = $el_text_css); endif;
		
		if ($enable_hover):
			if (!isset($shatts['tg_'.$el_slug."_tg_hover_tg_text_style"])): $shatts['tg_'.$el_slug."_tg_hover_tg_text_style"]=""; endif;
			$el_text_hover_css = $shatts['tg_'.$el_slug.'_tg_hover_tg_text_style'];
			$el_hover_class = (isset($hover_class) && $hover_class!='' ? $hover_class : $el_class.':hover');
			if (!isset($dynamic_css[$el_hover_class])): $dynamic_css[$el_hover_class]=""; endif;
			if ($el_text_hover_css!=""): ($dynamic_css[$el_hover_class] ? $dynamic_css[$el_hover_class] .= $el_text_hover_css : $dynamic_css[$el_hover_class] = $el_text_hover_css); endif;
		endif;
		
		if ($enable_active):
			if (!isset($shatts['tg_'.$el_slug."_tg_active_tg_text_style"])): $shatts['tg_'.$el_slug."_tg_active_tg_text_style"]=""; endif;
			$el_text_active_css = $shatts['tg_'.$el_slug.'_tg_active_tg_text_style'];
			$el_active_class = (isset($active_class) && $active_class!='' ? $active_class : $el_class.'.active');
			if (!isset($dynamic_css[$el_active_class])): $dynamic_css[$el_active_class]=""; endif;
			if ($el_text_active_css!=""): ($dynamic_css[$el_active_class] ? $dynamic_css[$el_active_class] .= $el_text_active_css : $dynamic_css[$el_active_class] = $el_text_active_css); endif;
		endif;
		
		return $dynamic_css;
	}
endif;


/* Parses Text Size of element on Mobile to Dynamic CSS */
if ( !function_exists( 'gusta_mobile_css' ) ):
	function gusta_mobile_css ($advanced_css, $selector) {
		$mobile_font_size = gusta_get_string_between ($advanced_css, 'mobile-font-size:', ' !important;');
		$mobile_text_align = gusta_get_string_between ($advanced_css, 'mobile-text-align:', ' !important;');
		$css = array();
		$css["new"] = $advanced_css;
		$css["media"] = "";
		if ($mobile_font_size):
			$css["new"] = str_replace ('mobile-font-size:'.$mobile_font_size.' !important;','',$advanced_css);
			$css["media"] = $selector.' { font-size:'.$mobile_font_size.' !important; } ';
		endif;
		if ($mobile_text_align):
			$css["new"] = str_replace ('mobile-text-align:'.$mobile_text_align.' !important;','',$advanced_css);
			$css["media"] = $selector.' { text-align:'.$mobile_text_align.' !important; } ';
		endif;
		return $css;
	}
endif;


/* Parses Icon CSS of element to Dynamic CSS */
if ( !function_exists( 'gusta_show_icon_css' ) ):
	function gusta_show_icon_css ( $atts ) {
		/* 'el_class' => '#'.$vc_id.' i',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'icon',
		'enable_hover' => 1,
		'hover_class' => '#'.$vc_id.':hover i',
		'enable_active' => 1,
		'active_class' => '#'.$vc_id.'.active i' */
		
		extract ($atts);
		
		$hover_class = ($hover_class!='' ? $hover_class : $el_class.':hover');
		$active_class = (isset($active_class) && $active_class!='' ? $active_class : $el_class.'.active');
		
		$dynamic_css[$el_class] = $dynamic_css[$hover_class] = $dynamic_css[$active_class] = '';
		
		if (isset($shatts[$el_slug.'color'])):
			$dynamic_css[$el_class] .= 'color:'.$shatts[$el_slug.'color'].' !important;';
		endif;
		if ($enable_hover):
			if (isset($shatts[$el_slug.'hovercolor'])):
				$dynamic_css[$hover_class] .= 'color:'.$shatts[$el_slug.'hovercolor'].' !important;';
			endif;
		endif;
		if ($enable_active):
			if (isset($shatts[$el_slug.'activecolor'])):
				$dynamic_css[$active_class] .= 'color:'.$shatts[$el_slug.'activecolor'].' !important;';
			endif;
		endif;
		if (isset($shatts[$el_slug.'background_color'])):
			$dynamic_css[$el_class] .= 'background-color:'.$shatts[$el_slug.'background_color'].' !important;';
		endif;
		if ($enable_hover):
			if (isset($shatts[$el_slug.'hoverbackground_color'])):
				$dynamic_css[$hover_class] .= 'background-color:'.$shatts[$el_slug.'hoverbackground_color'].' !important;';
			endif;
		endif;
		if ($enable_active):
			if (isset($shatts[$el_slug.'activebackground_color'])):
				$dynamic_css[$active_class] .= 'background-color:'.$shatts[$el_slug.'activebackground_color'].' !important;';
			endif;
		endif;
		
		if (isset($shatts[$el_slug.'size'])):
			$dynamic_css[$el_class] .= 'font-size:'.$shatts[$el_slug.'size'].' !important;';
		endif;
		if (isset($shatts[$el_slug.'margin_between'])):
			if (isset($shatts['icon_position'])):
				if ($shatts['icon_position']=='right'): $mar_pos = 'left'; else: $mar_pos = 'right'; endif;
			else:
				$mar_pos = 'right';
			endif;
			$dynamic_css[$el_class] .= 'margin-'.$mar_pos.':'.$shatts[$el_slug.'margin_between'].' !important;';
		endif;
		
		return $dynamic_css;
	}
endif;


/* Parses Button CSS of element to Dynamic CSS */
if ( !function_exists( 'gusta_show_button_css' ) ):
	function gusta_show_button_css ( $atts ) {
		
		extract ($atts);
		
		$dynamic_css[$el_class] = $dynamic_css[$el_class.':hover'] = '';

		$dynamic_css = gusta_show_dynamic_text_css ( array (
			'el_class' => $el_class,
			'dynamic_css' => $dynamic_css,
			'shatts' => $shatts,
			'el_slug' => $el_slug,
			'enable_hover' => 1,
			'enable_active' => 0,
			'active_class' => ''
		));

		$dynamic_css = gusta_show_dynamic_css ( array (
			'el_class' => $el_class,
			'dynamic_css' => $dynamic_css,
			'shatts' => $shatts,
			'el_slug' => $el_slug.'_styles',
			'enable_hover' => 1,
			'enable_active' => 0,
			'active_class' => ''
		));

		$dynamic_css = gusta_show_icon_css ( array (
			'el_class' => $el_class.' i',
			'dynamic_css' => $dynamic_css,
			'shatts' => $shatts,
			'el_slug' => $el_slug.'_icon',
			'enable_hover' => 1,
			'hover_class' => $el_class.':hover i',
			'enable_active' => 0,
			'active_class' => ''
		));

		if (isset($shatts[$el_slug.'animatedhover_color']) && $shatts[$el_slug.'animatedhover_color']!=""): 
			$dynamic_css[$el_class.':after'] = 'background: '.$shatts[$el_slug.'animatedhover_color'].' !important;';
		endif;

		if (isset($shatts[$el_slug.'threed_shadow_color']) && $shatts[$el_slug.'threed_shadow_color']!=""): 
			if ($shatts[$el_slug.'threed_shadow']=='brd-top'): $pos = '0 -4px'; $pos_hov = '0 -2px';
			elseif ($shatts[$el_slug.'threed_shadow']=='brd-right'): $pos = '4px 0'; $pos_hov = '2px 0';
			elseif ($shatts[$el_slug.'threed_shadow']=='brd-bottom'): $pos = '0 4px'; $pos_hov = '0 2px';
			elseif ($shatts[$el_slug.'threed_shadow']=='brd-left'): $pos = '-4px 0'; $pos_hov = '-2px 0';
			endif;
			$dynamic_css[$el_class] .= 'box-shadow: '.$pos.' '.$shatts[$el_slug.'threed_shadow_color'].' !important;';
			$dynamic_css[$el_class.':hover'] .= 'box-shadow: '.$pos_hov.' '.$shatts[$el_slug.'threed_shadow_color'].' !important;';
		endif;
		
		return $dynamic_css;
	}
endif;

/* Writes Post Listing Elements Inline Styles */
if(!function_exists('gusta_post_element_style')):
	function gusta_post_element_style ($element, $vc_id, $card_design_class, $dynamic_css, $atts, $add_link=false, $label=true, $text=true) {
		if ($card_design_class!=''):
			if ($add_link=='none' || $element=='container'):
				$box_el_class = '.'.$card_design_class.' .'.$vc_id;
				$box_el_overlay_class = '.'.$card_design_class.' .'.$vc_id.' .gusta-overlay';
				$box_hover_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id;
				$box_hover_overlay_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id.' .gusta-overlay';
			else:
				$box_el_class = '.'.$card_design_class.' .'.$vc_id;
				$box_hover_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id;
				$box_el_overlay_class = '.'.$card_design_class.' .'.$vc_id.' .gusta-overlay';
				$box_hover_overlay_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id.' .gusta-overlay';
			endif;
			
			if ($text):
				$txt_el_class = '.'.$card_design_class.' .'.$vc_id.', .'.$card_design_class.' .'.$vc_id.' a';
				$txt_hover_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id.', .'.$card_design_class.' .post-listing-container:hover .'.$vc_id.' a';
			endif;
			
			if ($label):
				$txt_el_i_class = '.'.$card_design_class.' .'.$vc_id.' i';
				$txt_el_span_class = '.'.$card_design_class.' .'.$vc_id.' span.label-text';
				$txt_hover_i_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id.' i';
				$txt_hover_span_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id.' span.label-text';
			endif;
			
		else:
			if ($add_link=='none'):
				$box_el_class = '.'.$vc_id;
				$box_el_overlay_class = $box_el_class.' .gusta-overlay';
				$box_hover_class = '';
				$box_hover_overlay_class = $box_el_class.':hover .gusta-overlay';
			else:
				$box_el_class = '.'.$vc_id;
				$box_el_overlay_class = '.'.$vc_id.' .gusta-overlay';
				$box_hover_class = '';
				$box_hover_overlay_class = '.'.$vc_id.':hover .gusta-overlay';
			endif;
			
			if ($text):
				$txt_el_class = '.'.$vc_id.', .'.$vc_id.' a';
				$txt_hover_class = '.'.$vc_id.':hover, .'.$vc_id.':hover a';
			endif;
			
			if ($label):
				$txt_el_i_class = '.'.$vc_id.' i';
				$txt_el_span_class = '.'.$vc_id.' span.label-text';
				$txt_hover_i_class = '.'.$vc_id.':hover i';
				$txt_hover_span_class = '.'.$vc_id.':hover span.label-text';
			endif;
		endif;
		
		$dynamic_css = gusta_show_dynamic_css ( array (
			'el_class' => $box_el_class,
			'overlay_class' => $box_el_overlay_class,
			'dynamic_css' => $dynamic_css,
			'shatts' => $atts,
			'el_slug' => $element,
			'enable_hover' => 1,
			'hover_class' => $box_hover_class,
			'hover_overlay_class' => $box_hover_overlay_class,
			'enable_active' => 0,	
		));
		
		if ($text):
			$dynamic_css = gusta_show_dynamic_text_css ( array (
				'el_class' => $txt_el_class,
				'dynamic_css' => $dynamic_css,
				'shatts' => $atts,
				'el_slug' => $element,
				'enable_hover' => 1,
				'hover_class' => $txt_hover_class,
				'enable_active' => 0,
			));
		endif;

		if ($label):
			$dynamic_css = gusta_show_dynamic_css ( array (
				'el_class' => $txt_el_span_class,
				'dynamic_css' => $dynamic_css,
				'shatts' => $atts,
				'el_slug' => 'label_text',
				'enable_hover' => 1,
				'hover_class' => $txt_hover_span_class,
				'enable_active' => 0,
			));
			
			$dynamic_css = gusta_show_dynamic_text_css ( array (
				'el_class' => $txt_el_span_class,
				'dynamic_css' => $dynamic_css,
				'shatts' => $atts,
				'el_slug' => 'label_text',
				'enable_hover' => 1,
				'hover_class' => $txt_hover_span_class,
				'enable_active' => 0,
			));

			$dynamic_css = gusta_show_icon_css ( array (
				'el_class' => $txt_el_i_class,
				'dynamic_css' => $dynamic_css,
				'shatts' => $atts,
				'el_slug' => 'label_icon',
				'enable_hover' => 1,
				'hover_class' => $txt_hover_i_class,
				'enable_active' => 0,
				'active_class' => ''
			));
		endif;
		
		return $dynamic_css;
	}
endif;
?>