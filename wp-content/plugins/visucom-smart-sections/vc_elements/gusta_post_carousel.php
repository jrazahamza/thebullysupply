<?php
/*
* Visual Composer Post Carousel Element & Shortcode
*
* @file           vc_elements/gusta_post_carousel.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.7
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Carousel
*/
 
function gusta_print_owl() {
        wp_enqueue_script( 'owl-carousel-ss' );
        wp_enqueue_style( 'owl-carousel-ss' );
    }
     
    // Element HTML
    function gusta_post_carousel_html( $atts ) {
		global $parent;
		if (!$parent): $parent=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$fields = array(
			'vc_id' => '',
			'card_design' => '',
			'usage' => 'default',
			'post_type' => 'post',
			'number_of_columns' => '1',
			'number_of_columns_tablet' => '1',
			'number_of_columns_mobile' => '1',
			'stage_padding' => '0',
			'stage_padding_tablet' => '0',
			'stage_padding_mobile' => '0',
			'gap' => '30',
			'loop' => 'false',
			'total_items' => '10',
			'navigation' => 'false',
			'dots' => 'false',
			'autoplay' => 'false',
			'autoplay_timeout' => '5000',
			'posts_include' => '',
			'posts_exclude' => '',
			'parents_include' => '',
			'parents_exclude' => '',
			'authors_include' => '',
			'authors_exclude' => '',
			'post_types_include' => '',
			'no_posts_found_text' => '',
			'orderby' => 'date',
			'order' => 'DESC',
			'offset' => '',
			'sticky_posts' => '',
			'el_class' => '',
		);
		
		$att = shortcode_atts($fields, $atts, 'gusta_post_carousel');
		extract($att);
		
		$post_type = ($post_type!='' ? $post_type : 'post');
		$exclude_tax = array ('nav_menu', 'post_format');
		$get_taxonomies = get_object_taxonomies( $post_type, 'objects' );
	
		foreach ($get_taxonomies as $taxonomy):
			if (!in_array($taxonomy->name, $exclude_tax)):
				$fields[$taxonomy->name.'_include'] = '';
				$fields[$taxonomy->name.'_exclude'] = '';
			endif;
		endforeach;
		
		$att = shortcode_atts($fields, $atts, 'gusta_post_listing');
		extract($att);
		
		if (isset($card_design) && $card_design!=''):
			
			add_action('wp_footer', 'gusta_print_owl');
			wp_enqueue_script( 'owl-carousel-ss' );
        	wp_enqueue_style( 'owl-carousel-ss' );
			
			$pargs = array(
				'posts_per_page'   => $total_items,
				'offset'           => $offset,
				'orderby'          => $orderby,
				'order'            => $order,
				'post_status'      => 'publish'
			);
			
			if ($usage != 'default'):
				if (is_singular(array('post')) && $usage == 'related'):
					$post_categories = wp_get_post_categories( $parent->ID );
					$pargs['post_type'] = 'post';
					$pargs['post__not_in'] = array($parent->ID);
					$pargs['category'] = array();
					foreach($post_categories as $c):
						$cat = get_category( $c );
						$pargs['category__in'][] = $cat->term_id;
					endforeach;
				elseif (!is_singular(array('page', 'attachment', 'post')) && $usage == 'related'):
					if ($parent): $pargs['post_type'] = $parent->post_type; endif;
				elseif (is_search()):
					if (isset($post_types_include) && $post_types_include!=""): $pargs['post_type'] = explode(",",$post_types_include); endif;
					$s = esc_attr(get_search_query());
					$pargs['s'] = $s;
				elseif (is_category() || is_tag() || is_tax()):
					if ($usage != 'default'):
						$q_obj = get_queried_object();
						$pargs['tax_query'] = array( array(
							'taxonomy' => $q_obj->taxonomy,
							'field' => 'slug',
							'terms' => $q_obj->slug,
						));
					endif;
				elseif (is_date()):
					if (is_year()):
						$d = get_the_date('Y');
					elseif (is_month()):
						$d = get_the_date('Ym');
					elseif (is_day()):
						$d = get_the_date('Ymd');
					endif;
					$pargs['m'] = $d;
				elseif (is_author()):
					$author_id = get_the_author_meta('ID');
					$pargs['author'] = $author_id;
				else:
					$pargs['post_type'] = $post_type;
				endif;
			else:
				$pargs['post_type'] = $post_type;
			endif;
				
			if (isset($posts_include) && $posts_include!=""): $pargs['post__in'] = explode(",",$posts_include); endif;
			if (isset($posts_exclude) && $posts_exclude!=""): $pargs['post__not_in'] = explode(",",$posts_exclude); endif;
			
			if (isset($authors_include) && $authors_include!=""): $pargs['post_author__in'] = explode(",",$authors_include); endif;
			if (isset($authors_exclude) && $authors_exclude!=""): $pargs['post_author__not_in'] = explode(",",$authors_exclude); endif;
			
			if ($post_type=="page"):
				if (isset($parents_include) && $parents_include!=""): $pargs['post_parent__in'] = explode(",",$parents_include); endif;
				if (isset($parents_exclude) && $parents_exclude!=""): $pargs['post_parent__not_in'] = explode(",",$parents_exclude); endif;
			endif;
				
				
				//var_dump ($att);
				
				$tax_query = array();

				foreach ($get_taxonomies as $taxonomy):
					if (!in_array($taxonomy->name, $exclude_tax)):
						if (isset($att[$taxonomy->name.'_include']) && $att[$taxonomy->name.'_include']!=""):
							$tax_query[] =	array(
								'taxonomy' => $taxonomy->name,
								'terms'    => explode(",",$att[$taxonomy->name.'_include'])
							);
						endif;
						if (isset($att[$taxonomy->name.'_exclude']) && $att[$taxonomy->name.'_exclude']!=""):
							$tax_query[] =	array(
								'taxonomy' => $taxonomy->name,
								'terms'    => explode(",",$att[$taxonomy->name.'_exclude']),
								'operator' => 'NOT IN'
							);
						endif;
					endif;
				endforeach;
				
				if ($tax_query): $tax_query = array_merge(array( 'relation' => 'AND' ), $tax_query); $pargs['tax_query'] = $tax_query; endif;
		
			$show_list = true;
			
			if (!array_key_exists('post__not_in',$pargs)): $pargs["post__not_in"] = array(); endif;
	
			$sticky = get_option( 'sticky_posts' );
			if ($sticky_posts=='only_sticky'):
				$pargs['post__in'] = $sticky;
			elseif ($sticky_posts=='remove_sticky'):
				$pargs['post__not_in'] = array_merge($sticky, $pargs['post__not_in']);;
			endif;
			$pargs['ignore_sticky_posts'] = true;
		
			if ((!is_singular() || is_page()) && $usage == 'related'):
				$show_list = false;
			endif;
			
			if ($show_list==true):
				$paged = 0;
				
				$the_query = new WP_Query( $pargs );
				$total = $the_query->found_posts;
				
				if ( $the_query->have_posts() ):
					$page = $paged + 1;
					$output .= '<div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-post-carousel"><div class="owl-carousel">';
					
					$i=0;
					while ( $the_query->have_posts() ):
						$the_query->the_post();
						$i++;
						$duration = $i * 100;
						$parent = $the_query->post;
						$post_id = $parent->ID;
						$output .= '<div class="post-listing-container" id="gusta-post-'.$post_id.'">'.do_shortcode(get_post_field('post_content', $card_design)).'</div>';
					endwhile;
					wp_reset_postdata();
					
					$output .= '</div>';
					
					$output .= '<div class="slider_nav '.$vc_id.'"><i class="fa fa-chevron-left gusta-prev" aria-hidden="true"></i><i class="fa fa-chevron-right gusta-next" aria-hidden="true"></i>
</div>';
					
					if( current_user_can('editor') || current_user_can('administrator') ) :
						$output .= '<div class="edit-link edit-card-design" title="'.ucwords(__('Edit', 'mb_framework')).' Listing Card Design Template">
							<a href="'. site_url() . '/wp-admin/post.php?post='.$card_design.'&action=edit" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>';
					endif;
					$output .= '</div>';
				else:
					if ($no_posts_found_text!=''):
						$output .= '<p class="gusta-carousel-no-posts">'.$no_posts_found_text.'</p>';
					endif;
				endif;
				$parent = '';
			endif;
		else:			
			$output .= '<p>'.__('Select Card Design.', 'mb_framework').'</p>';
		endif;
		
		return $output;
        
    }
    add_shortcode('gusta_post_carousel','gusta_post_carousel_html');
     
    // Element Mapping
        global $post;

		$get_post_types = gusta_get_post_types();
		$params = array (
			array(
				'type' => 'dropdown',
				'heading' => __( 'Card Design', 'mb_framework' ),
				'description' => __( 'Select the card design for your listing. Not in the list? Checkout "Sections" link in the left WP admin menu."', 'mb_framework' ),
				'param_name' => 'card_design',
				'admin_label' => true,
				"value" => gusta_get_sections('card'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Post Carousel Usage', 'mb_framework' ),
				'description' => __( 'If you want to list posts related to a single post, select "Related Posts". For dynamic loops such as search results or posts in a specific archive, select "Archives / Search Results". To query simply all posts, select "Default"', 'mb_framework' ),
				'param_name' => 'usage',
				'admin_label' => false,
				'value' => array(
					__('Default', 'mb_framework') 	=> 'default',
					__('Archives / Search Results', 'mb_framework') 	=> 'archive',
					__('Related Posts', 'mb_framework') 	=> 'related',
				),
				'std' => 'default'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Post Type', 'mb_framework' ),
				'description' => __( 'Select the post type to list.', 'mb_framework' ),
				'param_name' => 'post_type',
				'admin_label' => true,
				'dependency' => array( 'element' => 'usage', 'value' => array('default') ),
				"value" => $get_post_types,
				'std' => 'post'
			),
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Include Posts / Pages', 'mb_framework' ),
			'param_name'  => 'posts_include',
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( "Enter comma separated post or page ID's to include (i.e. 5,12,25). Leave empty for all.", 'mb_framework' )
		);
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Exclude Posts / Pages', 'mb_framework' ),
			'param_name'  => 'posts_exclude',
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( "Enter comma separated post or page ID's to exclude (i.e. 5,12,25). Leave empty for none.", 'mb_framework' )
		);

		$exclude_post_types = array ('attachment');
		$post_types = get_post_types( array('public' => true), 'objects', 'and' );

		foreach ($post_types as $post_type):
		if (!in_array($post_type->name, $exclude_post_types)):

		$post_types_inc[] = array( 'label' => $post_type->label, 'value' => $post_type->name );

		if ($post_type->name=='page'):
		$pages = get_pages();
		$parents = array ( array( 'label' => 'Root', 'value' => '0' ) );
		foreach ( $pages as $page ) {
			$parents[] = array( 'label' => $page->post_title, 'value' => $page->ID );
		}
		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Include Parent Pages', 'mb_framework' ),
			'param_name'  => 'parents_include',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $parents,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( 'Enter parent pages to include. Type "Root" for main pages. Leave empty for all.', 'mb_framework' ),
			'dependency' => array( 'element' => 'post_type', 'value' => 'page' )
		);
		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Exclude Parent Pages', 'mb_framework' ),
			'param_name'  => 'parents_exclude',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $parents,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( 'Enter parent pages to exclude. Type "Root" for main pages. Leave empty for none.', 'mb_framework' ),
			'dependency' => array( 'element' => 'post_type', 'value' => 'page' )
		);
		endif;
		$exclude_tax = array ('gusta_section_category', 'nav_menu', 'post_format');
		$get_taxonomies = get_object_taxonomies( $post_type->name, 'objects' );

		foreach ($get_taxonomies as $taxonomy):
		if (!in_array($taxonomy->name, $exclude_tax)):

		$get_terms = get_terms( array( 'taxonomy' => $taxonomy->name, 'hide_empty' => false ) );
		$terms = array();
		foreach ( $get_terms as $term ):
		$terms[] = array( 'label' => $term->name, 'value' => $term->term_id );
		endforeach;
		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Include', 'mb_framework' ).' '.$taxonomy->labels->name,
			'param_name'  => $taxonomy->name.'_include',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $terms,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( 'Enter', 'mb_framework' ).' '.$taxonomy->labels->name.' '.__('to include. Leave empty for all.', 'mb_framework'),
			'dependency' => array( 'element' => 'post_type', 'value' => $post_type->name )
		);
		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Exclude', 'mb_framework' ).' '.$taxonomy->labels->name,
			'param_name'  => $taxonomy->name.'_exclude',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $terms,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( 'Enter', 'mb_framework' ).' '.$taxonomy->labels->name.' '.__('to exclude. Leave empty for none.', 'mb_framework'),
			'dependency' => array( 'element' => 'post_type', 'value' => $post_type->name )
		);
		endif;
		endforeach;
		
		endif;
		endforeach;

		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Include Post Types for Search Results', 'mb_framework' ),
			'param_name'  => 'post_types_include',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $post_types_inc,
			),
			'group'     => __( 'Data', 'mb_framework' ),
			'description' => __( 'If you are creating your custom search results page, you can enter post types to include. Leave empty for all. Please note that this option only works for the search results page.', 'mb_framework' ),
			'dependency' => array( 'element' => 'usage', 'value' => 'archive' )
		);

		/*$author_array = get_users();
		$authors = array();
		foreach ($author_array as $author):
		$authors[] = array( 'label' => $author->data->display_name, 'value' => $author->data->ID );
		endforeach;

		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Include Authors', 'mb_framework' ),
			'param_name'  => 'authors_include',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $authors,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'dependency' => array( 'element' => 'usage', 'value' => array('default') ),
			'description' => __( 'Enter authors to include. Leave empty for all.', 'mb_framework' )
		);
		$params[] = array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Exclude Authors', 'mb_framework' ),
			'param_name'  => 'authors_exclude',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $authors,
			),
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'dependency' => array( 'element' => 'usage', 'value' => array('default') ),
			'description' => __( 'Enter authors to exclude. Leave empty for all.', 'mb_framework' )
		);*/

		$params = array_merge($params, array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Stage (Desktop)', 'mb_framework' ),
				'param_name' => 'number_of_columns',
				'admin_label' => false,
				'value' => array(
					__('1 Column', 'mb_framework') => '1',
					__('2 Columns', 'mb_framework') => '2',
					__('3 Columns', 'mb_framework') => '3',
					__('4 Columns', 'mb_framework') => '4',
					__('5 Columns', 'mb_framework') => '5',
					__('6 Columns', 'mb_framework') => '6',
					__('7 Columns', 'mb_framework') => '7',
					__('8 Columns', 'mb_framework') => '8',
					__('9 Columns', 'mb_framework') => '9',
					__('10 Columns', 'mb_framework') => '10',
					__('11 Columns', 'mb_framework') => '11',
					__('12 Columns', 'mb_framework') => '12',
					__('13 Columns', 'mb_framework') => '13',
					__('14 Columns', 'mb_framework') => '14',
					__('15 Columns', 'mb_framework') => '15',
					__('16 Columns', 'mb_framework') => '16',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'std' => '1'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Stage (Tablet)', 'mb_framework' ),
				'param_name' => 'number_of_columns_tablet',
				'admin_label' => false,
				'value' => array(
					__('1 Column', 'mb_framework') => '1',
					__('2 Columns', 'mb_framework') => '2',
					__('3 Columns', 'mb_framework') => '3',
					__('4 Columns', 'mb_framework') => '4',
					__('5 Columns', 'mb_framework') => '5',
					__('6 Columns', 'mb_framework') => '6',
					__('7 Columns', 'mb_framework') => '7',
					__('8 Columns', 'mb_framework') => '8',
					__('9 Columns', 'mb_framework') => '9',
					__('10 Columns', 'mb_framework') => '10',
					__('11 Columns', 'mb_framework') => '11',
					__('12 Columns', 'mb_framework') => '12',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'std' => '1'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of Columns per Stage (Mobile)', 'mb_framework' ),
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
				'type' => 'textfield',
				'heading' => __( 'Stage Padding (Desktop)', 'mb_framework' ),
				'param_name' => 'stage_padding',
				'value' => '0',
				'description' => __( 'Integer value (i.e. 50).', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Stage Padding (Tablet)', 'mb_framework' ),
				'param_name' => 'stage_padding_tablet',
				'value' => '0',
				'description' => __( 'Integer value (i.e. 50).', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Stage Padding (Mobile)', 'mb_framework' ),
				'param_name' => 'stage_padding_mobile',
				'value' => '0',
				'description' => __( 'Integer value (i.e. 50).', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-4',
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
			array(
				'type' => 'dropdown',
				'heading' => __( 'Loop', 'mb_framework' ),
				'param_name' => 'loop',
				'value' => array(
					__( 'No', 'mb_framework' ) => 'false',
					__( 'Yes', 'mb_framework' ) => 'true',
				),
				'description' => __( 'Infinity loop.', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => 'no'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Total Items', 'mb_framework' ),
				'param_name' => 'total_items',
				'description' => __( 'Total number of items to load.', 'mb_framework' ),
				'value' => '10',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Previous / Next Buttons?', 'mb_framework' ),
				'param_name' => 'navigation',
				'value' => array(
					__( 'No', 'mb_framework' ) => 'false',
					__( 'Yes', 'mb_framework' ) => 'true',
				),
				'description' => __( 'Select whether or not to show next/prev buttons.', 'mb_framework' ),
				'std' => 'no'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Dots Navigation', 'mb_framework' ),
				'param_name' => 'dots',
				'value' => array(
					__( 'No', 'mb_framework' ) => 'false',
					__( 'Yes', 'mb_framework' ) => 'true',
				),
				'description' => __( 'Select whether to show dots navigation.', 'mb_framework' ),
				'std' => 'no'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Autoplay', 'mb_framework' ),
				'param_name' => 'autoplay',
				'value' => array(
					__( 'No', 'mb_framework' ) => 'false',
					__( 'Yes', 'mb_framework' ) => 'true',
				),
				'description' => __( 'Select to autoplay or not.', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => 'no'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Autoplay Timeout', 'mb_framework' ),
				'param_name' => 'autoplay_timeout',
				'value' => '5000',
				'edit_field_class' => 'vc_col-sm-6',
				'description' => __( 'Select autoplay interval in milliseconds (i.e. 5000).', 'mb_framework' ),
				'dependency' => array( 'element' => 'autoplay', 'value' => 'true' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'mb_framework' ),
				'param_name' => 'orderby',
				'value' => array(
					__( 'Date', 'mb_framework' ) => 'date',
					__( 'Post ID', 'mb_framework' ) => 'ID',
					__( 'Author', 'mb_framework' ) => 'author',
					__( 'Title', 'mb_framework' ) => 'title',
					__( 'Last modified date', 'mb_framework' ) => 'modified',
					__( 'Post/page parent ID', 'mb_framework' ) => 'parent',
					__( 'Number of comments', 'mb_framework' ) => 'comment_count',
					__( 'Menu order/Page Order', 'mb_framework' ) => 'menu_order',
					/*__( 'Meta value', 'mb_framework' ) => 'meta_value',
						__( 'Meta value number', 'mb_framework' ) => 'meta_value_num',*/
					__( 'Random order', 'mb_framework' ) => 'rand',
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
					__( 'Descending', 'mb_framework' ) => 'DESC',
					__( 'Ascending', 'mb_framework' ) => 'ASC',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Offset', 'mb_framework' ),
				'param_name' => 'offset',
				'description' => __( 'Number of posts to displace or pass over.', 'mb_framework' ),
				'group' => __( 'Data', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sticky Posts', 'mb_framework' ),
				'param_name' => 'sticky_posts',
				'group' => __( 'Data', 'mb_framework' ),
				'value' => array(
					__( 'Ignore Sticky Posts', 'mb_framework' ) => '',
					__( 'Show Only Sticky Posts', 'mb_framework' ) => 'only_sticky',
					__( 'Remove Sticky Posts From Query', 'mb_framework' ) => 'remove_sticky',
				),
				'description' => __( 'Learn more about sticky posts from <a href="https://wordpress.org/support/article/sticky-posts/" target="_blank">this link</a>.', 'mb_framework' ),
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => __( '"No Posts Found" text', 'mb_framework' ),
				'param_name' => 'no_posts_found_text',
				'description' => __( 'If there is no post found in the query, the text you write here will be displayed (leave empty to display no text).', 'mb_framework' ),
			),
			gusta_vc_id('post-carousel'),
			gusta_vc_extra_class_name(),
		));

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Single Dot', 'mb_framework' ), 'el_slug' => 'single_dot', 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 0),
			array (	'sub_group' => __( 'Dots', 'mb_framework' ), 'el_slug' => 'dots', 'enable_hover' => 0, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
			array (	'sub_group' => __( 'Left Arrow', 'mb_framework' ), 'el_slug' => 'left_arrow', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
			array (	'sub_group' => __( 'Right Arrow', 'mb_framework' ), 'el_slug' => 'right_arrow', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1),
			array (	'sub_group' => __( 'Single Card Container', 'mb_framework' ), 'el_slug' => 'card_container', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Carousel", "mb_framework"), // add a name
				"base" => "gusta_post_carousel", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
    
	unset($params);
     