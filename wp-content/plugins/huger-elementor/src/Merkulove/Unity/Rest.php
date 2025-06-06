<?php
/**
 * Huger for Elementor
 * Customizable mega menu for Elementor editor
 * Exclusively on https://1.envato.market/huger-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.9
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design), Cherviakov Vlad (vladchervjakov@gmail.com)
 * @support         help@merkulov.design
 **/

namespace Merkulove\HugerElementor\Unity;

use WP_REST_Server;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/**
 * Class adds admin js scripts.
 *
 * @since 1.0.0
 *
 **/
final class Rest {

	/**
	 * The one true Rest.
	 * @var Rest
	 **/
	private static $instance;

	/**
	 * Sets up a new REST instance.
	 * @access public
	 **/
	private function __construct() {

		add_action( 'rest_api_init', function () {

			register_rest_route(

				untrailingslashit( 'huger-elementor/v2' ),
				'/(?P<action>\w+)/',
				array(
					'methods' => WP_REST_Server::ALLMETHODS,
					'callback' => [ $this, 'callback' ],
					'permission_callback' => '__return_true',
				)
			);

		} );

	}

	/**
	 * Rest callback
	 *
	 * @param $params
	 *
	 * @return void
	 */
	public function callback( $params ) {

		$action = $params[ 'action' ] ?? '';

		// Prepare url
		$url = wp_sprintf(
			'https://merkulove.host/wp-json/mdp/v2/%s?plugin=huger-elementor&name=%s&mail=%s&domain=%s',
			$action,
			$params[ 'name' ] ?? '',
			$params[ 'mail' ] ?? '',
            $this->clear_url()
		);

		switch ( $action ) {

			case 'subscribe':
				$remote = wp_remote_get( $url, $this->get_ssl_args() );
				$body = $remote[ 'body' ] ?? array();
				echo json_encode( $body );
				break;

			default:
				break;

		}

	}

	/**
	 * Prepare args for cURL request
	 * @return array
	 */
	private function get_ssl_args() {

		return [
			'timeout'    => 30,
			'user-agent' => 'huger-elementor-user-agent',
			'sslverify'  => Settings::get_instance()->options[ 'check_ssl' ] === 'on'
		];

	}

    /**
     * Make url safe for queries
     * @return array|string|string[]
     */
    private function clear_url() {

        $protocols  = array( 'http://', 'http://www.', 'https://', 'https://www.', 'www.' );
        $url        = str_replace( $protocols, '', get_site_url() );

        return str_replace( '/', '-', $url );

    }

	/**
	 * Main Rest Instance.
	 * Insures that only one instance of Rest exists in memory at any one time.
	 *
	 * @static
	 * @return Rest
	 **/
	public static function get_instance() {

        /** @noinspection SelfClassReferencingInspection */
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Rest ) ) {

			self::$instance = new Rest;

		}

		return self::$instance;

	}

}
