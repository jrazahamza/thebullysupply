<?php
/*
* VC Gusta Social Media Links Dynamic CSS
*
*
* @file           includes/css/gusta_social_media_links.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' ul li a span',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'labels',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' ul li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'listing_container',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' ul li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'listing_container',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css['#'.$vc_id.' ul li a i'] = $dynamic_css['#'.$vc_id.' ul li a:hover i'] = '';

if (isset($icons_color) && $icons_color!=''): $dynamic_css['#'.$vc_id.' ul li a i'] .= 'color: '.$icons_color.' !important;'; endif;
if (isset($iconshovercolor) && $iconshovercolor!=''): $dynamic_css['#'.$vc_id.' ul li a:hover i'] .= 'color: '.$iconshovercolor.' !important;'; endif;
if (isset($icons_size) && $icons_size!=''): $dynamic_css['#'.$vc_id.' ul li a i'] .= 'font-size: '.$icons_size.' !important;'; endif;
?>