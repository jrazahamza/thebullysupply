<?php

namespace GustaDemo;

use WP_Error;

class App
{
    protected static $plugin_file, $basename;
    protected static $ins = null;

    const VERSION = 0.1;
    const API_HOST = 'https://www.themegusta.com/demo-import/index.php';
    const VERIFIED_PURCHASE_CODE_TRANSIENT_EXPIRES = DAY_IN_SECONDS;

    static function instance()
    {
        return null == self::$ins ? new self : self::$ins;
    }

    static function setPluginFile($file)
    {
        self::$plugin_file = $file;
        return self::instance();
    }

    static function init()
    {
        add_action('plugins_loaded', array(self::instance(), 'loaded'));

        if ( is_admin() ) {
            Admin::init();
        }
    }

    static function loaded()
    {
        load_plugin_textdomain( 'gusta-demo', false, basename( dirname( __FILE__ ) ) . '/languages' );
        add_action('init', array(__CLASS__, 'registerSectionsPT'));
    }

    static function getPluginFile()
    {
        return self::$plugin_file;
    }

    static function getBasename()
    {
        if ( ! isset( self::$basename ) ) {
            self::$basename = plugin_basename( self::$plugin_file );
        }

        return self::$basename;
    }

    static function registerSectionsPT()
    {
        /*$labels = array(
            'name' => __('Smart Sections', 'gusta-demo'),
            'singular_name' => __('Section', 'gusta-demo'),
            'add_new' => __('Add New', 'gusta-demo'),
            'add_new_item' => __('Add New Section', 'gusta-demo'),
            'edit_item' => __('Edit Section', 'gusta-demo'),
            'new_item' => __('New Section', 'gusta-demo'),
            'view_item' => __('View Section', 'gusta-demo'),
            'search_items' => __('Search Sections', 'gusta-demo'),
            'not_found' =>  __('Nothing found', 'gusta-demo'),
            'not_found_in_trash' => __('Nothing found in Trash', 'gusta-demo'),
            'parent_item_colon' => ''
        );
     
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'query_var' => false,
            'menu_icon' => (defined('SMART_SECTIONS_PLUGIN_URL') ? SMART_SECTIONS_PLUGIN_URL : '') . 'assets/admin/img/smart-sections-adminmenu-icon.png',
            'exclude_from_search' => true,
            'show_in_nav_menus' => false,
            'rewrite' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 20,
            'supports' => array('title','editor','revisions','custom-fields')
        ); 
     
        return register_post_type('gusta_section', $args);*/
    }

    static function downloadURL( $url, $timeout = 300 )
    {
        //WARNING: The file is not automatically deleted, The script must unlink() the file.
        if ( ! $url )
            return new WP_Error('http_no_url', __('Invalid URL Provided.'));

        $url_filename = basename( parse_url( $url, PHP_URL_PATH ) );

        if ( ! function_exists('wp_tempnam') ) {
            if ( file_exists(ABSPATH . '/wp-admin/includes/file.php') ) {
                require_once ABSPATH . '/wp-admin/includes/file.php';
            } else {
                return new WP_Error('env_error', __('Internal server error.'));
            }
        }

        if ( ! $tmpfname = wp_tempnam( $url_filename ) )
            return new WP_Error('http_no_file', __('Could not create Temporary file.'));

        $tmpfnameo = $tmpfname;
        $tmpfname = preg_replace('/\.tmp$/i', '.xml', $tmpfname);

        $response = wp_safe_remote_get( $url, array( 'timeout' => $timeout, 'stream' => true, 'filename' => $tmpfname ) );

        if ( is_wp_error( $response ) ) {
            @unlink($tmpfname); @unlink($tmpfnameo);
            return $response;
        }

        if ( 200 != wp_remote_retrieve_response_code( $response ) ){
            @unlink($tmpfname); @unlink($tmpfnameo);
            return new WP_Error('http_404', trim( wp_remote_retrieve_response_message( $response ) ), array(
                'response' => $response
            ));
        }

        $content_md5 = wp_remote_retrieve_header( $response, 'content-md5' );
        if ( $content_md5 ) {
            $md5_check = verify_file_md5( $tmpfname, $content_md5 );
            if ( is_wp_error( $md5_check ) ) {
                @unlink($tmpfname); @unlink($tmpfnameo);
                return $md5_check;
            }
        }

        @unlink($tmpfnameo);

        return array('path' => $tmpfname, 'response' => $response);
    }

    static function url($after=null)
    {
        return plugin_dir_url(App::getPluginFile()) . preg_replace('/^\//', '', $after);
    }
}
