jQuery( document ).ready(function($){

	$(window).click(function() {

		if ( $( ".ast-search-menu-icon.slide-search" ).hasClass( "ast-dropdown-active" ) ) {
			$('.main-header-bar-navigation').hide().fadeOut('slow');
			$('.main-header-bar-navigation').css("visibility", "hidden");
		} else {
			if ( $('.main-header-bar-navigation').css("visibility") == "hidden" ) {
				$('.main-header-bar-navigation').css("visibility", "visible").hide().fadeIn('slow');
			}
		}

	});

  });