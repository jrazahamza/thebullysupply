<?php
/*
* Visual Composer Navigation Element & Shortcode
*
* @file           vc_elements/gusta_navigation.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.3.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if (!isset($gusta_mega_menu_added)): $gusta_mega_menu_added = array(); endif;

/*
Element Description: Gusta Navigation
*/


    // Element HTML
    function gusta_navigation_html( $atts ) {
		global $wp_nav_menus, $gusta_mega_menu_added;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'select_menu' => '',
			'nav_depth' => '1',
			'nav_type' => 'horizontal',
			'show_select_box' => '',
			'nav_label' => __('Navigation', 'mb_framework'),
			'nav_label_select' => __('Navigation', 'mb_framework'),
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'el_class' => ''
		), $atts, 'gusta_navigation');
		extract($att);
		if (!isset($gusta_mega_menu_added[$select_menu])): $gusta_mega_menu_added[$select_menu] = 0; endif;

		$nav_responsive = '';
		if ($nav_type=='horizontal' && isset($show_select_box) && $show_select_box=='select'): $nav_responsive .= ' gusta-nav-responsive'; endif;
		
		$no_child = '';
		if ($nav_depth=='1'): $no_child = ' no-child'; endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$select_menu_message = '<ul class="gusta-navigation"><li class="menu-item"><a title="'.__('You should select your menu from the shortcode options of this navigation menu.','mb_framework').'" href="#">'.__('Select your menu', 'mb_framework').'</a></li></ul>';
		
		$output .= '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' ss-element gusta-nav '.$nav_type.$nav_responsive.$no_child.'">';
		if (isset($select_menu) && $select_menu!=''):
			if ($nav_type!='select'):
				if (!isset($wp_nav_menus[$select_menu.$nav_depth.$nav_type])):
					$wp_nav_menus[$select_menu.$nav_depth.$nav_type] = wp_nav_menu( array(
						'menu' => $select_menu,
						'depth' => $nav_depth,
						'container' => 'ul',
						'echo' => false,
						'menu_class' => 'gusta-navigation',
						'fallback_cb' => false,
						'walker' => new gusta_bootstrap_navwalker()
					));
				endif;
				if ($wp_nav_menus[$select_menu.$nav_depth.$nav_type]): 
					$output .= $wp_nav_menus[$select_menu.$nav_depth.$nav_type];
					//if ($gusta_mega_menu_added[$select_menu]!=1):
						$output .= do_shortcode(gusta_mega_menu($select_menu));
					//endif;
				else: $output .= $select_menu_message; endif;
			endif;

			if (($nav_type=='horizontal' && isset($show_select_box) && $show_select_box=='select') || $nav_type=='select'):
				if ($nav_type=='select'): $nav_label = $nav_label_select; endif;
				if (!isset($wp_nav_menus[$select_menu.$nav_depth.'select'])):
					$wp_nav_menus[$select_menu.$nav_depth.'select'] = wp_nav_menu( array(
						'menu' => $select_menu,
						'depth' => $nav_depth,
						'container' => 'select',
						'echo' => false,
						'menu_class' => 'navbar-select',
						'fallback_cb' => false,
						'items_wrap'     => '<select><option value="">'.$nav_label.'</option>%3$s</select>',
						'walker' => new Gusta_Walker_Nav_Menu_Dropdown()
					));
				endif;
				if ($wp_nav_menus[$select_menu.$nav_depth.'select']): 
					$output .= $wp_nav_menus[$select_menu.$nav_depth.'select'];
					//if ($gusta_mega_menu_added[$select_menu]!=1):
						$output .= do_shortcode(gusta_mega_menu($select_menu));
					//endif;
				else: if ($nav_type=='select'): $output .= $select_menu_message; endif; endif;
			endif;
		else:
			$output .= $select_menu_message;
		endif;
		
		$output .= '</div></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
        
    }		

	add_shortcode( 'gusta_navigation', 'gusta_navigation_html' );
		
	$params = array (
		gusta_vc_id('nav'),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Select Menu', 'mb_framework' ),
			'param_name' => 'select_menu',
			'description' => __( 'Select the navigation menu.', 'mb_framework' ),
			'admin_label' => true,
			'value' => gusta_nav_menu_array (),
			'std' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Navigation Type', 'mb_framework' ),
			'param_name' => 'nav_type',
			'description' => __( 'Select the type of the navigation menu.', 'mb_framework' ),
			'admin_label' => true,
			'value' => array(
				'Horizontal'   => 'horizontal',
				'Vertical'   => 'vertical',
				'Select Box'   => 'select',
			),
			'std' => 'horizontal'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Navigation Depth', 'mb_framework' ),
			'param_name' => 'nav_depth',
			'description' => __( 'Select the depth of the child elements to be shown on the menu.', 'mb_framework' ),
			'admin_label' => true,
			'value' => array(
				'No Child Elements'   => '1',
				'2nd Level'   => '2',
				'3rd Level'   => '3',
			),
			'std' => '1'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Navigation Root Items Line Height', 'mb_framework' ),
			'param_name' => 'nav_height',
			'description' => __( 'In pixels (i.e. 86px).', 'mb_framework' ),
			'std' => '42px',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Navigation Width', 'mb_framework' ),
			'param_name' => 'nav_width',
			'description' => __( 'In pixels or percentage (i.e. 300px or 100%).', 'mb_framework' ),
			'dependency' => array ('element' => 'nav_type', 'value' => array ('select','vertical')),
			'std' => '100%',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Show Select Box on Mobile Screens', 'mb_framework' ),
			'param_name' => 'show_select_box',
			'admin_label' => false,
			'dependency' => array ('element' => 'nav_type', 'value' => array ('horizontal')),
			'value' => array(
				__('Yes', 'mb_framework')   => 'select',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Responsive Select Box Navigation Width', 'mb_framework' ),
			'param_name' => 'nav_responsive_width',
			'description' => __( 'In pixels or percentage (i.e. 300px or 100%).', 'mb_framework' ),
			'dependency' => array ('element' => 'show_select_box', 'value' => array ('select')),
			'std' => '100%',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Select Box Navigation Label', 'mb_framework' ),
			'param_name' => 'nav_label_select',
			'dependency' => array ('element' => 'nav_type', 'value' => array ('select')),
			'std' => __('Navigation', 'mb_framework'),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Select Box Navigation Label', 'mb_framework' ),
			'param_name' => 'nav_label',
			'dependency' => array ('element' => 'show_select_box', 'value' => array ('select')),
			'std' => __('Navigation', 'mb_framework'),
		)
	);

	$params = gusta_element_display($params);
	$params[] = gusta_vc_extra_class_name();

	$params = gusta_styles_tab ( $params, array ( 
		array (	'sub_group' => __( 'Select Box', 'mb_framework' ), 'el_slug' => 'select', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		array (	'sub_group' => __( 'Sub Menu Items', 'mb_framework' ), 'el_slug' => 'sub_menu_item', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 ),
		array (	'sub_group' => __( 'Menu Items', 'mb_framework' ), 'el_slug' => 'menu_item', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 ),
		array (	'sub_group' => __( 'Dropdown Wrap', 'mb_framework' ), 'el_slug' => 'dropdown', 'dependency' => 0, 'enable_hover' => 0, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
	));

	// Map the block with vc_map()
	vc_map( 
		array(
			"name" => __("Navigation Menu", "mb_framework"), 
			"base" => "gusta_navigation", 
			"content_element" => true, 
			"is_container" => false, 
			"category" => __('Smart Sections', 'mb_framework'),
			"params" => $params
		)
	);

unset($params);     
