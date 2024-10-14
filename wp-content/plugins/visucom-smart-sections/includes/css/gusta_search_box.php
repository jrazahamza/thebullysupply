<?php
/*
* VC Gusta Search Box Dynamic CSS
*
*
* @file           includes/css/gusta_search_box.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css['#'.$vc_id.''] = '';

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'search_field',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.' .form-group:hover .search-query',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.' .form-group .search-query:focus',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'search_field',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.' .form-group:hover .search-query',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.' .form-group .search-query:focus',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'search_button',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'search_button',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query::placeholder',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'placeholder',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query::-webkit-input-placeholder',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'placeholder',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query:-ms-input-placeholder',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'placeholder',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query::-moz-placeholder',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'placeholder',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .form-group .search-query:-moz-placeholder',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'placeholder',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' ul.results li',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'autosuggest',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' ul.results li',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'autosuggest',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' ul.results li .search-image',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'autosuggest_image',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_icon_css ( array (
	'el_class' => '#'.$vc_id.' button i',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'search_icon',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.' button:hover i',
	'enable_active' => 0,
	'active_class' => ''
));

if (isset($search_box_width) && $search_box_width!=''):
	$dynamic_css['#'.$vc_id.''] .= 'max-width: '.$search_box_width.';';
endif;
?>