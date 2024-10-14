<?php
/*
* VC Gusta Container Dynamic CSS
*
*
* @file           includes/css/gusta_container.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.1.0
*
*/

$add_link = 'none';
$dynamic_css = gusta_post_element_style ('container', $vc_id, $card_design_class, $dynamic_css, $atts, $add_link, $label=false, $text=false);
unset($add_link);
?>