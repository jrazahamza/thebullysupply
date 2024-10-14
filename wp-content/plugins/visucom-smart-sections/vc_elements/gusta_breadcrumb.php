<?php
/*
* Visual Composer Breadcrumb Element & Shortcode
*
* @file           vc_elements/gusta_breadcrumb.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Element HTML
    function gusta_breadcrumb_html( $atts ) {
        $css = $el_class = $output = ''; unset ($dynamic_css);
		global $wp_query;
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'styles' => '',
			'alignment' => 'left',
			'home_text' => __('Home', 'mb_framework'),
			'separator' => 'slash',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'custom_array' => '',
			'hide_at_home' => '1',
			'show_category' => '1',
			'show_parent' => '1',
			'show_shop_page_link' => '1',
			'show_product_category' => '1',
			'first_link' => '',
			'second_link_checkbox' => '',
			'second_link' => '',
			'third_link_checkbox' => '',
			'third_link' => '',
			'fourth_link_checkbox' => '',
			'fourth_link' => '',
			'el_class' => ''
		), $atts, 'gusta_breadcrumb');
		extract($att);
		
		$post_id = $wp_query->queried_object_id;
		
		$mobile_disp = gusta_mobile_display($att);
		
		if ($custom_array=='add_custom_array'):
			$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><ol id="'.$vc_id.'" class="ss-element gusta-breadcrumb '.$el_class.' '.$separator.'">';
		
			$first_link = ($first_link ? '<li>'.gusta_serialize_link($first_link).'</li>' : '' );
			$second_link = ($second_link && $first_link ? '<li>'.gusta_serialize_link($second_link).'</li>' : '' );
			$third_link = ($third_link && $second_link && $first_link ? '<li>'.gusta_serialize_link($third_link).'</li>' : '' );
			$fourth_link = ($fourth_link && $third_link && $second_link && $first_link ? '<li>'.gusta_serialize_link($fourth_link).'</li>' : '' );

			$output .= $first_link.$second_link.$third_link.$fourth_link;
			if (is_front_page()):
				$output .= '<li class="active">'.$home_text.'</li>';
			else:
				$output .= '<li class="active">'.get_the_title($post_id).'</li>';
			endif;
		
			$output .= '</ol></div>';
			if (is_front_page($post_id)):
				if ($hide_at_home):
					$output = '';
				endif;
			endif;
	
		else:
			$shop_page = $woocommerce_page = false;
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins')))):
				if (is_woocommerce()):
					$woocommerce_page = true;
				endif;
				if(is_shop()):
					$shop_page = true;
				endif;
			endif;
		
			if (is_front_page($post_id)):
				if (!$hide_at_home):
					$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><ol id="'.$vc_id.'" class="ss-element gusta-breadcrumb '.$el_class.' '.$separator.'">';
					$output .= '<li class="active">'.$home_text.'</li>';
					$output .= '</ol></div>';
				endif;
			else:
				$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><ol id="'.$vc_id.'" class="ss-element gusta-breadcrumb '.$el_class.' '.$separator.'">';
				$output .= '<li><a href="'.home_url().'">'.$home_text.'</a></li>';
				
				if ($woocommerce_page):
					if ($shop_page):
						$output .= '<li class="active">'.woocommerce_page_title( false ).'</li>';
					else:
						if ($show_shop_page_link!=''):
							$output .= '<li><a href="'.wc_get_page_permalink( 'shop' ).'">'.get_the_title( get_option( 'woocommerce_shop_page_id' ) ).'</a></li>';
						endif;
						if (is_product()):
							if ($show_product_category):
								$term_list = wp_get_post_terms(get_the_id(),'product_cat',array('fields'=>'ids'));
								if (count($term_list)>0):
									$cat_id = (int)$term_list[0];
									$term = get_term( $cat_id );
									$term_name = $term->name;
									$output .= '<li><a href="'.get_term_link ($cat_id, 'product_cat').'">'.$term_name.'</a></li>';
								endif;
							endif;
							$output .= '<li class="active">'.get_the_title($post_id).'</li>';
						else:
							$output .= '<li class="active">'.woocommerce_page_title( false ).'</li>';
						endif;
					endif;
				elseif (is_page($post_id)):
					if ($show_parent):
						$parent = wp_get_post_parent_id( $post_id );
						if ($parent):
							$output .= '<li><a href="'.get_permalink($parent).'">'.get_the_title($parent).'</a></li>';
						endif;
					endif;
				elseif (is_archive($post_id)):
					if ($show_category):
						$term = get_term($post_id);
						if ($term->parent!=0):
							$parent = get_term($term->parent);
							$output .= '<li><a href="'.get_category_link( $term->parent ).'">'.$parent->name.'</a></li>';
						endif;
					endif;
				elseif (is_single($post_id)):
					if ($show_category):
						$category = wp_get_post_categories($post_id); 
						if ($category):
							$cat = get_category($category[0]);
							$output .= '<li><a href="'.get_category_link( $cat->term_id ).'">'.$cat->name.'</a></li>';
						endif;
					endif;
				endif;
				if (is_search()):
					$output .= '<li class="active">'.__('Search').'</li>';
				elseif (is_archive($post_id) && !$woocommerce_page):
					$output .= '<li class="active">'.single_term_title( '', false ).'</li>';
				elseif(!$woocommerce_page):
					$output .= '<li class="active">'.get_the_title($post_id).'</li>';
				endif;
				$output .= '</ol></div>';
			endif;

		endif;
	
		$output .= gusta_clear($att);
	
		return $output;
         
    }

    add_shortcode('gusta_breadcrumb', 'gusta_breadcrumb_html');

    // Element Mapping

        global $post;

		$params = array(
					
			gusta_vc_id('breadcrumb'),
			array(
				'type' => 'textfield',
				'heading' => __( 'Home Text', 'mb_framework' ),
				'param_name' => 'home_text',
				"std" => 'Home'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Separator', 'mb_framework' ),
				'param_name' => 'separator',
				"value" => array(
					'> (Greater Sign)' => 'greater-sign',
					'→ (Arrow)' => 'arrow',
					'» (Angle Quotation Mark, Right)' => 'angle-quotation-right',
					'• (Dot)' => 'dot',
					'► (Triangle)' => 'triangle',
					'/ (Slash)' => 'slash',
					'| (Vertical Bar)'	=> 'vertical-bar',
				),
				"std" => array ( '0' => 'slash' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Hide Breadcrumb at Home Page', 'mb_framework' ),
				'param_name' => 'hide_at_home',
				"value" => array(
					'Yes'   => '1',
				),
				'std' => '1'
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show First Category as Parent (in Posts)', 'mb_framework' ),
				'param_name' => 'show_category',
				"value" => array(
					'Yes'   => '1',
				),
				'std' => '1'
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show Parent (in Pages)', 'mb_framework' ),
				'param_name' => 'show_parent',
				"value" => array(
					'Yes'   => '1',
				),
				'std' => '1'
			)
		);

		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins')))):
			$params[] = array(
				'type' => 'checkbox',
				'heading' => __( 'Show Shop Page Link (in Products & Product Categories)', 'mb_framework' ),
				'param_name' => 'show_shop_page_link',
				'edit_field_class' => 'vc_col-xs-6',
				"value" => array(
					'Yes'   => '1',
				),
				'std' => '1'
			);
			$params[] = array(
				'type' => 'checkbox',
				'heading' => __( 'Show Product Category (in Products)', 'mb_framework' ),
				'param_name' => 'show_product_category',
				'edit_field_class' => 'vc_col-xs-6',
				"value" => array(
					'Yes'   => '1',
				),
				'std' => '1'
			);
		endif;

		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Create a Custom Array?', 'mb_framework' ),
			'param_name' => 'custom_array',
			'admin_label' => true,
			'description' => __( 'If you select this option, you can set a custom link hierarchy. Do not forget that the current page will be automatically displayed at the end of the list.', 'mb_framework' ),
			"value" => array(
				'Yes'   => 'add_custom_array',
			),
			'std' => ''
		);
		$params[] = array(
			'type' => 'vc_link',
			'heading' => __( 'First Link', 'mb_framework' ),
			'param_name' => 'first_link',
			"dependency" => array(
				"element" => "custom_array",
				"value" => "add_custom_array"
			),
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Second Link?', 'mb_framework' ),
			'param_name' => 'second_link_checkbox',
			"value" => array(
				'Yes'   => 'add_second_link',
			),
			"dependency" => array(
				"element" => "custom_array",
				"value" => "add_custom_array"
			)
		);
		$params[] = array(
			'type' => 'vc_link',
			'heading' => __( 'Second Link', 'mb_framework' ),
			'param_name' => 'second_link',
			"dependency" => array(
				"element" => "second_link_checkbox",
				"value" => "add_second_link"
			),
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Third Link?', 'mb_framework' ),
			'param_name' => 'third_link_checkbox',
			"value" => array(
				'Yes'   => 'add_third_link',
			),
			"dependency" => array(
				"element" => "second_link_checkbox",
				"value" => "add_second_link"
			),
		);
		$params[] = array(
			'type' => 'vc_link',
			'heading' => __( 'Third Link', 'mb_framework' ),
			'param_name' => 'third_link',
			"dependency" => array(
				"element" => "third_link_checkbox",
				"value" => "add_third_link"
			),
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Fourth Link?', 'mb_framework' ),
			'param_name' => 'fourth_link_checkbox',
			"value" => array(
				'Yes'   => 'add_fourth_link',
			),
			"dependency" => array(
				"element" => "third_link_checkbox",
				"value" => "add_third_link"
			),
		);
		$params[] = array(
			'type' => 'vc_link',
			'heading' => __( 'Fourth Link', 'mb_framework' ),
			'param_name' => 'fourth_link',
			"dependency" => array(
				"element" => "fourth_link_checkbox",
				"value" => "add_fourth_link"
			),
		);
		
		$params = gusta_element_display($params);
		$params[] = gusta_vc_extra_class_name();
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Links', 'mb_framework' ), 'el_slug' => 'links', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 )
		));
		
	
		// Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Breadcrumb", "mb_framework"), // add a name
				"base" => "gusta_breadcrumb", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        ); 

        unset($params);