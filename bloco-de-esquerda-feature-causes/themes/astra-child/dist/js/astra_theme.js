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

  });;const open = document.getElementById('video_modal_open');
const close = document.getElementById('video_modal_close');
const modal = document.getElementById('video_modal_container');

if ( document.getElementById('video_modal_open') ) {
	open.addEventListener('click', () => {
		modal.classList.add('show');
	});
}

if ( document.getElementById('video_modal_close') ) {
	close.addEventListener('click', () => {
		modal.classList.remove('show');
	});
}

//# sourceMappingURL=astra_theme.js.map