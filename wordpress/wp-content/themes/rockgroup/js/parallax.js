if( jQuery('.sc_parallax').length > 0 ){
	jQuery(document).ready( function() {
		REX_parallax();
	});
	jQuery(window).resize( function() {
		REX_parallax()
	});
	jQuery(window).scroll( function() {
		REX_parallax();
	});
};



function REX_parallax(){

	jQuery('.sc_parallax').each(function(){
		var windowHeight = jQuery(window).height();
		var scrollTops = jQuery(window).scrollTop() + windowHeight;
		var offsetPrx = jQuery(this).offset().top; 
		var prxPosition = jQuery(this).find('.sc_parallax_img').data('position');  
	

		if( scrollTops >= offsetPrx ){
			if( prxPosition == 'up'){
				yPos =  (scrollTops - offsetPrx) / -3; 
			} else if( prxPosition == 'down' ){
				yPos =  (scrollTops - (windowHeight*2) - offsetPrx) / 3; 
			} else {
				alert('Does not indicate the direction of motion "up" or "down"')
			}
			jQuery(this).find('.sc_parallax_img').css('transform', 'translate(0px, ' + yPos + 'px) ');
		} 

	
	});

}; 

