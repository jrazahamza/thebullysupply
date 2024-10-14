<?php
/*
* Section Functions
*
* @file           functions/sections.php
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

/* Get Section Variables Function */
if(!function_exists('gusta_get_section_var')):
	function gusta_get_section_var ($section_id, $var) {
		global $gusta_section_query;
		if (!isset($gusta_section_query)):
			$all_sections_of_page = array();
			$section_areas = array ('header', 'above_content', 'content', 'archive', 'below_content', 'footer', 'sticky');
			foreach ($section_areas as $area):
				$section_array = get_gusta_option('gusta_'.$area.'_sections', gusta_get_template(), 'section');
				if ($section_array):
					if (!is_array($section_array)) : $section_array = explode(',',$section_array); endif;
					foreach ($section_array as $section):
						$all_sections_of_page[] = $section;
					endforeach;
				endif;
			endforeach;
			$args = array(
			   'post_type' => 'gusta_section',
			   'post__in'      => $all_sections_of_page
			);
			$gusta_section_query = new WP_Query( $args );
		endif;
		foreach ($gusta_section_query->posts as $section):
			if ($section->ID==$section_id):
				return $section->$var;
			endif;
		endforeach;
	}
endif;


/* Show Custom Sections */
if(!function_exists('gusta_show_sections')):
	function gusta_show_sections ( $section_array, $section_name = 'custom-section', $container = true ) {
		global $post;
		$extra_classes = $output = '';

		if ($section_array):
			
			if (!is_array($section_array)) : $section_array = explode(',',$section_array); endif;
			foreach ($section_array as $section_id):
				
				$overlapping = $sticky = $alignment = '';
				
				$gusta_section_purpose = get_post_meta($section_id, 'gusta_section_purpose', true);
				
				$overlapping = (get_post_meta($section_id, 'gusta_overlapping_section', true) ? ' section-overlapping' : '');
				
				if (in_array($gusta_section_purpose, array('vertical','sidebar'))):
					$sticky = (get_post_meta($section_id, 'gusta_sticky_section', true) ? ' section-sticky' : '');
				endif;
				
				if ($gusta_section_purpose=='vertical'):
					$alignment = get_post_meta($section_id, 'gusta_ver_section_alignment', true);
					if (!$alignment): $alignment = 'left'; endif;
					$alignment = ' section-'.$alignment;
				else:
					$alignment = ' section-align-none';
				endif;
				
				if ($section_name=='header-section'):
					$el = 'nav'; 
					$extra_classes = 'gusta-navbar-default ';
				else:
					$el = 'div'; 
				endif;
				
				$gusta_hide = ' gusta-show-section';
				if ($gusta_section_purpose=='sticky'):
					$gusta_section_display = get_post_meta($section_id, 'gusta_section_display', true);
					$gusta_sticky_section_position = get_post_meta($section_id, 'gusta_sticky_section_position', true);
					$sticky = ' sticky-'.$gusta_sticky_section_position;
					$alignment = '';
					
					if ($gusta_section_display=='href' || $gusta_section_display=='window'):
						$gusta_hide = ' gusta-hide-section';
					endif;
				endif;

				$output .= '<!-- '. $section_name .' -->
				<'.$el.' class="section gusta-section '.$section_name.$gusta_hide.' section-'.$gusta_section_purpose.' '.$extra_classes.$overlapping.$sticky.$alignment.'" id="section-'.$section_id.'">';
				if ($overlapping!=''):
					$output .= '<div class="section-container">';
				endif;
				if ($container!=false):
					$output .= '<div class="'.gusta_get_theme_var('container').'">';
				else:
					$output .= '<div class="container">';
				endif;
				$output .= do_shortcode(gusta_fix_shortcodes(get_post_field('post_content', $section_id))).'<div class="clear"></div>';
				$output .= '</div><!-- end container -->';
				if( current_user_can('editor') || current_user_can('administrator') ) :
					$output .= '<div class="edit-link edit-'.$section_name.'" title="'.ucwords(__('Edit', 'mb_framework').' '.str_replace('-', ' ', $section_name)).'">
						<a href="'.admin_url('post.php?post='.$section_id.'&action=edit').'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					</div>';
				endif;
				if ($overlapping!=''):
					$output .= '</div><!-- end .section-container -->';
				endif;
				$output .= '</'.$el.'><!-- end '.$section_name.' -->';

			endforeach;
		endif; 
		return $output;
	}
endif;

/* Outputs an array consisting of the sections filtered by the purpose */
if ( !function_exists( 'gusta_get_sections' ) ):
	function gusta_get_sections ( $type=null, $self=false ) {
		$post_id = '';
		
		$sections_array = array();
		$sections_array[__('Select Section...', 'mb_framework')] = '';
		$args = array( 'post_type' => 'gusta_section', 'posts_per_page' => -1 );
		if ($type!=null):
			$args['meta_query'] = array( array( 'key' => 'gusta_section_purpose', 'value' => $type ) );
		endif;
		if (!$self):
			$url = wp_get_referer();
			$post_id = gusta_get_string_between ($url, 'post=','&');
			
			$post_type = get_post_type($post_id);
			if ($post_type!='gusta_section'): $post_id = ''; endif;
			$args['post__not_in'] = array($post_id);
		endif;
		$sections = new WP_Query( $args );
		foreach ($sections->posts as $section):
			//if (strpos($section->post_content, 'gusta_post_content') === false):
				$sections_array[$section->post_title] = $section->ID;
			//endif;
		endforeach;
		return $sections_array;
	}
endif;
?>