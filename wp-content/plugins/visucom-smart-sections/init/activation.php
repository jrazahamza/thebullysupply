<?php
/*
* Smart Sections Init
*
* @file           init/activation.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

if(!function_exists('gusta_activation')):
    function gusta_activation() {
      add_option( 'gusta_extraction_length', '255', '', 'yes' );
    }
    register_activation_hook( __FILE__, 'gusta_activation' );
  endif;
?>