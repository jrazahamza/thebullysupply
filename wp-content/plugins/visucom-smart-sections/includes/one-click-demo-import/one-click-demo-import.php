<?php

/*
Plugin Name: One Click Demo Import
Plugin URI: https://wordpress.org/plugins/one-click-demo-import/
Description: Import your content, widgets and theme settings with one click. Theme authors! Enable simple demo import for your theme demo data.
Version: 3.1.2
Author: OCDI
Author URI: https://ocdi.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: one-click-demo-import
Domain Path: /languages
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main plugin class with initialization tasks.
 */
class Gusta_OCDI_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.6.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.6', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		}
		else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once OCDI_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$one_click_demo_import = OCDI\OneClickDemoImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'ocdi list', array( 'OCDI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'ocdi import', array( 'OCDI\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.6.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() { /* translators: %1$s - the PHP version, %2$s and %3$s - strong HTML tags, %4$s - br HTMl tag. */
		$message = sprintf( esc_html__( 'The %2$sOne Click Demo Import%3$s plugin requires %2$sPHP 5.6+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 7.4%4$s Your current version of PHP: %2$s%1$s%3$s', 'one-click-demo-import' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'OCDI_PATH' ) ) {
			define( 'OCDI_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'OCDI_URL' ) ) {
			define( 'OCDI_URL', plugin_dir_url( __FILE__ ) );
		}

		// Used for backward compatibility.
		if ( ! defined( 'PT_OCDI_PATH' ) ) {
			define( 'PT_OCDI_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PT_OCDI_URL' ) ) {
			define( 'PT_OCDI_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> OCDI_VERSION.
	 */
	public function set_plugin_version_constant() {
		$plugin_data = get_plugin_data( __FILE__ );

		if ( ! defined( 'OCDI_VERSION' ) ) {
			define( 'OCDI_VERSION', $plugin_data['Version'] );
		}

		// Used for backward compatibility.
		if ( ! defined( 'PT_OCDI_VERSION' ) ) {
			define( 'PT_OCDI_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$ocdi_plugin = new Gusta_OCDI_Plugin();

/* Validate Envato Purchase */
function gusta_envato_purchase_validation ($code) {
    // If you took $code from user input it's a good idea to trim it:
    
    $code = trim($code);
    
    // Make sure the code is valid before sending it to Envato:
    if (!preg_match("/^([a-z0-9]{8})[-](([a-z0-9]{4})[-]){3}([a-z0-9]{12})$/im", $code)):
        return __("Your current code is not entered or invalid.", 'mb_framework');
    endif;
    
    // Query using CURL:
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 20,
        
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer QQzOGh7sOyepjxv5l9SpLlxG9BLBS8nt",
            "User-Agent: Theme Gusta items purchase validation"
        )
    ));
    
    // Execute CURL with warnings suppressed:
    $response = @curl_exec($ch);
    
    if (curl_errno($ch) > 0):
        return __("Failed to query Envato API: ", 'mb_framework') . curl_error($ch);
    endif;
    
    // Validate response:
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($responseCode === 404) :
        return __('The purchase code was invalid', 'mb_framework');
    endif;
    
    if ($responseCode !== 200):
            return __('Failed to validate code due to an error: HTTP ', 'mb_framework').$responseCode;
    endif;
    
    // Verify that the purchase code is for the correct item:
    // (Replace the numbers 17022701 with your item's ID from its URL obviously)
    $body = json_decode($response);
        
    if ($body->item->id !== 21641422):
        return __('The purchase code you provided is for a different item', 'mb_framework');
    endif;

    return false;
    
}

function gusta_import_files() {
  return array(
    array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%201%20-%20Center%20aligned%20header%20with%20toggle%20search.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-1.jpg',
/*           'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'mb_framework' ),*/
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%202%20-%20Standart%20header%20with%20top%20bar.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%203%20-%20Boxed%20header%20with%20toggle%20button.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%204%20-%20Material%20header%20with%20toggle%20buttons.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 6',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-6',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%206%20-%20Basic%20full%20width%20header%20with%20shadowed%20style%20navigation.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/6-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 7',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-7',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%207%20-%20Dark%20header%20with%20featured%20image%20and%20top%20bar.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/7.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 8',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-8',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%208%20-%20Basic%20full%20width%20header.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/8.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 9',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-9',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%209%20-%20Header%20with%20grey%20outline.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/9.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 10',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-10',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%2010%20-%20Header%20with%20top%20bar.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/10.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 11',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-11',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%2011%20-%20Header%20with%20a%20rounded%20menu%20and%20breadcrumb.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/11.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 12',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-12',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%2012%20-%20Sticky%20header%20with%20search%20box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/12.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 13',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-13',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%2013%20-%20Full%20Screen%20Header%20with%20Title%20and%20BG.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/13.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%205%20-%20Vertical%20header%20with%20toggle%20map.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 14',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-14',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%2014%20-%20Vertical%20menu%20with%20multiple%20navigation.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/14.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Headers' ),
            'import_file_name'           => 'Header Demo 15',
            'preview_url'           => 'https://www.themegusta.com/showcase/#header-demo-15',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/header/Header%20Demo%2015%20-%20Vertical%20header%20with%20author%20info%20box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/15.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%201%20-%20Dark%20Background.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-1.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%202%20-%20with%20Dark%20Background%202.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-2.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%203%20-%20Flat%201.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%204%20-%20Overlay%203.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%205%20-%20Flat%202.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 6',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-6',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%206%20-%20Overlay%201.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-6.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 7',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-7',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%207%20-%20Overlay%202.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-7.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 8',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-8',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%208%20-%20without%20featured%20image.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-8.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 9',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-9',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%209%20-%20Horizontal%202.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-9.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 10',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-10',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2010%20-%20Horizontal%20Large%20Layout.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-10.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 11',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-11',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2011%20-%20Timeline.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-11.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 12',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-12',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2012%20-%20Basic.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-12.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 13',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-13',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2013%20-%20Material.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-13.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 14',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-14',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2014%20-%20for%20Sidebar.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-14.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 15',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-15',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2015%20-%20Overlay%204.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-15.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 16',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-16',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2016%20-%20Dark%20Overlay%20Read%20More%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-16.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 17',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-17',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2017%20-%20Sky%20Blue%20Overlay%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-17.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 18',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-18',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2018%20-%201%20Column%20Simple%20with%20Author.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-18.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 19',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-19',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2019%20-%20Absolute%20Radius.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-19.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 20',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-20',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2020%20-%20Ticket%20Purple%20Line%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-20.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 21',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-21',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2021%20-%20Dark%20BG%20Image%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-21.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 22',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-22',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2022%20-%20Obscure%20with%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-22.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 23',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-23',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2023%20-%20Crypto%20Dark%20Blue%20Background.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-23.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 24',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-24',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2024%20-%20Cloud%20Degrade%20Framed%20Image%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-24.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 25',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-25',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2025%20-%20Purple%20Green%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-25.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 26',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-26',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2026%20-%20Dark%20BG%20-%20Anim%20Author.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-26.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 27',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-27',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2027%20-%20White%20Description%20Overlay.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-27.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 28',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-28',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2028%20-%20Flat%20Contrast.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-28.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 29',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-29',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2029%20-%20Elegant%20Border.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-29.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 30',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-30',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2030%20-%20Picture%20of%20the%20Day.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-30.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 31',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-31',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2031%20-%20Flat%20Border%20Bottom.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-31.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 32',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-32',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2032%20-%20Dark%20Hover%20Overlay.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-32.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 33',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-33',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2033%20-%20Gradient%20Hover%20Overlay%20-%20Learn%20More.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-33.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 34',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-34',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2034%20-%20Dark%20Overlay%20-%20Hover%20Category%20and%20Date.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-34.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 35',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-35',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2035%20-%20Flat%20-%20Hover%20Shadow%20Up.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-35.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 36',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-36',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2036%20-%20Padded%20Border%20-%20White%20Overlay.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-36.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 37',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-37',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2037%20-%20Dark%20Overlay%20-%20Text%20Center.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-37.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 38',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-38',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2038%20-%20Overlay%20Text%20on%20Hover%20-%20Circle%20Button.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-38.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 39',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-39',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2039%20-%20Full%20Width%20Overlay%20Text%20and%20Social.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-39.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Post Listing' ),
            'import_file_name'           => 'Post Listing Demo 40',
            'preview_url'           => 'https://www.themegusta.com/showcase/#post-listing-demo-40',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/post%20listing/Smart%20Sections%20Post%20Listing%20Demo%2040%20-%20White%20BG%20Padding%20on%20Hover.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://themegusta.com/showcase/previews/post-listing-demo-40.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Sticky' ),
            'import_file_name'           => 'Sticky Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sticky-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sticky/Sticky%20Demo%201%20-%20Pop-up%20call%20to%20action%20modal%20box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-8.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Sticky' ),
            'import_file_name'           => 'Sticky Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sticky-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sticky/Sticky%20Demo%202%20-%20Expanding%20sticky%20search%20at%20the%20bottom.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-7.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Sticky' ),
            'import_file_name'           => 'Sticky Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sticky-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sticky/Sticky%20Demo%203%20-%20Sticky%20social%20sharing%20box%20at%20the%20middle%20left.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-7.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Sticky' ),
            'import_file_name'           => 'Sticky Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sticky-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sticky/Sticky%20Demo%204%20-%20Sticky%20Social%20Sharing%20Box%20at%20the%20bottom.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-6.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Sticky' ),
            'import_file_name'           => 'Sticky Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sticky-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sticky/Sticky%20Demo%205%20-%20Toggle%20triggered%20Contact%20Form%207.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-6.jpg',
            'import_notice'              => __( '"Contact Form 7" plug-in should be installed and activated for this demo to work properly.', 'mb_framework' ), 
        ),
        array(
            'categories'                 => array( 'Mega Menu' ),
            'import_file_name'           => 'Mega Menu Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#mega-menu-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/mega%20menu/Mega%20Menu%20Demo%201%20-%20With%20tour%20element.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Mega Menu' ),
            'import_file_name'           => 'Mega Menu Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#mega-menu-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/mega%20menu/Mega%20Menu%20Demo%202%20-%20Six%20columns%20with%20an%20image.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Mega Menu' ),
            'import_file_name'           => 'Mega Menu Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#mega-menu-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/mega%20menu/Mega%20Menu%20Demo%203%20-%20Three%20columns%20with%20image%20above.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/mega-menu-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Mega Menu' ),
            'import_file_name'           => 'Mega Menu Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#mega-menu-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/mega%20menu/Mega%20Menu%20Demo%204%20-%20Latest%20Posts.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Mega Menu' ),
            'import_file_name'           => 'Mega Menu Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#mega-menu-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/mega%20menu/Mega%20Menu%20Demo%205%20-%20Four%20columns%20with%20latest%20posts%20and%20social%20media%20links.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%201%20-%20Simple%20stylish%20call%20to%20action%20with%20icon%20and%20button.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%202%20-%20Mailchimp%20subsciption%20form.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-4.jpg',
            'import_notice'              => __( '"Easy Forms for MailChimp" plug-in should be installed and activated for this demo to work properly.', 'mb_framework' ), 
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%203%20-%20Author%20info%20and%20comment%20box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%204%20-%20Meta%20data%20and%20featured%20image.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%205%20-%20Multiple%20post%20listing%20layouts.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 6',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-6',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%206%20-%20Related%20posts.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/6-3.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 7',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-7',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%207%20-%20Dark%20page%20title%20with%20featured%20image%20and%20breadcrumb.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/7-2.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Content' ),
            'import_file_name'           => 'Content Demo 8',
            'preview_url'           => 'https://www.themegusta.com/showcase/#content-demo-8',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/content/Content%20Demo%208%20-%20Page%20title%20with%20featured%20image%20date%20and%20author.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/8-2.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Layout' ),
            'import_file_name'           => 'Layout Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#layout-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/layout/Layout%20Demo%201%20-%20Layout%20template%20with%20full%20screen%20featured%20image%20and%20boxed%20content.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-7.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Layout' ),
            'import_file_name'           => 'Layout Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#layout-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/layout/Layout%20Demo%202%20-%20Layout%20template%20with%20meta%20data,%20sidebar%20and%20comments%20box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-6.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Layout' ),
            'import_file_name'           => 'Layout Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#layout-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/layout/Layout%20Demo%203%20-%20Side%20full%20height%20image%20layout%20template.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-6.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Layout' ),
            'import_file_name'           => 'Layout Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#layout-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/layout/Layout%20Demo%204%20-%20404%20Page.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/page-layout4.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Widgetized Sidebar' ),
            'import_file_name'           => 'Sidebar Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sidebar-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sidebar/Smart%20Sections%20Sidebar%20Demo%201%20-%20Comments%20Tab.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-6.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Widgetized Sidebar' ),
            'import_file_name'           => 'Sidebar Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sidebar-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sidebar/Smart%20Sections%20Sidebar%20Demo%202%20-%20Call%20to%20Action.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Widgetized Sidebar' ),
            'import_file_name'           => 'Sidebar Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sidebar-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sidebar/Smart%20Sections%20Sidebar%20Demo%203%20-%20Post%20Listing.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Widgetized Sidebar' ),
            'import_file_name'           => 'Sidebar Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sidebar-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sidebar/Smart%20Sections%20Sidebar%20Demo%204%20-%20Basic%20Menu.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-5.jpg',
           'import_notice'              => __( '"Contact Form 7" plug-in should be installed and activated for this demo to work properly.', 'mb_framework' ), 
        ),
        array(
            'categories'                 => array( 'Widgetized Sidebar' ),
            'import_file_name'           => 'Sidebar Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#sidebar-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/sidebar/Smart%20Sections%20Sidebar%20Demo%205%20-%20Author%20Info%20Box.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-5.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Footer' ),
            'import_file_name'           => 'Footer Demo 1',
            'preview_url'           => 'https://www.themegusta.com/showcase/#footer-demo-1',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/footer/Footer%20Demo%201%20-%20Dark%20background%20footer%20with%20four%20columns%20plus%20two%20columns.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer1a.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Footer' ),
            'import_file_name'           => 'Footer Demo 2',
            'preview_url'           => 'https://www.themegusta.com/showcase/#footer-demo-2',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/footer/Footer%20Demo%202%20-%20Footer%20with%20google%20map%20and%20toggle%20pop-up%20contact%20form.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer2.jpg',
            'import_notice'              => __( '"Contact Form 7" plug-in should be installed and activated for this demo to work properly.', 'mb_framework' ), 
        ),
        array(
            'categories'                 => array( 'Footer' ),
            'import_file_name'           => 'Footer Demo 3',
            'preview_url'           => 'https://www.themegusta.com/showcase/#footer-demo-3',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/footer/Footer%20Demo%203%20-%203%20column%20center%20aligned%20footer%20with%20dark%20background.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer3a.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Footer' ),
            'import_file_name'           => 'Footer Demo 4',
            'preview_url'           => 'https://www.themegusta.com/showcase/#footer-demo-4',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/footer/Footer%20Demo%204%20-%20Footer%20with%20a%20dark%20box%20at%20the%20left%20side.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer4a.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
        array(
            'categories'                 => array( 'Footer' ),
            'import_file_name'           => 'Footer Demo 5',
            'preview_url'           => 'https://www.themegusta.com/showcase/#footer-demo-5',
            'import_file_url'            => 'https://themegusta.com/demo-import/downloads-67d4fc56b01062e6f9c003f9cf95d18f/footer/Footer%20Demo%205%20-%20Footer%20with%20a%20top%20bar.xml',
            'import_widget_file_url'     => '',
            'import_customizer_file_url' => '',
            'import_preview_image_url'   => 'https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer5a.jpg',
 /*           'import_notice'              => __( 'A special note for this import.', 'mb_framework' ), */
        ),
  );
}
add_filter( 'pt-ocdi/import_files', 'gusta_import_files' );