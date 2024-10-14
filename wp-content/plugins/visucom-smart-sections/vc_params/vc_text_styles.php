<?php
/*
* Custom Typography / Text Styles Params Functions
*
* @file           admin/functions/vc-params/vc_text_styles.php
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

/* Text Styles (Custom Typography) Tab */
if(!function_exists('gusta_text_style')):
	function gusta_text_style( $settings, $value ) {
		$vals_array = array();
		$vals = explode(' !important;',$value);
		foreach ($vals as $val):
			$exp = explode(':',$val);
			if (!isset($exp[1])): $exp[1] = ''; endif;
			$vals_array[$exp[0]] = $exp[1];
		endforeach;

		if (!isset($vals_array['font-family'])): $vals_array['font-family'] = ''; endif;
		if (!isset($vals_array['font-weight'])): $vals_array['font-weight'] = ''; endif;
		if (!isset($vals_array['font-size'])): $vals_array['font-size'] = ''; endif;
		if (!isset($vals_array['mobile-font-size'])): $vals_array['mobile-font-size'] = ''; endif;
		if (!isset($vals_array['line-height'])): $vals_array['line-height'] = ''; endif;
		if (!isset($vals_array['text-transform'])): $vals_array['text-transform'] = ''; endif;
		if (!isset($vals_array['font-style'])): $vals_array['font-style'] = ''; endif;
		if (!isset($vals_array['letter-spacing'])): $vals_array['letter-spacing'] = ''; endif;
		if (!isset($vals_array['text-decoration'])): $vals_array['text-decoration'] = ''; endif;
		if (!isset($vals_array['color'])): $vals_array['color'] = ''; endif;
		
		$return = '<div class="gusta-admin-text-style">
		<label class="font-family" title="'.__('Font Family','mb_framework').'">'.__('Font Family','mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="font-family">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			$fonts_array = gusta_get_selected_fonts();
			foreach ($fonts_array as $slug => $name):
				$return .= '<option value="'.$slug.'"'; if ($vals_array['font-family']==$slug): $return .= ' selected="selected"'; endif; $return .= '>'.$name.'</option>';
			endforeach;
		$return .= '</select></label>
		<label class="font-weight" title="'.__('Font Weight','mb_framework').'">'.__('Font Weight', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="font-weight">
			<option value="">'.__('Default', 'mb_framework').'</option>
			<option value="100"'; if ($vals_array['font-weight']=="100"): $return .= ' selected="selected"'; endif; $return .= '>100 (Thin)</option>
			<option value="200"'; if ($vals_array['font-weight']=="200"): $return .= ' selected="selected"'; endif; $return .= '>200 (Extra Light)</option>
			<option value="300"'; if ($vals_array['font-weight']=="300"): $return .= ' selected="selected"'; endif; $return .= '>300 (Light)</option>
			<option value="400"'; if ($vals_array['font-weight']=="400"): $return .= ' selected="selected"'; endif; $return .= '>400 (Normal)</option>
			<option value="500"'; if ($vals_array['font-weight']=="500"): $return .= ' selected="selected"'; endif; $return .= '>500 (Medium)</option>
			<option value="600"'; if ($vals_array['font-weight']=="600"): $return .= ' selected="selected"'; endif; $return .= '>600 (Semi Bold)</option>
			<option value="700"'; if ($vals_array['font-weight']=="700"): $return .= ' selected="selected"'; endif; $return .= '>700 (Bold)</option>
			<option value="800"'; if ($vals_array['font-weight']=="800"): $return .= ' selected="selected"'; endif; $return .= '>800 (Extra Bold)</option>
			<option value="900"'; if ($vals_array['font-weight']=="900"): $return .= ' selected="selected"'; endif; $return .= '>900 (Heavy)</option>
		</select></label>
		<label class="font-size" title="'.__('Font Size','mb_framework').'">'.__('Font Size','mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="font-size">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			for ($i=6; $i<151; $i++):
				$return .= '<option value="'.$i.'px"'; if ($vals_array['font-size']==$i."px"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'px</option>';
			endfor;
		$return .= '</select></label>
		<label class="mobile-font-size" title="'.__('Mobile Font Size','mb_framework').'">'.__('Mobile Font Size', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="mobile-font-size">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			for ($i=6; $i<151; $i++):
				$return .= '<option value="'.$i.'px"'; if ($vals_array['mobile-font-size']==$i."px"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'px</option>';
			endfor;
		$return .= '</select></label>
		
		<label class="line-height" title="'.__('Line Height','mb_framework').'">'.__('Line Height', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="line-height">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			for ($i=0; $i<151; $i++):
				$return .= '<option value="'.$i.'px"'; if ($vals_array['line-height']==$i."px"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'px</option>';
			endfor;
		$return .= '</select></label>';
		$return .= '<label class="text-transform" title="'.__('Text Transform','mb_framework').'">'.__('Text Transform', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="text-transform">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			$ttr = array('none','capitalize','uppercase','lowercase','initial','inherit');
			foreach ($ttr as $tt):
				$return .= '<option value="'.$tt.'"'; if ($vals_array['text-transform']==$tt): $return .= ' selected="selected"'; endif; $return .= '>'.ucfirst($tt).'</option>';
			endforeach;
		$return .= '</select></label>';
		
		/*$return .= '<label class="margin" title="'.__('Margin','mb_framework').'"><input class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="margin" value="'.$vals_array['margin'].'" placeholder="i.e. 10px 10px 20px 20px"></label>';*/
		
		$return .= '<label class="font-style" title="'.__('Font Style','mb_framework').'">'.__('Font Style', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="font-style">
			<option value="">'.__('Default', 'mb_framework').'</option>
			<option value="normal"'; if ($vals_array['font-style']=="normal"): $return .= ' selected="selected"'; endif; $return .= '>Normal</option>
			<option value="italic"'; if ($vals_array['font-style']=="italic"): $return .= ' selected="selected"'; endif; $return .= '>Italic</option>
			<option value="oblique"'; if ($vals_array['font-style']=="oblique"): $return .= ' selected="selected"'; endif; $return .= '>Oblique</option>
			<option value="initial"'; if ($vals_array['font-style']=="initial"): $return .= ' selected="selected"'; endif; $return .= '>Initial</option>
			<option value="inherit"'; if ($vals_array['font-style']=="inherit"): $return .= ' selected="selected"'; endif; $return .= '>Inherit</option>
		</select></label>
		
		<label class="letter-spacing" title="'.__('Letter Spacing','mb_framework').'">'.__('Letter Spacing', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="letter-spacing">
			<option value="">'.__('Default', 'mb_framework').'</option>';
			for ($i=-15; $i<51; $i++):
				$return .= '<option value="'.$i.'px"'; if ($vals_array['letter-spacing']==$i."px"): $return .= ' selected="selected"'; endif; $return .= '>'.$i.'px</option>';
			endfor;
		$return .= '</select></label>
		
		<label class="text-decoration" title="'.__('Text Decoration','mb_framework').'">'.__('Text Decoration', 'mb_framework').'
		<select class="text_style" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="text-decoration">
			<option value="">'.__('Default', 'mb_framework').'</option>
			<option value="none"'; if ($vals_array['text-decoration']=="none"): $return .= ' selected="selected"'; endif; $return .= '>None</option>
			<option value="underline"'; if ($vals_array['text-decoration']=="underline"): $return .= ' selected="selected"'; endif; $return .= '>Underline</option>
			<option value="overline"'; if ($vals_array['text-decoration']=="overline"): $return .= ' selected="selected"'; endif; $return .= '>Overline</option>
			<option value="line-through"'; if ($vals_array['text-decoration']=="line-through"): $return .= ' selected="selected"'; endif; $return .= '>Line-through</option>
			<option value="initial"'; if ($vals_array['text-decoration']=="initial"): $return .= ' selected="selected"'; endif; $return .= '>Initial</option>
			<option value="inherit"'; if ($vals_array['text-decoration']=="inherit"): $return .= ' selected="selected"'; endif; $return .= '>Inherit</option>
		</select></label>
		
		<label class="text_color_label" title="'.__('Text Color', 'mb_framework').'">'.__('Text Color','mb_framework').'
			<div class="color-group">
				<input type="text" class="text_style gusta-color-picker" data-parent="'.esc_attr( $settings['param_name'] ).'" data-attr="color" value="'.$vals_array['color'].'" />
			</div>
		</label>';
		
		$return .= '<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value ' .
				 esc_attr( $settings['param_name'] ) . ' ' .
				 esc_attr( $settings['type'] ) . '_field text_style_output" value="'.$value.'" />' .
				 '</div>';

		return $return;
	}
	vc_add_shortcode_param( 'text_style', 'gusta_text_style', SMART_SECTIONS_PLUGIN_URL . '/assets/admin/js/text_style.js' );
endif;

if(!function_exists('gusta_custom_typography_tab')):
	function gusta_custom_typography_tab ( $params, $atts ) {
		
		extract ($atts);
		
		$params[] = array(
			'type' => 'text_style',
			'admin_label' => false,
			'param_name' => $el_slug.'_text_style',
			'heading' => $el_name.' '.__('Text Style','mb_framework'),
			'dependency' => $dependency,
			'group' => $group,
			'weight' => 0
		);
		return $params;
	}
endif;
?>