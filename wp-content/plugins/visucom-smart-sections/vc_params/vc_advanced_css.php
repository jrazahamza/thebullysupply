<?php
/*
* Custom Styles / Advanced CSS Params Functions
*
* @file           admin/functions/vc-params/vc_advanced_css.php
* @package        Theme Gusta
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.2.1
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Inner Tabs Sub Group */
if(!function_exists('gusta_sub_group_field')):
	function gusta_sub_group_field( $settings, $value ) {
		$return = '';
		foreach ($settings["value"] as $var => $val):
			$return .= '<label class="vc_sub_group">
				<input id="' . esc_attr( $settings['param_name'] ) . '-' . $var . '" value="' . esc_attr( $var ) . '" class="wpb_vc_param_value vc_sub_group ' .	esc_attr( $settings['param_name'] ) . ' ' .	esc_attr( $settings['type'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" type="radio"';
				if ($value==$var): $return .= ' checked'; 
				elseif ($settings['std']==$var): $return .= ' checked'; endif;
			$return .= '> <span class="vc_sub_group-title">' . $val . '</span> 
			</label>';
		endforeach;	
		
		return $return;
	}
	if (function_exists('vc_add_shortcode_param')):
		vc_add_shortcode_param( 'gusta_sub_groups', 'gusta_sub_group_field', SMART_SECTIONS_PLUGIN_URL . '/assets/admin/js/inner_tabs.js' );
	endif;
endif;

/* Inner Tabs Image Radio */
if(!function_exists('gusta_radio_field')):
	function gusta_radio_field( $settings, $value ) {
		$return = '';
		foreach ($settings["value"] as $val):
			$return .= '<label class="vc_radio-label">
				<input id="' . esc_attr( $settings['param_name'] ) . '-' . $val . '" value="' . esc_attr( $val ) . '" class="wpb_vc_param_value vc_radio ' .	esc_attr( $settings['param_name'] ) . ' ' .	esc_attr( $settings['type'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" type="radio"';
				if ($value==$val): $return .= ' checked'; 
				elseif ($settings['std']==$val): $return .= ' checked'; endif;
			$return .= '> <span>' . $val . '</span>
			</label>';
		endforeach;	
		
		return $return;
	}
	if (function_exists('vc_add_shortcode_param')):
		vc_add_shortcode_param( 'gusta_radio', 'gusta_radio_field', SMART_SECTIONS_PLUGIN_URL . '/assets/admin/js/inner_tabs.js' );
	endif;
endif; 

/* Advanced CSS Tab */
if(!function_exists('gusta_advanced_css_field')):
	function gusta_advanced_css_field( $settings, $value ) {
		$return = "";
		$vals_array = array();
		$vals = explode(' !important;',$value);
		foreach ($vals as $val):
			$exp = explode(':',$val);
			if (!isset($exp[1])): $exp[1] = ''; endif;
			$vals_array[$exp[0]] = $exp[1];
		endforeach;
		
		if (!isset($vals_array['margin-top'])): $vals_array['margin-top'] = ''; endif;
		if (!isset($vals_array['margin-right'])): $vals_array['margin-right'] = ''; endif;
		if (!isset($vals_array['margin-bottom'])): $vals_array['margin-bottom'] = ''; endif;
		if (!isset($vals_array['margin-left'])): $vals_array['margin-left'] = ''; endif;
		if (!isset($vals_array['border-top-width'])): $vals_array['border-top-width'] = ''; endif;
		if (!isset($vals_array['border-right-width'])): $vals_array['border-right-width'] = ''; endif;
		if (!isset($vals_array['border-bottom-width'])): $vals_array['border-bottom-width'] = ''; endif;
		if (!isset($vals_array['border-left-width'])): $vals_array['border-left-width'] = ''; endif;
		if (!isset($vals_array['padding-top'])): $vals_array['padding-top'] = ''; endif;
		if (!isset($vals_array['padding-right'])): $vals_array['padding-right'] = ''; endif;
		if (!isset($vals_array['padding-bottom'])): $vals_array['padding-bottom'] = ''; endif;
		if (!isset($vals_array['padding-left'])): $vals_array['padding-left'] = ''; endif;
		if (!isset($vals_array['border-top-left-radius'])): $vals_array['border-top-left-radius'] = ''; endif;
		if (!isset($vals_array['border-top-right-radius'])): $vals_array['border-top-right-radius'] = ''; endif;
		if (!isset($vals_array['border-bottom-right-radius'])): $vals_array['border-bottom-right-radius'] = ''; endif;
		if (!isset($vals_array['border-bottom-left-radius'])): $vals_array['border-bottom-left-radius'] = ''; endif;
		if (!isset($vals_array['background-color'])): $vals_array['background-color'] = ''; endif;
		if (!isset($vals_array['background-style'])): $vals_array['background-style'] = ''; endif;
		if (!isset($vals_array['border-color'])): $vals_array['border-color'] = ''; endif;
		if (!isset($vals_array['border-style'])): $vals_array['border-style'] = ''; endif;
		if (!isset($vals_array['box-shadow-color'])): $vals_array['box-shadow-color'] = ''; endif;
		if (!isset($vals_array['box-shadow'])): $vals_array['box-shadow'] = ''; endif;
		if (!isset($vals_array['width'])): $vals_array['width'] = ''; endif;
		if (!isset($vals_array['height'])): $vals_array['height'] = ''; endif;
		if (!isset($vals_array['overlay'])): $vals_array['overlay'] = ''; endif;
		if (!isset($vals_array['gradient_direction'])): $vals_array['gradient_direction'] = ''; endif;
		if (!isset($vals_array['overlay-color'])): $vals_array['overlay-color'] = ''; endif;
		if (!isset($vals_array['gradient-color'])): $vals_array['gradient-color'] = ''; endif;
		if (!isset($vals_array['gradient_percentage_from'])): $vals_array['gradient_percentage_from'] = ''; endif;
		if (!isset($vals_array['gradient_percentage_to'])): $vals_array['gradient_percentage_to'] = ''; endif;

		$return .= '<div class="vc_advanced_css">
		<div class="main_advanced_css">
			<div class="gusta_left_column">
				<div class="margin_container">
					<label>margin</label>
					<input type="text" class="advanced_css css_box css_top" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="margin-top" value="'.$vals_array['margin-top'].'" />
					<input type="text" class="advanced_css css_box css_right" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="margin-right" value="'.$vals_array['margin-right'].'" />
					<input type="text" class="advanced_css css_box css_bottom" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="margin-bottom" value="'.$vals_array['margin-bottom'].'" />
					<input type="text" class="advanced_css css_box css_left" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="margin-left" value="'.$vals_array['margin-left'].'" />	
					<div class="border_container">
						<label>border</label>
						<input type="text" class="advanced_css css_box css_top" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="border-top-width" value="'.$vals_array['border-top-width'].'" />
						<input type="text" class="advanced_css css_box css_right" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="border-right-width" value="'.$vals_array['border-right-width'].'" />
						<input type="text" class="advanced_css css_box css_bottom" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="border-bottom-width" value="'.$vals_array['border-bottom-width'].'" />
						<input type="text" class="advanced_css css_box css_left" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="border-left-width" value="'.$vals_array['border-left-width'].'" />
						<div class="padding_container">
							<label>padding</label>
							<input type="text" class="advanced_css css_box css_top" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="padding-top" value="'.$vals_array['padding-top'].'" />
							<input type="text" class="advanced_css css_box css_right" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="padding-right" value="'.$vals_array['padding-right'].'" />
							<input type="text" class="advanced_css css_box css_bottom" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="padding-bottom" value="'.$vals_array['padding-bottom'].'" />
							<input type="text" class="advanced_css css_box css_left" data-parent="'.esc_attr( $settings['param_name'] ).'" placeholder="-" data-attr="padding-left" value="'.$vals_array['padding-left'].'" />
							<div class="css_center">
								<i class="fa fa-heart" aria-hidden="true"></i>
							</div>
						</div>
						<input type="text" class="advanced_css css_box border_radius" placeholder="-" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-top-left-radius" value="'.$vals_array['border-top-left-radius'].'" />
						<input type="text" class="advanced_css css_box border_radius" placeholder="-" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-top-right-radius" value="'.$vals_array['border-top-right-radius'].'" />
						<input type="text" class="advanced_css css_box border_radius" placeholder="-" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-bottom-right-radius" value="'.$vals_array['border-bottom-right-radius'].'" />
						<input type="text" class="advanced_css css_box border_radius" placeholder="-" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-bottom-left-radius" value="'.$vals_array['border-bottom-left-radius'].'" />
					</div>
				</div>
			</div>
			<div class="gusta_right_column">
				<div class="gusta_column_inner_full">
					<div class="gusta_background_field"></div>
				</div>
				<div class="gusta_column_inner">
					<label class="background_color_label">'.__('Background Color','mb_framework').'
						<div class="color-group">
							<input type="text" class="advanced_css gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="background-color" value="'.$vals_array['background-color'].'" />
						</div>
					</label>
				</div>
				<div class="gusta_column_inner">
					<label class="background_style_label">'.__('Background Style','mb_framework').'
						<select class="advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="background-style">
							<option value="">'.__('Default','mb_framework').'</option>
							<option value="cover"'; if ($vals_array['background-style']=="cover"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Cover','mb_framework').'</option>
							<option value="contain"'; if ($vals_array['background-style']=="contain"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Contain','mb_framework').'</option>
							<option value="no-repeat"'; if ($vals_array['background-style']=="no-repeat"): $return .= ' selected="selected"'; endif; $return .= '>'.__('No Repeat','mb_framework').'</option>
							<option value="repeat"'; if ($vals_array['background-style']=="repeat"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Repeat','mb_framework').'</option>
						</select>
					</label>
				</div>
				<div class="gusta_column_inner">
					<label class="border_color_label">'.__('Border Color','mb_framework').'
						<div class="color-group">
							<input type="text" class="advanced_css gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-color" value="'.$vals_array['border-color'].'" />
						</div>
					</label>
				</div>
				<div class="gusta_column_inner">
					<label class="border_style_label">'.__('Border Style','mb_framework').'
						<select class="advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="border-style">
							<option value="">'.__('Default','mb_framework').'</option>
							<option value="none"'; if ($vals_array['border-style']=="none"): $return .= ' selected="selected"'; endif; $return .= '>'.__('None','mb_framework').'</option>
							<option value="hidden"'; if ($vals_array['border-style']=="hidden"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Hidden','mb_framework').'</option>
							<option value="solid"'; if ($vals_array['border-style']=="solid"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Solid','mb_framework').'</option>
							<option value="dotted"'; if ($vals_array['border-style']=="dotted"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Dotted','mb_framework').'</option>
							<option value="dashed"'; if ($vals_array['border-style']=="dashed"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Dashed','mb_framework').'</option>
							<option value="double"'; if ($vals_array['border-style']=="double"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Double','mb_framework').'</option>
							<option value="groove"'; if ($vals_array['border-style']=="groove"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Groove','mb_framework').'</option>
							<option value="ridge"'; if ($vals_array['border-style']=="ridge"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Ridge','mb_framework').'</option>
							<option value="inset"'; if ($vals_array['border-style']=="inset"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Inset','mb_framework').'</option>
							<option value="outset"'; if ($vals_array['border-style']=="outset"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Outset','mb_framework').'</option>
							<option value="initial"'; if ($vals_array['border-style']=="initial"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Initial','mb_framework').'</option>
							<option value="inherit"'; if ($vals_array['border-style']=="inherit"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Inherit','mb_framework').'</option>
						</select>
					</label>
				</div>
				<div class="gusta_column_inner">
					<label class="box_shadow_color_label">'.__('Box Shadow Color','mb_framework').'
						<div class="color-group">
							<input type="text" class="advanced_css gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="box-shadow-color" value="'.$vals_array['box-shadow-color'].'" />
						</div>
					</label>
				</div>
				<div class="gusta_column_inner">
					<label class="box_shadow_label">'.__('Box Shadow','mb_framework').'
						<input type="text" class="advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="box-shadow" value="'.$vals_array['box-shadow'].'" />
					</label>
				</div>
				<div class="gusta_column_inner_full">
					<p class="box_shadow_desc">'.__('i.e. 10px 10px 5px 0','mb_framework').' <a href="https://www.w3schools.com/cssref/css3_pr_box-shadow.asp" target="_blank">'.__('Learn more', 'mb_framework').'</a></p>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="gusta_left_column">
			<div class="gusta_column_inner_full">
				<label class="box_width_label">'.__('Box Width','mb_framework').'
					<input type="text" class="advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="width" value="'.$vals_array['width'].'" />
					<p>Enter a pixel or percentage value (i.e. 300px or 100%).</p>
				</label>
			</div>
		</div>
		<div class="gusta_right_column">
			<div class="gusta_column_inner_full">
				<label class="box_height_label">'.__('Box Height','mb_framework').'
					<input type="text" class="advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="height" value="'.$vals_array['height'].'" />
					<p>Enter a pixel or percentage value (i.e. 300px or 100%).</p>
				</label>
			</div>
		</div>
		<div class="clear"></div>
		<div class="gusta_left_column">
			<div class="gusta_column_inner_full">
				<label class="overlay_label">'.__('Overlay Settings', 'mb_framework').'</label>
				<select class="advanced_css overlay" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="overlay">
					<option value="'.esc_attr( $settings['param_name'] ).'_single">'.__('Single Color','mb_framework').'</option>
					<option value="'.esc_attr( $settings['param_name'] ).'_gradient"'; if ($vals_array['overlay']=="gradient"): $return .= ' selected="selected"'; endif; $return .= '>'.__('Gradient','mb_framework').'</option>
				</select>
			</div>
			<div class="gusta_column_inner gradient_field">
				<label class="overlay_gradient_direction" data-position="top">
					<input class="gradient_direction advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" type="radio" data-attr="gradient_direction" value="top" name="'.esc_attr( $settings['param_name'] ).'_gradient_direction"'; if ($vals_array['gradient_direction']=="top"): $return .= ' checked="checked"'; endif;
					$return .= '/> <span></span>
				</label>
				<label class="overlay_gradient_direction" data-position="left">
					<input class="gradient_direction advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" type="radio" data-attr="gradient_direction" value="left" name="'.esc_attr( $settings['param_name'] ).'_gradient_direction"'; if ($vals_array['gradient_direction']=="left"): $return .= ' checked="checked"'; endif;
					$return .= '/> <span></span>
				</label>
				<label class="overlay_gradient_direction" data-position="top-left">
					<input class="gradient_direction advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" type="radio" data-attr="gradient_direction" value="top-left" name="'.esc_attr( $settings['param_name'] ).'_gradient_direction"'; if ($vals_array['gradient_direction']=="top-left"): $return .= ' checked="checked"'; endif;
					$return .= '/> <span></span>
				</label>
				<label class="overlay_gradient_direction" data-position="bottom-left">
					<input class="gradient_direction advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" type="radio" data-attr="gradient_direction" value="bottom-left" name="'.esc_attr( $settings['param_name'] ).'_gradient_direction"'; if ($vals_array['gradient_direction']=="bottom-left"): $return .= ' checked="checked"'; endif;
					$return .= '/> <span></span>
				</label>
				<label class="overlay_gradient_direction" data-position="radial">
					<input class="gradient_direction advanced_css" data-parent="'.esc_attr( $settings['param_name'] ).'" type="radio" data-attr="gradient_direction" value="radial" name="'.esc_attr( $settings['param_name'] ).'_gradient_direction"'; if ($vals_array['gradient_direction']=="radial"): $return .= ' checked="checked"'; endif;
					$return .= '/> <span></span>
				</label>
			</div>
			<div class="gusta_column_inner gradient_field">
				<p class="gradient_desc"><a href="https://www.w3schools.com/css/css3_gradients.asp" target="_blank">'.__('Learn more', 'mb_framework').'</a> '.__('about gradient.', 'mb_framework').'</p>
			</div>
		</div>
		<div class="gusta_right_column">
			<div class="gusta_column_inner_full"></div>
			<div class="gusta_column_inner">
				<label class="overlay_color_label">'.__('Overlay Color','mb_framework').'
					<div class="color-group">
						<input type="text" class="advanced_css gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="overlay-color" value="'.$vals_array['overlay-color'].'" />
					</div>
				</label>
			</div>
			<div class="gusta_column_inner gradient_field">
				<label class="gradient_color_label">'.__('Gradient Color','mb_framework').'
					<div class="color-group">
						<input type="text" class="advanced_css gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="gradient-color" value="'.$vals_array['gradient-color'].'" />
					</div>
				</label>
			</div>
			<div class="gusta_column_inner gradient_field">
				<select class="advanced_css gradient_percentage" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="gradient_percentage_from">
					<option value=""></option>';
					for ($i=0; $i<11; $i++):
						if ($i==0): $i=""; endif;
						$return .= '<option value="'.$i.'0%"'; if ($vals_array['gradient_percentage_from']==$i."0%"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'0%</option>';
					endfor;
				$return .= '</select>
			</div>
			<div class="gusta_column_inner gradient_field">
				<select class="advanced_css gradient_percentage" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="gradient_percentage_to">
					<option value=""></option>';
					for ($i=0; $i<11; $i++):
						if ($i==0): $i=""; endif;
						$return .= '<option value="'.$i.'0%"'; if ($vals_array['gradient_percentage_to']==$i."0%"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'0%</option>';
					endfor;
				$return .= '</select>
			</div>
		</div>
		<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field advanced_css_output" value="'.$value.'" />
		</div>';

		if ($vals_array['overlay']=="gradient"):
			$return .= '<style>div[data-vc-shortcode-param-name*="'.esc_attr($settings['param_name']).'"] .gradient_field { display: block; }</style>';
		endif;
		
		return $return;
	}
	vc_add_shortcode_param( 'advanced_css', 'gusta_advanced_css_field', SMART_SECTIONS_PLUGIN_URL . '/assets/admin/js/custom_css.js' );
endif;

/* Inner Tabs for each inner element of the shortcode element */
if(!function_exists('gusta_custom_styles_inner_tab')):
	function gusta_custom_styles_inner_tab ( $params, $element, $dependency, $atts ) {
		
		extract ($atts);
		
		$tab_name = ( $element == 'hover' ? 'Hover ' : ($element == 'active' ? 'Active ' : '' ) );
		
		if ($enable_box!=0):
			$params[] = array(
				'type' => 'advanced_css',
				'admin_label' => false,
				'param_name' => 'tg_'.$el_slug.'_tg_'.$element.'_tg_advanced_css',
				'heading' => $sub_group.' '.$tab_name.__('Advanced CSS','mb_framework'),
				'dependency' => $dependency,
				'group' => $group,
				'weight' => 0
			);
			$params[] = array(
				'type' => 'attach_image',
				'admin_label' => false,
				'param_name' => 'tg_'.$el_slug.'_tg_'.$element.'_tg_background_image',
				'heading' => __('Background Image','mb_framework'),
				'dependency' => $dependency,
				'group' => $group,
				'weight' => 0
			);
		endif;
		
		if ($enable_text==1):
			$params = gusta_custom_typography_tab ( $params, array ( 
				'group' => $group, 
				'el_slug' => 'tg_'.$el_slug.'_tg_'.$element.'_tg',
				'el_name' => $sub_group.' '.$tab_name,
				'dependency' => 0,
				'enable_hover' => $enable_hover,
				'enable_active' => $enable_active
			));
		endif;
		
		return $params;
	}
endif;

if(!function_exists('gusta_custom_styles_tab')):
	function gusta_custom_styles_tab ( $params, $atts ) {
		
		extract ($atts);
		
		if (!isset($sub_group)): $sub_group = ''; endif;
		if (!isset($enable_box)): $enable_box = ''; endif;
		if (!isset($enable_text)): $enable_text = ''; endif;
		
		$inner_atts = array (
			'group' => $group,
			'sub_group' => $sub_group,
			'enable_box' => $enable_box,
			'enable_text' => $enable_text,
			'enable_hover' => $enable_hover,
			'enable_active' => $enable_active,
			'el_slug' => $el_slug
		);

		$inner_tabs = array ( 'normal' );
		if ($enable_hover): $inner_tabs[] = 'hover'; endif;
		if ($enable_active): $inner_tabs[] = 'active'; endif;
		if ($enable_hover):
		$params[] = array(
			'type' => 'gusta_radio',
			'admin_label' => false,
			'param_name' => 'tg_'.$el_slug.'_tg_inner_tab',
			'heading' => 'Inner',
			'value' => $inner_tabs,
			'dependency' => $dependency,
			'group' => $group,
			'std' => 'normal',
			'weight' => 0
		);
		endif;
		$params = gusta_custom_styles_inner_tab ( $params, 'normal', $dependency, $inner_atts );
		if ($enable_hover): $params = gusta_custom_styles_inner_tab ( $params, 'hover', $dependency, $inner_atts ); endif;
		if ($enable_active): $params = gusta_custom_styles_inner_tab ( $params, 'active', $dependency, $inner_atts ); endif;
		
		return $params;
	}
endif;

if(!function_exists('gusta_styles_tab')):
	function gusta_styles_tab ( $params, $sub_groups ) {
		
		foreach ($sub_groups as $sub_grp):
			extract($sub_grp);
			$sub_groups_arr[$el_slug] = $sub_group;
			$std = $el_slug;
		endforeach;
		
		$params[] = array(
			'type' => 'gusta_sub_groups',
			'admin_label' => false,
			'param_name' => 'sub_groups',
			'heading' => 'Sub Groups',
			'value' => $sub_groups_arr,
			'dependency' => 0,
			'group' => __('Smart Styles', 'mb_framework'), 
			'weight' => 0,
			'std' => $std
		);
		
		foreach ($sub_groups as $sub_grp):
		
			if (!isset($sub_group)): $sub_group = ''; endif;
			if (!isset($enable_box)): $enable_box = ''; endif;
			if (!isset($enable_text)): $enable_text = ''; endif;
		
			extract ($sub_grp);
			$params = gusta_custom_styles_tab ( $params, array ( 
				'group' => __('Smart Styles', 'mb_framework'), 
				'sub_group' => $sub_group, 
				'el_slug' => $el_slug, 
				'dependency' => 0,
				'enable_hover' => $enable_hover,
				'enable_active' => $enable_active,
				'enable_box' => $enable_box,
				'enable_text' => $enable_text,
			));
		
		endforeach;
		
		return $params;
	}
endif;
?>