<?php
/**
 * Huger for Elementor
 * Customizable mega menu for Elementor editor
 * Exclusively on https://1.envato.market/huger-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.0
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design), Cherviakov Vlad (vladchervjakov@gmail.com)
 * @support         help@merkulov.design
 **/

namespace Merkulove\HugerElementor;

use Merkulove\HugerElementor\Unity\Plugin;
use Merkulove\HugerElementor\Unity\Settings;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Settings class used to modify default plugin settings.
 *
 * @since 1.0.0
 *
 **/
final class Config {

	/**
	 * The one true Settings.
	 *
     * @since 1.0.0
     * @access private
	 * @var Config
	 **/
	private static $instance;

    /**
     * Prepare plugin settings by modifying the default one.
     *
     * @since 1.0.0
     * @access public
     *
     * @return void
     **/
    public function prepare_settings() {

        /** Get default plugin settings. */
        $tabs = Plugin::get_tabs();

        /** Special config for Elementor plugins. */
        unset( $tabs['general'] );

        /** Set updated tabs. */
        Plugin::set_tabs( $tabs );

        /** Refresh settings. */
        Settings::get_instance()->get_options();

    }

	/**
	 * Main Settings Instance.
	 * Insures that only one instance of Settings exists in memory at any one time.
	 *
	 * @static
     * @since 1.0.0
     * @access public
     *
	 * @return Config
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

}
