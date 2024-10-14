<?php
/**
 * Plugin Name: Smart Sections Theme Builder
 * Plugin URI: https://themegusta.com/smartsections
 * Description: Take control of your entire Wordpress Website
 * Version: 1.7.8
 * Author: Theme Gusta
 * Author URI: https://www.themegusta.com/
 * Requires at least: 5.1
 * Tested up to: 5.7
 * Text Domain: mb_framework
 * Domain Path: /languages/
 * License: Envato
 */

define( 'SMART_SECTIONS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SMART_SECTIONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
update_option( 'smart_sections_purchase_code', 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' );
require SMART_SECTIONS_PLUGIN_PATH.'includes/plugin-updates/plugin-update-checker.php';
$ExampleUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://themegusta.com/updates/smart-sections.json',
	__FILE__
);

function gusta_exclude_plugins_from_auto_update ( $update, $item ) {
    $plugins = array ( // Plugins to exclude from auto-update
        'smart-sections',
    );
    if ( in_array( $item->slug, $plugins ) )
        return false; // Don't auto-update specified plugins
    //else return true; // Auto-update all other plugins
}
add_filter( 'auto_update_plugin', 'gusta_exclude_plugins_from_auto_update', 10, 2 );

add_action( 'in_plugin_update_message-' . 'visucom-smart-sections/smart-sections.php', 'gusta_addUpgradeMessageLink');

function gusta_addUpgradeMessageLink () {
	echo sprintf( ' ' . esc_html__( 'Please use the %sEnvato Market Plugin%s to receive updates.', 'mb_framework' ), '<a href="admin.php?page=envato-market">', '</a>' );
}

if ( !in_array( 'envato-market/envato-market.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
	include( SMART_SECTIONS_PLUGIN_PATH.'includes/envato-market/envato-market.php'); 
endif;

if (file_exists(get_theme_file_path().'/smart-sections/init.php')):
	include( get_theme_file_path().'/smart-sections/init.php'); 
else:
	include( SMART_SECTIONS_PLUGIN_PATH.'/init.php');
endif;
?>