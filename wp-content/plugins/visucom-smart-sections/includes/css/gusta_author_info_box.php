<?php
/** 

VC Gusta Author Info Box Dynamic CSS
*
*
* @file           includes/css/gusta_author_info_box.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/
$dynamic_css['#'.$vc_id.' .gusta-author-info-image'] = '';
$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'enable_active' => 0,
));
$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' p',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'bio',
	'enable_hover' => 0,
	'enable_active' => 0,
	'hover_class' => '',
	'active_class' => ''
));
$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' span a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'author_sub_title',
	'enable_hover' => 0,
	'enable_active' => 0,
	'hover_class' => '',
	'active_class' => ''
));
$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' h4',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'author_title',
	'enable_hover' => 0,
	'enable_active' => 0,
	'hover_class' => '',
	'active_class' => ''
));
$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-author-info-image',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'author_image',
	'enable_hover' => 1,
	'enable_active' => 0,
));
$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-social-media-links ul li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'social_icons',
	'enable_hover' => 1,
	'enable_active' => 0,
));

if (isset($image_size) && $image_size!='96'):
	$dynamic_css['#'.$vc_id.' .gusta-author-info-image'] .= 'width: '.$image_size.'px !important; min-width: '.$image_size.'px !important; max-width: '.$image_size.'px !important; height: '.$image_size.'px !important;';
endif;

$dynamic_css['#'.$vc_id.' .gusta-social-media-links li a:hover i'] = "";
$dynamic_css['#'.$vc_id.' .gusta-social-media-links li a i'] = "";

if (isset($icons_color)): $dynamic_css['#'.$vc_id.' .gusta-social-media-links li a i'] .= 'color: '.$icon_color.' !important;'; endif;
if (isset($iconshovercolor)): $dynamic_css['#'.$vc_id.' .gusta-social-media-links li a:hover i'] .= 'color: '.$iconshovercolor.' !important;';endif;
if (isset($icons_size) && $icons_size!=''): $dynamic_css['#'.$vc_id.' .gusta-social-media-links ul li a i'] .= 'font-size: '.$icons_size.' !important;'; endif;
?>