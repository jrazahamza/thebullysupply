<?php
/*
* VC Gusta Product Description Dynamic CSS
*
*
* @file           includes/css/gusta_wc_product_description.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/
$add_link = 'none';
$dynamic_css = gusta_post_element_style ('description', $vc_id, $card_design_class, $dynamic_css, $atts, $add_link, $label=false);
unset($add_link);
?>