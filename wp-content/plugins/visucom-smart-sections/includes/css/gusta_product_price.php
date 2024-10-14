<?php
/*
* VC Gusta Product Price Dynamic CSS
*
*
* @file           includes/css/gusta_product_price.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.2.0
*
*/
$dynamic_css['.'.$vc_id] = $dynamic_css['.'.$vc_id.' del'] = $dynamic_css['.'.$vc_id.' ins'] = '';

if ($card_design_class!=''):
	$dynamic_css['.'.$card_design_class.' .post-listing-container .'.$vc_id] = $dynamic_css['.'.$card_design_class.' .post-listing-container:hover .'.$vc_id] = '';
	$box_el_class = '.'.$card_design_class.' .post-listing-container .'.$vc_id;
	$box_hover_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id;
else:
	$box_el_class = '.'.$vc_id;
	$box_hover_class = '.'.$vc_id.':hover';
endif;

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class,
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class,
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class.' ins',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sale_price',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' ins',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class.' ins',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sale_price',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' ins',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class.' del',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'regular_price',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' del',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class.' del',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'regular_price',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' del',
	'enable_active' => 0,
	'active_class' => ''
));
?>