<?php
/*
* VC Gusta Product Images Dynamic CSS
*
*
* @file           includes/css/gusta_wc_product_images.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2020 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-woocommerce-product-main-image img',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'content',
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' .gusta-woocommerce-gallery-thumbnails img',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'thumbnails',
	'enable_hover' => 1,
	'enable_active' => 0
));