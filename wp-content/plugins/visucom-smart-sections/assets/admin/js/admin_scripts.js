!function($) {
	
	jQuery(window).scroll(function() {    
		var scroll = jQuery(window).scrollTop();
		var objectSelect = $("#normal-sortables");
		if (objectSelect.length != 0) {
			var objectPosition = objectSelect.offset().top;
			if (scroll > objectPosition - 50) {
				jQuery("#side-sortables").addClass("gusta-admin-fixed");
			} else {
				jQuery("#side-sortables").removeClass("gusta-admin-fixed");
			}	
		}
	});
	
}(window.jQuery);

jQuery(function($){ 

	jQuery(".smooth-scroll, .smooth-scroll a").click(function(event){ 
		event.preventDefault(); 
		var dest=0; 
		if(jQuery(this.hash).offset().top > jQuery(document).height()-jQuery(window).height()){ 
			dest=jQuery(document).height()-jQuery(window).height(); 
		} else { 
			dest=jQuery(this.hash).offset().top; 
		} 
		jQuery('html,body').animate({scrollTop:dest}, 1000,'swing'); 
	});
	
	jQuery('div[data-name*="_sections_tab"]').find('label[for*="_sections_tab"]').click(function() {
		jQuery(this).parent().parent().toggleClass('gusta_tab_active');
		jQuery(this).parent().parent().find('.acf-fields').slideToggle();
	});
	
	jQuery('#acf-group_single_archive_sections_meta_box [data-name="gusta_override_section_options"], .form-table [data-name="gusta_override_section_options"]').click(function() {
		if (jQuery(this).find('.acf-switch').hasClass('-on')) {
			jQuery('#acf-group_single_archive_sections_meta_box [data-key*="_sections_tab"][data-key*="gusta"], .form-table [data-key*="_sections_tab"][data-key*="gusta"]').hide();
		} else {
			jQuery('#acf-group_single_archive_sections_meta_box [data-key*="_sections_tab"][data-key*="gusta"], .form-table [data-key*="_sections_tab"][data-key*="gusta"]').show();
		}
	});
  
});

jQuery(window).on('load', function() {
	if (jQuery('#acf-group_single_archive_sections_meta_box [data-name="gusta_override_section_options"], .form-table [data-name="gusta_override_section_options"]').find('.acf-switch').hasClass('-on')) {
		jQuery('#acf-group_single_archive_sections_meta_box [data-key*="_sections_tab"][data-key*="gusta"], .form-table [data-key*="_sections_tab"][data-key*="gusta"]').show();
	} else {
		jQuery('#acf-group_single_archive_sections_meta_box [data-key*="_sections_tab"][data-key*="gusta"], .form-table [data-key*="_sections_tab"][data-key*="gusta"]').hide();
	}
});