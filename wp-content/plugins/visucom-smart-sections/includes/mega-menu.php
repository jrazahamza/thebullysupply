<?php
/*
* Mega Menu
* 
*
* @file           admin/mega-menu.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.7
*
*/

/* Created the mega menu object and parses it under the navigation item 
if(!function_exists('gusta_mega_menu_objects')):
	function gusta_mega_menu_objects( $items, $args ) {	
		foreach( $items as &$item ):
			$gusta_mega_menu = get_field('gusta_mega_menu', $item);
			if ($gusta_mega_menu):
				$gusta_mega_menu_section = get_field('gusta_mega_menu_section', $item);
				if ($gusta_mega_menu_section!=''):
					$section_content = get_post($gusta_mega_menu_section);
					$content = $section_content->post_content;
					$container = gusta_get_theme_var('container');
					if ($container==''):
						$container = 'container';
					endif;
					$item->mega_menu = '<div id="gusta-mega-menu-'.$item->ID.'" class="gusta-mega-menu"><div class="'.$container.'">'.do_shortcode($content);
					if( current_user_can('editor') || current_user_can('administrator') ) :
						$item->mega_menu .= '<div class="edit-link edit-'.$section_content->post_name.'" title="'.ucwords(__('Edit', 'mb_framework')).' '.$section_content->post_title.'"><a href="'.get_edit_post_link( $section_content->ID ).'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>';
					endif;
					$item->mega_menu .= '</div></div>';
					
					$mega_menu_css = get_post_meta( $gusta_mega_menu_section, '_wpb_shortcodes_custom_css', true );
					$mega_menu_css .= get_post_meta( $gusta_mega_menu_section, '_wpb_post_custom_css', true );
					
					$inner_dynamic_css = gusta_inline_shortcode_css ( array(), $gusta_mega_menu_section, 'section-inner' );
					$transparency = floatval(get_post_meta($gusta_mega_menu_section, 'gusta_section_background_gusta_section_background_transparency', true)) / 100;
					$transparency = ($transparency ? $transparency : 1);
					$bg_color_opt = get_post_meta($gusta_mega_menu_section, 'gusta_section_background_gusta_section_background_color', true);
					$background_color = ( $bg_color_opt ? gusta_hextorgbcss($bg_color_opt, $transparency) : '');
					$inner_dynamic_css["#gusta-mega-menu-".$item->ID] .= ($background_color ? 'background-color: '.$background_color.' !important;' : '');
					
					foreach ($inner_dynamic_css as $var => $val):
						if ($val): $mega_menu_css .= ' '. $var . ' { ' . $val . ' }'; endif;
					endforeach;
					
					$mega_menu_css = trim ( preg_replace( '/\s+/', ' ', $mega_menu_css) );
					if ($mega_menu_css!=''): $item->mega_menu .= '<style id="gusta_mega_menu_css_'.$gusta_mega_menu_section.'">'.$mega_menu_css.'</style>'; endif;
					$gusta_mega_menu_on_click = get_field('gusta_mega_menu_on_click', $item);
					$item->mega_menu_on_click = $gusta_mega_menu_on_click;
				endif;
			endif;
		endforeach;
		return $items;
	}
	add_filter('wp_nav_menu_objects', 'gusta_mega_menu_objects', 10, 2);
endif; */
function gusta_mega_menu($menu_id) {
	global $gusta_mega_menu_added;
	$output = '';
	$array_menu = wp_get_nav_menu_items($menu_id);
	if ($array_menu):
		foreach ($array_menu as $m) {
			if (empty($m->menu_item_parent)) {
				$items[] = $m->ID;
			}
		}
		$args = array(
			'numberposts'	=> -1,
			'post_type' => 'gusta_section',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'gusta_menu_item',
					'value' => $items,
					'compare' => 'IN'
				)
			)
		);
		// query
		$the_query = new WP_Query( $args );
		if( $the_query->have_posts() ): 
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$gusta_mega_menu_section = get_the_id();
				$purpose = get_post_meta( $gusta_mega_menu_section, 'gusta_section_purpose', true );
				if ($purpose=='mega_menu'):
					$menu_item = get_post_meta( $gusta_mega_menu_section, 'gusta_menu_item', true );
					$gusta_menu_trigger_type = get_post_meta( $gusta_mega_menu_section, 'gusta_menu_trigger_type', true );
					$container = gusta_get_theme_var('container');
					if ($container==''):
						$container = 'container';
					endif;
					$output .= '<div id="gusta-mega-menu-'.$menu_item.'" class="gusta-mega-menu gusta-trigger-on-'.$gusta_menu_trigger_type.'"><div class="'.$container.'">';
					$output .= get_the_content();
					$output .= '</div></div>';
					$mega_menu_css = get_post_meta( $gusta_mega_menu_section, '_wpb_shortcodes_custom_css', true );
					$mega_menu_css .= get_post_meta( $gusta_mega_menu_section, '_wpb_post_custom_css', true );

					$inner_dynamic_css = gusta_inline_shortcode_css ( array(), $gusta_mega_menu_section, 'section-inner' );
					$transparency = floatval(get_post_meta($gusta_mega_menu_section, 'gusta_section_background_gusta_section_background_transparency', true)) / 100;
					$transparency = ($transparency ? $transparency : 1);
					$bg_color_opt = get_post_meta($gusta_mega_menu_section, 'gusta_section_background_gusta_section_background_color', true);
					$background_color = ( $bg_color_opt ? gusta_hextorgbcss($bg_color_opt, $transparency) : '');
					if (!isset($inner_dynamic_css["#gusta-mega-menu-".$menu_item])):
						$inner_dynamic_css["#gusta-mega-menu-".$menu_item] = '';
					endif;
					$inner_dynamic_css["#gusta-mega-menu-".$menu_item] .= ($background_color ? 'background-color: '.$background_color.' !important;' : '');

					foreach ($inner_dynamic_css as $var => $val):
					if ($val): $mega_menu_css .= ' '. $var . ' { ' . $val . ' }'; endif;
					endforeach;

					$mega_menu_css = trim ( preg_replace( '/\s+/', ' ', $mega_menu_css) );
					if ($mega_menu_css!=''): $output .= '<style id="gusta_mega_menu_css_'.$gusta_mega_menu_section.'">'.$mega_menu_css.'</style>'; endif;
				endif;
			endwhile;
		endif;
		wp_reset_query();
		$gusta_mega_menu_added[$menu_id] = 1;
	endif;
	return $output;
}
?>