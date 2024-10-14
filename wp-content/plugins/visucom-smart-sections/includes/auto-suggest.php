<?php
/*
* Auto Suggest
*
* @file           includes/auto-suggest.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.1.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Auto Suggest */
if(!function_exists('gusta_auto_suggest')):
	function gusta_auto_suggest() {
		$search_term = (isset($_POST['search_term']) ? strip_tags($_POST['search_term']) : '');
		$post_types = (isset($_POST['post_types']) ? strip_tags($_POST['post_types']) : '');
		$pt = explode(', ', $post_types);
		if ($search_term!=''):
			$auto_query = new WP_Query( array( 'post_type' => $pt, 's' => $search_term, 'post_status' => array('publish') ) );
			if ( $auto_query->have_posts() ):
				while ( $auto_query->have_posts() ): $auto_query->the_post();
					echo '<li class="result"><a href="'.get_permalink().'"><div class="search-image">'.get_the_post_thumbnail( get_the_ID(), 'thumbnail' ).'</div> <p>' . get_the_title() . '</p></a></li>';
				endwhile;
			endif;
			wp_reset_postdata();
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_gusta_auto_suggest', 'gusta_auto_suggest' );
	add_action( 'wp_ajax_nopriv_gusta_auto_suggest', 'gusta_auto_suggest' );
endif;
?>