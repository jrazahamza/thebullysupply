<?php
/*
* Ajax Load More
*
* @file           includes/load-more.php
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

/* Load More Posts Query Action */
if ( !function_exists( 'gusta_ajax_load_more' ) ):
	function gusta_ajax_load_more() {
		$query_vars = (isset($_POST['query_vars']) ? unserialize( rawurldecode( base64_decode( strip_tags( $_POST['query_vars'])))) : '');
		$page = (isset($_POST['page']) ? strip_tags($_POST['page']) : 2);
		$items = (isset($_POST['items']) ? strip_tags($_POST['items']) : 10);
		$offset = (isset($_POST['offset']) ? strip_tags($_POST['offset']) : 0);
		$usage = (isset($_POST['usage']) ? strip_tags($_POST['usage']) : 'default');
		$card_design = (isset($_POST['card_design']) ? strip_tags($_POST['card_design']) : 0);
		$query_vars["paged"] = $page;
		$query_vars["offset"] = (( $page - 1 ) * $items ) + $offset;
		
		$tax_ids = (isset($_POST['tax_id']) ? strip_tags($_POST['tax_id']) : false);
		if ($tax_ids):

			$tax_query = array();
			
			$tax_each = explode(',', $tax_ids);
			
			foreach ($tax_each as $tax_id):
				if ($tax_id):
					$tax_ex = explode ('-', $tax_id);
					$taxonomy_id = end($tax_ex);
					$taxonomy = str_replace('-'.$taxonomy_id, '', $tax_id);

					if ($taxonomy_id):
			
						$tax_query[] =	array(
							'taxonomy' => $taxonomy,
							'field' => 'term_id',
							'terms'    => $taxonomy_id
						);
						
					endif;
				endif;
			endforeach;
				
			if ($tax_query): 
				if (array_key_exists('tax_query', $query_vars)):
					$query_vars['tax_query'] = array_merge($query_vars['tax_query'], $tax_query); 
				else:
					$tax_query = array_merge(array( 'relation' => 'AND' ), $tax_query); 
					$query_vars['tax_query'] = $tax_query; 
				endif;
			endif;
		
		endif;

		if ($usage == 'archive'):
			global $wp_query;
			if (!isset($current_term)): $current_term = (object) array(); endif;
			if (!is_object($current_term)): $current_term = (object) array(); endif;
			if (property_exists($current_term, "term_id") || is_search()):
				if (!is_date()):
					query_posts(array_merge($wp_query->query_vars, $query_vars));
				endif;
				$the_query = $wp_query;
			else:
				$que = (object) $wp_query->query;
				if (property_exists($que, "post_type")):
					$pargs['post_type'] = $que->post_type;
					$usage = 'default';
				endif;
				$the_query = new WP_Query( $query_vars );
			endif;
		else:
			$the_query = new WP_Query( $query_vars );
		endif;

		/*echo '<div class="post-listing-container">';
		print_r($the_query);
		echo '</div>';*/
		
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				global $parent, $inline;
				$parent = $the_query->post;
				$inline = true;
				WPBMap::addAllMappedShortcodes();
				echo '<div class="post-listing-container">'.do_shortcode(get_post_field('post_content', $card_design)).'</div>';
			}
			wp_reset_postdata();
			$inline = false;
		}
		echo '<div class="gusta-found-posts">'.$the_query->found_posts.'</div>';
		wp_die();
	}
	add_action( 'wp_ajax_gusta_ajax_load_more', 'gusta_ajax_load_more' );
	add_action( 'wp_ajax_nopriv_gusta_ajax_load_more', 'gusta_ajax_load_more' );
endif;
?>