<?php
/*
* Archive Functions
*
* @file           includes/archive.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Limit Words in Excerpt */
if (!function_exists( 'get_gusta_excerpt')):
	function get_gusta_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (get_the_excerpt()):
			if (count($excerpt)>=$limit):
				array_pop($excerpt);
				$excerpt = implode(" ",$excerpt).'...';
			else:
				$excerpt = implode(" ",$excerpt);
			endif;
			$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
			return $excerpt;
		endif;
	}
endif;

if (!function_exists( 'gusta_excerpt')):
	function gusta_excerpt($limit) {
		$excerpt = get_tG_excerpt($limit);
		if ($excerpt):
			echo '<p>'.$excerpt.'</p>';
		endif;
	}
endif;
?>