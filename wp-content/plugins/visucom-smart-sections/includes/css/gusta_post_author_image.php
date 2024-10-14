<?php
/*
* VC Gusta Post Author Image Dynamic CSS
*
*
* @file           includes/css/gusta_post_author_image.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$add_link = 'none';
$dynamic_css['.'.$vc_id] = '';
$dynamic_css = gusta_post_element_style ('image', $vc_id, $card_design_class, $dynamic_css, $atts, $add_link, $label=false, $text=false);
if (isset($image_size) && $image_size!=''):
	$dynamic_css['.'.$vc_id] .= 'width: '.$image_size.'px !important; min-width: '.$image_size.'px !important; max-width: '.$image_size.'px !important; height: '.$image_size.'px !important;';
endif;
unset($add_link);
?>