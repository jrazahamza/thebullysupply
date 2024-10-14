<?php
/*
* Wordpress Core Related Functions
*
* @file           includes/wp.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.7
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Replace Post Meta Meta Box for Speed Optimization 
if(!function_exists('gusta_admin_speedup_remove_post_meta_box')):
	function gusta_admin_speedup_remove_post_meta_box() {
		if (get_option('options_gusta_disable_custom_fields_meta_box')):
			if ( is_admin() && post_type_supports( GUSTA_POST_TYPE, 'custom-fields' ) ):
				remove_meta_box( 'postcustom', GUSTA_POST_TYPE, 'normal' );
			endif;
		endif;
	}
	add_action( 'add_meta_boxes', 'gusta_admin_speedup_remove_post_meta_box' );
endif;

/* Remove Auto-top from all post types 
remove_filter( 'the_content', 'wpautop' );*/

/* Fixes the Wordpress editor adding "<p>" tag unintentionally */
if ( !function_exists('gusta_fix_shortcodes') ) {
	function gusta_fix_shortcodes($content){
		$array = array (
			'<p></p>[' => '[',
			'<p>[' => '[',
			']<p></p>' => ']',
			']</p>' => ']',
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'gusta_fix_shortcodes');
}

/* Remove View Links of Gusta Sections Post Type */
if(!function_exists('gusta_remove_row_view_action')):
	function gusta_remove_row_view_action( $actions ) {
		if( get_post_type() === 'gusta_section' )
			unset( $actions['view'] );
		return $actions;
	}
	add_filter( 'post_row_actions', 'gusta_remove_row_view_action', 10, 1 );
endif;


/* Remove View Link from Toolbar */
if(!function_exists('gusta_remove_toolbar_node_view')):
	function gusta_remove_toolbar_node_view($wp_admin_bar) {
		if( get_post_type() === 'gusta_section' )
			$wp_admin_bar->remove_node('view');
	}
	add_action('admin_bar_menu', 'gusta_remove_toolbar_node_view', 999);
endif;

/* Serialize Links */
if(!function_exists('gusta_serialize_link')):
	function gusta_serialize_link ($input, $content='', $class='', $show_title=false, $id='') {
		
		if ($input != '|||'):
			
			$fla = explode('|', $input);
		
			$url = "#";
			$title = $target = $rel = '';
			foreach ($fla as $fl):
				if (strpos($fl, 'url:') !== false): $url = str_replace('url:','', urldecode($fl)); 
				elseif (strpos($fl, 'title:') !== false): $title = str_replace('title:','', urldecode($fl)); 
				elseif (strpos($fl, 'target:') !== false): $target = str_replace('target:','', urldecode($fl)); 
				elseif (strpos($fl, 'rel:') !== false): $rel = str_replace('rel:','', urldecode($fl)); 
				endif;
			endforeach;
			
			//$title = ($title ? $title : get_the_title(url_to_postid( $url )));
			$content = ($content ? ($show_title==true ? $content.' <span>'.$title.'</span>' : $content) : $title);
			$title = ' title="'.$title.'"';
			$target = ($target ? ' target="'.$target.'"' : '');
			$rel = ($rel ? ' rel="'.$rel.'"' : '');
			$class = ($class ? ' class="'.$class.'"' : '');
			$id = ($id ? ' id="'.$id.'"' : '');
			
			return '<a href="'.$url.'"'.$target.$rel.$title.$class.$id.'>'.$content.'</a>';
			
		else:
		
			return '';
			
		endif;
	}
endif;


/* List of Current Navigation Menus Array */
if(!function_exists('gusta_nav_menu_array')):
	function gusta_nav_menu_array () {
		if (isset($gusta_nav_menu_array)): return $gusta_nav_menu_array; endif;
		$gusta_nav_menu_array = array();
		$navs = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$gusta_nav_menu_array[__('Select Menu', 'mb_framework')]='';
		foreach ($navs as $nav):
			$gusta_nav_menu_array[$nav->name]=$nav->term_id;
		endforeach;
		return $gusta_nav_menu_array;
	}
endif;


/* Remove Script and Style Version */
if (!function_exists('gusta_remove_script_style_version')):
	if (!is_admin()):
		if (get_option ('options_remove_script_style_version')):
			function gusta_remove_script_style_version( $src ){
				return remove_query_arg( 'ver', $src );	
			}
			add_filter( 'script_loader_src', 'gusta_remove_script_style_version', 15, 1 );
			add_filter( 'style_loader_src', 'gusta_remove_script_style_version', 15, 1 );
		endif;
	endif;
endif;


/* Defer Parsing */
if (!function_exists('gusta_defer_parsing_of_js')):
	if (!is_admin()):
		if (get_option ('options_defer_parsing_of_js')):
		function gusta_defer_parsing_of_js ( $url ) {
			if ( FALSE === strpos( $url, '.js' ) ):
				return $url;
			endif;
			if ( strpos( $url, 'jquery.js' ) ): return $url; endif;
				return "$url' defer='defer";
			}
			add_filter( 'clean_url', 'gusta_defer_parsing_of_js', 11, 1 );
		endif;
	endif;
endif;


/* Add svg support to WordPress uploader */
if (!function_exists('gusta_mime_types')):
	function gusta_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['woff'] = 'application/font-woff';
		$mimes['woff2'] = 'application/font-woff2';
		$mimes['ttf'] = 'application/octet-stream';
		$mimes['eot'] = 'application/font-eot';
		return $mimes;
	}
	add_filter( 'upload_mimes', 'gusta_mime_types' );
endif;


/* Remove WP Emoji Enqueues */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/* Remove The generator meta tag created by Wordpress */
if (!function_exists('gusta_remove_wp_generator')):
	function gusta_remove_wp_generator() {
		return '';
	}
	add_filter('the_generator', 'gusta_remove_wp_generator');
endif;


/* Remove the meta tags created by Visual Composer */
if (!function_exists('gusta_remove_vc_generator')):
	function gusta_remove_vc_generator() {
		if (function_exists('visual_composer')):
			remove_action('wp_head', array(visual_composer(), 'addMetaData'));
		endif;
	}
	add_action('init', 'gusta_remove_vc_generator', 100);
endif;


/* Add Pagebreak button to WP editor */
if (!function_exists('gusta_add_next_page_button')):
	function gusta_add_next_page_button( $buttons, $id ){
		if ( 'content' != $id ): return $buttons; endif;
		array_splice( $buttons, 13, 0, 'wp_page' );	
		return $buttons;
	}
	add_filter( 'mce_buttons', 'gusta_add_next_page_button', 1, 2 );
endif;


/* Add code right after <body> tag 
if(!function_exists('gusta_body_begin')):
	function gusta_body_begin() {
		do_action('gusta_body_begin');
	}
endif;*/

/* Get Meta Values of all posts */
if(!function_exists('gusta_get_meta_values')):
	function gusta_get_meta_values( $key ) {

		global $wpdb;

		if( empty( $key ) )
			return;
		
		$table_name = $wpdb->prefix . 'postmeta';
		$values = $wpdb->get_col( $wpdb->prepare( "SELECT `meta_value` FROM {$table_name} WHERE `meta_key` = '%s'", $key ) );
		
		return $values;
	}
endif;

if (!function_exists('gusta_get_post_types')):
	function gusta_get_post_types () {
		if (isset($gusta_post_types)): return $gusta_post_types; endif;
		$gusta_post_types = array();
		$get_post_types = get_post_types( array( 'public' => true ), 'objects', 'and' ); 
		if ( $get_post_types ):
			foreach ( $get_post_types  as $pt ):
				if (($pt->name != 'attachment') && ($pt->name != 'gusta_section')):
					$gusta_post_types[] = array( 'label' => $pt->labels->singular_name, 'value' => $pt->name );
				endif;
			endforeach;
		endif;
		return $gusta_post_types;
	}
endif;

/* Primary Categories */
if (!function_exists('gusta_get_post_primary_category')):
	function gusta_get_post_primary_category($post_id, $term='category'){
		$return = '';

		if (class_exists('WPSEO_Primary_Term')):
			// Show Primary category by Yoast if it is enabled & set
			$primary_term = array();
			$wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
			$return = $wpseo_primary_term->get_primary_term();
		endif;

		return $return;
	}
endif;
?>