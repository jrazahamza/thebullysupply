<?php
/*
* Visual Composer Theme Compatibility
*
* @file           includes/theme-compatibility.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

/* Check the current theme slug */
if(!function_exists('gusta_theme_name')):
	function gusta_theme_name() {
		$theme_name = str_replace( get_bloginfo( 'url' ).'/wp-content/themes/', '', get_bloginfo( 'stylesheet_directory' ));
		return $theme_name;
	}
endif;

/* Outputs the default header, content and footer area CSS selectors and the grid container class, some themes have been added for theme compatibility to change these selectors */
if(!function_exists('gusta_get_theme_var')):
	function gusta_get_theme_var ($area) {
		$theme_var['header'] = 'header'; /* Header Container Selector */
		$theme_var['content'] = '#main-body'; /* Content Container Selector (Excluding the Sidebar) */
		$theme_var['footer'] = 'footer'; /* Footer Container Selector */
		$theme_var['container'] = 'container'; /* Grid Container Class (Excluding # or .)*/
		$theme_var['extra_css'] = '';
		
		if (GUSTA_THEME_MODE==false):
		
			$theme_name = gusta_theme_name();
			
			switch ($theme_name):
				case "twentyseventeen":
					$theme_var['content'] = '#primary';
					$theme_var['container'] = 'wrap';
					$theme_var['extra_css'] = '.wrap { width: 100%; }';
				break;
				case "twentysixteen":
					$theme_var['content'] = '#primary';
					$theme_var['container'] = 'site-content';
					$theme_var['extra_css'] = '.site-content { max-width: 1320px; margin: 0 auto; }';
				break;
				case "understrap":
					$theme_var['content'] = '#primary';
					$theme_var['header'] = '#wrapper-navbar';
					$theme_var['footer'] = '#wrapper-footer';
				break;
				case "thegem":
					$theme_var['content'] = '#main-content';
					$theme_var['header'] = '#site-header-wrapper, #top-area';
					$theme_var['footer'] = '#footer-nav';
					$theme_var['extra_css'] = '.gusta-section .vc_row { margin-bottom: 0; } .wpb_row, .wpb_row > * { margin-top: 0; }';
				break;
				case "salient":
					$theme_var['content'] = '.main-content';
					$theme_var['header'] = '#header-outer, #header-space';
					$theme_var['footer'] = '#footer-outer';
					$theme_var['extra_css'] = '.wpb_row, .wpb_content_element { margin-bottom: 0; } .container-wrap, .project-title { margin-top: -24px; padding-top: 60px; z-index: 9; .gusta-mega-menu .container { width: initial !important; padding: initial !important; } }';
				break;
				case "houzez":
					$theme_var['content'] = '.container-contentbar';
				break;
				case "Total":
					$theme_var['header'] = '#site-header-sticky-wrapper';
				break;
				case "soledad":
					$theme_var['content'] = '#main';
				break;
				case "flatsome":
					$theme_var['content'] = '.content-area';
				break;
				case "oshin":
					$theme_var['content'] = '#page-content';
					$theme_var['container'] = 'be-wrap';
				break;
				case "Impreza":
					$theme_var['content'] = '.l-main';
					$theme_var['extra_css'] = '.l-section-h { padding-top: 0; padding-bottom: 0; }';
				break;
				case "ronneby":
					$theme_var['header'] = '#header-container';
					$theme_var['content'] = '#main-content';
					$theme_var['footer'] = '#footer';
				break;
				case "thimpress":
					$theme_var['content'] = '#main';
				break;
				case "publisher":
					$theme_var['content'] = '#content-column';
				break;
				case "brooklyn":
					$theme_var['extra_css'] = 'header .container, footer .container { padding: 0 20px !important; }';
				break;
				case "porto":
					$theme_var['header'] = '.header-wrapper';
					$theme_var['content'] = '.main-content';
					$theme_var['footer'] = '.footer-wrapper';
				break;
				case "rehub":
					$theme_var['content'] = '.main-side';
					$theme_var['extra_css'] = '@media screen and (min-width : 1141px) and (max-width : 1279px) { header .container, footer .container { max-width: 1080px !important; } }';
				break;
				case "smart-mag":
					$theme_var['header'] = '#main-head';
					$theme_var['content'] = '.main-content';
					$theme_var['container'] = 'wrap';
				break;
				case "visual-composer-starter":
					$theme_var['content'] = '.main-content';
					$theme_var['container'] = 'container';
				break;
				case "jupiter":
					$theme_var['content'] = '#mk-theme-container';
					$theme_var['footer'] = '#mk-footer';
					$theme_var['container'] = 'mk-grid';
					$theme_var['extra_css'] = 'div.vc_row[data-mk-full-width] { overflow: initial !important; } .mk-grid.vc_row { margin-right: 0; margin-left: 0; } @media screen and (max-width: 767px) { .vc_col-sm-12 { width: 100%; }';
				break;
				case "bridge":
					$theme_var['content'] = '.wrapper';
					$theme_var['container'] = 'container_inner';
					$theme_var['extra_css'] = '#gusta-header-container { z-index: 1001; } .section-sticky { z-index: 1002; } .full_section_inner { width: 100%; display: block; box-sizing: border-box; }';
				break;
				case "dt-the7":
					$theme_var['header'] = '.masthead, .mobile-header-space, .masthead, .dt-close-mobile-menu-icon, .dt-mobile-header';
					$theme_var['content'] = '#main';
					$theme_var['container'] = 'wf-wrap';
					$theme_var['extra_css'] = '.gusta-section .wf-wrap { padding: 0 50px; width: 1300px; } ';
				break;
		case "dt-the7-child":
					$theme_var['header'] = '.masthead, .mobile-header-space, .masthead, .dt-close-mobile-menu-icon, .dt-mobile-header';
					$theme_var['content'] = '#main';
					$theme_var['container'] = 'wf-wrap';
					$theme_var['extra_css'] = '.gusta-section .wf-wrap { padding: 0 50px; width: 1300px; } ';
				break;
				case "tm-beans":
					$theme_var['content'] = '.tm-main';
					$theme_var['container'] = 'uk-container uk-container-center';
					$theme_var['extra_css'] = '';
				break;
				case "kalium":
					$theme_var['content'] = '#main-wrapper';
					$theme_var['container'] = 'container';
					$theme_var['extra_css'] = '#main-wrapper { z-index: 0; } .container .row-container { width: 100% !important; margin: 0 !important; }';
				break;
				case "bimber":
					$theme_var['header'] = '.g1-header, .g1-preheader, .g1-navbar';
					$theme_var['content'] = '#page';
					$theme_var['container'] = 'g1-row-inner';
					$theme_var['extra_css'] = '';
				break;
				case "Avada":
					$theme_var['content'] = '#main';
					$theme_var['footer'] = '.fusion-footer';
					$theme_var['container'] = 'fusion-row';
					$theme_var['extra_css'] = '[class*="gusta-"] .fusion-row { max-width: 1100px; }';
				break;
				case "betheme":
					$theme_var['header'] = '#Header_wrapper';
					$theme_var['content'] = '#Content';
					$theme_var['footer'] = '#Footer';
					$theme_var['container'] = 'section_wrapper';
					$theme_var['extra_css'] = '[class*="gusta-"] .wpb_wrapper > div { margin-bottom: 0; }';
				break;
				case "stack":
					$theme_var['header'] = '.nav-container';
					$theme_var['content'] = '.main-container';
					$theme_var['extra_css'] = '[class*="gusta-"] .vc_row { margin-left: -15px; margin-right: -15px; } [class*="gusta-"] button, input[type="submit"] { height: 42px; } .container>.container { padding-left: 0 !important; padding-right: 0 !important; } .wpb_column.vc_column_container { padding-left: 0; padding-right: 0; } .wpb_column.vc_column_container .vc_column-inner { padding-left: 15px; padding-right: 15px; } .post-listing-container > .vc_row > .column_container, .post-listing-container .vc_row, .post-listing-container .vc_column_container > .vc_column-inner { padding: 0; margin: 0; } .container { max-width: 100%; }';
				break;
			endswitch;
			
			if (GUSTA_THEME_MODE==false):
				$theme_var_header = get_option('options_gusta_header_area_selector', true);
				$theme_var_content = get_option('options_gusta_main_content_area_selector', true);
				$theme_var_footer = get_option('options_gusta_footer_area_selector', true);
				$theme_var_container = get_option('options_gusta_container_class', true);
				
				if ($theme_var_header!='' && !is_numeric($theme_var_header) && $theme_var_header!='1'): $theme_var['header'] = $theme_var_header; endif;
				if ($theme_var_content!='' && !is_numeric($theme_var_content) && $theme_var_content!='1'): $theme_var['content'] = $theme_var_content; endif;
				if ($theme_var_footer!='' && !is_numeric($theme_var_footer) && $theme_var_footer!='1'): $theme_var['footer'] = $theme_var_footer; endif;
				if ($theme_var_container!='' && !is_numeric($theme_var_container) && $theme_var_container!='1'): $theme_var['container'] = $theme_var_container; endif;
			endif;
			
		endif;
		
		return $theme_var[$area];
	}
endif;
?>