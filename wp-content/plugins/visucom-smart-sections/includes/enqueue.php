<?php
/*
* Enqueue Functions
*
* @file           includes/enqueue.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.7
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Enqueue Scripts */
if ( !function_exists( 'gusta_enqueue_scripts' ) ):
	function gusta_enqueue_scripts() {
		global $post;
		
		wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js', array( 'jquery' ), true );
		wp_register_script( 'easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.min.js', array( 'jquery' ), true);
		wp_register_script( 'loop', SMART_SECTIONS_PLUGIN_URL . 'assets/js/loop.js', array( 'jquery' ), true );
		wp_register_script( 'salvattore', SMART_SECTIONS_PLUGIN_URL . 'assets/js/salvattore.min.js', array( 'jquery' ), true );
		wp_register_script( 'owl-carousel-ss', SMART_SECTIONS_PLUGIN_URL . 'assets/js/owl.carousel.min.js', array( 'jquery' ), true );
		wp_register_script( 'smart-sections', SMART_SECTIONS_PLUGIN_URL . 'assets/js/scripts.js', array( 'jquery' ), '1.6.5', true );
		
		//  enqueue the scripts:
		wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'easing' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ):
			wp_enqueue_script( 'comment-reply' );
		endif;
		
		wp_enqueue_script( 'smart-sections' );
		wp_localize_script( 'smart-sections', 'smart_sections', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		
		/* Adobe Typekit */
		$typekit_id = get_option('options_gusta_adobe_typekit_kit_id');
		if ($typekit_id):
			wp_enqueue_script( 'AdobeTypekit', 'https://use.typekit.net/'.$typekit_id.'.js', '', true );
			wp_add_inline_script( 'AdobeTypekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		endif;
	}
	add_action( 'wp_enqueue_scripts', 'gusta_enqueue_scripts' );
endif;

/* Enqueue Styles */
if ( !function_exists( 'gusta_enqueue_styles' ) ):
	function gusta_enqueue_styles() {		
		//Enqueue Google Fonts
		$fonts = get_option('options_gusta_google_fonts');
		if ($fonts):
			$query_args = array();
			$query_args['family'] = '';
			$query_args['subset'] = 'latin';
			$f=0;
			foreach ($fonts as $font):
				$count_fonts = count($fonts);
				$f++;
				$query_args['family'] .= str_replace(' ','+',$font).':';
				$variants = get_option('options_font_variants_'.$font);
				if (get_option('options_gusta_google_api_key')):
					if ($variants):
						$count_vars = count($variants);
						$v=0;
						foreach ($variants as $variant):
							$v++;
							$query_args['family'] .= $variant;
							$query_args['family'] .= ( $v != $count_vars ? ',' : '' );
						endforeach;
					else:
						$query_args['family'] .= '100,200,300,400,500,600,700,800,900';
					endif;
					$subsets = get_option('options_font_subsets_'.$font);
					if ($subsets):
						$count_subs = count($subsets);
						$s=0;
						foreach ($subsets as $subset):
							if (strpos($query_args['subset'], $subset) === false):
								$s++;
								$query_args['subset'] .= ','.$subset;
							endif;
						endforeach;
					endif;
				else:
					$query_args['family'] .= '100,200,300,400,500,600,700,800,900';
				endif;
				$query_args['family'] .= ( $f != $count_fonts ? '|' : '' );
			endforeach;
			wp_register_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
			wp_enqueue_style( 'google-fonts' );
		endif;
		
		// Register the styles for the plugin:
		wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		wp_register_style( 'owl-carousel-ss', SMART_SECTIONS_PLUGIN_URL . 'assets/css/owl.carousel.min.css', array(), '2.3.4', 'all' );
		wp_register_style( 'smart-sections', SMART_SECTIONS_PLUGIN_URL . 'assets/css/style.css', array(), '1.6.8', 'all' );
		//wp_register_style( 'smart-sections-dynamic', SMART_SECTIONS_PLUGIN_URL . 'assets/css/dynamic.css', array(), '1.0.1', 'all' );
		
		//  enqueue the styles:
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'smart-sections' );
		if (get_option('gusta_save_css')==1):
			wp_enqueue_style( 'smart-sections-dynamic' );
		endif;
		
	}
	add_action( 'wp_enqueue_scripts', 'gusta_enqueue_styles', 9999 );
endif;


/**************************


ADMIN


***************************/

/* Add Admin Styles and Scripts*/
if ( !function_exists( 'gusta_enqueue_admin_styles' ) ):
	function gusta_enqueue_admin_styles() {
		wp_register_style( 'gusta-admin-styles', SMART_SECTIONS_PLUGIN_URL . 'assets/admin/css/admin_style.css', array(), '1.6.1', 'all' );
		wp_register_style( 'bootstrap-colorpicker', SMART_SECTIONS_PLUGIN_URL . 'assets/admin/css/bootstrap-colorpicker.min.css', array(), '1.0.0', 'all' );

		wp_register_script( 'gusta-admin-scripts', SMART_SECTIONS_PLUGIN_URL . 'assets/admin/js/admin_scripts.js', array( 'jquery' ), true );
		wp_register_script( 'bootstrap-colorpicker', SMART_SECTIONS_PLUGIN_URL . 'assets/admin/js/bootstrap-colorpicker.min.js', array( 'jquery' ), true );
		
		wp_enqueue_style( 'bootstrap-colorpicker' );
		wp_enqueue_style( 'gusta-admin-styles' );

		$screen = get_current_screen();
		if ($screen->base=='post' || strpos($screen->base, 'gusta') !== false):
			wp_enqueue_script( 'bootstrap-colorpicker' );
			wp_enqueue_script( 'gusta-admin-scripts' );
		endif;
	}
	add_action( 'admin_enqueue_scripts', 'gusta_enqueue_admin_styles' );
endif;