<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_style( 'nectar-element-interactive-map' );

   extract(shortcode_atts(array(
    'map_type' => 'google',
    'size' => '400',
	  "img_link_target" => '',
	  'map_center_lat'=> '', 
	  'map_center_lng'=> '', 
	  'zoom' => '12', 
	  'enable_zoom' => '', 
	  'marker_image'=> '', 
	  'map_greyscale' => '',
	  'map_color' => '',
	  'ultra_flat' => '',
	  'dark_color_scheme' => '',
	  'marker_animation'=> 'false',
	  'map_markers' => '',
	  'marker_style' => 'default',
    'marker_image_width' => '50',
    'marker_image_height' => '50',
	  'nectar_marker_color' => 'accent-color',
    'leaflet_map_greyscale' => '',
    'infowindow_start_open' => '',
    'color' => 'accent-color' //leaflet marker color
	),
	$atts));
	
  if( !defined( 'NECTAR_THEME_NAME' ) ) {
    $map_type = 'leaflet';
  }
  
  if( $map_type === 'google' ) {
  	wp_enqueue_script('nectarMap', get_template_directory_uri() . '/js/build/map.js', array('jquery'), '8.5.4', TRUE);
  } else if( $map_type === 'leaflet' ) {
    wp_enqueue_script('leaflet'); 
    wp_enqueue_script('nectar-leaflet-map'); 
    wp_enqueue_style('leaflet'); 
  }
  
	$markersArr   = array();
	$explodedByBr = explode("\n", $map_markers);	
	$count         = 0;
	
	foreach ($explodedByBr as $brExplode) {
		
	    $markersArr[$count] = array();
	    $explodedBySep = explode('|', $brExplode);
	  
	    foreach ($explodedBySep as $sepExploded) {
	        $markersArr[$count][] = do_shortcode($sepExploded);
	    }
	  
	    $count++;
	}

	$map_data         = null;
	$unique_id        = uniqid("map_");
	$marker_image_src = null;
  
	if( !empty($marker_image) ) {
		$marker_image_src = wp_get_attachment_image_src($marker_image, 'full');
		if( isset($marker_image_src[0]) ) {
			$marker_image_src = $marker_image_src[0];
		}
	}
	
  $map_class = ($map_type === 'google') ? 'nectar-google-map' : 'nectar-leaflet-map';
  
  if( $map_class === 'nectar-leaflet-map' ) {
      $map_greyscale       = $leaflet_map_greyscale;
      $nectar_marker_color = $color;
  }


  
	echo '<div id="'.$unique_id.'" style="height: '.nectar_css_sizing_units($size).';" class="'.esc_attr($map_class).'" data-infowindow-start-open="'. esc_attr($infowindow_start_open) .'" data-dark-color-scheme="'. esc_attr($dark_color_scheme) .'" data-marker-style="'.esc_attr($marker_style).'" data-nectar-marker-color="'.esc_attr($nectar_marker_color).'" data-ultra-flat="'.esc_attr($ultra_flat).'" data-greyscale="'.esc_attr($map_greyscale).'" data-extra-color="'.esc_attr($map_color).'" data-enable-animation="'.esc_attr($marker_animation).'" data-enable-zoom="'.esc_attr($enable_zoom).'" data-zoom-level="'.esc_attr($zoom).'" data-center-lat="'.esc_attr(do_shortcode($map_center_lat)).'" data-center-lng="'.esc_attr(do_shortcode($map_center_lng)).'" data-marker-img="'.$marker_image_src.'"></div>';
	echo '<div class="'.$unique_id.' map-marker-list">';
  
		$count = 0;
		for($i = 1; $i <= sizeof($markersArr); $i++) {
			
			if(empty($markersArr[$count][0])) { $markersArr[$count][0] = null; }
			if(empty($markersArr[$count][1])) { $markersArr[$count][1] = null; }
			if(empty($markersArr[$count][2])) { $markersArr[$count][2] = null; }
		
			echo '<div class="map-marker" data-marker-image-width="'. esc_attr($marker_image_width) .'" data-marker-image-height="'. esc_attr($marker_image_height) .'" data-lat="'.esc_attr($markersArr[$count][0]).'" data-lng="'.esc_attr($markersArr[$count][1]).'" data-mapinfo="'.wp_kses_post($markersArr[$count][2]).'"></div>';

			$count++;
		}
	echo '</div>';
	
?>