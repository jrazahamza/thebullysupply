<?php
/*
* Visual Composer Post Listing Element & Shortcode
*
* @file           vc_elements/gusta_post_listing.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.7
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Post Listing
*/

function gusta_salvattore_print_script() {
        wp_enqueue_script( 'salvattore' );
		wp_enqueue_script( 'loop' );
		wp_localize_script( 'loop', 'loop', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    }

	// Element HTML
    function gusta_post_listing_html( $atts ) {
		global $parent, $inline;
		if (!$parent): $parent=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$fields = array(
			'vc_id' => '',
			'card_design' => '',
			'usage' => 'default',
			'relation' => 'taxonomy',
			'related_taxonomy' => '',
			'related_custom_field' => '',
			'post_type' => 'post',
			'number_of_columns' => '1',
			'number_of_columns_tablet' => '1',
			'number_of_columns_mobile' => '1',
			'gap' => '30',
			'load_more_style' => 'load_more_button',
			'load_more_text' => __('Load More', 'mb_framework'),
			'items_per_page' => '10',
			/*'items_layout' => 'masonry',*/
			'posts_include' => '',
			'posts_exclude' => '',
			'parents_include' => '',
			'parents_exclude' => '',
			'authors_include' => '',
			'authors_exclude' => '',
			'post_types_include' => '',
			'orderby' => 'date',
			'meta_key' => '',
			'order' => 'DESC',
			'offset' => '',
			'sticky_posts' => '',
			'el_class' => '',
		);
		
		$att = shortcode_atts($fields, $atts, 'gusta_post_listing');
		extract($att);
		
		$post_type = ($post_type!='' ? $post_type : 'post');
		$exclude_tax = array ('nav_menu', 'post_format');
		$get_taxonomies = get_object_taxonomies( $post_type, 'objects' );
	
		foreach ($get_taxonomies as $taxonomy):
			if (!in_array($taxonomy->name, $exclude_tax)):
				$fields[$post_type.'_'.$taxonomy->name.'_include'] = '';
				$fields[$post_type.'_'.$taxonomy->name.'_exclude'] = '';
			endif;
		endforeach;
		
		$att = shortcode_atts($fields, $atts, 'gusta_post_listing');
		extract($att);
		
		if (isset($card_design) && $card_design!=''):
			if ($usage=='previous' || $usage=='next'):
				if ($usage=='previous'):
					$parent = get_previous_post();					
				else:
					$parent = get_next_post();
				endif;
				if ($parent):
					$post_id = $parent->ID;
					$output .= '<div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-next-previous">';
					$output .= do_shortcode(get_post_field('post_content', $card_design));
					$output .= '</div>';
				endif;
			else:
				
				wp_enqueue_script( 'salvattore' );
				wp_enqueue_script( 'loop' );
				wp_localize_script( 'loop', 'loop', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
				add_action( 'wp_footer', 'gusta_salvattore_print_script' );
				
				$pargs = array(
					'posts_per_page'   => $items_per_page,
					'offset'           => $offset,
					'orderby'          => $orderby,
					'order'            => $order,
					'post_status'      => 'publish'
				);
		
				/*if (get_query_var('orderby')!=''): $pargs["orderby"] = get_query_var('orderby'); endif;
				if (get_query_var('order')!=''): $pargs["order"] = get_query_var('order'); endif;*/
		
				if ($orderby=='meta_value' || $orderby=='meta_value_num'):
					$pargs["meta_key"] = $meta_key;
				endif;
		
				$tax_query = array();

				if ($usage != 'default'):
					if ($usage == 'related'):
						$pargs['post__not_in'] = array($parent->ID);
						if ($relation=='taxonomy'):
							$rel_terms = array();
							$terms = wp_get_post_terms( $parent->ID, $related_taxonomy );
							foreach ($terms as $term):
								$rel_terms[] = $term->term_id;
							endforeach;
							$tax_query[] =	array(
								'taxonomy' => $related_taxonomy,
								'terms'    => $rel_terms
							);
						elseif($relation=='custom_field'):
							if($related_custom_field!=''):
								$custom_field = get_post_meta($parent->ID, $related_custom_field, true );
								if ($related_custom_field && $custom_field):
									$pargs['meta_key'] = $related_custom_field;
									$pargs['meta_value'] = $custom_field;
								else:
									$pargs['meta_key'] = 'smart_sections_no_custom_field';
									$pargs['meta_value'] = 'smart_sections_no_custom_field';
								endif;
							endif;
						else:
							$custom_field = get_post_meta($parent->ID, $related_custom_field, true );
							if (!is_array($custom_field)): $custom_field = array($custom_field); endif;
							$pargs['post__in'] = $custom_field;
						endif;
						$pargs['post_type'] = $post_type;
					/*elseif (is_search()):
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
						$pargs['post_type'] = $post_type;*/
					endif;
				else:
					$pargs['post_type'] = $post_type;
				endif;

				if (isset($posts_include) && $posts_include!=""): $pargs['post__in'] = explode(",",$posts_include); endif;
				if (isset($posts_exclude) && $posts_exclude!=""): $pargs['post__not_in'] = explode(",",$posts_exclude); endif;

				if (isset($authors_include) && $authors_include!=""): $pargs['author__in'] = explode(",",$authors_include); endif;
				if (isset($authors_exclude) && $authors_exclude!=""): $pargs['author__not_in'] = explode(",",$authors_exclude); endif;

				if ($post_type=="page"):
					if (isset($parents_include) && $parents_include!=""): $pargs['post_parent__in'] = explode(",",$parents_include); endif;
					if (isset($parents_exclude) && $parents_exclude!=""): $pargs['post_parent__not_in'] = explode(",",$parents_exclude); endif;
				endif;


				//var_dump ($att);

				if ($usage == 'archive' && is_archive()):
					$current_term = get_queried_object();
					if (property_exists($current_term, 'taxonomy')):
						$tax_query[] =	array(
							'taxonomy' => $current_term->taxonomy,
							'field' => 'ID',
							'terms' => $current_term->term_id,
							'include_children' => false
						);
					endif;
				else:
	
					foreach ($get_taxonomies as $taxonomy):
						if (!in_array($taxonomy->name, $exclude_tax)):
							if (isset($att[$post_type.'_'.$taxonomy->name.'_include']) && $att[$post_type.'_'.$taxonomy->name.'_include']!=""):
								$tax_query[] =	array(
									'taxonomy' => $taxonomy->name,
									'terms'    => explode(",",$att[$post_type.'_'.$taxonomy->name.'_include'])
								);
							endif;
							if (isset($att[$post_type.'_'.$taxonomy->name.'_exclude']) && $att[$post_type.'_'.$taxonomy->name.'_exclude']!=""):
								$tax_query[] =	array(
									'taxonomy' => $taxonomy->name,
									'terms'    => explode(",",$att[$post_type.'_'.$taxonomy->name.'_exclude']),
									'operator' => 'NOT IN'
								);
							endif;
						endif;
					endforeach;
				endif;
	
				if ($tax_query): $tax_query = array_merge(array( 'relation' => 'AND' ), $tax_query); $pargs['tax_query'] = $tax_query; endif;

				$show_list = true;
			
				if ($sticky_posts=='only_sticky'):
					$pargs['post__in'] = get_option( 'sticky_posts' );
				elseif ($sticky_posts=='remove_sticky'):
					$pargs['post__not_in'] = array_merge(get_option( 'sticky_posts' ), $pargs['post__not_in']);
				else:
					$pargs['ignore_sticky_posts'] = true;
				endif;

				if ($show_list==true):
					$paged = 0;
					if ($load_more_style!="all"):
						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$pargs['paged'] = $paged;
					endif;

					if ($usage == 'archive'):
						global $wp_query;
						/*$query = $wp_query->query;
						$the_post_type = $query["post_type"];
						//if (!is_date() && $the_post_type!='wppf_property'):*/
						if (!is_date()):
							query_posts(array_merge($wp_query->query_vars, $pargs));
						endif;
						$the_query = $wp_query;
					else:
						$the_query = new WP_Query( $pargs );
					endif;
					$total = $the_query->found_posts;

					if ( $the_query->have_posts() ):
						$page = $paged + 1;
						if ($inline):
							$output .= '<div class="'.$vc_id.' ' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-post-listing-inline" data-usage="'.$usage.'" data-card_design="'.$card_design.'"><div class="gusta-inline-grid" style="grid-template-columns: repeat('.$number_of_columns.', 1fr); margin: 0 auto; display: grid; grid-auto-rows: auto; grid-column-gap: '.$gap.'px; grid-row-gap: '.$gap.'px;">';
						else:
							$output .= '<div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-post-listing" data-query_vars="'.base64_encode( rawurlencode( serialize($pargs))) .'" data-page="'.$page.'" data-total="'.$total.'" data-card_design="'.$card_design.'" data-tax="0"><div class="gusta-grid" data-columns>';
						endif;

						$i=0;
						while ( $the_query->have_posts() ):
							$the_query->the_post();
							$i++;
							$duration = $i * 100;
							$parent = $the_query->post;
							$post_id = $parent->ID;
							$GLOBALS['thepost'] = $post_id;
							if ( get_post_type($post_id) == 'product' && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
								global $product;
								if ( $product->is_visible() ):
									if ($inline):
										$output .= '<div class="post-listing-container-inner" id="gusta-post-'.$post_id.'" style="-webkit-animation-delay: '.$duration.'ms; animation-delay: '.$duration.'ms;">';
									else:
										$output .= '<div class="post-listing-container" id="gusta-post-'.$post_id.'" style="-webkit-animation-delay: '.$duration.'ms; animation-delay: '.$duration.'ms;">';
									endif;
									$inline = true;
									$output .= do_shortcode(get_post_field('post_content', $card_design));
									$inline = false;
									$output .= '</div>';
								endif;
							else:
								if ($inline):
									$output .= '<div class="post-listing-container-inner" id="gusta-post-'.$post_id.'" style="-webkit-animation-delay: '.$duration.'ms; animation-delay: '.$duration.'ms;">';
								else:
									$output .= '<div class="post-listing-container" id="gusta-post-'.$post_id.'" style="-webkit-animation-delay: '.$duration.'ms; animation-delay: '.$duration.'ms;">';
								endif;
								$inline = true;
								$output .= do_shortcode(get_post_field('post_content', $card_design));
								$inline = false;
								$output .='</div>';
							endif;
						endwhile;
						wp_reset_postdata();

						$output .= '</div>';

						if( current_user_can('editor') || current_user_can('administrator') ) :
							$output .= '<div class="edit-link edit-card-design" title="'.ucwords(__('Edit', 'mb_framework')).' Listing Card Design Template">
								<a href="'. admin_url('post.php?post='.$card_design.'&action=edit') .'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							</div>';
						endif;

						if ($items_per_page==''): $items_per_page = 10; endif;

						if ($total > $items_per_page && $inline!=true && $load_more_style!='all'):
							if ($usage!='archive'):
								$output .= '<div class="clear"></div><div class="gusta-load-more gusta-align-center"><button id="gusta-load-more-'.$vc_id.'" class="load-more-button btn">'.$load_more_text.'</button></div>';
							else:
								$output .= '<div class="gusta-posts-navigation gusta-load-more gusta-align-center"><p>'.get_posts_nav_link().'</p></div>';
							endif;
						endif;

						$output .= '</div>';
						//$output .= '<div class="gusta-no-results"></div>';
					else:
						//$output .= '<div id="'.$vc_id.'" class="gusta-no-posts">'.__('No posts found.', 'mb_framework').'</div>';
					endif;
					$parent = '';
					$inline = false;
				endif;
			endif;
		else:			
			$output .= '<p>'.__('Select Card Design.', 'mb_framework').'</p>';
		endif;
		
		wp_reset_query();
		return $output;
        
    }
    add_shortcode( 'gusta_post_listing', 'gusta_post_listing_html' );
 
    // Element Mapping
        global $post;
		
		$get_post_types = gusta_get_post_types();
		$taxes = array(__("Please Select...","mb_framework")=>'');
		$exclude_tax = array ('gusta_section_category', 'nav_menu', 'post_format');
		$get_taxonomies = get_taxonomies( array('public' => true), 'objects' );
		foreach ($get_taxonomies as $taxonomy):
			if (!in_array($taxonomy->name, $exclude_tax)):
				$taxes[$taxonomy->labels->name.' ('.$taxonomy->name.')'] = $taxonomy->name;
			endif;
		endforeach;
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
				'heading' => __( 'Post Listing Usage', 'mb_framework' ),
				'description' => __( 'If you want to list posts related to a single post, select "Related Posts". For dynamic loops such as search results or posts in a specific archive, select "Archives / Search Results". To query simply all posts, select "Default"', 'mb_framework' ),
				'param_name' => 'usage',
				'admin_label' => false,
				'value' => array(
					__('Default', 'mb_framework') 	=> 'default',
					__('Archives / Search Results', 'mb_framework') 	=> 'archive',
					__('Related Posts', 'mb_framework') 	=> 'related',
					__('Previous Post', 'mb_framework') 	=> 'previous',
					__('Next Post', 'mb_framework') 	=> 'next',
				),
				'std' => 'default'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Post Type', 'mb_framework' ),
				'description' => __( 'Select the post type to list.', 'mb_framework' ),
				'param_name' => 'post_type',
				'admin_label' => true,
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related') ),
				"value" => $get_post_types,
				'std' => 'post'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select Relation', 'mb_framework' ),
				'param_name' => 'relation',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-6',
				'value' => array(
					__('Taxonomy', 'mb_framework') 	=> 'taxonomy',
					__('Custom Field', 'mb_framework') 	=> 'custom_field',
					__('Relationship', 'mb_framework') 	=> 'relationship',
				),
				'dependency' => array( 'element' => 'usage', 'value' => array('related') ),
				'std' => 'taxonomy'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select Taxonomy', 'mb_framework' ),
				'param_name' => 'related_taxonomy',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-6',
				'value' => $taxes,
				'dependency' => array( 'element' => 'relation', 'value' => array('taxonomy') ),
				'std' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Enter Custom Field', 'mb_framework' ),
				'param_name' => 'related_custom_field',
				'value' => '',
				'dependency' => array( 'element' => 'relation', 'value' => array('custom_field','relationship') ),
				'edit_field_class' => 'vc_col-xs-6',
			),
		);

		$params[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Include Posts / Pages', 'mb_framework' ),
			'param_name'  => 'posts_include',
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
			'description' => __( "Enter comma separated post or page ID's to include (i.e. 5,12,25). Leave empty for all.", 'mb_framework' )
		);
		$params[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Exclude Posts / Pages', 'mb_framework' ),
			'param_name'  => 'posts_exclude',
			'edit_field_class' => 'vc_col-xs-6',
			'group'     => __( 'Data', 'mb_framework' ),
			'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
			'param_name'  => $post_type->name.'_'.$taxonomy->name.'_include',
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
			'param_name'  => $post_type->name.'_'.$taxonomy->name.'_exclude',
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
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
				'description' => __( 'Select gap between columns.', 'mb_framework' ),
			),
			/*array(
					'type' => 'dropdown',
					'heading' => __( 'Listing Items Layout', 'mb_framework' ),
					'param_name' => 'items_layout',
					'value' => array(
						'Masonry'   => 'masonry',
						'Grid'   => 'grid',
					),
					'edit_field_class' => 'vc_col-sm-6',
					'description' => '<a target="_blank" href="http://themegusta.ticksy.com">'.__( 'Learn more', 'mb_framework').'</a> '.__( 'about post listing layouts.', 'mb_framework' ),
					'std' => 'masonry',
				),*/
			array(
				'type' => 'dropdown',
				'heading' => __( 'Load More Style', 'mb_framework' ),
				'param_name' => 'load_more_style',
				'value' => array(
					__( 'Show all', 'mb_framework' ) => 'all',
					__( 'Load more button', 'mb_framework' ) => 'load_more_button',
					__( 'Load more on scroll', 'mb_framework' ) => 'scroll',
					/*__( 'Pagination', 'mb_framework' ) => 'pagination',*/
				),
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
				'description' => __( 'Select style for loading more posts.', 'mb_framework' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std' => 'load_more_button'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items on single load', 'mb_framework' ),
				'param_name' => 'items_per_page',
				'description' => __( 'Number of items to show per load.', 'mb_framework' ),
				'value' => '10',
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Load More Text', 'mb_framework' ),
				'param_name' => 'load_more_text',
				'admin_label' => true,
				'dependency' => array( 'element' => 'load_more_style', 'value' => array('load_more_button') ),
				'std' => __('Load More', 'mb_framework')
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
					__( 'Meta value', 'mb_framework' ) => 'meta_value',
					__( 'Meta value number', 'mb_framework' ) => 'meta_value_num',
					__( 'Random order', 'mb_framework' ) => 'rand',
				),
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Meta key', 'mb_framework' ),
				'param_name' => 'meta_key',
				'description' => __( 'Input meta key for ordering.', 'mb_framework' ),
				'group' => __( 'Data', 'mb_framework' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array('element' => 'orderby',	'value' => array('meta_value','meta_value_num')),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Offset', 'mb_framework' ),
				'param_name' => 'offset',
				'description' => __( 'Number of grid elements to displace or pass over.', 'mb_framework' ),
				'group' => __( 'Data', 'mb_framework' ),
				'dependency' => array( 'element' => 'usage', 'value' => array('default','related','archive') ),
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
			gusta_vc_id('post-listing'),
			gusta_vc_extra_class_name(),
		));

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Load More Button', 'mb_framework' ), 'el_slug' => 'load_more_button', 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1),
			array (	'sub_group' => __( 'Single Card Container', 'mb_framework' ), 'el_slug' => 'card_container', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Post Listing", "mb_framework"), // add a name
				"base" => "gusta_post_listing", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);