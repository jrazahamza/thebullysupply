<?php
/*
* Auto Suggest
*
* @file           includes/update-cart.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.1.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Update Cart Count */
if(!function_exists('gusta_update_cart_count')):
	function gusta_update_cart_count() {
		$cart_count = WC()->cart->get_cart_contents_count();
		echo $cart_count;
		wp_die();
	}
	add_action( 'wp_ajax_gusta_update_cart_count', 'gusta_update_cart_count' );
	add_action( 'wp_ajax_nopriv_gusta_update_cart_count', 'gusta_update_cart_count' );
endif;

/* Update Cart */
if(!function_exists('gusta_update_cart')):
	function gusta_update_cart() {
		$current_cart_count = (isset($_POST['current_cart_count']) ? strip_tags($_POST['current_cart_count']) : '');
		$cart_type = (isset($_POST['cart_type']) ? strip_tags($_POST['cart_type']) : '');
		$cart_count = WC()->cart->get_cart_contents_count();
		if ($current_cart_count!=$cart_count):
			
		        $cart_total 	= WC()->cart->get_cart_total();
			
			if ($cart_type='dropdown'):
			
				$cart_url   	= WC()->cart->get_cart_url();
			        $checkout_url   = WC()->cart->get_checkout_url();
			
				$output = '<table>';
		
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
				
				
				$output .= '</tbody></table>'; 
				
				$output .= '<a class="gusta-view-cart-button" href="'.$cart_url.'" title="'.__('View Cart','mb_framework').'">'.__('View Cart','mb_framework').'</a>';
				
				if ( sizeof( WC()->cart->cart_contents) > 0 ) :
					$output .= '<a class="gusta-checkout-button gusta-icon-link" href="' . $checkout_url . '" title="' . __( 'Checkout', 'mb_framework' ) . '">' . __( 'Checkout', 'mb_framework' ) . '</a>';
				endif;
				
			endif;
			if ($output==''): $output=0; endif;
			echo $output;
			
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_gusta_update_cart', 'gusta_update_cart' );
	add_action( 'wp_ajax_nopriv_gusta_update_cart', 'gusta_update_cart' );
endif;
?>