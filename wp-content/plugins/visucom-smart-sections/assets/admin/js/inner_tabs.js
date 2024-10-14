!function($) {
	jQuery(document).ready(function() {
		jQuery('div[data-vc-shortcode-param-name*="tg_inner_tab"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_advanced_css"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_background_image"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_text_style"]').hide();
		var firsttab = jQuery('input.vc_sub_group').last().val();
		jQuery('div[data-vc-shortcode-param-name*="tg_' + firsttab +'_tg_inner_tab"]').show();
		jQuery('div[data-vc-shortcode-param-name*="tg_' + firsttab +'_tg_normal_tg"]').show();
	});
	jQuery('input.gusta_radio').click(function() {
		var el = jQuery(this).attr('name');
		el = el.replace('_inner_tab', '');
		var innertabname = jQuery(this).val();
		jQuery('div[data-vc-shortcode-param-name*="tg_advanced_css"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_background_image"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_text_style"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="' + el + '_' + innertabname + '_tg"]').show();
		var overlay = jQuery('div[data-vc-shortcode-param-name*="' + el + '_' + innertabname + '_tg_advanced_css"]').find('.overlay').val();
		if (overlay.indexOf("single") >= 0) {
			jQuery('div[data-vc-shortcode-param-name*="' + el + '_' + innertabname + '_tg_gradient"]').hide();
		}
	});	
	jQuery('input.vc_sub_group').click(function() {
		var tabname = jQuery(this).val();
		jQuery('div[data-vc-shortcode-param-name*="tg_inner_tab"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_advanced_css"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_background_image"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_text_style"]').hide();
		jQuery('div[data-vc-shortcode-param-name*="tg_' + tabname +'_tg_inner_tab"]').show();
		jQuery('div[data-vc-shortcode-param-name*="tg_' + tabname +'_tg_inner_tab"]').find('input.gusta_radio').filter('[value=normal]').prop('checked', true);
		jQuery('div[data-vc-shortcode-param-name*="tg_' + tabname +'_tg_normal_tg"]').show();
	});
	
}(window.jQuery);