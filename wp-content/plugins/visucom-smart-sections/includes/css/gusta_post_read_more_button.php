<?php
/*
* VC Gusta Post Read More Button Dynamic CSS
*
*
* @file           includes/css/gusta_post_read_more_button.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '.'.$vc_id.'.gusta-icon-link',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'read_more_button',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '.'.$vc_id.'.gusta-icon-link',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'read_more_button',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0
));

$dynamic_css = gusta_show_icon_css ( array (
	'el_class' => '.'.$vc_id.'.gusta-icon-link i',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'button_icon',
	'enable_hover' => 1,
	'hover_class' => '.'.$vc_id.'.gusta-icon-link:hover i',
	'enable_active' => 0
));
unset($add_link);
?>