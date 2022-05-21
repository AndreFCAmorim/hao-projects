/* global $, jQuery, google, stockAjax*/
/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */
'use strict';

(function($) {


// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
	// All pages
	common: {
		init: function() {
		}
	},
	page_template_template_csv: { // stock online
		init: function() {

			jQuery(document).ready(function() {

				$('#term__qt').bind('keydown',function(e){
					return isNumeric(e);
				});

				$(document).on("click", '.js-btn-toggle-cart',function(e) {
					e.preventDefault();
					toggle_cart();
				});

				$(document).on("click", '.js-btn-toggle-lists',function(e) {
					e.preventDefault();
					toggle_lists();
				});

				$(document).on("click", '#btn-submit-search',function(e) {
					e.preventDefault();
					search_term( function() {
					});
				});

				$('.js-show-support').on( 'click', function( e ) {
					hide_support_table( '.js-support-list' );
					show_support_table( '.' + $(this).data( 'tableid' ) );
				});

				$('.js-hide-support').on( 'click', function( e ) {
					hide_support_table( '.js-support-list' );
				});

				$(document).on( 'click', '.js-add__cart', function() {
					var self = $(this);
					var product_sku  = self.data('product_sku');
					var product_name = self.data('product_name');
					var ref_extra = '';
					if ( $(this).hasClass('js-ask-avail') ) {
						ref_extra = ' - Pedir Prazo de Entrega';
					}


					addToBasket(product_sku + ' ' + product_name + ref_extra );

					$(this).parent().parent().find(".product__overlay").css({
						'transform': ' translateY(0px)',
						'opacity': '1',
						'transition': 'all ease-in-out .45s'
					}).delay(1500).queue(function() {
						$(this).css({
							'transform': 'translateY(-500px)',
							'opacity': '0',
							'transition': 'all ease-in-out .45s'
						}).dequeue();
					});
				});

				jQuery(window).keydown(function(event){

					if(event.keyCode === 13) {
						if( document.getElementById("term__text") === document.activeElement ) {
							event.preventDefault();

							search_term();

					return false;
						}
					}
				});
				if ( document.getElementById("term__text") != null ) {
					document.getElementById("term__text").focus();
				}
			});
		}
	},

};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
	fire: function(func, funcname, args) {
		var namespace = Roots;
		funcname = (funcname === undefined) ? 'init' : funcname;
		if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
			namespace[func][funcname](args);
		}
	},
	loadEvents: function() {
		UTIL.fire('common');

		$.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
			UTIL.fire(classnm);
		});
	}
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

