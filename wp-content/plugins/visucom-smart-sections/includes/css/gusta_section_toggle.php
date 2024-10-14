<?php
/*
* VC Gusta Section Toggle Dynamic CSS
*
*
* @file           includes/css/gusta_section_toggle.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'icon_container',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover, #'.$vc_id.'.active:hover',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'.active',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'icon_container',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover, #'.$vc_id.'.active:hover',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'.active',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => '#'.$vc_id.' span',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'near_icon',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover span, #'.$vc_id.'.active:hover span',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'.active span'
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => '#'.$vc_id.' span',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'near_icon',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover span, #'.$vc_id.'.active:hover span',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'.active span'
));

$dynamic_css = gusta_show_icon_css ( array (
	'el_class' => '#'.$vc_id.' i',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'toggle_icon',
	'enable_hover' => 1,
	'hover_class' => '#'.$vc_id.':hover i, #'.$vc_id.'.active:hover i',
	'enable_active' => 1,
	'active_class' => '#'.$vc_id.'.active i'
));

/*
if (isset($section) && $section!=''):
	global $hidden;
	if (!isset($dynamic_css["#section-".$section])): $dynamic_css["#section-".$section] = ''; endif;
	if (!isset($hidden)): $hidden = array(); endif;
	if (!isset($hidden[$section])): $hidden[$section] = false; endif;
	if (isset($hide_by_default) && $hide_by_default=='yes'):
		if ($hidden[$section]!=true):
			$dynamic_css["#section-".$section] .= 'display: none !important; ';
			$hidden[$section]=true;
		endif;
	endif;
endif;*/
?>