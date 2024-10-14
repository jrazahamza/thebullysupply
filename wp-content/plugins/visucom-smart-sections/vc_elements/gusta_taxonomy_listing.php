<?php
/*
* Visual Composer Taxonomy Listing Element & Shortcode
*
* @file           vc_elements/gusta_taxonomy_listing.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.4.7
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Taxonomy Listing
*/
 
// Element HTML
    function gusta_taxonomy_listing_html( $atts ) {
    	global $parent;
    	if (!$parent): $parent=get_queried_object(); endif;

        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$fields = array(
			'vc_id' => '',
			'card_design' => '',
			'usage' => 'default',
			'taxonomy' => 'category',
			'number_of_columns' => '1',
			'number_of_columns_tablet' => '1',
			'number_of_columns_mobile' => '1',
			/*'load_more_style' => 'load_more_button',
			'load_more_text' => __('Load More', 'mb_framework'),*/
			'items_per_page' => '10',
			'hide_empty' => true,
			'parent_term' => '',
			'terms_include' => '',
			'terms_exclude' => '',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'offset' => '',
			'el_class' => '',
		);
		
		$att = shortcode_atts($fields, $atts, 'gusta_taxonomy_listing');
		extract($att);
		
		if (isset($card_design) && $card_design!=''):

			wp_enqueue_script( 'salvattore' );
			wp_enqueue_script( 'loop' );
			wp_localize_script( 'loop', 'loop', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			
			$hide_empty = ($hide_empty=='true' ? true : false);
		
			$targs = array(
				'hide_empty'        => $hide_empty,
				'number'   			=> $items_per_page,
				'offset'           	=> $offset,
				'orderby'          	=> $orderby,
				'order'            	=> $order,
			);

			if ($orderby=='meta_value_num'):
				$targs["meta_query"] = [[
				    'type' => 'NUMERIC',
				]];
			endif;

			if (isset($terms_include) && $terms_include!=""): $targs['include'] = $terms_include; endif;
			if (isset($terms_exclude) && $terms_exclude!=""): $targs['exclude'] = $terms_exclude; endif;
			
			if ($usage=='archive'):
				$arch = get_queried_object();
				$targs['taxonomy'] = $arch->taxonomy;
				$targs['parent'] = $arch->term_id;
			else:
				$targs['taxonomy'] = $taxonomy;
				$targs['parent'] = $parent_term;
			endif;
		
			$terms = get_terms( $targs );
			
			/*[term_id] => 51
            [name] => Trial
            [slug] => trial
            [term_group] => 0
            [term_taxonomy_id] => 51
            [taxonomy] => product_cat
            [description] => 
            [parent] => 0
            [count] => 1
            [filter] => raw*/
		
			if ( $terms ):
				//print_r($terms);
				$output .= '<div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-post-listing"><div class="gusta-grid" data-columns>';
				
				$i=0;
				foreach ( $terms as $term ):
					$i++;
					$duration = $i * 100;
					$parent = $term;
					$term_id = $parent->term_id;
					$output .= '<div class="post-listing-container" id="gusta-term-'.$term_id.'">'.do_shortcode(get_post_field('post_content', $card_design)).'</div>';
				endforeach;
				
				$output .= '</div>';
				
				if( current_user_can('editor') || current_user_can('administrator') ) :
					$output .= '<div class="edit-link edit-card-design" title="'.ucwords(__('Edit', 'mb_framework')).' Listing Card Design Template">
						<a href="'. site_url() . '/wp-admin/post.php?post='.$card_design.'&action=edit" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
				endif;
		
				$output .= '</div>';
				
				/*if ($load_more_style == 'load_more_button' && $total > $items_per_page):
					$output .= '<div class="clear"></div><div class="gusta-load-more gusta-align-center"><button id="gusta-load-more-'.$vc_id.'" class="load-more-button btn">'.$load_more_text.'</button></div>';
				endif;*/

			else:
				$output .= '<p class="gusta-no-terms-found">'.__('No terms found.', 'mb_framework').'</p>';
			endif;
		else:			
			$output .= '<p>'.__('Select Card Design.', 'mb_framework').'</p>';
		endif;
		
		return $output;
        
    }
    add_shortcode( 'gusta_taxonomy_listing', 'gusta_taxonomy_listing_html' );
     
    // Element Mapping
        global $post;
	
		$args = array( 'public'   => true ); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator ); 	
		$params = array (
			array(
				'type' => 'dropdown',
				'heading' => __( 'Card Design', 'mb_framework' ),
				'description' => __( 'Select the card design for your listing."', 'mb_framework' ),
				'param_name' => 'card_design',
				'admin_label' => true,
				"value" => gusta_get_sections('card'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Usage', 'mb_framework' ),
				'param_name' => 'usage',
				'value' => array(
					__( 'Default', 'mb_framework' ) => 'default',
					__( 'Archive Child Taxonomies', 'mb_framework' ) => 'archive',
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Taxonomy', 'mb_framework' ),
				'description' => __( 'Select the taxonomy to list.', 'mb_framework' ),
				'param_name' => 'taxonomy',
				'admin_label' => false,
				"value" => $taxonomies,
				'dependency' => array( 'element' => 'usage', 'value' => array('default') ),
				'std' => 'post'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Include Terms', 'mb_framework' ),
				'param_name'  => 'terms_include',
				'edit_field_class' => 'vc_col-xs-6',
				'group'     => __( 'Data', 'mb_framework' ),
				'description' => __( "Enter comma separated post or term ID's to include (i.e. 5,12,25). Leave empty for all.", 'mb_framework' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Exclude Terms', 'mb_framework' ),
				'param_name'  => 'terms_exclude',
				'edit_field_class' => 'vc_col-xs-6',
				'group'     => __( 'Data', 'mb_framework' ),
				'description' => __( "Enter comma separated post or term ID's to exclude (i.e. 5,12,25). Leave empty for none.", 'mb_framework' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Hide Empty', 'mb_framework' ),
				'param_name' => 'hide_empty',
				'value' => array(
					__( 'Yes', 'mb_framework' ) => 'true',
					__( 'No', 'mb_framework' ) => 'false',
				),
				'group' => __( 'Data', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'description' => __( "Whether to hide terms not assigned to any posts.", 'mb_framework' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Parent', 'mb_framework' ),
				'param_name'  => 'parent_term',
				'group'     => __( 'Data', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array( 'element' => 'usage', 'value' => array('default') ),
				'description' => __( "Enter the parent term ID to only retrieve direct-child terms. Leave empty for all terms.", 'mb_framework' )
			),
		);

		$params = array_merge($params, array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Row (Desktop)', 'mb_framework' ),
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
				'edit_field_class' => 'vc_col-sm-4',
				'std' => '1'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Row (Tablet)', 'mb_framework' ),
				'param_name' => 'number_of_columns_tablet',
				'admin_label' => false,
				'value' => array(
					__('1 Column', 'mb_framework') => '1',
					__('2 Columns', 'mb_framework') => '2',
					__('3 Columns', 'mb_framework') => '3',
					__('4 Columns', 'mb_framework') => '4',
					__('5 Columns', 'mb_framework') => '5',
					__('6 Columns', 'mb_framework') => '6',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'std' => '1'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Row (Mobile)', 'mb_framework' ),
				'param_name' => 'number_of_columns_mobile',
				'admin_label' => false,
				'value' => array(
					__('1 Column', 'mb_framework') => '1',
					__('2 Columns', 'mb_framework') => '2',
					__('3 Columns', 'mb_framework') => '3',
					__('4 Columns', 'mb_framework') => '4',
					__('5 Columns', 'mb_framework') => '5',
					__('6 Columns', 'mb_framework') => '6',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'std' => '1'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Gap', 'mb_framework' ),
				'param_name' => 'gap',
				'value' => array(
					'0px'   => '0',
					'1px'   => '1',
					'2px'   => '2',
					'3px'   => '3',
					'4px'   => '4',
					'5px'   => '5',
					'10px'   => '10',
					'15px'   => '15',
					'20px'   => '20',
					'25px'   => '25',
					'30px'   => '30',
					'35px'   => '35',
					'40px'   => '40',
					'45px'   => '45',
					'50px'   => '50'
				),
				/*'edit_field_class' => 'vc_col-sm-6',*/
				'std' => '30',
				'description' => __( 'Select gap between columns.', 'mb_framework' ),
			),
			/*array(
				'type' => 'dropdown',
				'heading' => __( 'Load More Style', 'mb_framework' ),
				'param_name' => 'load_more_style',
				'value' => array(
					__( 'Show all', 'mb_framework' ) => 'all',
					__( 'Load more button', 'mb_framework' ) => 'load_more_button',
					__( 'Load more on scroll', 'mb_framework' ) => 'scroll',
				),
				'description' => __( 'Select style for loading more terms.', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => 'load_more_button'
			),*/
			array(
				'type' => 'textfield',
				'heading' => __( 'Offset', 'mb_framework' ),
				'param_name' => 'offset',
				'description' => __( 'Number of grid elements to displace or pass over.', 'mb_framework' ),
				'group' => __( 'Data', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items on page load', 'mb_framework' ),
				'param_name' => 'items_per_page',
				'description' => __( 'Number of items to show.', 'mb_framework' ),
				'value' => '10',
				'edit_field_class' => 'vc_col-sm-6',
			),
			/*array(
				'type' => 'textfield',
				'heading' => __( 'Load More Text', 'mb_framework' ),
				'param_name' => 'load_more_text',
				'admin_label' => true,
				'dependency' => array( 'element' => 'load_more_style', 'value' => array('load_more_button') ),
				'std' => __('Load More', 'mb_framework')
			),*/
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'mb_framework' ),
				'param_name' => 'orderby',
				'value' => array(
					__( 'Term Order', 'mb_framework' ) => 'meta_value_num',
					__( 'Term ID', 'mb_framework' ) => 'term_id',
					__( 'Name', 'mb_framework' ) => 'name',
					__( 'Description', 'mb_framework' ) => 'description',
					__( 'Post Count', 'mb_framework' ) => 'count',
					__( 'Parent', 'mb_framework' ) => 'parent',
				),
				'group' => __( 'Data', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sort order', 'mb_framework' ),
				'param_name' => 'order',
				'group' => __( 'Data', 'mb_framework' ),
				'value' => array(
					__( 'Ascending', 'mb_framework' ) => 'ASC',
					__( 'Descending', 'mb_framework' ) => 'DESC',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			gusta_vc_id('taxonomy-listing'),
			gusta_vc_extra_class_name(),
		));

		$params = gusta_styles_tab ( $params, array ( 
			/*array (	'sub_group' => __( 'Load More Button', 'mb_framework' ), 'el_slug' => 'load_more_button', 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1),*/
			array (	'sub_group' => __( 'Single Card Container', 'mb_framework' ), 'el_slug' => 'card_container', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Taxonomy Listing", "mb_framework"), // add a name
				"base" => "gusta_taxonomy_listing", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);