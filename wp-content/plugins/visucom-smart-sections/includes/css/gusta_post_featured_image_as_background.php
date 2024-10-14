<?php
/*
* VC Gusta Post Featured Image as Background Dynamic CSS
*
*
* @file           includes/css/gusta_post_featured_image_as_background.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$add_link = (isset($add_link) ? $add_link : 'none');
$dynamic_css = gusta_post_element_style ('container', $vc_id, $card_design_class, $dynamic_css, $atts, $add_link, $label=false, $text=false);
unset($add_link);
?>