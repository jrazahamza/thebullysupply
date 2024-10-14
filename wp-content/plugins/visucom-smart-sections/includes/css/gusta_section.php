<?php
/*
* VC Gusta Section Dynamic CSS
*
*
* @file           includes/css/gusta_section.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if (isset($section)):

	$dynamic_css = gusta_show_dynamic_css ( array (
		'el_class' => '.'.$vc_id.' .section-container',
		'dynamic_css' => $dynamic_css,
		'shatts' => $atts,
		'el_slug' => 'container',
		'enable_hover' => 1,
		'enable_active' => 0,
	));
	
	if (!isset($dynamic_css["@media screen"])): $dynamic_css["@media screen"] = ''; endif;
	
	$dynamic_css["@media screen"] .= get_post_meta( $section, '_wpb_shortcodes_custom_css', true ) . get_post_meta( $section, '_wpb_post_custom_css', true );
	
	$dynamic_css = gusta_inline_shortcode_css ( $dynamic_css, $section, 'section-inner' );
	
endif;
?>