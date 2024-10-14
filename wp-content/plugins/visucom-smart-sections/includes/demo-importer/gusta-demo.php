<?php
/*
Plugin Name: Gusta Demo
Plugin URI: http://elhardoum.com/work-with-me
Description: Gusta Theme Demos.
Author: Samuel Elh
Version: 0.1
Author URI: http://elhardoum.com/work-with-me
License: GPLv3
Text Domain: gusta-demo
*/

if ( ! defined ( 'WPINC' ) ) {
    exit; // direct access
}

if ( ! function_exists('gdem_init') ) {
    function gdem_init() {
        require_once __DIR__ . '/src/vendor/autoload.php';
        GustaDemo\App::setPluginFile(__FILE__)->init();
    }
}
if ( ! class_exists('CompatCheckWP') ) {
    require_once __DIR__ . '/src/wp-php-compat-check/wp-php-compat-check.php';
}

CompatCheckWP::check(array(
    'php_version' => '5.3.2',
    'deactivate_incompatible' => true,
))->then('gdem_init');