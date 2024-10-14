<?php

namespace GustaDemo;

use WP_Error;

class Admin
{
    protected static $is_network_active, $settings, $wp_importer_loaded, $require_plugin_wp_error;
    const PAGEID = 'gusta-demo';

    static function isNetworkActive()
    {
        if ( isset( self::$is_network_active ) ) {
            return self::$is_network_active;
        }

        if ( ! is_multisite() ) {
            self::$is_network_active = false;
            return false;
        }

        $plugins = get_site_option( 'active_sitewide_plugins', array() );

        if ( ! is_array($plugins) || ! isset($plugins[ App::getBasename() ]) ) {
            self::$is_network_active = false;
            return false;
        }

        self::$is_network_active = true;
        return true;
    }


    static function init()
    {
        if ( $network = self::isNetworkActive() ) {
            // network_admin_menu
            add_action('admin_menu', array(__CLASS__, 'pages'));
        } else {
            add_action('admin_menu', array(__CLASS__, 'pages'));
        }

        if (isset($_GET['page']) && self::PAGEID === $_GET['page']) {
            self::$wp_importer_loaded = self::isImporterAvailable();
            add_action('admin_enqueue_scripts', array(__CLASS__, 'scripts'));
            add_action('admin_menu', array(__CLASS__, 'update'));

            // using admin instead of ajax to install plugins correctly
            if ( isset($_REQUEST['action']) && 'gusta-demo-install-plugin' == $_REQUEST['action'] ) {
                add_action('admin_menu', array(__CLASS__, 'installPluginAjax'), 0);
            }

            add_action( ($network ? 'network_' : '') .'admin_notices', array(__CLASS__, 'wpImportMissingNotice') );
        }

        if ( $network ) {
            add_filter('network_admin_plugin_action_links_' . App::getBasename(), array(__CLASS__, 'links'));
        } else {
            add_filter('plugin_action_links_' . App::getBasename(), array(__CLASS__, 'links'));
        }

        if ( defined('DOING_AJAX') && DOING_AJAX ) {
            if ( isset($_REQUEST['action']) && 'gusta-demo-import' == $_REQUEST['action']  ) {
                defined('WP_LOAD_IMPORTERS') || define('WP_LOAD_IMPORTERS', true);
            }

            // AJAX is way late for activation hooks and such plugin requirements to be processed, therefore use admin.
            // add_action('wp_ajax_gusta-demo-install-plugin', array(__CLASS__, 'installPluginAjax'));
            add_action('wp_ajax_gusta-demo-verify-purchase-code', array(__CLASS__, 'verifyPurchaseCodeAjax'));
            add_action('wp_ajax_gusta-demo-import', array(__CLASS__, 'importDemoAjax'));
        }
    }

    static function pages()
    {
        return add_submenu_page(
            'edit.php?post_type=gusta_section',
            __('Import Demos', 'gusta-demo'),
            __('Import Demos', 'gusta-demo'),
            'manage_options',
            self::PAGEID,
            array(__CLASS__, 'screen'),
            'dashicons-welcome-view-site'
        );
    }

    static function scripts()
    {
        wp_enqueue_script('gusta-demo', App::url('/src/app/assets/js/demo.js'), array('jquery'), App::VERSION);
        wp_localize_script('gusta-demo', 'GUSTA_DEMO', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'adminUrl' => admin_url('edit.php?post_type=gusta_section&page=' . self::PAGEID),
            'i18n' => array(
                'err_general' => __('Error occured, please try again or later.', 'gusta-demo'),
                'import' => __('Import', 'gusta-demo'),
                'verify_purchase' => __('Verify purchase', 'gusta-demo'),
                'loading' => __('Loading ...', 'gusta-demo'),
                'downloading_item' => __('Downloading demo...', 'gusta-demo'),
                'download_success' => __('Download was successful.', 'gusta-demo'),
                'reading_download_data' => __('Reading download data...', 'gusta-demo'),
                'demo_suggests_plugins' => __('This demo suggests to install and/or activate the following plugins:', 'gusta-demo'),
                'plugin_install_activate' => __('Install and Activate', 'gusta-demo'),
                'plugin_activate' => __('Activate', 'gusta-demo'),
                'not_installed' => __('Not installed', 'gusta-demo'),
                'installed_and_activated' => __('<em>Installed and Activated.</em>', 'gusta-demo'),
                'continue_import' => __('Continue Import', 'gusta-demo'),
                'import_success' => __('Demo imported successfully!', 'gusta-demo'),
                'import_loading' => __('Importing...', 'gusta-demo'),
                'import_check' => __('&check; Imported', 'gusta-demo'),
            ),
            'import_nonce' => wp_create_nonce('gusta-demo-import'),
            'install_nonce' => wp_create_nonce('install-wp-plugin'),
        ));
        wp_enqueue_style('gusta-demo', App::url('/src/app/assets/css/demo.css'), array(), App::VERSION);
    }

    static function screen()
    {
        $verified = self::isCurrentPurchaseKeyVerified();
        include __DIR__ . '/../templates/admin-screen.php';
    }

    static function updateSettings( $settings )
    {
        if ( empty( $settings['purchase_code'] ) || ! trim($settings['purchase_code']) ) {
            unset($settings['purchase_code']);
        }

        if ( self::isNetworkActive() ) {
            update_site_option('gusta-demo_settings', $settings);
        } else {
            update_option('gusta-demo_settings', $settings);
        }

        // update settings
        self::$settings = null;
        self::settings();
    }

    static function links($links)
    {
        return array_merge(array(
            'screen' => sprintf(
                '<a href="%s">' . __('Import Demos', 'gusta-demo') . '</a>',
                admin_url('edit.php?post_type=gusta_section&page=' . self::PAGEID)
            )
        ), $links);
    }

    static function settings()
    {
        if ( ! self::$settings || ! is_array( self::$settings ) ) {
            self::$settings = wp_parse_args(get_site_option('gusta-demo_settings'), array(
                'purchase_code' => null,
            ));
        }

        return self::$settings;
    }

    static function getSetting($setting, $default=null)
    {
        self::settings();
        return isset( self::$settings[ $setting ] ) ? self::$settings[ $setting ] : $default;
    }

    static function wpImportMissingNotice()
    {
        if ( ! is_wp_error( self::$wp_importer_loaded ) && self::$wp_importer_loaded )
            return;

        echo '<div class="error notice is-dismissible">'
           , sprintf(
                __('<p>Gusta Demo Importer requires the default WordPress importer to be installed and activated.</p><p>Error: <strong>%2$s</strong></p><p><a href="%1$s" class="button button-primary">Install and/or Activate WP Importer</a></p>', 'gusta-demo'),
                admin_url('edit.php?post_type=gusta_section&page=' . self::PAGEID . '&install-wp-importer=' . wp_create_nonce('install-wp-importer')),
                self::$wp_importer_loaded->get_error_message()
            )
           , '</div>';
    }

    private static function downloadPlugin( $plugin_id )
    {
        if ( ! function_exists('download_url') ) {
            if ( file_exists(ABSPATH . '/wp-admin/includes/file.php') ) {
                require_once ABSPATH . '/wp-admin/includes/file.php';
            } else {
                return new WP_Error('env_error', __('Internal server error.', 'gusta-demo'));
            }
        }

        if ( is_wp_error( $res = download_url("https://downloads.wordpress.org/plugin/{$plugin_id}.latest-stable.zip") ) ) {
            return new WP_Error('err_download', sprintf(
                __('Downloading plugin ended with an error: %s.', 'gusta-demo'),
                $res->get_error_message()
            ));
        }

        if ( ! file_exists($res) || ! is_readable($res)/* || ! self::checkMimeContentType($res, 'application/zip', 'zip')*/ ) {
            @unlink($res);
            return new WP_Error('err_download', __('Error, could not verify your download', 'gusta-demo'));
        }

        WP_Filesystem();

        $upload = unzip_file( $res, WP_PLUGIN_DIR );
        @unlink($res);

        if ( is_wp_error( $upload ) ) {
            return new WP_Error('err_download', sprintf(
                __('Unpacking plugin ended with an error: %s.', 'gusta-demo'),
                $res->get_error_message()
            ));
        }

        return $upload;
    }

    static function update()
    {
        self::$wp_importer_loaded = self::isImporterAvailable();
        self::$require_plugin_wp_error = null;
        self::installWpImporterHead();
    }

    private static function installWpImporterHead()
    {
        if ( isset( $_REQUEST['install-wp-importer'] ) ) {
            check_admin_referer( 'install-wp-importer', 'install-wp-importer' );
        } else {
            return;
        }

        if ( ! is_wp_error( self::$wp_importer_loaded ) && self::$wp_importer_loaded ) {
            return;
        }

        if ( 'needs_activate' != self::$wp_importer_loaded->get_error_data() ) {
            $download = self::downloadPlugin('wordpress-importer');

            if ( is_wp_error( $download ) ) {
                self::$require_plugin_wp_error = $download;
            } else if ( ! $download ) {
                self::$require_plugin_wp_error = new WP_Error('err_download', __('Unknown error, could not download your plugin.', 'gusta-demo'));
            } else {
                wp_cache_delete('plugins', 'plugins');
            }
        }

        if ( ! self::$require_plugin_wp_error && is_wp_error( $activate = activate_plugin( 'wordpress-importer/wordpress-importer.php' ) ) ) {
            self::$require_plugin_wp_error = new WP_Error('activating_plugin', sprintf(
                __('Error occured while trying to activate this plugin: %s', 'gusta-demo'),
                $activate->get_error_message()
            ));
            self::$wp_importer_loaded = self::isImporterAvailable();
        } else {
            remove_action( (self::isNetworkActive() ? 'network_' : '') .'admin_notices', array(__CLASS__, 'wpImportMissingNotice') );
        }

        add_action(( self::isNetworkActive() ? 'network_' : '' ) . 'admin_notices', array(__CLASS__, 'installActivateNotices'));
    }

    static function installActivateNotices()
    {
        if ( isset(self::$require_plugin_wp_error) && is_wp_error(self::$require_plugin_wp_error) ) {
            printf( '<div class="error notice is-dismissible"><p>%s</p></div>', self::$require_plugin_wp_error->get_error_message() );
        } else {
            printf( '<div class="updated notice is-dismissible"><p>%s</p></div>', __('Installed and activated plugin successfully.', 'gusta-demo') );
        }
    }

    private static function isImporterAvailable()
    {
        defined('WP_LOAD_IMPORTERS') || define('WP_LOAD_IMPORTERS', true);
        require_once ABSPATH . 'wp-admin/includes/plugin.php';

        if ( class_exists( '\WP_Import' ) ) {
            return true;
        }
        
        $plugins = get_plugins();
        $wordpress_importer = 'wordpress-importer/wordpress-importer.php';

        if ( isset($plugins[$wordpress_importer]) && ! is_plugin_active($wordpress_importer) ) {
            return new WP_Error('importer-missing', __('WordPress Importer needs to be activated.', 'gusta-demo'), 'needs_activate');
        } else if ( ! isset($plugins[$wordpress_importer]) ) {
            return new WP_Error('importer-missing', __('WordPress Importer needs to be installed.', 'gusta-demo'), 'needs_install');
        } else {
            return true;
        }
    }

    static function installPluginAjax()
    {
        if ( ! current_user_can('manage_options') ) {
            return wp_send_json_error(array(
                'errors' => array( __('You are not permitted to perform this action.', 'gusta-demo') )
            ));
        }

        $plugin_id = isset($_REQUEST['plugin_id']) ? sanitize_text_field($_REQUEST['plugin_id']) : null;

        if ( ! $plugin_id || ! isset( $_REQUEST['install_wp_plugin'] ) || ! wp_verify_nonce($_REQUEST['install_wp_plugin'], 'install-wp-plugin') ) {
            return wp_send_json_error(array(
                'errors' => array( __('Error validating request. Please try again or later.', 'gusta-demo') )
            ));
        }

        if ( ! function_exists('get_plugins') ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugins = get_plugins();
        $plugin_dirs = array_map('dirname', array_keys($plugins));
        $search = array_search($plugin_id, $plugin_dirs);

        if ( is_numeric($search) ) {
            $plugin = array_merge(array_values($plugins)[ $search ], array(
                '_plugin_file' => array_keys($plugins)[$search]
            ));

            if ( ! is_plugin_active( $plugin['_plugin_file'] ) ) {
                $activate = activate_plugin( $plugin['_plugin_file'] );
            }

            if ( ! isset( $activate ) || ! is_wp_error( $activate ) ) {
                return wp_send_json_success(array(
                    'errors' => array( __('Plugin installed and activated successfully.', 'gusta-demo') )
                ));
            } else {
                return wp_send_json_error(array(
                    'errors' => array( sprintf(
                        __('Error occured while trying to activate this plugin: %s', 'gusta-demo'),
                        $activate->get_error_message()
                    ) )
                ));
            }
        }

        $download = self::downloadPlugin($plugin_id);

        if ( is_wp_error( $download ) ) {
            return wp_send_json_error(array(
                'errors' => array( sprintf(
                    __('Error occured while trying to install this plugin: %s', 'gusta-demo'),
                    $download->get_error_message()
                ) )
            ));
        } else if ( ! $download ) {
            return wp_send_json_error(array(
                'errors' => array(__('Unknown error, could not download your plugin.', 'gusta-demo'))
            ));
        } else {
            wp_cache_delete('plugins', 'plugins');
        }

        $plugins = get_plugins();
        $plugin_dirs = array_map('dirname', array_keys($plugins));
        $search = array_search($plugin_id, $plugin_dirs);

        if ( is_numeric($search) ) {
            $plugin = array_merge(array_values($plugins)[ $search ], array(
                '_plugin_file' => array_keys($plugins)[$search]
            ));

            if ( ! is_plugin_active( $plugin['_plugin_file'] ) ) {
                $activate = activate_plugin( $plugin['_plugin_file'] );
            }

            if ( ! isset( $activate ) || ! is_wp_error( $activate ) ) {
                return wp_send_json_success(array(
                    'errors' => array( __('Plugin installed and activated successfully.', 'gusta-demo') )
                ));
            } else {
                return wp_send_json_error(array(
                    'errors' => array( sprintf(
                        __('Error occured while trying to activate this plugin: %s', 'gusta-demo'),
                        $activate->get_error_message()
                    ) )
                ));
            }
        }
    }

    static function verifyPurchaseCodeAjax()
    {
        if ( ! current_user_can('manage_options') ) {
            return wp_send_json_error(array(
                'errors' => array( __('You are not permitted to perform this action.', 'gusta-demo') )
            ));
        }

        $purchase_code = isset($_REQUEST['purchase-code']) ? sanitize_text_field($_REQUEST['purchase-code']) : null;

        self::settings();
        self::$settings['purchase_code'] = $purchase_code;
        self::updateSettings( self::$settings );

        if ( ! $purchase_code || ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce($_REQUEST['nonce'], 'gusta-demo-verify') ) {
            return wp_send_json_error(array(
                'errors' => array( __('Error validating request. Please try again or later.', 'gusta-demo') )
            ));
        }

        $res = wp_remote_get( add_query_arg( 'purchase-code', $purchase_code, App::API_HOST ) );

        if ( filter_var(wp_remote_retrieve_header( $res, 'X-Purchase-Verified' ), FILTER_VALIDATE_BOOLEAN) ) {
            set_transient( "gusta-demo_verified_{$purchase_code}", 1, App::VERIFIED_PURCHASE_CODE_TRANSIENT_EXPIRES );
            return wp_send_json_success(array(
                'errors' => array( __('Your purchase code was successfully verified.', 'gusta-demo') ),
            ));
        } else {
            return wp_send_json_error(array(
                'errors' => array( __('Invalid or expired purchase code.', 'gusta-demo') ),
            ));
        }
    }

    static function importDemoAjax()
    {
        if ( ! current_user_can('manage_options') ) {
            return wp_send_json_error(array(
                'errors' => array( __('You are not permitted to perform this action.', 'gusta-demo') )
            ));
        }

        $demo = isset($_REQUEST['demo']) ? sanitize_text_field($_REQUEST['demo']) : null;

        if ( ! $demo || ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce($_REQUEST['nonce'], 'gusta-demo-import') ) {
            return wp_send_json_error(array(
                'errors' => array( __('Error validating request. Please try again or later.', 'gusta-demo') )
            ));
        }

        self::$wp_importer_loaded = self::isImporterAvailable();

        if ( is_wp_error( self::$wp_importer_loaded ) ) {
            return wp_send_json_error(array(
                'errors' => array( self::$wp_importer_loaded->get_error_message() )
            ));
        } else if ( ! self::$wp_importer_loaded ) {
            return wp_send_json_error(array(
                'errors' => array( 'Error: you must install and activate the default WordPress Importer to import demos.', 'gusta-demo' )
            ));
        } else if ( ! file_exists(trailingslashit(WP_PLUGIN_DIR) . '/wordpress-importer/wordpress-importer.php') ) {
            return wp_send_json_error(array(
                'errors' => array( 'Error: you must install and activate the default WordPress Importer to import demos.', 'gusta-demo' )
            ));
        } else {
            require_once trailingslashit(WP_PLUGIN_DIR) . '/wordpress-importer/wordpress-importer.php';
            if ( ! class_exists('\WP_Import') ) {
                return wp_send_json_error(array(
                    'errors' => array( 'Error: you must install and activate the default WordPress Importer to import demos.', 'gusta-demo' )
                ));
            }
        }

        $download = App::downloadURL(add_query_arg(array(
            'purchase-code' => self::getSetting('purchase_code'),
            'download' => $demo
        ), App::API_HOST));

        if ( is_wp_error( $download ) ) {
            $response = $download->get_error_data();
            $response = isset($response['response']) && $response['response'] ? $response['response'] : null;
            $errors = $response ? explode('|', wp_remote_retrieve_header( $response, 'X-Error-Messages' )) : array();
            $errors = array_map('trim', array_filter($errors));
            $errors []= $download->get_error_message();

            if ( isset($download['path']) && file_exists($download['path']) ) {
                @unlink($download['path']);
            }

            return wp_send_json_error(array(
                'errors' => array_map(function($error){
                    return sprintf(__('Downloading demo ended with an error: %s.', 'gusta-demo'), $error);
                }, $errors)
            ));
        } else {
            $requires = wp_remote_retrieve_header( $download['response'], 'X-Requires-Plugins' );
            $requires = array_map('trim', explode(',', $requires));
            $requires = array_filter( array_unique( $requires ) );

            if ( 0 && ! self::checkMimeContentType($download['path'], 'application/xml', 'xml') ) {
                @unlink($download['path']);

                return wp_send_json_error(array(
                    'errors' => array( __('Error occured: invalid import downloaded.', 'gusta-demo') )
                ));
            }

            if ( $requires && ! isset( $_REQUEST['skip_plugins'] ) ) {
                if ( ! function_exists('get_plugins') ) {
                    require_once ABSPATH . 'wp-admin/includes/plugin.php';
                }

                $plugins = get_plugins();
                $plugin_dirs = array_map('dirname', array_keys($plugins));

                $requires = array_combine($requires, array_map(function($plugin) use ($plugin_dirs, $plugins){
                    $search = array_search($plugin, $plugin_dirs);

                    if ( is_numeric($search) && isset($plugin_dirs[$search]) && $plugin_dirs[$search] ) {
                        $plugin = array_merge(array_values($plugins)[ $search ], array(
                            '_plugin_file' => array_keys($plugins)[$search],
                            'installed' => true,
                            'activated' => is_plugin_active(array_keys($plugins)[$search]),
                            'wporg_id' => $plugin,
                        ));
                    } else {
                        $plugin = array(
                            'Name' => $plugin,
                            'installed' => false,
                            'activated' => false,
                            'wporg_id' => $plugin,
                        );
                    }

                    return $plugin;
                }, $requires));

                if ( $requires ) {
                    @unlink($download['path']);

                    return wp_send_json_success(array(
                        'plugins' => $requires
                    )); 
                }
            }

            if ( ! isset($_REQUEST['skip_plugins']) ) {
                return wp_send_json_success(array(
                    'plugins' => array()
                )); 
            }

            defined('IMPORT_DEBUG') || define('IMPORT_DEBUG', defined('WP_DEBUG') && WP_DEBUG);

            add_filter('wp_import_existing_post', '__return_false');

            $import = new Import;
            ob_start();
            $import->import( $download['path'] );
            $out = ob_get_clean();
            @unlink($download['path']);

            return wp_send_json_success(array(
                'output' => wpautop($out)
            ));
        }
    }

    static function isCurrentPurchaseKeyVerified()
    {
        if ( $purchase_code = self::getSetting('purchase_code') ) {
            return (bool) get_transient( "gusta-demo_verified_{$purchase_code}" );
        }
    }

    private static function mimeContentType($path)
    {
        if ( function_exists('mime_content_type') ) {
            return mime_content_type( $path );
        } else if ( class_exists('\finfo') ) {
            $info = new \finfo;
            return $info->file($path, FILEINFO_MIME_TYPE);
        }
    }

    private static function checkMimeContentType($path, $types=null, $extensions=null)
    {
        $types = array_map('strtolower', (array) $types);
        $extensions = array_map('strtolower', (array) $extensions);

        if ( $type = strtolower( self::mimeContentType( $path ) ) ) {
            return in_array($type, $types);
        } else if ( $extensions ) {
            $ext = strtolower( pathinfo($path, PATHINFO_EXTENSION) );
            return in_array($ext, $extensions);
        }
    }
}