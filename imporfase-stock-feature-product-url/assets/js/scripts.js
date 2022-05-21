/* ========================================================================
 * Bootstrap: button.js v3.2.0
 * http://getbootstrap.com/javascript/#buttons
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // BUTTON PUBLIC CLASS DEFINITION
  // ==============================

  var Button = function (element, options) {
    this.$element  = $(element)
    this.options   = $.extend({}, Button.DEFAULTS, options)
    this.isLoading = false
  }

  Button.VERSION  = '3.2.0'

  Button.DEFAULTS = {
    loadingText: 'loading...'
  }

  Button.prototype.setState = function (state) {
    var d    = 'disabled'
    var $el  = this.$element
    var val  = $el.is('input') ? 'val' : 'html'
    var data = $el.data()

    state = state + 'Text'

    if (data.resetText == null) $el.data('resetText', $el[val]())

    $el[val](data[state] == null ? this.options[state] : data[state])

    // push to event loop to allow forms to submit
    setTimeout($.proxy(function () {
      if (state == 'loadingText') {
        this.isLoading = true
        $el.addClass(d).attr(d, d)
      } else if (this.isLoading) {
        this.isLoading = false
        $el.removeClass(d).removeAttr(d)
      }
    }, this), 0)
  }

  Button.prototype.toggle = function () {
    var changed = true
    var $parent = this.$element.closest('[data-toggle="buttons"]')

    if ($parent.length) {
      var $input = this.$element.find('input')
      if ($input.prop('type') == 'radio') {
        if ($input.prop('checked') && this.$element.hasClass('active')) changed = false
        else $parent.find('.active').removeClass('active')
      }
      if (changed) $input.prop('checked', !this.$element.hasClass('active')).trigger('change')
    }

    if (changed) this.$element.toggleClass('active')
  }


  // BUTTON PLUGIN DEFINITION
  // ========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.button')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.button', (data = new Button(this, options)))

      if (option == 'toggle') data.toggle()
      else if (option) data.setState(option)
    })
  }

  var old = $.fn.button

  $.fn.button             = Plugin
  $.fn.button.Constructor = Button


  // BUTTON NO CONFLICT
  // ==================

  $.fn.button.noConflict = function () {
    $.fn.button = old
    return this
  }


  // BUTTON DATA-API
  // ===============

  $(document).on('click.bs.button.data-api', '[data-toggle^="button"]', function (e) {
    var $btn = $(e.target)
    if (!$btn.hasClass('btn')) $btn = $btn.closest('.btn')
    Plugin.call($btn, 'toggle')
    e.preventDefault()
  })

}(jQuery);
;// Add Items To Basket
function addToBasket( reference ) {
	var selectionStart = $('#email__encs')[0].selectionStart;
	var selectionEnd = $('#email__encs')[0].selectionEnd;

	$('#email__encs').val($('#email__encs').val() + reference + ", \n");


	$('#email__encs')[0].selectionStart = selectionStart;
	$('#email__encs')[0].selectionEnd = selectionEnd;
}

function show_support_table( table_id ) {
	$(table_id).show();
}

function hide_support_table( table_class ) {
	$(table_class).hide();
}

function highlightbody(ii,dd,cc,ss){
	setTimeout(function(){
		$('#term__body').css('backgroundColor','hsl('+ cc +','+ ss + '%,'+ii+'%)');
	}, dd);
}


function lightenTable(c,s) {
	$('#term__body').css('backgroundColor','hsl('+ c+ ', ' + s +'%, 74%)');
	var p1 = new Promise(
		function(resolve, reject) {
			var d = 100;
			for(var i=74; i<=100; i=i+0.1){
				d	+= 2;
				highlightbody(i,d,c,s);
			}
			resolve(i);

	});
	p1.then(
		function(val) {
			setTimeout(function(){
				$('#term__body').css('backgroundColor','rgba(0,0,0,0)');
			}, 1000);
		}
	).catch(function() { });
}

function isNumeric(e) {
	var specialKeys = [];
	specialKeys.push(8); //Backspace
	specialKeys.push(13); //enter
	specialKeys.push(46); //delete
	var keyCode = e.which ? e.which : e.keyCode,
		ret = (( keyCode <= 57) || specialKeys.indexOf(keyCode) !== -1);
	document.getElementById("error").style.display = ret ? "none" : "inline";
	return ret;
}


function buildtable(each, tbody, term_even, row_even ){

	var term__body = document.getElementById(tbody),
		div__row = document.createElement("div"),
		term__qt = 1,
		term__bodyfrag = document.createDocumentFragment(),
		iter = 0;

	div__row.className = "row product__line";

	if( term_even ) {
		div__row.className += " even";
	} else {
		div__row.className += " odd";
	}



	each.forEach(function(e) {
		var
		d__wrp = document.createElement("div"),
		d__ovl = document.createElement("div"),
		h__msg = document.createElement("h2"),
		i__chk = document.createElement("i"),
		b__btn = document.createElement("button"),
		d__inn = document.createElement("div");
		d__inn.className = "product__inner";
		d__ovl.className = "product__overlay";
		h__msg.className = "product__overlay__title";
		i__chk.className = "glyphicon glyphicon-ok btn btn-success";

		// ref
		var p__ref = document.createElement("p"),
			p__vnd = document.createElement("h3"),
			p__pvp = document.createElement("p"),
			p__qty = document.createElement("p");

		if( iter === 0 ) {
			d__wrp.className = "product__wrap term__info";
		} else if( iter === 1) {
			d__wrp.className = "product__wrap product__found";
		} else {
			d__wrp.className = "product__wrap product__equivalence";
		}

		if( iter > 0 ) {
			p__ref.className = "term__data term__ref__data";
			p__vnd.className = "term__data term__vnd__data";
			p__pvp.className = "term__data term__pvp__data";
			p__qty.className = "term__data term__stk__data";
		} else {
			p__ref.className = "term__info_desc";

		}

		/*
		* 0. vendor name
		*/
		var contains_name = e[0];
		var content_text_ref_vendor = document.createTextNode( contains_name ),
			content_span_ref_vendor = document.createElement("span");
		content_span_ref_vendor.className = 'term__vendor';
		content_span_ref_vendor.appendChild(content_text_ref_vendor);


		/*
		 * 1. product sku / reference
		 */
		var contains_span_ref = document.createElement("span")

		// also used in data attr
		var contains_ref = '';
		if( e[1] !== '' ) {
			contains_ref = e[1];
		}
		var content_ref = document.createTextNode(contains_ref);

		contains_span_ref.className= "term__text__query";
		contains_span_ref.appendChild(content_ref);


		/* 4 discount letter */
		var discount_letter = '';
		if( e[4] !== "" ) {
			discount_letter = " (" + e[4] + ")";
		}
		var content_text_ref_letter = document.createTextNode( discount_letter ),
			content_span_ref_letter = document.createElement("span");

		content_span_ref_letter.appendChild(content_text_ref_letter);
		content_span_ref_letter.className = "term__letter";

		/* 6 discount value */
		var discount_value = '';
		if( e[6] !== '' ) {
			discount_value += e[6] + '%';
		}
		var content_text_ref_discount = document.createTextNode( discount_value ),
			content_span_ref_discount = document.createElement("span");
		content_span_ref_discount.appendChild(content_text_ref_discount);
		content_span_ref_discount.className = "term__discount";


		/**
		 * Product description / name
		 */
		// also used in data attr
		var contains_description = e[7];

		/** Elements */
		// add ref to <p>
		p__ref.appendChild(contains_span_ref);



		// add <p> to <div inner>
		d__inn.appendChild(content_span_ref_vendor);

		d__inn.appendChild(p__ref);

		// pvp
		var contains_pvp = '';
		if ( e[2] !== '' ) {
			contains_pvp = e[2];
		}

		var contains_span_pvp = document.createElement("span"),
			content_pvp = document.createTextNode(contains_pvp);
		contains_span_pvp.className= "term__text__pvp";
		contains_span_pvp.appendChild(content_pvp);

		// add discount letter to Ref
		if( iter > 0 ) {
			p__ref.appendChild(content_span_ref_letter);
		}

		if( iter > 0 ) {

			var content_text_price_audience = document.createTextNode('( PVP )'),
			content_span_price_audience = document.createElement('span');

			content_span_price_audience.appendChild(content_text_price_audience);
			content_span_price_audience.className= "term__audience";
			contains_span_pvp.appendChild(content_span_price_audience);
		}

		if ( iter > 0 ) {
			contains_span_pvp.appendChild(content_span_ref_discount);
		}
		// add <p> to <div inner>
		d__inn.appendChild(contains_span_pvp);

		// stk
		var contains_stk = "";
		var contains_stk_class = "";
		var qt_int = e[3].replace(",",".");
		var qt_ttl,
			qty_add_cart = false;

		if( qt_int === "Stock") {
			contains_stk = qt_int;
			contains_stk_class = 'term__text__result';
		} else {
			if( null !== e[5] ){
				var stock_class_base = 'term__avail btn glyphicon ';
				var qt_res = e[5].replace(",",".");
				qt_ttl = qt_int - qt_res;
				if ( ~~qt_ttl >= ~~term__qt && ~~qt_int >= ~~term__qt ) { // binary compare

					/*
					* no reservation:
					*
					*	3 > 1	=> qt_ttl 3-0(3) >= 1 (true)		&& 3 >= 1 ( true)		true
					*	1 = 1	=>				1-0(1) >= 1 (true)		&& 1 >= 1 ( true)		true
					*	0 < 1	=>				0-0(0) >= 1 ( false)	&& 0 >= 1 ( false)	 false
					*
					* has reservation:
					* 3, 1 , 1 =>			 3-1(2)	>= 1 ( true)	 && 3 >= 1 (true)		true
					* 2, 1 , 1					2-1(1)	>= 1 ( true)	 && 2 >= 1 (true)		true
					* 1, 1 , 1					1-1(0)	>= 1 ( false)	&& 1 >= 1 (true)		false
					* 0, 1 , 1					0-1(-1) >= 1 ( false)	&& 0 >= 1 (false)	 false
					*
					*/
					contains_stk_class = 'glyphicon-ok btn-success';
					qty_add_cart = true;
				} else if ( ~~qt_ttl < ~~term__qt && ~~qt_int >= ~~term__qt	) {
					/*
					* no reservation:
					*
					*	3 > 1	=> qt_ttl 3-0(3) <	1 (false)		&& 3 >= 1 ( true)		 false
					*	1 = 1	=>				1-0(1) <	1 (false)		&& 1 >= 1 ( true)		 false
					*	0 < 1	=>				0-0(0) <	1 (true)		 && 0 >= 1 ( false)		false
					*
					* has reservation:
					* 3, 1 , 1 =>			 3-1(2)	< 1 ( false)	 && 3 >= 1 (true)		 false
					* 2, 1 , 1					2-1(1)	< 1 ( false)	 && 2 >= 1 (true)		 false
					* 1, 1 , 1					1-1(0)	< 1 ( true)		&& 1 >= 1 (true)		 true
					* 0, 1 , 1					0-1(-1) < 1 ( true)		&& 0 >= 1 (false)		false
					*
					*/
					qty_add_cart = false;
					contains_stk_class = 'glyphicon-remove btn-warning';
				} else if ( ~~qt_ttl < ~~term__qt && ~~qt_int < ~~term__qt	) {
					qty_add_cart = false;
					contains_stk_class = 'glyphicon-remove btn-danger';
				}
			} else {

				if ( ~~qt_int > ~~term__qt ) { // binary compare
					qty_add_cart = true;
					contains_stk_class = 'glyphicon-ok btn-success';
				} else if ( ~~qt_int === ~~term__qt ) {
					qty_add_cart = false;
					contains_stk_class = 'glyphicon-remove btn-warning';
				} else if ( ~~qt_int < ~~term__qt	) {
					qty_add_cart = false;
					contains_stk_class = 'glyphicon-remove btn-danger';
				}
			}
		}
		var contains_span_stk = document.createElement("span"),
		content_stk = document.createTextNode( contains_stk );
		contains_span_stk.className = stock_class_base + contains_stk_class;
		contains_span_stk.appendChild(content_stk);

		if( qty_add_cart ) {
			var add_to_cart_text = document.createTextNode("Adicionar");
			b__btn.appendChild(add_to_cart_text);

			b__btn.className = "term__cart term__qty__data js-add__cart";
		} else {
			var add_to_cart_text = document.createTextNode( 'Pedir Prazo entrega' );

			b__btn.className = "term__cart term__not-available js-add__cart js-ask-avail";
			b__btn.appendChild(add_to_cart_text);
		}
		b__btn.dataset.product_sku = contains_ref;
		b__btn.dataset.product_name = contains_description;

		b__btn.appendChild(contains_span_stk);

		d__inn.appendChild(b__btn);

		// div.product
		d__wrp.appendChild(d__inn);

		// div.product_overlay has h2 and i
		var h__msg_text = document.createTextNode( 'Adicionado!' );
		h__msg.appendChild(h__msg_text);
		d__ovl.appendChild(h__msg);
		d__ovl.appendChild(i__chk);
		d__wrp.appendChild(d__ovl);

		term__bodyfrag.appendChild(d__wrp);

		iter++;
	});
	div__row.appendChild(term__bodyfrag);
	term__body.appendChild(div__row);
}

function toggle_cart() {

	$("#email__form").toggle( 200, function(){
		$(this).toggleClass('active');
		$('.js-btn-toggle-cart').toggleClass( 'js-show-cart-mode' );
	});
}

function toggle_lists() {

	$("#list__block").toggle( 200, function(){
		$(this).toggleClass('active');
		$('.js-btn-toggle-lists').toggleClass( 'js-show-lists-mode' );
	});
}


function search_term() {

	var term__text = jQuery("#term__text").val();
	var client_code = jQuery("#client__code").val();
	var client_id = jQuery("#client__id").val();
	var page_id = jQuery("#page_id").val();
	var actioncall = {
		action: 'get_terms',
		term_text: term__text,
		client_code: client_code,
		client_id: client_id,
		page_id: page_id,
		getterms_nonce: stockAjax.gettermsNonce
	};

	$('#term__body').empty();

	jQuery.post(stockAjax.ajaxurl, actioncall , function(response) {

		var term__body = {},
			row_even = false,
			term_even = false;

		if( ("" === response || 0 === response) || !response.match) {

			var each0 = [];
			term__body.textContent = "";
			term_even = false;
			buildtable(each0,"term__body" ,term_even);
			lightenTable(0,100); // red
			return;

		}
		if ( response.match ) {
			term__body.textContent = "";
			term_even = false;
			row_even = false;
			Object.keys(response.match).map(function( objectKey ) {
				var each = response.match[objectKey];
				buildtable(each,"term__body",term_even, row_even );
				term_even = !term_even;
				row_even = !row_even;
				lightenTable(64,68); // green
			});
		}

		if ( jQuery("#term__text").val() && document.getElementById('term__body').innerHTML ) {

			var term__latest__body = document.getElementById("term__latest__body"),
				term__latest__bodyfrag = document.createDocumentFragment(),
				$term_latest_matches = jQuery("#term__body .term__data span"),
				term__search_value = document.getElementById('term__text').value;


				var ref_a, pvp_a, stk_a, res_a;
				ref_a = []; pvp_a = []; stk_a = [];	res_a = [];

				$term_latest_matches.each(function(e,f) {
					switch( f.className ) {
						case "term__text__query":
							ref_a.push( f );

							break;
						case "term__text__pvp":
							pvp_a.push( f );
							break;
						case "glyphicon glyphicon-ok btn btn-success":
						case "glyphicon glyphicon-remove btn btn-danger":
						case "glyphicon glyphicon-remove btn btn-warning":
							stk_a.push( f );
							res_a.push( f );
							break;
					}
				});

				var count_a = ref_a.length;
				for( var a = 0 ; a < count_a / 9; ) {
					var latests_tr_1 = document.createElement("tr"),
						latests_td_search_term = document.createElement("td"),
						latests_value_search_term = document.createTextNode(term__search_value);

					latests_td_search_term.appendChild(latests_value_search_term);
					latests_tr_1.appendChild(latests_td_search_term);
					for( var i = 0+9*a; i < 0+9*a; i++ ){
						var latests_td_1 = document.createElement("td"),
							latests_tn_1 = document.createTextNode(ref_a[i].innerHTML),
							latests_span_1 = document.createElement("span");

						latests_span_1.className = ref_a[i].className;
						latests_span_1.appendChild(latests_tn_1);
						latests_td_1.appendChild(latests_span_1);
						latests_td_1.className = "term__data";

						if (typeof stk_a[i] !== 'undefined') {
							var	contains_span_stk = document.createElement("span");
							contains_span_stk.className = stk_a[i].className + " btn-xs";
							latests_td_1.appendChild(contains_span_stk);
						}

						if (typeof pvp_a[i] !== 'undefined') {
							var latests_tn_2 = document.createTextNode(pvp_a[i].innerHTML),
								latests_span_2 = document.createElement("span");

							latests_span_2.className = pvp_a[i].className+ " term__text__result";
							latests_span_2.appendChild(latests_tn_2);
							latests_td_1.appendChild(latests_span_2);
						}

						latests_tr_1.appendChild(latests_td_1);
					}
					term__latest__bodyfrag.appendChild(latests_tr_1);
					a++;
				}
				$(term__latest__body).prepend(term__latest__bodyfrag);
		}
		var element = document.getElementById( 'term__body' );
		//element.scrollIntoView();
		element.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});

	}, 'json');

}
;/* global $, jQuery, google, stockAjax*/
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

				$('.js-show-support').on( 'click', function( e ) {					hide_support_table( '.js-support-list' );
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

