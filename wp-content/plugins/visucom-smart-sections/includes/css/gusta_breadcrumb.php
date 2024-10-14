<?php
/*
* VC Gusta Breadcrumb Dynamic CSS
*
*
* @file           includes/css/gusta_breadcrumb.php
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
	'enable_active' => 0,
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' li, #'.$vc_id.' li:before',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (	
	'el_class' => '#'.$vc_id.' li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'links',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'links',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => ''
));
?>