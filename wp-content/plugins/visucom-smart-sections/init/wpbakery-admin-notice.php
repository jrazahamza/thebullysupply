<?php
/*
* Smart Sections Init
*
* @file           init/wpbakery-admin-notice.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

if(!function_exists('gusta_admin_notice_warning')):
    //Visual Composer requirement notice
    function gusta_admin_notice_warning() {
      $class = 'notice notice-warning';
      $message = __( 'The Smart Sections plugin only works if the WPBakery Page Builder plugin is installed and activated.', 'mb_framework' );

      printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }
    add_action( 'admin_notices', 'gusta_admin_notice_warning' );
  endif;
?>