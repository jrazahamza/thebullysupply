<?php
/*
* Visual Composer Product Price Element & Shortcode
*
* @file           vc_elements/gusta_product_price.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.3.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Product Price
*/

// Element HTML
    function gusta_product_price_html( $atts ) {
		global $parent, $product;
		$the_post = $parent;
		if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'ex_tax_label'       => false,
		        'decimal_separator'  => '.',
		        'thousand_separator' => ',',
		        'decimals'           => '2',
		        'price_format'       => '%1$s&nbsp;%2$s',
			'element_tag' => 'p',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'visibility' => 'show-show',
			'animation' => 'fade',
			'el_class' => '',
		), $atts, 'gusta_post_custom_field');
		extract($att);
		
		if ($the_post):
			if (!$product): $product = wc_get_product($the_post->ID); endif;
			if ($product):
		        $price = $product->get_price(); // Get the active price
		        $regular_price = $product->get_regular_price(); // Get the regular price
		        $sale_price = $product->get_sale_price(); // Get the sale price
			else:
				$price = $regular_price = $sale_price = '';
			endif;
		endif;
		
		if ($price || $regular_price):
			$mobile_disp = gusta_mobile_display($att);
			
			$args = array(
		            'ex_tax_label'       => $ex_tax_label,
		            'currency'           => get_woocommerce_currency(),
		            'decimal_separator'  => $decimal_separator,
		            'thousand_separator' => $thousand_separator,
		            'decimals'           => intval($decimals),
		            'price_format'       => $price_format,
		        );
			
			$el_class .= ' '.$visibility;
			if (isset($animation) && $animation!=''): $el_class .= ' ani-'.$animation.''; endif;
		
			$output = '<div class="gusta-post-meta gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><'.$element_tag.' class="'.$vc_id.' gusta-product-price ss-element '.$el_class.'">';
			
			if( ! empty( $sale_price ) && $sale_price != 0 && $sale_price < $regular_price ):
            			$output .= "<del>" . wc_price( $regular_price, $args ) . "</del> <ins>" . wc_price( $sale_price, $args ) . "</ins>"; // Sale price is set
       			else:
            			$output .= "<ins>" . wc_price( $price, $args ) . "</ins>";
			endif;
			
			$output .= '</'.$element_tag.'></div>';
			
			$output .= gusta_clear($att);
		endif;
		
		return $output;
        
    }
    add_shortcode( 'gusta_product_price', 'gusta_product_price_html' );
	
	// Element Mapping
        global $post;
		
		$params = array (
			gusta_vc_id('product-price'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Show Tax Label', 'mb_framework' ),
				'param_name' => 'ex_tax_label',
				'admin_label' => false,
				'value' => array(
					__('No', 'mb_framework') 	=> false,
					__('Yes', 'mb_framework') 	=> true
				),
				'std' => false
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Decimal Separator', 'mb_framework' ),
				'param_name' => 'decimal_separator',
				'admin_label' => false,
				'std' => '.'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Thousand Separator', 'mb_framework' ),
				'param_name' => 'thousand_separator',
				'admin_label' => false,
				'std' => ','
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Decimals', 'mb_framework' ),
				'param_name' => 'decimals',
				'admin_label' => false,
				'value' => array(
					__('0', 'mb_framework') 	=> '0',
					__('1', 'mb_framework') 	=> '1',
					__('2', 'mb_framework') 	=> '2',
					__('3', 'mb_framework') 	=> '3',
					__('4', 'mb_framework') 	=> '4',
					__('5', 'mb_framework') 	=> '5',
				),
				'std' => '2'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Price Format', 'mb_framework' ),
				'param_name' => 'price_format',
				'admin_label' => false,
				'value' => array(
					__('Currency Price', 'mb_framework') 	=> '%1$s&nbsp;%2$s',
					__('CurrencyPrice', 'mb_framework') 	=> '%1$s%2$s',
					__('Price Currency', 'mb_framework') 	=> '%2$s&nbsp;%1$s',
					__('PriceCurrency', 'mb_framework') 	=> '%2$s%1$s',
				),
				'std' => '%1$s&nbsp;%2$s'
			),
		);
		
		$params = gusta_element_display($params);
		$params = gusta_visibility_hover_animation($params);
		$params[] = gusta_vc_extra_class_name();

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Sale Price / Price', 'mb_framework' ), 'el_slug' => 'sale_price', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Regular Price', 'mb_framework' ), 'el_slug' => 'regular_price', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Price", "mb_framework"), // add a name
				"base" => "gusta_product_price", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);
		unset($params);