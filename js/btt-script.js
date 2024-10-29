jQuery(function() {
	jQuery(window).scroll(function() {
		var scrollposition = jQuery('#back-to-top').data('scroll-offset');
		scrollposition = (scrollposition) ? scrollposition : 0;
		if(jQuery(this).scrollTop() > scrollposition) {
			jQuery('#back-to-top').fadeIn();	
		} else {
			jQuery('#back-to-top').fadeOut();
		}
	});
 
	jQuery('#back-to-top').click(function() {
		var scroll_speed = jQuery(this).data('scroll-speed');
		jQuery('body,html').animate({scrollTop:0},scroll_speed);
	});	
});