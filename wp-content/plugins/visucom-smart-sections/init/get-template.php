<?php
/*
* Smart Sections Init
*
* @file           init/get-template.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

//Outputs the WP template file on the current page
if(!function_exists('gusta_get_template')):
	function gusta_get_template () { 
		if (is_404()): $template = '404';
		elseif ( is_author() ): $template = 'author';
		elseif ( is_date() ): $template = 'date';
		elseif ( is_category() ): $template = 'category';
		elseif ( is_tag() ): $template = 'post_tag';
		elseif ( is_tax() ): $term_id = get_queried_object()->term_id; $the_term = get_term($term_id); $template = $the_term->taxonomy;
		elseif ( is_search() ): $template = 'search';
		elseif ( is_singular() ): $template = get_post_type();
		elseif ( is_page() ): $template = 'page';
		  elseif ( is_post_type_archive() ): $template = get_post_type();
		else: $template = 'all';
		endif;
		if ( function_exists("is_shop") ): if(is_shop()): $template = 'shop'; endif; endif;
		
		return $template;
	}
endif;