<?php
/*
* Toolbar Links
*
* @file           includes/toolbar.php
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

/*
* add a group of links under a parent link
*/
 
// Add a parent shortcut link
 
if ( !function_exists('gusta_toolbar_link') ):
	function gusta_toolbar_link($wp_admin_bar) {
		if (is_admin()):
		    $args = array(
		        'id' => 'smart-sections',
		        'title' => __('Smart Sections', 'mb_framework'),
				'href'   => esc_url( admin_url( 'edit.php?post_type=gusta_section' ) ),
		        'meta' => array(
		            'class' => 'smart-sections', 
		            'title' => __('List All Smart Sections', 'mb_framework')
		        )
		    );
			$wp_admin_bar->add_node($args);
			$args = array(
		        'id' => 'all-smart-sections',
		        'title' => __('Show All Sections', 'mb_framework'),
				'parent' => 'smart-sections', 
				'href'   => esc_url( admin_url( 'edit.php?post_type=gusta_section' ) ),
		        'meta' => array(
		            'class' => 'all-smart-sections', 
		            'title' => __('List All Smart Sections', 'mb_framework')
		        )
		    );
			$wp_admin_bar->add_node($args);
			$args = array(
		        'id' => 'add-smart-section',
		        'title' => __('Create New Section', 'mb_framework'),
				'parent' => 'smart-sections', 
				'href'   => esc_url( admin_url( 'post-new.php?post_type=gusta_section' ) ),
		        'meta' => array(
		            'class' => 'add-smart-section', 
		            'title' => __('Create New Smart Section', 'mb_framework')
		        )
		    );
			$wp_admin_bar->add_node($args);
			$args = array(
		        'id' => 'smart-sections-assign',
		        'title' => __('Assign Sections', 'mb_framework'),
				'parent' => 'smart-sections', 
				'href'   => esc_url( admin_url( 'edit.php?post_type=gusta_section&page=assign-smart-sections' ) ),
		        'meta' => array(
		            'class' => 'smart-sections-assign', 
		            'title' => __('Assign Smart Sections to the site in general', 'mb_framework')
		            )
		    );
		    $wp_admin_bar->add_node($args);
			
			$sections = array ('header','above_content','content','archive','below_content','footer','sticky');
			
			$gt=0;
			foreach ($sections as $section):
				$sec = get_gusta_option('gusta_'.$section.'_sections', gusta_get_template(), 'section');
				if ($sec):
					if ($gt==0):
						$gtmp = gusta_get_template();
						$gtmps = str_replace('_',' ',$gtmp);
						if ($gtmp=='all'):
							$assigned_title = __('Sections Assigned', 'mb_framework');
							$assigned_message = __('Edit the sections assigned to all pages.', 'mb_framework');
							$area_message = __('all pages.', 'mb_framework');
						else:
							$assigned_title = __('Sections Assigned to', 'mb_framework').' '.ucwords($gtmps);
							$assigned_message = __('Edit the sections assigned to this', 'mb_framework').' '.$gtmps;
							$area_message = __('this', 'mb_framework').' '.$gtmps;
						endif;
						$args = array(
							'id' => 'smart-sections-in-page',
							'title' => $assigned_title,
							'parent' => 'smart-sections', 
							'meta' => array(
								'class' => 'smart-sections-in-page', 
								'title' => $assigned_message
								)
						);
						$wp_admin_bar->add_node($args);
						$gt=1;
					endif;
					$word = ucwords(str_replace('_',' ',$section));
					$args = array(
						'id' => 'smart-sections'.$section.'-sections',
						'title' => $word.' '.__('Sections', 'mb_framework'),
						'parent' => 'smart-sections-in-page', 
						'meta' => array(
							'class' => 'smart-sections'.$section.'-sections', 
							'title' => __('Edit', 'mb_framework').' '.$word.' '.__('Sections assigned to', 'mb_framework').' '.$area_message
						)
					);
					$wp_admin_bar->add_node($args);
					foreach ($sec as $s):
						$title = get_the_title($s);
						$args = array(
							'id' => 'smart-sections-'.$s,
							'title' => $title, 
							'parent' => 'smart-sections'.$section.'-sections',
							'href'   => esc_url( admin_url( 'post.php?post='.$s.'&action=edit' ) ),
							'meta' => array(
								'class' => 'smart-sections-'.$s,
								'title' => __('Edit', 'mb_framework').' '.$title,
								'target' => '_blank'
							)
						);
						$wp_admin_bar->add_node($args);
					endforeach;
				endif;
			endforeach;
			
			$args = array(
		        'id' => 'smart-sections-font-manager',
		        'title' => __('Font Manager', 'mb_framework'),
				'parent' => 'smart-sections', 
				'href'   => esc_url( admin_url( 'edit.php?post_type=gusta_section&page=gusta-font-manager' ) ),
		        'meta' => array(
		            'class' => 'smart-sections', 
		            'title' => __('Smart Sections Font Manager', 'mb_framework')
		            )
		    );
		    $wp_admin_bar->add_node($args);
	 	endif;
	}
	 
	add_action('admin_bar_menu', 'gusta_toolbar_link', 100);
endif;
?>