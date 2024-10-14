<?php
/*
* VC Gusta Direct Checkout Button Dynamic CSS
*
*
* @file           includes/css/gusta_wc_direct_checkout.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '.'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'button',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '.'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'button',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0
));
?>