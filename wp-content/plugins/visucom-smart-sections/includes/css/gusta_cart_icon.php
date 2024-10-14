<?php
/*
* VC Gusta Shopping Cart Icon Dynamic CSS
*
*
* @file           includes/css/gusta_cart_icon.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.2.0
*
*/

$dynamic_css['#'.$vc_id] = $dynamic_css['#'.$vc_id.' .gusta-cart-count'] = $dynamic_css['#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart'] = $dynamic_css['#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-cart-total'] = $dynamic_css['#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-view-cart-button'] = $dynamic_css['#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-checkout-button'] = '';

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'icon_container',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-cart-count',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'cart_count',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-cart-count',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'cart_count',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'dropdown',
	'enable_hover' => 0,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'dropdown',
	'enable_hover' => 0,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'links',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart table a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'links',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart img',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'images',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart img',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'images',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-cart-total',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sub_total',
	'enable_hover' => 0,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-cart-total',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'sub_total',
	'enable_hover' => 0,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-checkout-button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'checkout',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-checkout-button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'checkout',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-view-cart-button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'view_cart',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.'+.gusta-update-cart .gusta-shopping-cart .gusta-view-cart-button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'view_cart',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_icon_css ( array (
	'el_class' => '#'.$vc_id.' i',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'cart_icon',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover i',
	'enable_active' => 0,
	'active_class' => ''
));

?>