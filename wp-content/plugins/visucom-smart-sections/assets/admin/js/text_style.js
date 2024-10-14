!function($) {
	jQuery('.gusta-color-picker').colorpicker({format: null});
	
	jQuery('.text_style').bind("keyup input change", function() {
		
		var newtext = '';
		var parent = jQuery(this).data('parent');
		jQuery('.text_style').each(function(){
			if (jQuery(this).data('parent')===parent) {
				var str = jQuery(this).val();
				if (str!='') {
					if(jQuery(this).attr('type') == 'radio') {
						if(jQuery(this).is(':checked')) {
							newtext = newtext + jQuery(this).data('attr') + ':' + str + ' !important;';
						}
					} else  {
						newtext = newtext + jQuery(this).data('attr') + ':' + str + ' !important;';
					}
				}
			}
		});
		jQuery('input.' + parent).val(newtext);
	});
	
	/*jQuery('span[data-vc-ui-element="button-save"]').click(function() {
		var content = jQuery("#content_ifr").contents().find("#tinymce").html();
		var elements = content.split('[');
		var message = '';
		$.each( elements, function( index, value ) {
			var attributes = value.split(' ');
			$.each( attributes, function( index2, attr ) {	
				var vc_id_added = false;
				var shortcode = '';
				if (index != 0 && attr.indexOf(']') < 1 && attr.indexOf('"') < 1) {
					var shortcode = attr;
				}
				if (attr.indexOf('="') >= 0) {
					var att = attr.split('="');
					var at = att[0];
					if (at==='vc_id') {
						vc_id_added = true;
					}
				}
				if (shortcode!='') {
					if (vc_id_added === false) {
						//alert(at + ' ' + shortcode);
						message = message + " - vc_id not added for " + shortcode;
					}
				}
			});
		});
		//alert(message);
		alert ("Deneme");
	});*/
	
}(window.jQuery);