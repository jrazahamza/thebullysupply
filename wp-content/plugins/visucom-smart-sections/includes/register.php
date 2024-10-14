<?php
/*
* Register Section Post Type and Taxonomy
* 
*
* @file           admin/register.php
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

/* Register "Smart Section" Custom Post Type */
if(!function_exists('gusta_sections_register')):
	function gusta_sections_register() {
	 	if (is_admin()):
			$labels = array(
				'name' => __('Smart Sections', "mb_framework"),
				'singular_name' => __('Section', "mb_framework"),
				'add_new' => __('Add New', "mb_framework"),
				'add_new_item' => __('Add New Section', "mb_framework"),
				'edit_item' => __('Edit Section', "mb_framework"),
				'new_item' => __('New Section', "mb_framework"),
				'view_item' => __('View Section', "mb_framework"),
				'search_items' => __('Search Sections', "mb_framework"),
				'not_found' =>  __('Nothing found', "mb_framework"),
				'not_found_in_trash' => __('Nothing found in Trash', "mb_framework"),
				'parent_item_colon' => ''
			);
		 
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'query_var' => false,
				'menu_icon' => SMART_SECTIONS_PLUGIN_URL . 'assets/admin/img/smart-sections-adminmenu-icon.png',
				'exclude_from_search' => true,
				'show_in_nav_menus' => false,
				'rewrite' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 20,
				'supports' => array('title','editor','revisions','custom-fields')
			); 
		 
			register_post_type( 'gusta_section' , $args );
		
			$labels = array(
				'name'              => __( 'Categories', 'mb_framework' ),
				'singular_name'     => __( 'Category', 'mb_framework' ),
				'search_items'      => __( 'Search Categories', 'mb_framework' ),
				'all_items'         => __( 'All Categories', 'mb_framework' ),
				'parent_item'       => __( 'Parent Category', 'mb_framework' ),
				'parent_item_colon' => __( 'Parent Category:', 'mb_framework' ),
				'edit_item'         => __( 'Edit Category', 'mb_framework' ),
				'update_item'       => __( 'Update Category', 'mb_framework' ),
				'add_new_item'      => __( 'Add New Category', 'mb_framework' ),
				'new_item_name'     => __( 'New Category Name', 'mb_framework' ),
				'menu_name'         => __( 'Categories', 'mb_framework' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'gusta_section_category' ),
			);

			register_taxonomy( 'gusta_section_category', array( 'gusta_section' ), $args );
		endif;
	}
	add_action('init', 'gusta_sections_register');
endif;

/* Smart Section Columns */

add_filter( 'manage_edit-gusta_section_columns', 'gusta_section_columns' ) ;

function gusta_section_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title', 'mb_framework' ),
		'category' => __( 'Categories', 'mb_framework' ),
		'purpose' => __( 'Purpose', 'mb_framework' ),
		'preview' => __( 'Preview Image', 'mb_framework' ),
	);

	return $columns;
}

add_action('manage_posts_custom_column',  'gusta_show_section_columns');
function gusta_show_section_columns($name) {
    global $post;
    $purpose_name = '';
    switch ($name) {
		case 'title':		
			echo get_the_title();
			break;
		case 'purpose':
			$purpose = get_post_meta($post->ID, 'gusta_section_purpose', true);
			switch ($purpose) {
				case 'header':
					$purpose_name = __('Header', 'mb_framework');
					break;
				case 'footer':
					$purpose_name = __('Footer', 'mb_framework');
					break;
				case 'content':
					$purpose_name = __('Content Template', 'mb_framework');
					break;
				case 'mega_menu':
					$purpose_name = __('Mega Menu', 'mb_framework');
					break;
				case 'sticky':
					$purpose_name = __('Sticky Section', 'mb_framework');
					break;
				case 'sidebar':
					$purpose_name = __('Sidebar Widget', 'mb_framework');
					break;
				case 'vertical':
					$purpose_name = __('Vertical Header', 'mb_framework');
					break;
				case 'card':
					$purpose_name = __('Listing Card Template', 'mb_framework');
					break;
			}
			echo $purpose_name;
			break;
		case 'preview':
			$image_id = get_post_meta($post->ID, 'preview_image', true);
			$image = wp_get_attachment_image_src( $image_id, 'large', false );
			if (isset($image[0])):
				$img_url = $image[0];
				echo '<img src="'.$img_url.'" />';
			endif;
			break;
		case 'category':
			$terms = get_the_terms( get_the_ID(), 'gusta_section_category' );
			if ( $terms && ! is_wp_error( $terms ) ) : 
				foreach ( $terms as $term ):
					echo '<a href="'.site_url().'/wp-admin/edit.php?s&post_type=gusta_section&action=-1&gusta_section_category='.$term->term_id.'">'.$term->name.'</a><br>';
				endforeach;
			endif;
			break;
    }
}



add_action('restrict_manage_posts', 'gusta_filter_section_by_category');
function gusta_filter_section_by_category() {
	global $typenow;
	$post_type = 'gusta_section'; 
	$taxonomy  = 'gusta_section_category'; 
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

add_filter('parse_query', 'gusta_convert_id_to_term_in_query');
function gusta_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'gusta_section'; 
	$taxonomy  = 'gusta_section_category'; 
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}



/* Remove Date Filter */
add_filter('months_dropdown_results', '__return_empty_array');

/* Filter by Purpose */
add_action('restrict_manage_posts' ,'gusta_purpose_filter_dropdown');

function gusta_purpose_filter_dropdown($post_type) {
  global $wpdb;
  if ( $post_type == 'gusta_section' ) {
	
	$purpose = '';
	if (isset($_GET['gusta_section_purpose'])): $purpose = $_GET['gusta_section_purpose']; endif;
	$selected = ' selected="selected"';
	
    $options[] = sprintf('<option value="">%1$s</option>', __('All Purposes', 'mb_framework'));
    $options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'content', __('Content Templates', 'mb_framework'), ($purpose=='content' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'header', __('Headers', 'mb_framework'), ($purpose=='header' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'mega_menu', __('Mega Menus', 'mb_framework'), ($purpose=='mega_menu' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'footer', __('Footers', 'mb_framework'), ($purpose=='footer' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'sticky', __('Sticky Sections', 'mb_framework'), ($purpose=='sticky' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'sidebar', __('Sidebar Widgets', 'mb_framework'), ($purpose=='sidebar' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'vertical', __('Vertical Headers', 'mb_framework'), ($purpose=='vertical' ? $selected : ''));
	$options[] = sprintf('<option value="%1$s"%3$s>%2$s</option>', 'card', __('Listing Card Templates', 'mb_framework'), ($purpose=='card' ? $selected : ''));

    /** Output the dropdown menu */
    echo '<select class="" id="gusta_section_purpose" class="gusta_section_purpose" name="gusta_section_purpose">';
    echo join("\n", $options);
    echo '</select>';

  }
}

add_filter( 'parse_query', 'gusta_purpose_filter' );
function gusta_purpose_filter( $query ){
    global $pagenow;
    
    if ( isset($_GET['gusta_section_purpose']) && $_GET['post_type'] == 'gusta_section' && is_admin() && $pagenow=='edit.php' && isset($_GET['gusta_section_purpose']) && $_GET['gusta_section_purpose'] != '') {
        $query->query_vars['meta_key'] = 'gusta_section_purpose';
        $query->query_vars['meta_value'] = esc_attr($_GET['gusta_section_purpose']);
    }
}
?>