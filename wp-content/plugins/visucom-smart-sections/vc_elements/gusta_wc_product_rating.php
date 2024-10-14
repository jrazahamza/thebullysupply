<?php
/*
* Smart Sections Product Rating Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_rating.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2020 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.4
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Product Rating
*/

     /* Vidualize Rating */
	function gusta_visualize_rating ($rating) {
		for ($i=0; $i<5; $i++):
			echo '<em class="fa ';
			if ($rating>$i):
				$star = 'fa-star-o';
				if($rating>$i+0.24):
					$star = 'fa-star-half-alt';
				endif;
				if($rating>$i+0.74):
					$star = 'fa-star';
				endif;
			else:
				$star = 'fa-star-o';
			endif;
			echo $star;
			echo '"></em>';
		endfor;
	}

    // Element HTML
    function gusta_product_rating_html( $atts ) {
		ob_start();
		global $parent, $product;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'alignment' => 'left',
			'rating_view' => 'stars',
			'link_to_reviews' => 'false',
			'no_ratings_text' => __('No Ratings', 'mb_framework' ),
			'show_empty_stars' => 'false',
			'stars_position' => 'right',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_wc_product_rating');
		extract($att);
		
		if ($the_post):

			if (get_post_type($the_post)=='product'):
		
				$mobile_disp = gusta_mobile_display($att);
			
				echo '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'">';
			
				if ($link_to_reviews=='true'): 
					echo '<a class="'.$vc_id.' gusta-product-rating ss-element '.$el_class.'" href="'.get_permalink( $the_post->ID ).'#reviews">';
				else:
					echo '<div class="'.$vc_id.' gusta-product-rating ss-element '.$el_class.'">';
				endif;

				$rating = $product->get_average_rating();

				if ($rating!='0'):
					if ($rating_view=='stars'):
						gusta_visualize_rating ($rating);
					else:
						if(fmod($rating, 1) !== 0.00):
							echo number_format($rating, 2, '.', '');
						else:
							echo number_format($rating, 1, '.', '');
						endif;
					endif;
				else:
					if ($show_empty_stars=='true' && $stars_position=='left'):
						echo "<span class='gusta-no-reviews'>";
						gusta_visualize_rating (0);
						echo "</span>";
					endif;
					echo "<span class='gusta-no-reviews-text'>".$no_ratings_text."</span>";
					if ($show_empty_stars=='true' && $stars_position=='right'):
						echo "<span class='gusta-no-reviews'>";
						gusta_visualize_rating (0);
						echo "</span>";
					endif;
				endif;

				if ($link_to_reviews=='true'): echo '</a>'; else: echo '</div>'; endif;

				//echo gusta_visualize_rating (3.4);
			
				echo '</div>';
			
				echo gusta_clear($att);
				
			endif;
				
		endif;
		
		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_product_rating', 'gusta_product_rating_html' );



		$params = array (
			gusta_vc_id('product-rating'),
			array(
				'type'        => 'dropdown',
				'heading'     => __( "Rating View", 'mb_framework' ),
				'param_name'  => 'rating_view',
				'admin_label' => false,
				'value' => array (
					'Stars' => 'stars',
					'Number' => 'number',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( "Link to Reviews?", 'mb_framework' ),
				'param_name'  => 'link_to_reviews',
				'admin_label' => false,
				'value' => array (
					'No' => 'false',
					'Yes' => 'true',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( "No Ratings Text", 'mb_framework' ),
				'param_name'  => 'no_ratings_text',
				'admin_label' => false,
				'std' => __('No Ratings', 'mb_framework' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( "Show empty stars when there are no reviews?", 'mb_framework' ),
				'param_name'  => 'show_empty_stars',
				'admin_label' => false,
				'value' => array (
					'No' => 'false',
					'Yes' => 'true',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( "Empty Stars Position", 'mb_framework' ),
				'param_name'  => 'stars_position',
				'admin_label' => false,
				'value' => array (
					'Right' => 'right',
					'Left' => 'left',
				),
				'dependency' => array( 'element' => 'show_empty_stars', 'value' => array('true') ),
			),
		);
		
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Empty Stars', 'mb_framework' ), 'el_slug' => 'empty_stars', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'No Rating Text', 'mb_framework' ), 'el_slug' => 'no_rating_text', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Rating', 'mb_framework' ), 'el_slug' => 'rating', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Rating", "mb_framework"), // add a name
				"base" => "gusta_wc_product_rating", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);