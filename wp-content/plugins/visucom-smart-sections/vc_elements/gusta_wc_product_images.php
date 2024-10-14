<?php
/*
* Smart Sections Product Images Element & Shortcode
*
* @file           vc_elements/gusta_wc_product_images.php
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
Element Description: Gusta Product Images
*/

     

    // Element HTML
    function gusta_product_images_html( $atts ) {
	ob_start();
	global $parent, $product;
	$the_post = $parent;
	if ($the_post==''): $the_post=get_queried_object(); endif;
        $css = $el_class = $output = $the_permalink = $the_content = ''; unset ($dynamic_css);
		
	$att = shortcode_atts(array(
		'vc_id' => '',
		'gallery_layout' => '',
		'thumbnail_columns' => '4',
		'thumbnail_columns_tablet' => '4',
		'thumbnail_columns_mobile' => '4',
		'el_class' => ''
	), $atts, 'gusta_wc_product_images');
	extract($att);
	
	if ($the_post):

		if (get_post_type($the_post)=='product'):
		
			echo '<div id="'.$vc_id.'" class="ss-element product gusta-product-images '.$el_class.'">';
			
				/*$post_thumbnail_id = $product->get_image_id();
				if ( $product->get_image_id() ) {
					$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
				} else {
					$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
					$html .= '</div>';
				}

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

				echo "---";*/
		
				if ($gallery_layout=='gusta'):
					$post_thumbnail_id = $product->get_image_id(); ?>
						<div class="gusta-woocommerce-product-gallery-wrapper">
							<?php
							echo '<div class="gusta-woocommerce-product-main-image">';
							if ( $product->get_image_id() ) {
								
								$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
								$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
								$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || true ? 'woocommerce_single' : $thumbnail_size );
								$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
								$full_src = wp_get_attachment_image_src( $post_thumbnail_id, $full_size );
								$image             = wp_get_attachment_image(
									$post_thumbnail_id,
									$image_size,
									false,
									apply_filters(
										'woocommerce_gallery_image_html_attachment_image_params',
										array(
											'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
											'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
											'data-src'                => esc_url( $full_src[0] ),
											'data-large_image'        => esc_url( $full_src[0] ),
											'data-large_image_width'  => esc_attr( $full_src[1] ),
											'data-large_image_height' => esc_attr( $full_src[2] ),
											'class'                   => esc_attr( true ? 'wp-post-image' : '' ),
										),
										$post_thumbnail_id,
										$image_size,
										true
									)
								);
								echo '<a data-lightbox="lightbox" href="'.$full_src[0].'">'.$image.'</a>';
							} else {
								echo sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
							}
							echo '</div>';
							
							echo '<div class="gusta-woocommerce-gallery-thumbnails gusta-wc-columns-'.$thumbnail_columns.' gusta-wc-columns-tablet-'.$thumbnail_columns_tablet.' gusta-wc-columns-mobile-'.$thumbnail_columns_mobile.'">';
							$attachment_ids = $product->get_gallery_image_ids();
							
							if ($thumbnail_columns=='1'): $gtsize = true; else: $gtsize = false; endif;
		
							if ( $attachment_ids && $product->get_image_id() ) {
								foreach ( $attachment_ids as $attachment_id ) {
									$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
									$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
									$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $gtsize ? 'woocommerce_single' : $thumbnail_size );
									$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
									$full_src = wp_get_attachment_image_src( $attachment_id, $full_size );
									$image             = wp_get_attachment_image(
										$attachment_id,
										($thumbnail_columns=='1' ? $image_size : $thumbnail_size),
										$gtsize,
										apply_filters(
											'woocommerce_gallery_image_html_attachment_image_params',
											array(
												'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
												'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
												'data-src'                => esc_url( $full_src[0] ),
												'data-large_image'        => esc_url( $full_src[0] ),
												'data-large_image_width'  => esc_attr( $full_src[1] ),
												'data-large_image_height' => esc_attr( $full_src[2] ),
												'class'                   => esc_attr( false ? 'wp-post-image' : '' ),
											),
											$attachment_id,
											($thumbnail_columns=='1' ? $image_size : $thumbnail_size),
											$gtsize
										)
									);
									echo '<a data-lightbox="lightbox" href="'.$full_src[0].'">'.$image.'</a>';
								}
							}
							echo '</div>';
							?>
						</div>
		
				<?php else:

					woocommerce_show_product_images();
		
				endif;
			
			echo '</div>';
			
		endif;
		
	endif;
	
	$ReturnString = ob_get_contents(); ob_end_clean(); return $ReturnString;
        
    }
     

	add_shortcode( 'gusta_wc_product_images', 'gusta_product_images_html' );



		$params = array (
			gusta_vc_id('product-images'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Layout', 'mb_framework' ),
				'param_name' => 'gallery_layout',
				'admin_label' => true,
				'value' => array (
					'Theme Default Layout' => '',
					'Smart Sections Layout' => 'gusta',
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Thumbnail Columns (Desktop)', 'mb_framework' ),
				'param_name' => 'thumbnail_columns',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-4',
				'value' => array (
					'Justified' => 'justified',
					'1 Column (With full size images instead of thumbnail)' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'5 Columns' => '5',
					'6 Columns' => '6',
					'7 Columns' => '7',
					'8 Columns' => '8',
					'9 Columns' => '9',
					'10 Columns' => '10',
				),
				'dependency' => array( 'element' => 'gallery_layout', 'value' => array('gusta') ),
				'std' => '4'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Thumbnail Columns (Tablet)', 'mb_framework' ),
				'param_name' => 'thumbnail_columns_tablet',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-4',
				'value' => array (
					'Justified' => 'justified',
					'1 Column (With full size images instead of thumbnail)' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'5 Columns' => '5',
					'6 Columns' => '6',
					'7 Columns' => '7',
					'8 Columns' => '8',
					'9 Columns' => '9',
					'10 Columns' => '10',
				),
				'dependency' => array( 'element' => 'gallery_layout', 'value' => array('gusta') ),
				'std' => '4'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Thumbnail Columns (Mobile)', 'mb_framework' ),
				'param_name' => 'thumbnail_columns_mobile',
				'admin_label' => false,
				'edit_field_class' => 'vc_col-xs-4',
				'value' => array (
					'Justified' => 'justified',
					'1 Column (With full size images instead of thumbnail)' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'5 Columns' => '5',
					'6 Columns' => '6',
					'7 Columns' => '7',
					'8 Columns' => '8',
					'9 Columns' => '9',
					'10 Columns' => '10',
				),
				'dependency' => array( 'element' => 'gallery_layout', 'value' => array('gusta') ),
				'std' => '4'
			),
			gusta_vc_extra_class_name(),
		);

		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Thumbnails', 'mb_framework' ), 'el_slug' => 'thumbnails', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
			array (	'sub_group' => __( 'Main Image', 'mb_framework' ), 'el_slug' => 'content', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));

		// Map the block with vc_map()
		vc_map( 
			array(
				"name" => __("Product Images", "mb_framework"), // add a name
				"base" => "gusta_wc_product_images", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => __('Smart Sections', 'mb_framework'),
				"params" => $params
			)
		);

     
     
unset($params);