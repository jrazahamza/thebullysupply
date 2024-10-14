<?php
/*
* VC Gusta Product Rating Dynamic CSS
*
*
* @file           includes/css/gusta_wc_product_rating.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

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
	'el_slug' => 'rating',
	'hover_class' => $box_hover_class,
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'rating',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class,
	'enable_active' => 0,
	'active_class' => ''
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class." .gusta-no-reviews-text",
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'no_rating_text',
	'hover_class' => $box_hover_class." .gusta-no-reviews-text",
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class." .gusta-no-reviews-text",
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'no_rating_text',
	'hover_class' => $box_hover_class." .gusta-no-reviews-text",
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class." .gusta-no-reviews",
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'empty_stars',
	'hover_class' => $box_hover_class." .gusta-no-reviews",
	'enable_hover' => 1,
	'enable_active' => 0
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class." .gusta-no-reviews",
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'empty_stars',
	'hover_class' => $box_hover_class." .gusta-no-reviews",
	'enable_hover' => 1,
	'enable_active' => 0
));
?>