jQuery(document).ready(function($) {
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