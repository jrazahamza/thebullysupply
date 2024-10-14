<?php
/*
* VC Gusta Product Additional Information Dynamic CSS
*
*
* @file           includes/css/gusta_wc_product_additional_information.php
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
	'el_slug' => 'additional_information',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' th',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'titles',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' th',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'titles',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' td',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'values',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' td',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'values',
	'enable_hover' => 1,
	'enable_active' => 0
));