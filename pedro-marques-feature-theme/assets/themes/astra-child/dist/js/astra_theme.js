jQuery( document ).ready(function($){
	var offset = 100,
		speed = 250,
		duration = 500,
		scrollButton = $('.topbutton');

	$( window ).scroll( function() {
		if ( $( this ).scrollTop() < offset) {
			scrollButton.fadeOut( duration );
		} else {
			scrollButton.fadeIn( duration );
		}
	});

	scrollButton.on( 'click', function(e){
		e.preventDefault();
		$( 'html, body' ).animate({
			scrollTop: 0
		}, speed);
		});
	});;jQuery( document ).ready(function($){
	$('.header-slick-slider').slick({
		slidesToShow: 1,
		autoplay:true,
		autoplaySpeed:2200,
		slidesToScroll:1
	});
});;jQuery(document).ready(function($) {
	$('.related-slick-slider').slick({
		mobileFirst: true,
		responsive: [
			{
			breakpoint: 1200,
				settings: {
					slidesToShow: 3,
					autoplay:true,
					autoplaySpeed:3000,
					slidesToScroll:1,

				}
			},
			{
			breakpoint: 768,
				settings: {
					slidesToShow: 1,
					autoplay:true,
					autoplaySpeed:3000,
					slidesToScroll:1,

				}
			}
		]
	});
});
//# sourceMappingURL=astra_theme.js.map