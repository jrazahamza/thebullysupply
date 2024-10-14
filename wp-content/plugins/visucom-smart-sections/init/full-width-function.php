<?php
/*
* Smart Sections Init
*
* @file           init/full-width-function.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

//Adds a script at the head sections that makes the rows full width 
  if(!function_exists('gusta_header_buffer_holder')):
	function gusta_header_buffer_holder(){
	  ob_start();

	  if (in_array(gusta_theme_name(), array('bridge','bridge-child'))):
		if (in_array(gusta_theme_name(), array('bridge','bridge-child'))): 
		  $width = 'outerWidth()+30'; 
		else:
		  $width = 'outerWidth()'; 
		endif;
		echo "<script>function gusta_fix_vc_full_width() {var fix = 1, jQueryelement=jQuery('.vc_row-o-full-height:first'); if(jQueryelement.length){ jQueryelement.css('min-height','100vh'); } jQuery(document).trigger('vc-full-height-row',jQueryelement); jQuery.each(jQuery('[data-vc-full-width=\"true\"]:not(.vc_clearfix, [data-vc-stretch-content=\"true\"]), .vc_row-full-width:not(.vc_clearfix, [data-vc-stretch-content=\"true\"])'),function(){ var el=jQuery(this); el.css({'left':'','width':'','box-sizing':'','max-width':'','padding-left':'','padding-right':''}); var el_width = el.parent().".$width.", width = jQuery(window).width() + 2; el_margin = parseInt((width - el_width) / 2 + 1); if (el_margin!='0' && fix==1) { el.addClass('vc_hidden').css({'left':-el_margin, 'width':width, 'box-sizing':'border-box', 'max-width':width, 'padding-left':el_margin, 'padding-right':el_margin }).attr('data-vc-full-width-init','true').removeClass('vc_hidden');}}); fix = 0; jQuery('.owl-carousel').each(function(){ jQuery(this).trigger('refresh.owl.carousel'); }); } jQuery( '#gusta-header-container' ).on('load', function() { gusta_fix_vc_full_width(); });</script>";
	  else:
		echo "<script>function gusta_fix_vc_full_width() { var elements=jQuery('[data-vc-full-width=\"true\"], .mk-fullwidth-true');jQuery.each(elements,function(key,item){var el=jQuery(this);el.addClass('vc_hidden');var el_full=el.next('.vc_row-full-width');if(el_full.length||(el_full=el.parent().next('.vc_row-full-width')),el_full.length){var el_margin_left=parseInt(el.css('margin-left'),10),el_margin_right=parseInt(el.css('margin-right'),10),offset=0-el_full.offset().left-el_margin_left,width=jQuery(window).width();if(el.css({position:'relative',left:offset,'box-sizing':'border-box',width:jQuery(window).width()}),!el.data('vcStretchContent')){var padding=-1*offset;0>padding&&(padding=0);var paddingRight=width-padding-el_full.width()+el_margin_left+el_margin_right;0>paddingRight&&(paddingRight=0),el.css({'padding-left':padding+'px','padding-right':paddingRight+'px'})}el.attr('data-vc-full-width-init','true'),el.removeClass('vc_hidden'),jQuery(document).trigger('vc-full-width-row-single',{el:el,offset:offset,marginLeft:el_margin_left,marginRight:el_margin_right,elFull:el_full,width:width})}}),jQuery(document).trigger('vc-full-width-row',elements),jQuery(document).trigger('[data-mk-stretch-content=\"true\"]', elements); jQuery('.owl-carousel').each(function(){ jQuery(this).trigger('refresh.owl.carousel'); }); } jQuery( '#gusta-header-container' ).on('load', function() { gusta_fix_vc_full_width(); });</script>";
	  endif;    
	}
	add_action( 'wp_head', 'gusta_header_buffer_holder');
  endif;
?>