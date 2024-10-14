<?php
/*
* Image Functions
*
* @file           includes/image.php
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

/* Add Image Size */
if(!function_exists('gusta_add_new_image_size')):
	function gusta_add_new_image_size() {
		add_image_size( 'tg-landscape', 800, 600, true );
	}
	add_action( 'init', 'gusta_add_new_image_size' );
endif;


/* Image Crop Dimensions */
if(!function_exists('gusta_image_crop_dimensions')):
	function gusta_image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
	add_filter('image_resize_dimensions', 'gusta_image_crop_dimensions', 10, 6);
endif;

/* Resize Images Dynamically */
if(!function_exists('gusta_resize')):
	function gusta_resize($attach_id = null, $img_url = null, $width = 0, $height = 0, $crop = false){
		$image_src = wp_get_attachment_image_src($attach_id, 'full');
		$file_path = get_attached_file($attach_id);
		$img = wp_get_image_editor( $file_path );
		if ( ! is_wp_error( $img ) ):
			if ($crop): $crop = array( 'center', 'center' ); endif;
			$resize = $img->resize( $width, $height, $crop );
			$saved = $img->save();
			$new_url = str_replace(basename($image_src[0]), $saved['file'], $image_src[0]);
			$return["url"] = $new_url;
			$return["width"] = $saved['width'];
			$return["height"] = $saved['height'];
			$return["mime-type"] = $saved['mime-type'];	
			return $return;
		endif;
		return false;
	}
endif;
?>