<?php
/*
* VC Gusta Post Listing Dynamic CSS
*
*
* @file           includes/css/gusta_post_listing.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if (isset($card_design) && $card_design!=''):

	$dynamic_css['#'.$vc_id] = $dynamic_css['#'.$vc_id.' .column'] = $dynamic_css['#'.$vc_id.' .column .post-listing-container'] = $dynamic_css['#'.$vc_id] = '';

	if (!isset($usage)): $usage = 'default'; endif;

	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .column .post-listing-container',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'card_container',
		'enable_hover' => 1,
		'enable_active' => 0,
	));

	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '#'.$vc_id.' .gusta-load-more .load-more-button',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'load_more_button',
		'enable_hover' => 1,
		'enable_active' => 1,
		'active_class' => '#'.$vc_id.' .gusta-load-more .load-more-button.loading',
	));

	$dynamic_css = gusta_show_dynamic_text_css ( array (
		'el_class' => '#'.$vc_id.' .gusta-load-more .load-more-button',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'load_more_button',
		'enable_hover' => 1,
		'enable_active' => 1,
		'active_class' => '#'.$vc_id.' .gusta-load-more .load-more-button.loading',
	));

	if ($usage!='previous' && $usage!='next'):

		if (!isset($gap)): $gap='30'; endif;
		$hgap = $gap / 2;
		$dynamic_css['#'.$vc_id] .= 'margin-left: -'.$hgap.'px !important; margin-right: -'.$hgap.'px !important';
		$dynamic_css['#'.$vc_id.' .column'] = 'padding: 0 '.$hgap.'px !important;';
		$dynamic_css['#'.$vc_id.' .column .post-listing-container'] .= 'margin-bottom: '.$gap.'px !important;';
		unset($gap);

		if (!isset($dynamic_css["@media only screen"])): $dynamic_css["@media only screen"] = ''; endif;

		if (!isset($number_of_columns)): $number_of_columns = '1'; endif;
		if (!isset($number_of_columns_tablet)): $number_of_columns_tablet = '1'; endif;
		if (!isset($number_of_columns_mobile)): $number_of_columns_mobile = '1'; endif;
	endif;

		if (!isset($card_design_css)): $card_design_css=array(); endif;

		if (!isset($card_design_css[$card_design]) || $card_design_css[$card_design]!=true):
			$card_shortcodes_custom_css = get_post_meta( $card_design, '_wpb_shortcodes_custom_css', true );
			$card_post_custom_css = get_post_meta( $card_design, '_wpb_post_custom_css', true );
			$dynamic_css["@media only screen"] .= $card_shortcodes_custom_css.$card_post_custom_css;
			$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $card_design, 'section-inner', 'card-'.$card_design );
			$card_design_css[$card_design]=true;
		endif;

	if ($usage!='previous' && $usage!='next'):
		if (!isset($dynamic_css["@media screen and (max-width: 575px)"])):
			$dynamic_css["@media screen and (max-width: 575px)"] = '';
		endif;
		$dynamic_css["@media screen and (max-width: 575px)"] .= "#".$vc_id." .gusta-grid[data-columns]::before { content: '".$number_of_columns_mobile." .column.size-1of".$number_of_columns_mobile."'; }";

		if (!isset($dynamic_css["@media screen and (min-width: 576px) and (max-width: 991px)"])):
			$dynamic_css["@media screen and (min-width: 576px) and (max-width: 991px)"] = '';
		endif;
		$dynamic_css["@media screen and (min-width: 576px) and (max-width: 991px)"] .= "#".$vc_id." .gusta-grid[data-columns]::before { content: '".$number_of_columns_tablet." .column.size-1of".$number_of_columns_tablet."'; }";

		if (!isset($dynamic_css["@media screen and (min-width: 992px)"])):
			$dynamic_css["@media screen and (min-width: 992px)"] = '';
		endif;
		$dynamic_css["@media screen and (min-width: 992px)"] .= "#".$vc_id." .gusta-grid[data-columns]::before { content: '".$number_of_columns." .column.size-1of".$number_of_columns."'; }";
	endif;
endif;

unset($number_of_columns, $number_of_columns_tablet, $number_of_columns_mobile, $items_layout, $items_height, $card_design);

?>