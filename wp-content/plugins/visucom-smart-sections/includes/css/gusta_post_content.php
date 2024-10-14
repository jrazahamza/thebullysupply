<?php
/*
* VC Gusta Post Content Dynamic CSS
*
*
* @file           includes/css/gusta_post_content.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/
$add_link = 'none';
$dynamic_css = gusta_post_element_style ('content', $vc_id, $card_design_class, $dynamic_css, $atts, $add_link, $label=false);
unset($add_link);
?>