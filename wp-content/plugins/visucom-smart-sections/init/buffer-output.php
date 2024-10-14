<?php
/*
* Smart Sections Init
*
* @file           init/buffer-output.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

if (GUSTA_THEME_MODE==false):

	$gusta_get_header_with_js=false;

	//Writes the header section to dom
	if(!function_exists('gusta_header_buffer_output')):
	  function gusta_header_buffer_output(){
		global $gusta_get_header_with_js;
		$get_me_buffers = ob_get_clean();

		ob_start();

		$header_sections ='';
		$gusta_header_sections = get_gusta_option('gusta_header_sections', gusta_get_template(), 'section');

		if ($gusta_header_sections):

		  $header_sections .= '<div id="gusta-header-container" role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';

		  if ($gusta_header_sections): $header_sections .= '<div id="gusta-header">' . gusta_show_sections ( $gusta_header_sections , 'header-section' ) . '</div>'; endif;

		  $header_sections .= '</div>';

		  //echo $header_sections;

		  if (gusta_theme_name()=='jupiter'):
			echo str_replace ('<div id="top-of-page"></div>', '<div id="top-of-page"></div>' . $header_sections, $get_me_buffers);
		  else:
			$pattern ='/<[bB][oO][dD][yY]\s[A-Za-z]{2,5}[A-Za-z0-9 "_=\-\.]+>|<body>/';
			if(preg_match($pattern, $get_me_buffers, $get_me_buffers_return)):
			  if ($get_me_buffers_return[0]):
				$d_new_body_plus =$get_me_buffers_return[0].$header_sections;
				echo preg_replace($pattern, $d_new_body_plus, $get_me_buffers);
			  else:
				$gusta_get_header_with_js=true;
			  endif;
			else:
			  $gusta_get_header_with_js=true;
			  echo $get_me_buffers;
			endif;
		  endif;
		else:
		  echo $get_me_buffers;
		endif;
		ob_flush();
	  }
	  add_action( 'wp_footer', 'gusta_header_buffer_output');
	endif;

	//Writes the rest of the sections to dom
	if(!function_exists('gusta_add_footer')):
	  function gusta_add_footer() { 
		global $gusta_get_header_with_js;
		if (!(is_preview() && (get_post_type()=="gusta_section"))):
		  $output = '';
		  if ($gusta_get_header_with_js):
			$gusta_header_sections = get_gusta_option('gusta_header_sections', gusta_get_template(), 'section');
			if ($gusta_header_sections):            
			  $header_sections = '<div id="gusta-header-container" role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
			  if ($gusta_header_sections): $header_sections .= '<div id="gusta-header">' . gusta_show_sections ( $gusta_header_sections , 'header-section' ) . '</div>'; endif;
			  $header_sections .= '</div>';
			  $output .= $header_sections;
			endif;
		  endif;
		  $gusta_above_content_sections = get_gusta_option('gusta_above_content_sections', gusta_get_template(), 'section');
		  if ($gusta_above_content_sections):
			$output .= '<div id="gusta-above-content">' . gusta_show_sections ( $gusta_above_content_sections , 'custom-section' ) . '</div>';
		  endif;
		  if (is_archive() || is_post_type_archive() || is_search() || is_home()):
			$gusta_archive_sections = get_gusta_option('gusta_archive_sections', gusta_get_template(), 'section');
			if ($gusta_archive_sections):
			  $output .= '<div id="gusta-archive">' . gusta_show_sections ( $gusta_archive_sections, 'custom-section' ) . '</div>';
			endif;
		  else:
			$gusta_content_sections = get_gusta_option('gusta_content_sections', gusta_get_template(), 'section');
			if ($gusta_content_sections):
			  $output .= '<div id="gusta-content"';
  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): 
		  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
		  	if (is_product()): $output .= ' class="product"'; endif; endif;
		  endif;
  $output .= '>' . gusta_show_sections ( $gusta_content_sections, 'custom-section' ) . '</div>';
			endif;
		  endif;
		  $gusta_below_content_sections = get_gusta_option('gusta_below_content_sections', gusta_get_template(), 'section');
		  if ($gusta_below_content_sections):
			$output .= '<div id="gusta-below-content">' . gusta_show_sections ( $gusta_below_content_sections, 'custom-section' ) . '</div>';
		  endif;
		  $gusta_footer_sections = get_gusta_option('gusta_footer_sections', gusta_get_template(), 'section');
		  if ($gusta_footer_sections):
			$output .= '<div id="gusta-footer" role="contentInfo" itemscope="itemscope" itemtype="https://schema.org/WPFooter">' . gusta_show_sections ( $gusta_footer_sections, 'footer-section' ) . '</div>';
		  endif;
		  $gusta_sticky_sections = get_gusta_option('gusta_sticky_sections', gusta_get_template(), 'section');
		  if ($gusta_sticky_sections):
			$output .= '<div id="gusta-sticky">' . gusta_show_sections ( $gusta_sticky_sections, 'custom-section' ) . '</div>';
		  endif;
		else:
		  $output = '<div id="gusta_preview"><div class="'.gusta_get_theme_var('container').'">' . do_shortcode(get_the_content()) . '</div></div>';
		endif;
		echo $output;
	  }
	  add_action( 'wp_footer', 'gusta_add_footer' );
	endif;

  endif;
?>