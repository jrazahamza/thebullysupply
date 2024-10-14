<?php
/*
* Smart Sections Product Upsells Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_upsells.php
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
Element Description: Gusta Product Upsells
*/

    // Element HTML
    function gusta_product_upsells_html( $atts ) {
		global $product;

		$fields = array(
			'vc_id' => '',
			'card_design' => '',
			'number_of_columns' => '1',
			'number_of_columns_tablet' => '1',
			'number_of_columns_mobile' => '1',
			'gap' => '30',
			'limit' => '-1',
			'orderby' => 'rand',
			'order' => 'desc',
			'el_class' => '',
		);
		
		$att = shortcode_atts($fields, $atts, 'gusta_wc_product_upsells');
		extract($att);

		$columns = $number_of_columns;

		wp_enqueue_script( 'salvattore' );
		wp_enqueue_script( 'loop' );
		wp_localize_script( 'loop', 'loop', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		add_action( 'wp_footer', 'gusta_salvattore_print_script' );

		// Handle the legacy filter which controlled posts per page etc.
		$args = apply_filters(
			'woocommerce_upsell_display_args',
			array(
				'posts_per_page' => $limit,
				'orderby'        => $orderby,
				'order'          => $order,
				'columns'        => $columns,
			)
		);
		/*wc_set_loop_prop( 'name', 'up-sells' );
		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );

		$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
		$order   = apply_filters( 'woocommerce_upsells_order', isset( $args['order'] ) ? $args['order'] : $order );
		$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );*/

		// Get visible upsells then sort them at random, then limit result set.
		$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
		$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

		echo '<div id="'.$vc_id.'" class="' . esc_attr( $el_class ) .' card-'.$card_design.' ss-element gusta-post-listing" data-query-vars="" data-page="2" data-total="10" data-card_design="'.$card_design.'" data-tax="0"><div class="gusta-grid" data-columns>'; ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_id = $upsell->get_id();
				$post_object = get_post( $post_id );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				$parent = $upsell;
				
				echo '<div class="post-listing-container" id="gusta-post-'.$post_id.'">';

				echo do_shortcode(get_post_field('post_content', $card_design));

				echo '</div>';
				
				/*wc_get_template_part( 'content', 'product' );*/
				?>

			<?php endforeach; ?>

		</div></div>

		<?php wp_reset_postdata();

		$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
    }


	add_shortcode( 'gusta_wc_product_upsells', 'gusta_product_upsells_html' );



		$params = array (
			gusta_vc_id('product-upsells'),
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
				'edit_field_class' => 'vc_col-sm-6',
				'std' => '30',
				'description' => __( 'Select gap between columns.', 'mb_framework' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Total Items', 'mb_framework' ),
				'param_name' => 'limit',
				'description' => __( 'Number of items to show on page load (-1 for all).', 'mb_framework' ),
				'value' => '-1',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'mb_framework' ),
				'param_name' => 'orderby',
				'value' => array(
					__( 'Random', 'mb_framework' ) => 'rand',
					__( 'Title', 'mb_framework' ) => 'title',
					__( 'ID', 'mb_framework' ) => 'ID',
					__( 'Date', 'mb_framework' ) => 'date',
					__( 'Last modified date', 'mb_framework' ) => 'modified',
					__( 'Menu order', 'mb_framework' ) => 'menu_order',
					__( 'Price', 'mb_framework' ) => 'price',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sort order', 'mb_framework' ),
				'param_name' => 'order',
				'value' => array(
					__( 'Descending', 'mb_framework' ) => 'desc',
					__( 'Ascending', 'mb_framework' ) => 'asc',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			gusta_vc_extra_class_name(),
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Single Card Container', 'mb_framework' ), 'el_slug' => 'card_container', 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Upsells", "mb_framework"), // add a name
				"base" => "gusta_wc_product_upsells", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);