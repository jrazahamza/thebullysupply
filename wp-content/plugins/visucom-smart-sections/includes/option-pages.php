<?php
/*
* Add Option Pages to Admin Menu
*
* @file           admin/option-pages.php
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

if( function_exists('acf_add_options_page') ) {
	acf_add_options_sub_page(array(
		'page_title' 	=> __('Assign Smart Sections', 'mb_framework'),
		'menu_title'	=> __('Assign Sections', 'mb_framework'),
		'menu_slug' 	=> 'assign-smart-sections',
		'parent_slug'	=> 'edit.php?post_type=gusta_section',
		'autoload'		=> true,
	));
	if (GUSTA_THEME_MODE==false):
		acf_add_options_sub_page(array(
			'page_title' 	=> __('Smart Sections Theme Compatibility', 'mb_framework'),
			'menu_title'	=> __('Theme Compatibility', 'mb_framework'),
			'menu_slug' 	=> 'smart-sections-theme-compatibility',
			'parent_slug'	=> 'edit.php?post_type=gusta_section',
			'autoload'		=> true,
		));
	endif;
	
	if (gusta_theme_name()=='themegusta'): $fonts_parent_slug = 'gusta'; else: $fonts_parent_slug = 'edit.php?post_type=gusta_section'; endif;	
	acf_add_options_sub_page(array(
		'page_title' 	=> __('Font Manager', 'mb_framework'),
		'menu_title'	=> __('Font Manager', 'mb_framework'),
		'menu_slug' 	=> 'gusta-font-manager',
		'parent_slug'	=> $fonts_parent_slug,
		'autoload'		=> true,
	));
	
}
?>