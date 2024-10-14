<?php
/*
* Smart Sections Init
*
* @file           init.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

define('GUSTA_THEME_MODE', false);
define('THEME_MODE', false);

if (file_exists(get_theme_file_path().'/smart-sections/includes/theme-compatibility.php')): include( get_theme_file_path().'/smart-sections/includes/theme-compatibility.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/theme-compatibility.php'); endif;

$header_selector = gusta_get_theme_var('header');
$content_selector = gusta_get_theme_var('content');
$footer_selector = gusta_get_theme_var('footer');

if(!function_exists('gusta_textdomain')):
	function gusta_textdomain() {
	  load_theme_textdomain( 'mb_framework', SMART_SECTIONS_PLUGIN_PATH . 'languages' );
	}
	add_action( 'after_setup_theme', 'gusta_textdomain' );
endif;

//if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
if ( defined( 'WPB_VC_VERSION' ) && !isset($_GET["et_fb"]) ):

  if (file_exists(get_theme_file_path().'/smart-sections/init/get-post-type.php')): include( get_theme_file_path().'/smart-sections/init/get-post-type.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/get-post-type.php'); endif;
  
  if (file_exists(get_theme_file_path().'/smart-sections/init/get-template.php')): include( get_theme_file_path().'/smart-sections/init/get-template.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/get-template.php'); endif;
  
  if (file_exists(get_theme_file_path().'/smart-sections/includes/php.php')): include( get_theme_file_path().'/smart-sections/includes/php.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/php.php'); endif;
  if( ! class_exists('ACF') ) :
	if (file_exists(get_theme_file_path().'/smart-sections/includes/acf.php')): include( get_theme_file_path().'/smart-sections/includes/acf.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/acf.php'); endif;
  endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/wp.php')): include( get_theme_file_path().'/smart-sections/includes/wp.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/wp.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/toolbar.php')): include( get_theme_file_path().'/smart-sections/includes/toolbar.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/toolbar.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/mega-menu.php')): include( get_theme_file_path().'/smart-sections/includes/mega-menu.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/mega-menu.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/navwalker.php')): include( get_theme_file_path().'/smart-sections/includes/navwalker.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/navwalker.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/enqueue.php')): include( get_theme_file_path().'/smart-sections/includes/enqueue.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/enqueue.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/fonts.php')): include( get_theme_file_path().'/smart-sections/includes/fonts.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/fonts.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/vc.php')): include( get_theme_file_path().'/smart-sections/includes/vc.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/vc.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/option-pages.php')): include( get_theme_file_path().'/smart-sections/includes/option-pages.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/option-pages.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/register.php')): include( get_theme_file_path().'/smart-sections/includes/register.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/register.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/option-fields.php')): include( get_theme_file_path().'/smart-sections/includes/option-fields.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/option-fields.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/options.php')): include( get_theme_file_path().'/smart-sections/includes/options.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/options.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/sections.php')): include( get_theme_file_path().'/smart-sections/includes/sections.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/sections.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/css.php')): include( get_theme_file_path().'/smart-sections/includes/css.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/css.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/excerpt.php')): include( get_theme_file_path().'/smart-sections/includes/excerpt.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/excerpt.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/image.php')): include( get_theme_file_path().'/smart-sections/includes/image.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/image.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/author.php')): include( get_theme_file_path().'/smart-sections/includes/author.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/author.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/social.php')): include( get_theme_file_path().'/smart-sections/includes/social.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/social.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/js.php')): include( get_theme_file_path().'/smart-sections/includes/js.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/js.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/widget.php')): include( get_theme_file_path().'/smart-sections/includes/widget.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/widget.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/auto-suggest.php')): include( get_theme_file_path().'/smart-sections/includes/auto-suggest.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/auto-suggest.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/load-more.php')): include( get_theme_file_path().'/smart-sections/includes/load-more.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/load-more.php'); endif;
  if (file_exists(get_theme_file_path().'/smart-sections/includes/update-cart.php')): include( get_theme_file_path().'/smart-sections/includes/update-cart.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'includes/update-cart.php'); endif;
  include( SMART_SECTIONS_PLUGIN_PATH . 'includes/one-click-demo-import/one-click-demo-import.php');

  //include( SMART_SECTIONS_PLUGIN_PATH . 'includes/demo-importer/gusta-demo.php');

  if (file_exists(get_theme_file_path().'/smart-sections/init/activation.php')): include( get_theme_file_path().'/smart-sections/init/activation.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/activation.php'); endif;
  
  if (file_exists(get_theme_file_path().'/smart-sections/init/shortcode-mappers.php')): include( get_theme_file_path().'/smart-sections/init/shortcode-mappers.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/shortcode-mappers.php'); endif;
  
  if (!is_admin()):
	  
	if (file_exists(get_theme_file_path().'/smart-sections/init/full-width-function.php')): include( get_theme_file_path().'/smart-sections/init/full-width-function.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/full-width-function.php'); endif;

	if (file_exists(get_theme_file_path().'/smart-sections/init/buffer-output.php')): include( get_theme_file_path().'/smart-sections/init/buffer-output.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/buffer-output.php'); endif;
	  
  endif;
else:
  
  if (file_exists(get_theme_file_path().'/smart-sections/init/wpbakery-admin-notice.php')): include( get_theme_file_path().'/smart-sections/init/wpbakery-admin-notice.php'); else: include( SMART_SECTIONS_PLUGIN_PATH . 'init/wpbakery-admin-notice.php'); endif;
  
endif;
?>