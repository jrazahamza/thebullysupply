<?php
/*
* Custom options / fields functions and shortcodes
*
* @file           functions/options.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2015 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Gets the option according to the post type */
if (!function_exists('get_gusta_option')):
	function get_gusta_option ( $option, $tg_post_type=null, $field_group=null ) {
		global $wp;
		$group = '';
		if (strpos($option, 'header') !== false): $group = 'header';
		elseif (strpos($option, 'footer') !== false): $group = 'footer';
		elseif (strpos($option, 'sticky') !== false): $group = 'sticky';
		else: $group = 'content';
		endif;

		$current_lang = '';
	        if ( in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
	            $current_lang = ICL_LANGUAGE_CODE;
	    		global $sitepress;
	    		$default_lang = $sitepress->get_default_language();
	    		if ($default_lang==$current_lang): $current_lang = ''; else: $current_lang = $current_lang."_"; endif;
	    	endif;

		if ($group!=''):
			$option_old = $option;
			$option = $current_lang.'gusta_'.$group.'_sections_tab_'.$tg_post_type.'_'.$option_old;
			$post_meta = 'gusta_'.$group.'_sections_tab_'.$option_old;
		endif;
		
		$global = gusta_global_page_options($tg_post_type);
		if ($tg_post_type):
			if (!isset($global['options_'.$current_lang.'gusta_override_options_'.$tg_post_type])): 
				$global['options_'.$current_lang.'gusta_override_options_'.$tg_post_type]=''; 
			endif;
			if (!isset($global['options_'.$current_lang.'gusta_override_section_options_' . $tg_post_type])): 
				 $global['options_'.$current_lang.'gusta_override_section_options_' . $tg_post_type]=''; 
			endif;
			$the_id = gusta_get_the_id ('value');
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins')))):
				if(is_shop()):
					if (gusta_check_unserialize(get_option('options_'.$current_lang.'gusta_override_section_options_shop'))):
						$option = $current_lang.'gusta_'.$group.'_sections_tab_shop_'.$option_old;
						return gusta_check_unserialize(get_option('options_'.$option.'_shop'));
					endif;
				endif;
			endif;
			if ($tg_post_type=='author' && $the_id!='' && get_the_author_meta('gusta_override_'.$field_group.'_options', $the_id)=='1'):
				return gusta_check_unserialize(get_the_author_meta($post_meta, $the_id));
			elseif ((is_tax() || is_category() || is_tag()) && $the_id!='' && get_term_meta($the_id, 'gusta_override_'.$field_group.'_options', true)=='1'):
				return gusta_check_unserialize(get_term_meta($the_id, $post_meta, true));
			elseif ($tg_post_type!='author' && $the_id!='' && get_post_meta($the_id, 'gusta_override_'.$field_group.'_options', true)=='1'):
				return gusta_check_unserialize(get_post_meta($the_id, $post_meta, true));
			elseif (gusta_check_unserialize($global['options_'.$current_lang.'gusta_override_section_options_' . $tg_post_type])):
				if ($global):
					return ( isset($global['options_'.$option.'_'.$tg_post_type]) ? gusta_check_unserialize($global['options_'.$option.'_'.$tg_post_type]) : gusta_check_unserialize(get_option('options_'.$option.'_'.$tg_post_type)));
				endif;
				$global='';
				return gusta_check_unserialize(get_option('options_'.$option.'_'.$tg_post_type));
			elseif (gusta_check_unserialize(get_option('options_'.$current_lang.'gusta_override_section_options_' . $tg_post_type))):
				return gusta_check_unserialize(get_option('options_'.$option.'_'.$tg_post_type));
			elseif (gusta_is_custom_post_type($tg_post_type)):
				if (gusta_check_unserialize(get_option('options_'.$current_lang.'gusta_override_section_options_cpt'))):
					$option = $current_lang.'gusta_'.$group.'_sections_tab_cpt_'.$option_old;
					return gusta_check_unserialize(get_option('options_'.$option.'_cpt'));
				endif;
			elseif (is_tax()):
				if (gusta_check_unserialize(get_option('options_'.$current_lang.'gusta_override_section_options_tax'))):
					$option = $current_lang.'gusta_'.$group.'_sections_tab_tax_'.$option_old;
					return gusta_check_unserialize(get_option('options_'.$option.'_tax'));
				endif;
			endif;
		endif;
		$global_all = gusta_global_page_options('all');
		$option = str_replace($tg_post_type, 'all', $option);
		if ($global_all):
			return ( isset($global_all['options_'.$option.'_all']) ? gusta_check_unserialize($global_all['options_'.$option.'_all']) : gusta_check_unserialize(get_option('options_'.$option.'_all')) );
		else:
			return gusta_check_unserialize(get_option('options_'.$option.'_all'));
		endif;
	}
endif;

if (!function_exists('gusta_option')):
	function gusta_option ( $field, $tg_post_type=null, $field_group=null ) {
		echo get_gusta_option ( $field, $tg_post_type, $field_group );
	}
	add_shortcode( 'gusta_option', 'gusta_option' );
endif;


/* Load necessary options to a global array */
if (!function_exists('gusta_global_page_options')):
	function gusta_global_page_options ($tg_post_type) {
		global $wpdb, $_GLOBAL;
		if (isset($_GLOBAL["page_options_".$tg_post_type.""])): 
			return $_GLOBAL["page_options_".$tg_post_type.""]; 
		else:
			$page_fields = '
				"options_gusta_override_options_'.$tg_post_type.'",
				"options_gusta_override_section_options_'.$tg_post_type.'",
				"options_gusta_header_sections_tab_'.$tg_post_type.'_gusta_header_sections_'.$tg_post_type.'",
				"options_gusta_content_sections_tab_'.$tg_post_type.'_gusta_above_content_sections_'.$tg_post_type.'",
				"options_gusta_content_sections_tab_'.$tg_post_type.'_gusta_content_sections_'.$tg_post_type.'",
				"options_gusta_content_sections_tab_'.$tg_post_type.'_gusta_archive_sections_'.$tg_post_type.'",
				"options_gusta_content_sections_tab_'.$tg_post_type.'_gusta_below_content_sections_'.$tg_post_type.'",
				"options_gusta_content_sections_tab_'.$tg_post_type.'_gusta_footer_sections_'.$tg_post_type.'",
				"options_gusta_sticky_sections_tab_'.$tg_post_type.'_gusta_sticky_sections_'.$tg_post_type.'"
			';
			$_GLOBAL["page_options_".$tg_post_type.""] = array();
			$results = $wpdb->get_results( 'SELECT option_name, option_value FROM '.$wpdb->prefix.'options WHERE option_name IN ('.$page_fields.')', OBJECT );
			foreach ($results as $r):
				$_GLOBAL["page_options_".$tg_post_type.""][$r->option_name] = $r->option_value;
			endforeach;
			return $_GLOBAL["page_options_".$tg_post_type.""];
		endif;
	}
endif;

/* Get the id of the page regardless of its post type, returns null if there is no id */
if (!function_exists('gusta_get_the_id')):
	function gusta_get_the_id ($get) {
		$the_id="";
		if (($get=='label') || ($get=='label-value')): $label=true; else: $label=false; endif;
		if (($get=='value') || ($get=='label-value')): $value=true; else: $value=false; endif;
		
		if (is_author()):
			$the_id .= ($label ? 'author-' : ''); 
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$the_id .= ($value ? $author->ID : '');
		else:
			$obj = get_queried_object();
			if ($obj):
				if (is_singular()):
					$the_id .= ($label ? ( is_page() ? 'page-' : 'single-' ) : '');
					$the_id .= ($value ? $obj->ID : '');
				elseif (is_category() || is_tag() || is_tax()):
					$the_id .= ($label ? $obj->taxonomy . '-' : ''); 
					$the_id .= ($value ? $obj->term_id : '');
				endif;
			endif;
		endif;
		return $the_id;
	}
endif;


/* Check if input is array and unserialize if array else return the string  */
if (!function_exists('gusta_check_unserialize')):
	function gusta_check_unserialize ($string) {
		if ((!is_array($string)) && (strpos($string, '{') !== false)):
			$string = unserialize ($string);
		endif;
		return $string;
	}
endif;

/* Check if the post type is a custom post type */
if (!function_exists('gusta_is_custom_post_type')):
	function gusta_is_custom_post_type( $current_post_type ) {
	    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );

	    // there are no custom post types
	    if ( empty ( $all_custom_post_types ) )
	        return FALSE;

	    $custom_types      = array_keys( $all_custom_post_types );

	    // could not detect current type
	    if ( ! $current_post_type )
	        return FALSE;

	    return in_array( $current_post_type, $custom_types );
	}
endif;
?>