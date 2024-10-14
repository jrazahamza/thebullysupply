<?php
/*
* Icon Picker Functions
*
* @file           admin/functions/vc-params/vc_icon_picker.php
* @package        Theme Gusta
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Icon fields for shortcode elements */
if(!function_exists('gusta_add_icon_field')):
	function gusta_add_icon_field ( $params, $atts ) {
		
		extract ($atts);
		
		$group = (isset($group) ? $group : __('Icon', 'mb_framework'));
		
		$params[] = gusta_icon_select( $heading, $param_name, $dependency, $group );
		$params[] = gusta_icon_fontawesome( $heading, $param_name, $group, $std );
		$params[] = gusta_icon_openiconic( $heading, $param_name, $group );
		$params[] = gusta_icon_typicons( $heading, $param_name, $group );
		$params[] = gusta_icon_entypo( $heading, $param_name, $group );
		$params[] = gusta_icon_linecons( $heading, $param_name, $group );
		$params[] = gusta_icon_pixelicons( $heading, $param_name, $group );
		$params[] = gusta_icon_monosocial( $heading, $param_name, $group );
		$params[] = gusta_icon_material( $heading, $param_name, $group );
		
		if ($enable_active):
			$params[] = gusta_icon_select( $heading.' Active', $param_name.'active', $dependency, $group );
			$params[] = gusta_icon_fontawesome( $heading.' Active', $param_name.'active', $group, 'fa fa-times' );
			$params[] = gusta_icon_openiconic( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_typicons( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_entypo( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_linecons( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_pixelicons( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_monosocial( $heading.' Active', $param_name.'active', $group );
			$params[] = gusta_icon_material( $heading.' Active', $param_name.'active', $group );
		endif;
		
		if ($enable_active): $field_class = 'vc_col-xs-4'; else: $field_class = 'vc_col-xs-6'; endif;
		
		$params[] = array(
			'type' => 'colorpicker',
			'heading' => __( $heading.' Color', 'mb_framework' ),
			'param_name' => $param_name.'color',
			'admin_label' => false,
			'edit_field_class' => $field_class,
			'dependency' => $dependency, 
			'group' => $group
		);
		if ($enable_hover):
			$params[] = array(
				'type' => 'colorpicker',
				'heading' => __( $heading.' Hover Color', 'mb_framework' ),
				'param_name' => $param_name.'hovercolor',
				'admin_label' => false,
				'edit_field_class' => $field_class,
				'dependency' => $dependency, 
				'group' => $group
			);
		endif;
		if ($enable_active):
			$params[] = array(
				'type' => 'colorpicker',
				'heading' => __( $heading.' Active Color', 'mb_framework' ),
				'param_name' => $param_name.'activecolor',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-4',
				'dependency' => $dependency, 
				'group' => $group
			);
		endif;
		$params[] = array(
			'type' => 'textfield',
			'heading' => __( $heading.' Size', 'mb_framework' ),
			'description' => __( 'In pixels (i.e. 15px).', 'mb_framework' ),
			'param_name' => $param_name.'size',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'dependency' => $dependency,
			'group' => $group
		);
		if (!isset($disable_text)): $disable_text=0; endif;
		if ($disable_text!=1):
			$params[] = array(
				'type' => 'textfield',
				'heading' => __( 'Margin between Icon and Text', 'mb_framework' ),
				'description' => __( 'In pixels (i.e. 4px).', 'mb_framework' ),
				'param_name' => $param_name.'margin_between',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-6',
				'dependency' => $dependency,
				'group' => $group
			);
		endif;
		
		return $params;
	}
endif;

if(!function_exists('gusta_icon_select')):
	function gusta_icon_select( $heading, $param_name, $dependency = null, $group = null ) {
		$heading = ( $heading ? $heading : __('Icon Library', 'mb_framework') );
		$param_name = ( $param_name ? $param_name : 'icon_type');
		$data = array(
			'type' => 'dropdown',
			'heading' => $heading,
			'value' => array(
				__( 'Font Awesome', 'mb_framework' ) => 'fontawesome',
				__( 'Open Iconic', 'mb_framework' ) => 'openiconic',
				__( 'Typicons', 'mb_framework' ) => 'typicons',
				__( 'Entypo', 'mb_framework' ) => 'entypo',
				__( 'Linecons', 'mb_framework' ) => 'linecons',
				__( 'Pixel', 'mb_framework' ) => 'pixelicons',
				__( 'Mono Social', 'mb_framework' ) => 'monosocial',
				__( 'Material', 'mb_framework' ) => 'material',
			),
			'param_name' => $param_name,
			'admin_label' => false,
			'description' => __( 'Select icon library.', 'mb_framework' ),
			'std' => 'fontawesome'
		);
		if ($dependency): $data['dependency'] = $dependency; endif;
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_fontawesome')):
	function gusta_icon_fontawesome( $heading, $dep_param_name = null, $group = null, $default = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$def = ( $default ? $default : 'fa fa-info-circle');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_fontawesome',
			'value' => $default,
			'admin_label' => false,
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_openiconic')):
	function gusta_icon_openiconic ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_openiconic',
			'value' => 'vc-oi vc-oi-dial',
			'admin_label' => false,
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'openiconic',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return apply_filters( 'gusta_icon_openiconic', $data, $dep_param_name, $group );
	}
endif;

if(!function_exists('gusta_icon_typicons')):
	function gusta_icon_typicons ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_typicons',
			'admin_label' => false,
			'value' => 'typcn typcn-adjust-brightness',
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'typicons',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_entypo')):
	function gusta_icon_entypo ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_entypo',
			'admin_label' => false,
			'value' => 'entypo-icon entypo-icon-note',
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'entypo',
			),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_linecons')):
	function gusta_icon_linecons ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_linecons',
			'admin_label' => false,
			'value' => 'vc_li vc_li-heart',
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'linecons',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_pixelicons')):
	function gusta_icon_pixelicons ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		if(function_exists('vc_pixel_icons')):
			$pixel_icons = vc_pixel_icons();
		else:
			$pixel_icons = false;
		endif;
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_pixelicons',
			'admin_label' => false,
			'value' => 'vc_pixel_icon vc_pixel_icon-alert',
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'type' => 'pixelicons',
				'source' => $pixel_icons,
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'pixelicons',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_monosocial')):
	function gusta_icon_monosocial ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_monosocial',
			'admin_label' => false,
			'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'monosocial',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'monosocial',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;

if(!function_exists('gusta_icon_material')):
	function gusta_icon_material ( $heading, $dep_param_name=null, $group = null ) {
		$depparname = ( $dep_param_name ? $dep_param_name : 'icon_type');
		$icon_prefix = ( $dep_param_name ? $dep_param_name : 'icon');
		$data = array(
			'type' => 'iconpicker',
			'heading' => __( 'Select', 'mb_framework' ).' '.$heading,
			'param_name' => $icon_prefix.'_material',
			'admin_label' => false,
			'value' => 'vc-material vc-material-cake', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'material',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => $depparname,
				'value' => 'material',
			),
			'description' => __( 'Select icon from library.', 'mb_framework' ),
		);
		if ($group): $data['group'] = $group; endif;
		return $data;
	}
endif;
?>