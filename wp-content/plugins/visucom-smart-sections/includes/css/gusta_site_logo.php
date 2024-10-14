<?php
/*
* VC Gusta Site Logo Dynamic CSS
*
*
* @file           includes/css/gusta_site_logo.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css['#'.$vc_id.' a']=$dynamic_css['#'.$vc_id.', #'.$vc_id.' a']='';
$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'enable_active' => 0,
));

if (isset($logo_height)): 
	$dynamic_css['#'.$vc_id.', #'.$vc_id.' a'] .= 'height: '.$logo_height.' !important;'; 
endif;
?>