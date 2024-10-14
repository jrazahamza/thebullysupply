<?php
/*
* Javascript Functions
*
* @file           functions/js.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Sections Javascript on timing, delay and scroll based interactions */
if ( !function_exists( 'gusta_sections_js' ) ):
	function gusta_sections_js( $sections_js, $section ) {
		$overlapping = $sticky = $section_display = $disable_scroll = $enable_scroll = '';
		$gusta_section_purpose = get_post_meta($section, 'gusta_section_purpose', true);
		
		if (in_array($gusta_section_purpose, array('vertical','sidebar'))):
			$overlapping = get_post_meta($section, 'gusta_overlapping_section', true);
			$sticky = get_post_meta($section, 'gusta_sticky_section', true);
		endif;
		
		if ($gusta_section_purpose=='sticky'): $sticky = 1; endif;
		
		if ($gusta_section_purpose!='mega_menu' && $gusta_section_purpose!='card'):
			$section_delay = get_post_meta( $section, 'gusta_section_timing_gusta_section_delay', true );			
			$section_duration = get_post_meta( $section, 'gusta_section_timing_gusta_section_duration', true );
		endif;
		
		if (!$section_duration): $section_duration = '9999999999999'; endif;
		
		if (!$section_delay): $section_delay = 0; endif;
								
		$section_delay = 1000 * $section_delay;
		$section_duration = 1000 * $section_duration;
		
		if ($sticky): $section_display = get_post_meta($section, 'gusta_section_display', true); endif;
		
		$section_width = get_post_meta($section, 'gusta_section_width_height_gusta_section_width', true);
		$section_height = get_post_meta($section, 'gusta_section_width_height_gusta_section_height', true);
		
		if ($section_width=="100%" && $section_height=="100%"):
			$disable_scroll = " jQuery('html,body').addClass('disable-scroll');"; 
			$enable_scroll = " jQuery('html,body').removeClass('disable-scroll');"; 
		endif;
		
		if ($section_display==''):
			if ($section_delay!='' && $section_duration != '9999999999999000'):
				$sections_js .= "jQuery('#section-".$section."').addClass('gusta-hide-section'); setTimeout(function() { jQuery('#section-".$section."').removeClass('gusta-hide-section'); jQuery(\"[data-toggle='#section-".$section."']\").addClass('active');".$disable_scroll." gusta_fix_vc_full_width(); setTimeout(function() { jQuery('#section-".$section."').addClass('gusta-hide-section'); jQuery(\"[data-toggle='#section-".$section."']\").removeClass('active');".$enable_scroll." gusta_fix_vc_full_width(); }, ".$section_duration."); }, ".$section_delay.");";
			endif;
		else:
			if ($sticky):
				$sections_js .= "var fixed=1; var sectionheight; jQuery(window).on('load resize scroll',function(){ var scrolled = jQuery(this).scrollTop();
				";
				if ($section_display=='div'):
					$div = str_replace('#', '', trim(get_post_meta( $section, 'gusta_section_div_ids', true )));
					$sections_js .= "if ( jQuery('#".$div."').length ) { var contdiv = jQuery('#".$div."'); 
					if (jQuery('#section-".$section."').is(':visible')) { sectionheight = jQuery('#section-".$section."').outerHeight( true ); } ";
					$sections_js .= "
					var divheight = contdiv.outerHeight( true ); 
					var eTop = contdiv.offset().top - 150; 
					var eBottom = (eTop + divheight + 150);";
					$sections_js .= "
					if (divheight > sectionheight) { eBottom = eBottom - sectionheight; } else { eBottom = eTop + 50; } ";
					/*if ($i!=1): $divs_js .= " || "; endif;
					$divs_js = "if (scrolled > eTop && scrolled < eBottom )";
					
					$divs_js .= " { jQuery('#section-".$section."').removeClass('gusta-hide-section'); } else { fixed=0; jQuery('#section-".$section."').addClass('gusta-hide-section'); } }";
					$sections_js .= $divs_js;*/

					$sections_js .= "
					if(( scrolled < eTop ) || ( scrolled > eBottom )) { 
						if (jQuery('#section-".$section."').hasClass('gusta-hide-section')===false) {
							fixed=0; 
							jQuery('#section-".$section."').addClass('gusta-hide-section'); 
						}
					} else {
						if (jQuery('#section-".$section."').hasClass('gusta-hide-section')) {
							jQuery('#section-".$section."').removeClass('gusta-hide-section'); 
						}
					} }
					 ";
				elseif ($section_display=='hide'):
					$div = get_post_meta( $section, 'gusta_section_hide_selector', true );
					$sections_js .= " if ( jQuery('".$div."').length ) { var contdiv = jQuery('".$div."'); 
					if (jQuery('#section-".$section."').is(':visible')) { sectionheight = jQuery('#section-".$section."').outerHeight( true ); } ";
					$sections_js .= "
					var divheight = contdiv.outerHeight( true ); 
					var eTop = contdiv.offset();
					eTop = eTop.top;
					var eBottom = (eTop + divheight);
					";
					$sections_js .= "
					scrolled = scrolled + jQuery(window).height();
					console.log(divheight+' '+scrolled+' '+eTop+' '+eBottom);";

					$sections_js .= "
					if(( scrolled > eTop ) && ( scrolled < eBottom )) { 
						fixed=0; 
						jQuery('#section-".$section."').addClass('gusta-hide-section'); 
					} else {
						jQuery('#section-".$section."').removeClass('gusta-hide-section'); 
					} }
					 ";
				elseif ($section_display=='offset'):
					$offset_from = str_replace('px', '', get_post_meta( $section, 'gusta_section_offset_gusta_section_offset_from', true ));
					$offset_to = str_replace('px', '', get_post_meta( $section, 'gusta_section_offset_gusta_section_offset_to', true ));
					if ($offset_from==''): $offset_from = '-1'; endif;
					if ($offset_to==''): $offset_to = '9999999999999'; endif;
					$sections_js .= "
					if(( scrolled < ".$offset_from." ) || ( scrolled > ".$offset_to." )) { 
						if (jQuery('#section-".$section."').hasClass('gusta-hide-section')===false) {
							fixed=0; 
							jQuery('#section-".$section."').addClass('gusta-hide-section'); 
						}
					} else {
						if (jQuery('#section-".$section."').hasClass('gusta-hide-section')) {
							jQuery('#section-".$section."').removeClass('gusta-hide-section'); 
						}
					} 
					 ";
				endif;
				$sections_js .= "if (jQuery('#section-".$section."').is(':visible') && fixed==0) { 
					gusta_fix_vc_full_width(); fixed=1; 
				} });";
				if ($section_display=='href'):
					$gusta_section_href = get_post_meta($section, 'gusta_section_href', true);
					$sections_js .= "jQuery('.".$gusta_section_href."').click(function(){ jQuery('#section-".$section."').toggleClass('gusta-hide-section').toggleClass('gusta-show-section'); });";
				elseif ($section_display=='window'):
					$sections_js .= "jQuery('body').mouseleave(function () { jQuery('#section-".$section."').removeClass('gusta-hide-section'); });";
				endif;
			endif;
		endif;
		
		return $sections_js;
	}
endif;

/* Shortcode Dynamic Inline JS to Footer */
if ( !function_exists( 'gusta_inline_shortcode_js' ) ):
	function gusta_inline_shortcode_js ( $dynamic_js, $post_id=null, $type=null ) {
		global $post;
		
		$content = '';
		
		if ($type=='section'):
			$content = gusta_get_section_var ($post_id, 'post_content');
		elseif ($type=='section_vc'):
			$content = get_post_field('post_content', $post_id);
		else:
			if ($post):
				if (is_singular()):
					$content = $post->post_content;
				endif;
			endif;
		endif;
		
		$shortcodes = array (
			'gusta_section_toggle',
			'gusta_post_listing',
			'gusta_taxonomy_listing',
			'gusta_post_carousel',
			'gusta_search_box',
			'gusta_section'
		);
		
		if ($content!=''):

			$r = $content;

			foreach ($shortcodes as $shortcode):
				if (strpos($r, "[".$shortcode) !== false):
					
					$sloop=true;
					$i=0;
					while ($sloop==true):
						$atts=array();
						$shatts = gusta_get_string_between($r, '['.$shortcode.' ', ']');
						$atts = shortcode_parse_atts($shatts);
						
						$r = str_replace('['.$shortcode.' '.$shatts.']', '', $r);
						$r = str_replace('['.$shortcode.']', '', $r);
						
						if ($shatts): 
							extract($atts); 
							
							if (isset($vc_id)):
								switch ($shortcode) {
									case 'gusta_section_toggle':
										if (isset($section) && $section!=''):
											if (isset($hide_by_default) && $hide_by_default=='yes'):
												$dynamic_js .= "jQuery('#section-".$section."').removeClass('gusta-show-section gusta-higher').addClass('gusta-hide-section hide-by-default'); if (jQuery('#section-".$section."').hasClass('section-vertical')) { jQuery('body').addClass('gusta-body-zero-margin'); }";
											else:
												//$dynamic_js .= "jQuery('#section-".$section."').addClass('gusta-show-section gusta-higher').removeClass('gusta-hide-section hide-by-default'); }";
											endif;
										endif;
										unset ($section, $hide_by_default);
									break;
									case 'gusta_post_listing':
										if (!isset($usage)): $usage = 'default'; endif;
										if ($usage!='previous' && $usage!='next'):
											$dynamic_js .= "jQuery('#".$vc_id."').load_more({total_items: jQuery(this).data('total')";
											$dynamic_js .= (isset($items_per_page) && $items_per_page!="" ? ", items_per_page: ".$items_per_page : ", items_per_page: 10");
											$dynamic_js .= (isset($offset) && $offset!="" ? ", offset: ".$offset : "");
											$dynamic_js .= (isset($load_more_style) && $load_more_style!="" ? ", load_more_style: '".$load_more_style."'" : "");
											$dynamic_js .= (isset($load_more_text) && $load_more_text!="" ? ", load_more_text: '".$load_more_text."'" : "");
											$dynamic_js .= "});";
											$dynamic_js = gusta_inline_shortcode_js ( $dynamic_js, $card_design, 'section_vc' );
										endif;
										unset ($post_type, $vc_id, $items_per_page, $offset, $load_more_style, $load_more_text, $columns, $items_layout, $number_of_columns, $number_of_columns_tablet, $number_of_columns_mobile);
									break;
									case 'gusta_taxonomy_listing':
										$dynamic_js .= "jQuery('#".$vc_id."').load_more({total_items: jQuery(this).data('total')";
										$dynamic_js .= (isset($items_per_page) && $items_per_page!="" ? ", items_per_page: ".$items_per_page : ", items_per_page: 10");
										$dynamic_js .= (isset($offset) && $offset!="" ? ", offset: ".$offset : "");
										$dynamic_js .= "});";
										unset ($taxonomy, $vc_id, $items_per_page, $offset, $columns, $items_layout, $number_of_columns, $number_of_columns_tablet, $number_of_columns_mobile);
									break;
									case 'gusta_post_carousel':
										$loop = (isset($loop) && $loop!="" ? $loop : 'false');
										$dynamic_js .= "jQuery('#".$vc_id." .owl-carousel').owlCarousel({autoHeight:true, navText: [jQuery('.".$vc_id." .gusta-prev'),jQuery('.".$vc_id." .gusta-next')], loop: ".$loop."";
										$number_of_columns = (isset($number_of_columns) && $number_of_columns!="" ? $number_of_columns : '1');
										$number_of_columns_tablet = (isset($number_of_columns_tablet) && $number_of_columns_tablet!="" ? $number_of_columns_tablet : '1');
										$number_of_columns_mobile = (isset($number_of_columns_mobile) && $number_of_columns_mobile!="" ? $number_of_columns_mobile : '1');
										$stage_padding = (isset($stage_padding) && $stage_padding!="" ? $stage_padding : '0');
										$stage_padding_tablet = (isset($stage_padding_tablet) && $stage_padding_tablet!="" ? $stage_padding_tablet : '0');
										$stage_padding_mobile = (isset($stage_padding_mobile) && $stage_padding_mobile!="" ? $stage_padding_mobile : '0');
										$dynamic_js .= ", responsiveClass:true, responsive:{0:{items:".$number_of_columns_mobile.",stagePadding: ".$stage_padding_mobile."},768:{items:".$number_of_columns_tablet.",stagePadding: ".$stage_padding_tablet."},1024:{
            items:".$number_of_columns.",stagePadding: ".$stage_padding."}}";
										$dynamic_js .= (isset($navigation) && $navigation!="" ? ", nav: ".$navigation : "");
										$dynamic_js .= (isset($dots) && $dots!="" ? ", dots: ".$dots : "");
										$dynamic_js .= (isset($gap) && $gap!="" ? ", margin: ".$gap : ", margin: 30");
										$dynamic_js .= (isset($autoplay) && $autoplay!="" ? ", autoplay: ".$autoplay.", autoplayHoverPause:true" : "");
										if (isset($autoplay) && $autoplay!=""):
											$dynamic_js .= (isset($autoplay_timeout) && $autoplay_timeout!="" ? ", autoplayTimeout: '".$autoplay_timeout."'" : ", autoplayTimeout:5000");
										endif;
										$dynamic_js .= "});";
										unset ($post_type, $vc_id, $loop, $navigation, $dots, $gap, $autoplay, $autoplay_timeout, $number_of_columns, $number_of_columns_tablet, $number_of_columns_mobile, $stage_padding, $stage_padding_tablet, $stage_padding_mobile);
									break;
									case 'gusta_search_box':
										if (!isset($search_box_width)): $search_box_width='100%'; endif;
										if (!isset($expand_width)): $expand_width='100%'; endif;
										if (isset($search_box_type) && $search_box_type == 'expanding' && isset($expand_width) && ($expand_width != '' || $expand_width != $search_box_width)):
											$dynamic_js .= "jQuery(document).click(function(e) { if (!jQuery('#".$vc_id."').is(e.target) && jQuery('#".$vc_id."').has(e.target).length === 0 && !jQuery('#".$vc_id." button').is(e.target) && jQuery('#".$vc_id." button').has(e.target).length === 0) { jQuery('#".$vc_id."').css('max-width', '".$search_box_width."').removeClass('gusta-form-active'); jQuery('#".$vc_id." .form-group input').val('');	} else { jQuery('#".$vc_id."').css('max-width', '".$expand_width."').addClass('gusta-form-active'); jQuery('#".$vc_id." .form-group input').focus(); } }); ";
										endif;
										$autosuggest = (isset($autosuggest) ? $autosuggest : 'false');
										if ($autosuggest=='true'):
											$dynamic_js .= "jQuery('#".$vc_id."').find('input').keyup(function(e){ jQuery(this).parent().auto_suggest(); });";
										endif;
										unset ($autosuggest, $expand_width, $search_box_type, $search_box_width);
									break;
									case 'gusta_section':
										if (isset($section) && $section!=''):
											$dynamic_js = gusta_inline_shortcode_js ( $dynamic_js, $section, 'section_vc' );
										endif;
										unset ($section);
									break;
								}
							endif;
						unset ($atts);
						endif;
						
						if (strpos($r, "[".$shortcode) === false):
							$sloop=false;
						endif;
						$i++;
						if ($i==50) : $loop=false; endif;
					
					endwhile;
				endif;
			endforeach;
		endif;
		
		return $dynamic_js;
	}
endif;


/* Convert Columns to Bootstrap class number */
if ( !function_exists( 'gusta_columns' ) ):
	function gusta_columns ($from) {
		if ($from=='12'): $ret = '1';
		elseif ($from=='6'): $ret = '2';
		elseif ($from=='4'): $ret = '3';
		elseif ($from=='3'): $ret = '4';
		elseif ($from=='5-12'): $ret = '5';
		else: $ret = '6';
		endif;
		return $ret;
	}
endif;

/* This function parses all the inline javascript of shortcode inside content of the page and the included sections. */
if ( !function_exists( 'gusta_parse_dynamic_js' ) ):
	function gusta_parse_dynamic_js () {
		global $gusta_get_header_with_js;
		$header_selector = gusta_get_theme_var('header');
		$content_selector = gusta_get_theme_var('content');
		$footer_selector = gusta_get_theme_var('footer');
		$dynamic_js = $sticky_js = "";
		
		$sections_js = "jQuery.noConflict(); var $ = jQuery.noConflict(); jQuery(function($) { 'use strict'; ";
		
		$dynamic_js = gusta_inline_shortcode_js( $dynamic_js, get_the_id() );
		
		$section_areas = array ('header', 'above_content', 'content', 'archive', 'below_content', 'footer', 'sticky');

		$above_below_js = "";
		foreach ($section_areas as $area):
			$section_array = get_gusta_option('gusta_'.$area.'_sections', gusta_get_template(), 'section');
			if ($section_array):
				if (!is_array($section_array)) : $section_array = explode(',',$section_array); endif;
				
				foreach ($section_array as $section):
					if (!(is_preview() && (get_post_type()=="gusta_section"))):
						if (get_post_meta($section, 'gusta_section_purpose', true)=='vertical'):
							$align = get_post_meta($section, 'gusta_ver_section_alignment', true);
							if (!$align): $align = 'left'; endif;
							$sections_js .= "
							jQuery('body').addClass('gusta-vertical-header-".$align."'); ";
						endif;
						if ($area=='archive'):
							if (is_archive() || is_search() || is_home()):
								$dynamic_js = gusta_inline_shortcode_js( $dynamic_js, $section, 'section' );
							endif;
						else:
							$dynamic_js = gusta_inline_shortcode_js( $dynamic_js, $section, 'section' );
						endif;
						$sections_js = gusta_sections_js( $sections_js, $section );
					endif;
				endforeach;
				
				if (GUSTA_THEME_MODE==false):
					if (get_option('options_gusta_clear_theme_main_content_styles')==1): $sections_js .= "jQuery('".$content_selector."').addClass('gusta_clear_styles');"; endif;
					if ($area=='header'):
						if ($gusta_get_header_with_js): $sections_js .= "jQuery('body').prepend(jQuery('#gusta-header-container')); "; endif;
						$headers = explode(',',$header_selector);
						foreach ($headers as $header):
							$sections_js .= "jQuery('".trim($header)."').first().remove(); ";
						endforeach;
					endif;
					if (is_archive() || is_search() || is_home()):
						if ($area=='archive'):
							$sections_js .= "jQuery('".$content_selector."').first().html(''); jQuery('".$content_selector."').first().prepend(jQuery('#gusta-archive'));";
						endif;
					else:
						if ($area=='content'):
							$sections_js .= "jQuery('".$content_selector."').first().html(''); jQuery('".$content_selector."').first().prepend(jQuery('#gusta-content'));";
						endif;
					endif;
					if ($area=='above_content'):
						$above_below_js .= "jQuery('".$content_selector."').first().prepend(jQuery('#gusta-above-content'));";
					endif;
					if ($area=='below_content'):
						$above_below_js .= "jQuery('".$content_selector."').first().append(jQuery('#gusta-below-content'));";
					endif;
					if ($area=='footer'):
						$footers = explode(',',$footer_selector);
						foreach ($footers as $footer):
							$sections_js .= "jQuery('".trim($footer)."').last().remove(); ";
						endforeach;
					endif;
				endif;
				
			endif;
			
		endforeach;
		
		$sections_js .= $above_below_js;
		
		$sections_js .= "jQuery('".$header_selector.", ".$footer_selector.", ".$content_selector."').show(); gusta_fix_vc_full_width();";
		
		$dynamic_js .= $sections_js . "}); jQuery(window).on('load resize', function() { jQuery('#gusta-sticky').show(); gusta_fix_vc_full_width(); });"; 
		
		if ($dynamic_js!=""):
			echo '
	<script type="text/javascript" id="gusta_dynamic_js">'.$dynamic_js.'</script>
	';
		endif;
	}
	add_action ( 'wp_footer', 'gusta_parse_dynamic_js', 999 );
endif;
?>