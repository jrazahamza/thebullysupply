<?php
/*
* Visual Composer Post Filter Element & Shortcode
*
* @file           vc_elements/gusta_post_filter.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Filter
*/

// Element HTML
    function gusta_post_filter_html( $atts ) {
		global $parent;
    	if (!$parent): $parent=get_queried_object(); endif;
		$css = $el_class = $output = ''; unset ($dynamic_css);
		
		$fields = array(
			'vc_id' => '',
			'filters' => '',
			'post_listing_id' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'el_class' => '',
		);
		
		$att = shortcode_atts($fields, $atts, 'gusta_post_listing_filter');
		extract($att);
		
		$mobile_disp = gusta_mobile_display($att);
		
		$filters = (array) vc_param_group_parse_atts( $filters );
		
		$output .= '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div id="'.$vc_id.'" class="ss-element gusta-post-filter '.$el_class.'" data-post-listing="'.$post_listing_id.'">';
		
		foreach ($filters as $filter):
			$taxonomy = $filter["taxonomy"];
			$type = $filter["type"];
			$card_design = $filter["card_design"];
			$number_of_columns = $filter["number_of_columns"];
			$gap = $filter["gap"];
			$included_ids = isset($filter["included_ids"]) ? $filter["included_ids"] : '';
			$excluded_ids = isset($filter["excluded_ids"]) ? $filter["excluded_ids"] : '';
			$all_text = $filter["all_text"];
			$hide_empty = (isset($filter["hide_empty"]) ? $filter["hide_empty"] : '');
			
			if ($hide_empty == 'true'): $hide_empty = true; else: $hide_empty = false; endif;
		
			$get_terms = array(
			    'taxonomy' => $taxonomy,
				'parent' => '0',
			    'hide_empty' => $hide_empty,
			);
			
			if ($included_ids!=''): $get_terms["include"] = array_map('trim', explode(',', $included_ids)); endif;
			if ($excluded_ids!=''): $get_terms["exclude"] = array_map('trim', explode(',', $excluded_ids)); endif;
		
			$terms = get_terms( $get_terms );
			
			if ($type=='advanced'):
				$output .= '<ul id="filter-'.$taxonomy.'" class="gusta-type-advanced gusta-filter-columns-'.$number_of_columns.' gusta-filter-gap-'.$gap.' card-'.$card_design.'">';
				$parent = (object) array(
					 'term_id' => 0,
					 'name' => ($all_text!='' ? $all_text : __('All','mb_framework')),
					 'slug' => 0,
					 'term_group' => 0,
					 'term_taxonomy_id' => 0,
					 'taxonomy' => $taxonomy,
					 'description' => '',
					 'parent' => 0,
					 'count' => 1,
					 'filter' => 'raw'
				);
				$listing_type = 'post-filter';
				$term_id = 0;
				$output .= '<li id="'.$taxonomy.'-'.$term_id.'" class="post-listing-container gusta-active"><a>';
				$output .= do_shortcode(get_post_field('post_content', $card_design));
				$output .= '</a></li>';
				foreach($terms as $term):
					$parent = $term;
					$listing_type = 'post-filter';
					$term_id = $parent->term_id;
					$output .= '<li id="'.$taxonomy.'-'.$term_id.'" class="post-listing-container"><a>';
						$output .= do_shortcode(get_post_field('post_content', $card_design));
					$output .= '</a></li>';
				endforeach;
				$output .= '</ul>';
			elseif ($type=='dropdown'):
				$output .= '<div class="gusta-type-dropdown-container"><button class="gusta-type-button" type="button">'.($all_text!='' ? $all_text : __('All','mb_framework')).'<i class="fa fa-sort-down"></i></button> <ul id="filter-'.$taxonomy.'" class="gusta-type-dropdown">
				<li class="gusta-active" id="'.$taxonomy.'-0"><a>'.($all_text!='' ? $all_text : __('All','mb_framework')).'</a></li>';
				foreach($terms as $term):
					$output .= '<li id="'.$taxonomy.'-'.$term->term_id.'"'.($term->parent!='0' ? ' class="gusta-child-term"' : '').'><a>'.$term->name.'</a></li>';
					$child_terms = array(
						'taxonomy' => $taxonomy,
						'parent' => $term->term_id,
						'hide_empty' => $hide_empty,
					);
					if ($included_ids!=''): $child_terms["include"] = array_map('trim', explode(',', $included_ids)); endif;
					if ($excluded_ids!=''): $child_terms["exclude"] = array_map('trim', explode(',', $excluded_ids)); endif;
					$children = get_terms( $child_terms );
					foreach ($children as $child):
						$output .= '<li id="'.$taxonomy.'-'.$child->term_id.'"'.($child->parent!='0' ? ' class="gusta-child-term"' : '').'><a>'.$child->name.'</a></li>';
					endforeach;
				endforeach;
				$output .= '</ul></div>';
			else:
				$output .= '<ul id="filter-'.$taxonomy.'" class="gusta-type-tabs">
				<li class="gusta-active" id="'.$taxonomy.'-0"><a>'.($all_text!='' ? $all_text : __('All','mb_framework')).'</a></li>';
				foreach($terms as $term):
					$output .= '<li id="'.$taxonomy.'-'.$term->term_id.'"'.($term->parent!='0' ? ' class="gusta-child-term"' : '').'><a>'.$term->name.'</a></li>';
					$child_terms = array(
						'taxonomy' => $taxonomy,
						'parent' => $term->term_id,
						'hide_empty' => $hide_empty,
					);
					if ($included_ids!=''): $child_terms["include"] = array_map('trim', explode(',', $included_ids)); endif;
					if ($excluded_ids!=''): $child_terms["exclude"] = array_map('trim', explode(',', $excluded_ids)); endif;
					$children = get_terms( $child_terms );
					foreach ($children as $child):
						$output .= '<li id="'.$taxonomy.'-'.$child->term_id.'"'.($child->parent!='0' ? ' class="gusta-child-term"' : '').'><a>'.$child->name.'</a></li>';
					endforeach;
				endforeach;
				$output .= '</ul>';
			endif;
					
		endforeach;
		
		$output .= '</div></div>';
		
		$output .= gusta_clear($att);
				
		return $output;
        
    }
    add_shortcode( 'gusta_post_filter', 'gusta_post_filter_html' );
     
    // Element Mapping
        global $post;
		
	$args = array(
	  'public'   => true
	  
	); 
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$taxonomies = get_taxonomies( $args, $output, $operator ); 	
		
     	$params = array (
			array(
				'type' => 'param_group',
				'heading' => __( 'Filters', 'mb_framework' ),
				'param_name' => 'filters',
				'value' => /*urlencode( json_encode( array(
					array(
						'text' => __( 'Lorem ipsum dolor sit amet', 'mb_framework' ),
						'link' => '',
					),
					array(
						'text' => __( 'Sed ut perspiciatis unde omnis iste natus', 'mb_framework' ),
						'link' => '',
					),
				) ) )*/'',
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __( 'Taxonomy', 'js_composer' ),
						'param_name' => 'taxonomy',
						'description' => __( 'Select the taxonomy for filter.', 'mb_framework' ),
						'value' => $taxonomies,
						'admin_label' => true,
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Type', 'js_composer' ),
						'param_name' => 'type',
						'description' => __( 'Select the type of the filter (tabs or dropdown).', 'mb_framework' ),
						'value' => array (
							__('Tabs', 'mb_framework') => 'tabs',
							__('Dropdown', 'mb_framework') => 'dropdown',
							__('Advanced', 'mb_framework') => 'advanced',
						),
						'admin_label' => false,
						'std' => 'tabs',
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Card Design', 'mb_framework' ),
						'description' => __( 'Select the card design for your filter listing. Not in the list? Checkout "Sections" link in the left WP admin menu."', 'mb_framework' ),
						'param_name' => 'card_design',
						'admin_label' => true,
						"value" => gusta_get_sections('card'),
						'edit_field_class' => 'vc_col-sm-12',
						'dependency' => array( 'element' => 'type', 'value' => array('advanced') ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Number of Columns per Row', 'mb_framework' ),
						'param_name' => 'number_of_columns',
						'admin_label' => false,
						'value' => array(
							__('1 Column', 'mb_framework') => '1',
							__('2 Columns', 'mb_framework') => '2',
							__('3 Columns', 'mb_framework') => '3',
							__('4 Columns', 'mb_framework') => '4',
							__('5 Columns', 'mb_framework') => '5',
							__('6 Columns', 'mb_framework') => '6',
						),
						'edit_field_class' => 'vc_col-sm-8',
						'dependency' => array( 'element' => 'type', 'value' => array('advanced') ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Gap', 'mb_framework' ),
						'param_name' => 'gap',
						'admin_label' => false,
						'value' => array(
							'0' => '0',
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6',
							'7' => '7',
							'8' => '8',
							'9' => '9',
							'10' => '10',
							'11' => '11',
							'12' => '12',
							'13' => '13',
							'14' => '14',
							'15' => '15',
							'16' => '16',
							'17' => '17',
							'18' => '18',
							'19' => '19',
							'20' => '20',
						),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array( 'element' => 'type', 'value' => array('advanced') ),
						'std' => '0'
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Hide Empty', 'mb_framework' ),
						'param_name' => 'hide_empty',
						'description' => __( 'Hide the taxonomies which have no posts.', 'mb_framework' ),
						'value' => array (
							__('Yes', 'mb_framework') => 'true',
						),
						'admin_label' => false,
						'std' => '',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( "Include Terms (ID's)", 'mb_framework' ),
						'param_name'  => 'included_ids',
						'edit_field_class' => 'vc_col-xs-6',
						'admin_label' => false,
						'description' => __( "Enter comma separated term ID's to include, if you want only a few specific terms to be displayed (i.e. 5,12,25). Leave empty for all.", 'mb_framework' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( "or Exclude Terms (ID's)", 'mb_framework' ),
						'param_name'  => 'excluded_ids',
						'edit_field_class' => 'vc_col-xs-6',
						'admin_label' => false,
						'description' => __( "Enter comma separated term ID's to exclude, if you want few specific terms not to be displayed (i.e. 5,12,25). Leave empty for none.", 'mb_framework' )
					),
					array(
						'type' => 'textfield',
						'heading' => __( '"All" Text', 'mb_framework' ),
						'param_name' => 'all_text',
						'description' => __( 'Enter the text for the "All" tabs in the filter (default: All).', 'mb_framework' ),
						'admin_label' => false,
						'std' => __('All', 'mb_framework'),
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Post Listing ID', 'mb_framework' ),
				'param_name' => 'post_listing_id',
				'description' => __( 'Enter the post listing unique ID (i.e. post-listing-4388115195bc1f840c1de3). Leave empty if you have only one post listing on your page.', 'mb_framework' ),
				'admin_label' => false,
				'std' => '',
			),
			gusta_vc_id('post-filter'),
			gusta_vc_extra_class_name(),
		);
		
		$params = gusta_element_display($params);


		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Dropdown Button', 'mb_framework' ), 'el_slug' => 'dropdown_button', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
			array (	'sub_group' => __( 'Filter Items', 'mb_framework' ), 'el_slug' => 'filter_items', 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1),
			array (	'sub_group' => __( 'Filter Container', 'mb_framework' ), 'el_slug' => 'container', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Listing Filter", "mb_framework"), // add a name
				"base" => "gusta_post_filter", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);