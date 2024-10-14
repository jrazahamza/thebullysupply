<?php
/*
* Initialize Advanced Custom Fields Pro for Admin Options and Custom Metaboxes
*
* @file           admin/acf.php
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

// 1. customize ACF path
add_filter('acf/settings/path', 'gusta_acf_settings_path');
 
function gusta_acf_settings_path( $path ) {
 
    // update path
    $path = SMART_SECTIONS_PLUGIN_PATH . '/includes/acf/';
    
    // return
    return $path;
    
}
 

// 2. customize ACF dir
add_filter('acf/settings/dir', 'gusta_acf_settings_dir');
 
function gusta_acf_settings_dir( $dir ) {

    $dir = SMART_SECTIONS_PLUGIN_URL . '/includes/acf/';
    return $dir;
    
}

/*//Save options to JSON
add_filter('acf/settings/save_json', 'gusta_acf_json_save_point');
function gusta_acf_json_save_point( $path ) {
   
    $path = SMART_SECTIONS_PLUGIN_PATH . '/includes/acf-json/';
    return $path;
    
}

//Load options from JSON
add_filter('acf/settings/load_json', 'gusta_acf_json_load_point');
function gusta_acf_json_load_point( $paths ) {
    
    //unset($paths[0]);
    $paths[] = SMART_SECTIONS_PLUGIN_PATH . '/includes/acf-json/';
    return $paths;
    
}*/

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_true');

// 4. Include ACF
include_once( SMART_SECTIONS_PLUGIN_PATH . '/includes/acf/acf.php' );
?>