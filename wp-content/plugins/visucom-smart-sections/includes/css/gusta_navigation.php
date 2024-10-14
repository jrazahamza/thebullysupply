<?php
/*
* VC Gusta Navigation Dynamic CSS
*
*
* @file           includes/css/gusta_navigation.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css['#'.$vc_id] = $dynamic_css['#'.$vc_id.'.select'] = $dynamic_css['#'.$vc_id.' select'] = $dynamic_css['#'.$vc_id.'>ul>li>a'] = '';

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' select',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'select',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' select',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'select',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'>ul>li>ul.gusta-dropdown-menu, #'.$vc_id.'>ul>li>div.gusta-mega-menu',
	'after_class' => '#'.$vc_id.'>ul>li>ul.gusta-dropdown-menu:after, #'.$vc_id.'>ul>li>div.gusta-mega-menu:after',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'dropdown',
	'enable_hover' => 0,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'>ul>li>a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'menu_item',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.'>ul>li:hover>a',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li.current-menu-parent>a, #'.$vc_id.'>ul>li.current-page-ancestor>a, #'.$vc_id.'>ul>li.gusta-mega-menu-active>a',
	'active_after_class' => '#'.$vc_id.'>ul>li.current-menu-item>a:after, #'.$vc_id.'>ul>li.current-menu-parent>a:after, #'.$vc_id.'>ul>li.current-page-ancestor>a:after, #'.$vc_id.'>ul>li.gusta-mega-menu-active>a:after'
));



$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'>ul>li>a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'menu_item',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.'>ul>li:hover>a',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li.current-menu-parent>a, #'.$vc_id.'>ul>li.current-page-ancestor>a'
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'>ul>li>ul>li>a, #'.$vc_id.'>ul>li>ul>li>ul>li>a',
	'after_class' => '#'.$vc_id.'>ul>li>ul>li>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li>a:after',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sub_menu_item',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.'>ul>li>ul>li:hover>a, #'.$vc_id.'>ul>li>ul>li>ul>li:hover>a',
	'hover_after_class' => '#'.$vc_id.'>ul>li>ul>li:hover>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li:hover>a:after',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'>ul>li>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li>ul>li>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li>ul>li.current-page-ancestor>a, #'.$vc_id.'>ul>li>ul>li>ul>li.current-page-ancestor>a',
	'active_after_class' => '#'.$vc_id.'>ul>li>ul>li.current-menu-item>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li.current-menu-item>a:after, #'.$vc_id.'>ul>li>ul>li.current-page-ancestor>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li.current-page-ancestor>a:after'
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'>ul>li>ul>li>a, #'.$vc_id.'>ul>li>ul>li>ul>li>a',
	'after_class' => '#'.$vc_id.'>ul>li>ul>li>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li>a:after',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sub_menu_item',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.'>ul>li>ul>li:hover>a, #'.$vc_id.'>ul>li>ul>li>ul>li:hover>a',
	'hover_after_class' => '#'.$vc_id.'>ul>li>ul>li:hover>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li:hover>a:after',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'>ul>li>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li>ul>li>ul>li.current-menu-item>a, #'.$vc_id.'>ul>li>ul>li.current-page-ancestor>a, #'.$vc_id.'>ul>li>ul>li>ul>li.current-page-ancestor>a',
	'active_after_class' => '#'.$vc_id.'>ul>li>ul>li.current-menu-item>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li.current-menu-item>a:after, #'.$vc_id.'>ul>li>ul>li.current-page-ancestor>a:after, #'.$vc_id.'>ul>li>ul>li>ul>li.current-page-ancestor>a:after'
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'enable_active' => 0,
));
if (!isset($nav_type)): $nav_type = 'horizontal'; endif;
if (isset($nav_height) && $nav_height != ''):
	if ($nav_type=='select'):
		$dynamic_css['#'.$vc_id.' select'] .= 'height: '.$nav_height.' !important;';
	else:
		$dynamic_css['#'.$vc_id.'>ul>li>a'] .= 'line-height: '.$nav_height.' !important;';
	endif;
endif;
if (isset($nav_width) && $nav_width != '' && $nav_type!='horizontal'):
	$dynamic_css['#'.$vc_id] .= 'width: '.$nav_width.' !important;';
endif;

if (isset($nav_responsive_width) && $nav_responsive_width != '' && $nav_type=='horizontal'):
	$dynamic_css['#'.$vc_id.'.select'] .= 'width: '.$nav_responsive_width.' !important;';
endif;

if (isset($nav_width) && $nav_width != '' && $nav_type!='select'):
	$dynamic_css['#'.$vc_id.'.select'] .= 'width: '.$nav_width.' !important;';
endif;

unset ($nav_type, $nav_width, $nav_responsive_width, $nav_height);
?>