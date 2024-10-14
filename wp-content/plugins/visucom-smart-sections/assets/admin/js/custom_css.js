(function( $ ) {
	jQuery('.vc_ui-panel-content-container').css('margin-top', '0');
	
	jQuery('.vc_edit-form-tab-control').click(function(){ 
		var content_container = jQuery(this).parent().parent().parent().parent().parent().find('.vc_ui-panel-content-container');
		if (jQuery(this).text()=='Smart Styles') {
			if (jQuery( window ).width()<768) {
				content_container.css('margin-top', '0');
			} else {
				content_container.css('margin-top', '69px');
			}
		} else {
			content_container.css('margin-top', '0');
		}
	});
	
})( jQuery );

!function($) {
	jQuery('.gusta-color-picker').colorpicker();
	
	jQuery('.advanced_css').bind("keyup input change", function() {
		var newtext = '';
		var parent = jQuery(this).data('parent');
		
		jQuery('.advanced_css').each(function(){
			if (jQuery(this).data('parent')===parent) {
				var str = jQuery(this).val();
				if (str!='') {
					if(jQuery(this).attr('type') == 'radio') {
						if(jQuery(this).is(':checked')) {
							newtext = newtext + jQuery(this).data('attr') + ':' + str + ' !important;';
						}
					} else  {
						if(jQuery(this).data('attr') == 'overlay') {
							if (str.indexOf("gradient") >= 0) { 
								newtext = newtext + jQuery(this).data('attr') + ':gradient !important;';
							} 
						} else {
							newtext = newtext + jQuery(this).data('attr') + ':' + str + ' !important;';
						}
					}
				}
			}
		});
		jQuery('div[data-vc-shortcode-param-name="' + parent + '"]').find('input.advanced_css_output').val(newtext);
	});
	
	jQuery('.overlay').change(function() {
		var str = jQuery(this).val();
		var parent = jQuery(this).data('parent');
		if (str.indexOf("gradient") >= 0) {
			jQuery('div[data-vc-shortcode-param-name="' + parent + '"]').find('.gradient_field').show();
		} else {
			jQuery('div[data-vc-shortcode-param-name="' + parent + '"]').find('.gradient_field').hide();
		}
	});
	
}(window.jQuery);