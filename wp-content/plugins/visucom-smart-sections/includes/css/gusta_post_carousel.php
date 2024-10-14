<?php
/*
* VC Gusta Post Carousel Dynamic CSS
*
*
* @file           includes/css/gusta_post_carousel.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.1.0
*
*/

if (isset($card_design) && $card_design!=''):

	$dynamic_css['#'.$vc_id] = $dynamic_css['#'.$vc_id.' .post-carousel-container'] = '';

	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .post-listing-container',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'card_container',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .owl-nav .gusta-next',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'right_arrow',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	$dynamic_css = gusta_show_dynamic_text_css ( array (
		'el_class' => '#'.$vc_id.' .owl-nav .gusta-next',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'right_arrow',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .owl-nav .gusta-prev',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'left_arrow',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	$dynamic_css = gusta_show_dynamic_text_css ( array (
		'el_class' => '#'.$vc_id.' .owl-nav .gusta-prev',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'left_arrow',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .owl-dots',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'dots',
		'enable_hover' => 0,
		'hover_class' => '',
		'enable_active' => 0,
		'active_class' => ''
	));
	
	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .owl-dots .owl-dot',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'single_dot',
		'enable_hover' => 1,
		'hover_class' => '#'.$vc_id.' .owl-dots .owl-dot:hover',
		'enable_active' => 1,
		'active_class' => '#'.$vc_id.' .owl-dots .owl-dot.active'
	));

	if (!isset($card_design_css)): $card_design_css=array(); endif;
	if (!isset($dynamic_css["@media only screen"])): $dynamic_css["@media only screen"] = ''; endif;

	if (!isset($card_design_css[$card_design]) || $card_design_css[$card_design]!=true):
		$card_shortcodes_custom_css = get_post_meta( $card_design, '_wpb_shortcodes_custom_css', true );
		$card_post_custom_css = get_post_meta( $card_design, '_wpb_post_custom_css', true );
		$dynamic_css["@media only screen"] .= $card_shortcodes_custom_css.$card_post_custom_css;
		$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $card_design, 'section-inner', 'card-'.$card_design );
		$card_design_css[$card_design]=true;
	endif;

endif;

unset($card_design);

?>