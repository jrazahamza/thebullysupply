<?php
/*
* VC Gusta Add to Cart Button Dynamic CSS
*
*
* @file           includes/css/gusta_add_to_cart.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.2.0
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '.'.$vc_id.' a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'button',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '.'.$vc_id.' a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'button',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0
));
?>