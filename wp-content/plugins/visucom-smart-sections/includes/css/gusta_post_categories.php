<?php
/*
* VC Gusta Post Categories Dynamic CSS
*
*
* @file           includes/css/gusta_post_categories.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if ($card_design_class!=''):
	$box_el_class = '.'.$card_design_class.' .post-listing-container .'.$vc_id;
	$box_hover_class = '.'.$card_design_class.' .post-listing-container:hover .'.$vc_id;
else:
	$box_el_class = '.'.$vc_id;
	$box_hover_class = '.'.$vc_id.':hover';
endif;

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class,
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'container',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class,
	'enable_active' => 0,
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class.' span.ss-element-item a, '.$box_el_class.' span.ss-element-item span',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'category_item',
	'enable_hover' => 1,
	'hover_class' => $box_el_class.' span.ss-element-item a:hover, '.$box_hover_class.' span.ss-element-item span',
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class . ', '.$box_el_class.' span.ss-element-item a, '.$box_el_class.' span.ss-element-item span',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'category_item',
	'enable_hover' => 1,
	'hover_class' => $box_el_class . ':hover, '.$box_el_class.' span.ss-element-item a:hover, '.$box_hover_class.' span.ss-element-item span',
	'enable_active' => 0,
	'active_class' => '',
));

$dynamic_css = gusta_show_dynamic_css ( array (
	'el_class' => $box_el_class.' span.label-text',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'label_text',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' span.label-text',
	'enable_active' => 0,
));

$dynamic_css = gusta_show_dynamic_text_css ( array (
	'el_class' => $box_el_class.' span.label-text',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'label_text',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' span.label-text',
	'enable_active' => 0,
));

$dynamic_css = gusta_show_icon_css ( array (
	'el_class' => $box_el_class.' i.label-icon',
	'dynamic_css' => $dynamic_css,
	'shatts' => $atts,
	'el_slug' => 'label_icon',
	'enable_hover' => 1,
	'hover_class' => $box_hover_class.' i.label-icon',
	'enable_active' => 0,
	'active_class' => ''
));
unset($add_link);
?>