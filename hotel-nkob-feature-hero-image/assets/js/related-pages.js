jQuery(document).ready(function($) {
	console.log('Document Ready');

	$('.related-slick-slider').slick({
		slidesToShow: 3,
		autoplay:true,
		autoplaySpeed:3000,
		slidesToScroll:1,
		responsive: [
			{
			breakpoint: 768,
			settings: {
				slidesToShow: 1
			}
			}
		]
	});
});