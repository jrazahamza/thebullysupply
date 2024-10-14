<?php
/*
* Visual Composer Cart Icon Element & Shortcode
*
* @file           vc_elements/gusta_cart_icon.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.4
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Cart Icon
*/
 
// Element HTML
    function gusta_cart_icon_html( $atts ) {
        $css = $el_class = $output = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'cart_type' => 'simple-link',
			'show_cart_count' => 'show',
			'button_size' => '',
			'alignment' => 'right',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'cart_icon' => 'fontawesome',
			'cart_icon_fontawesome' => 'fa fa fa-shopping-cart',
			'cart_icon_openiconic' => 'vc-oi vc-oi-dial',
			'cart_icon_typicons' => 'typcn typcn-adjust-brightness',
			'cart_icon_entypo' => 'entypo-icon entypo-icon-note',
			'cart_icon_linecons' => 'vc_li vc_li-heart',
			'cart_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'cart_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'cart_icon_material' => 'vc-material vc-material-cake',
			'el_class' => ''
		), $atts, 'gusta_cart_icon');
		extract($att);
		
		vc_icon_element_fonts_enqueue( $cart_icon );

		$the_cart_icon = $att['cart_icon_'.$cart_icon];
								
		if ($button_size!=''): $button_size = ' gusta-'.$button_size; endif;
				
		$mobile_disp = gusta_mobile_display($att);
		
		$cart_count 	= is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0';
		$cart_url   	= is_object( WC()->cart ) ? WC()->cart->get_cart_url() : '#';
	        
		$output .= '<div class="gusta-cart-icon gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><button';
		if ($cart_type=="simple-link"):
			$output .= ' onclick="window.location.href=\''.$cart_url.'\'"';
		endif;
		$output .= ' id="'.$vc_id.'" class="' . esc_attr( $el_class ) . ' ss-element gusta-icon-link'.$button_size.'">';
		
		$icon_button = '<i class="'.$the_cart_icon.' gusta-icon"></i>';
		
		$output .= $icon_button;
		if ($show_cart_count=='show'):
			$output .= '<span class="gusta-cart-count">'.$cart_count.'</span>';
		endif;
		$output .= '</button><div class="gusta-update-cart" data-cart-type="'.$cart_type.'">';
		if ($cart_type=='dropdown'):
			$cart_total 	= WC()->cart->get_cart_total();
		        $checkout_url   = WC()->cart->get_checkout_url();
	
			$output .= '<div class="gusta-shopping-cart">';
	
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
	
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					$cart_item_class = esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) );
					$product_remove = apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ), esc_attr( $product_id ), esc_attr( $_product->get_sku() ) ), $cart_item_key );
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
	
					if ( ! $product_permalink ) {
						$product_image = wp_kses_post( $thumbnail );
						$item_name = wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
					} else {
						$product_image = sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
						$item_name = wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
					}
					
					// Meta data.
					//$output .=  wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
	
					// Backorder notification.
					$backorder = '';
					if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
						$backorder =  wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
					}
	
	
					$item_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							
						
							
					if ( $_product->is_sold_individually() ) {
						$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
					} else {
						$product_quantity = woocommerce_quantity_input( array('input_name'   => "cart[{$cart_item_key}][qty]", 'input_value'  => $cart_item['quantity'], 'max_value'    => $_product->get_max_purchase_quantity(), 'min_value'    => '0', 'product_name' => $_product->get_name(), ), $_product, false );
					}
	
					$product_quantity = apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
					$product_quantity = $cart_item['quantity'];
	
					$subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
	
					$output .= '<div class="gusta-cart-item">
						<div class="gusta-product-thumbnail">'.$product_image.'</div>
						<div class="gusta-product-details-in-cart">
						<div class="gusta-product-name">'.$item_name.'</div>
						<div class="gusta-product-price">'.$item_price.'</div>
						<div class="gusta-product-quantity">'.$product_quantity.'</div>
						<div class="gusta-product-subtotal">'.$subtotal.'</div>
						</div>
					</div>';	
	
				}
			}
	
	
			//$output .= do_action( 'woocommerce_cart_collaterals' );
			
			$output .= '<div class="gusta-cart-total">
				<span class="gusta-sub-total-label">'.__('Sub-total', 'mb_framework').'</span>
				<span class="gusta-sub-total">'.$cart_total.'</span></div>';
			

			
			$output .= '<a class="gusta-view-cart-button" href="'.$cart_url.'" title="'.__('View Cart','mb_framework').'">'.__('View Cart','mb_framework').'</a>';
			
			if ( sizeof( WC()->cart->cart_contents) > 0 ) :
				$output .= '<a class="gusta-checkout-button gusta-icon-link" href="' . $checkout_url . '" title="' . __( 'Checkout', 'mb_framework' ) . '">' . __( 'Checkout', 'mb_framework' ) . '</a>';
			endif;
			
			//$output .= do_shortcode('[woocommerce_cart]');
			$output .= '</div>';
			
		endif;
		
		$output .= '</div></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
         
    }

    add_shortcode('gusta_cart_icon', 'gusta_cart_icon_html');

    // Element Mapping
    	
		$params = array();
		
		$params[] = gusta_vc_id('cart-icon');
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Cart Type', 'mb_framework' ),
			'param_name' => 'cart_type',
			'weight' => 0,
			'admin_label' => true,
			'value' => array(
				'Simple Link' => 'simple-link',
				'Dropdown' => 'dropdown'
			),
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Show Cart Count?', 'mb_framework' ),
			'param_name' => 'show_cart_count',
			'admin_label' => false,
			'dependency' => 0,
			'value' => array(
				__('Show', 'mb_framework')   => 'show',
				__('Hide', 'mb_framework')   => 'hide',
			),
			'std' => 'show',
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Button Size', 'mb_framework' ),
			'param_name' => 'button_size',
			'value' => array(
				'Medium' => '',
				'Small' => 'small',
				'Big' => 'big'
			),
			'std' => ''
		);
		$params = gusta_element_display($params, 'right');
		$params = gusta_add_icon_field ( $params, array (
			'heading' => __('Cart Icon', 'mb_framework'), 
			'param_name' => 'cart_icon', 
			'dependency' => 0,
			'std' => 'fa fa-shopping-cart',
			'group' => __('Icon', 'mb_framework'), 
			'enable_hover' => 1,
			'enable_active' => 0,
			'disable_text' => 1
		));
		
		$params[] = gusta_vc_extra_class_name();
		
		$params = gusta_styles_tab ( $params, array (
			array (	'sub_group' => __( 'View Cart', 'mb_framework' ), 'el_slug' => 'view_cart', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Checkout', 'mb_framework' ), 'el_slug' => 'checkout', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Sub-total', 'mb_framework' ), 'el_slug' => 'sub_total', 'dependency' => 0, 'enable_hover' => 0, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Images', 'mb_framework' ), 'el_slug' => 'images', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
			array (	'sub_group' => __( 'Links', 'mb_framework' ), 'el_slug' => 'links', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Dropdown', 'mb_framework' ), 'el_slug' => 'dropdown', 'dependency' => 0, 'enable_hover' => 0, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Cart Count', 'mb_framework' ), 'el_slug' => 'cart_count', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Icon', 'mb_framework' ), 'el_slug' => 'icon_container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 )
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Shopping Cart Icon", "mb_framework"), // add a name
		"base" => "gusta_cart_icon", // bind with our shortcode
		"content_element" => true, // set this parameter when element will has a content
		"is_container" => false, // set this param when you need to add a content element in this element
		'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
		"category" => "Smart Sections",
		"params" => $params
            )
        );

        unset($params);