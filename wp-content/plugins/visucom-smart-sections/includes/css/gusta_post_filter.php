<?php
/*
* VC Gusta Post Filter Dynamic CSS
*
*
* @file           includes/css/gusta_post_filter.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.8
*
*/

$dynamic_css['#'.$vc_id.''] = '';

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' ul',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'hover_class' => '',
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' ul li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'filter_items',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.' ul li:hover a',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.' ul li.gusta-active a',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' ul li a',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'filter_items',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.' ul li:hover a',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.' ul li.gusta-active a',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'dropdown_button',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' button',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'dropdown_button',
	'enable_hover' => 1,
	'enable_active' => 0,
	'active_class' => '',
));

$filters = (array) vc_param_group_parse_atts( $filters );
foreach ($filters as $filter):
	$card_design = $filter["card_design"];
	if ($card_design!=''):
		if (!isset($card_design_css)): $card_design_css=array(); endif;
		if (!isset($dynamic_css["@media only screen"])): $dynamic_css["@media only screen"]=''; endif;

		if (!isset($card_design_css[$card_design]) || $card_design_css[$card_design]!=true):
			$card_shortcodes_custom_css = get_post_meta( $card_design, '_wpb_shortcodes_custom_css', true );
			$card_post_custom_css = get_post_meta( $card_design, '_wpb_post_custom_css', true );
			$dynamic_css["@media only screen"] .= $card_shortcodes_custom_css.$card_post_custom_css;
			$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $card_design, 'section-inner', 'card-'.$card_design );
			$card_design_css[$card_design]=true;
		endif;
	endif;
endforeach;
?>