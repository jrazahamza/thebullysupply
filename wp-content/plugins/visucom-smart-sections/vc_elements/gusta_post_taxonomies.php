<?php
/*
* Visual Composer Post Taxonomies Element & Shortcode
*
* @file           vc_elements/gusta_post_taxonomies.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.1
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Taxonomies
*/
 
 // Element HTML
    function gusta_post_taxonomies_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if (isset($product)): if ($the_post==''): $the_post=get_post($product->get_id()); endif; endif;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'taxonomy' => 'category',
			'number_of_terms' => '1',
			'separator' => ', ',
			'label_text' => '',
			'add_label_icon' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'add_link' => 'none',
			'label_icon' => 'fontawesome',
			'label_icon_fontawesome' => 'fa fa fa-sitemap',
			'label_icon_openiconic' => 'vc-oi vc-oi-dial',
			'label_icon_typicons' => 'typcn typcn-adjust-brightness',
			'label_icon_entypo' => 'entypo-icon entypo-icon-note',
			'label_icon_linecons' => 'vc_li vc_li-heart',
			'label_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'label_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'label_icon_material' => 'vc-material vc-material-cake',
			'el_class' => '',
		), $atts, 'gusta_post_taxonomies');
		extract($att);
		
		if (isset($animation) && $animation!='none'):
			$ani = ' ani-'.$animation.'';
		endif;
		
		$output = $label = '';
		
		if (isset($add_label_icon) && $add_label_icon=='true'):
			$label = '<i class="'.$att['label_icon_'.$label_icon].' label-icon"></i>';
			vc_icon_element_fonts_enqueue( $label_icon );
		endif;
		if (isset($label_text) && $label_text!=''): $label .= '<span class="label-text">'.$label_text.'</span> '; endif;
		
		$tax_args = array("fields" => "all");
		
		if (isset($number_of_terms) && $number_of_terms!=''):
			$tax_args['number'] = $number_of_terms;
		endif;
		
		if ($the_post==''): $the_post=get_queried_object(); endif;
		
		$post_taxonomies = array();
		if ($the_post):
			$post_taxonomies = wp_get_post_terms( $the_post->ID, $taxonomy, $tax_args );
			$primary = gusta_get_post_primary_category($the_post->ID, $taxonomy, true);
			if (!empty($primary)):
				$primary = get_term($primary);
				$new_post_taxonomies = array();
				foreach($post_taxonomies as $taxo):
					if ($taxo->term_id!=$primary->term_id):
						$new_post_taxonomies[] = $taxo;
					endif;
				endforeach;
				$post_taxonomies = $new_post_taxonomies;
				array_unshift($post_taxonomies,$primary);
				if ($number_of_terms<count($post_taxonomies)):
					$remove_last = array_pop($post_taxonomies);
				endif;
			endif;
		endif;
		$i=0;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output .= '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><p class="'.$vc_id.' '.$el_class.' '.$visibility.' '.$ani.' ss-element gusta-post-taxonomies">';
		
		if ($label!=''):
			$output .= '<span class="gusta-label">'.$label.'</span>';
		endif;
		$cnt_cat = count($post_taxonomies)-1;
		foreach($post_taxonomies as $term){
			$link_class='';
			if (isset($add_link) && $add_link != 'none'):
				$the_permalink = get_term_link( $term->term_id );
				$linked = '<a'.$link_class.' href="'.$the_permalink.'">'.$term->name.'</a>';
			else:
				$linked = $term->name;
			endif;
			
			$output .= '<span class="ss-element-item">'.$linked.'</span>';
			if ($i<$cnt_cat): $output .= $separator; endif;
			$i++;
		}
		
		$output .= '</p></div>'.gusta_clear($att);
		
		return $output;
        
    }
    add_shortcode( 'gusta_post_taxonomies', 'gusta_post_taxonomies_html' );

	// Element Mapping

		$args = array( 'public' => true ); 
		$taxonomies = get_taxonomies( $args, 'objects', 'and' ); 
		if ( $taxonomies ) {
			foreach ( $taxonomies  as $taxonomy ) {
				$taxs[$taxonomy->label.' ('.$taxonomy->name.')'] = $taxonomy->name;
			}
		}
		$params = array (
			gusta_vc_id('taxonomies'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select Taxonomy', 'mb_framework' ),
				'param_name' => 'taxonomy',
				'admin_label' => false,
				'value' => $taxs
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Max. # of Terms', 'mb_framework' ),
				'description' => __( 'Enter the maximum number of terms to display.', 'mb_framework' ),
				'param_name' => 'number_of_terms',
				'admin_label' => false,
				'std' => '1'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Separator', 'mb_framework' ),
				'param_name' => 'separator',
				'admin_label' => false,
				'std' => ', '
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Add Link', 'mb_framework' ),
				'param_name' => 'add_link',
				'admin_label' => true,
				'value' => array(
					__('None', 'mb_framework')   => 'none',
					__('Taxonomy Link', 'mb_framework')   => 'tax'
				),
				'std' => 'none'
			),
		);

		$params = gusta_label($params, 'fa fa-sitemap');
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array (
			array (	'sub_group' => __( 'Label Text', 'mb_framework' ), 'el_slug' => 'label_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Taxonomy Item', 'mb_framework' ), 'el_slug' => 'taxonomy_item', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Taxonomies", "mb_framework"), // add a name
				"base" => "gusta_post_taxonomies", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);