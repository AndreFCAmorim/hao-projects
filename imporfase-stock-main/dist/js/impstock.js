/* global $, jQuery, google, stockAjax*/
'use strict';

(function ($) {
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

function show_support_table( table_id ) {
	$(table_id).show();
}

function hide_support_table( table_class ) {
	$(table_class).hide();
}
// Add Items To Basket
function addToBasket( sku, reference, pvp, discount ) {
	var selectionStart = $('#email__encs')[0].selectionStart;
	var selectionEnd = $('#email__encs')[0].selectionEnd;

	$('#email__encs').val($('#email__encs').val() + reference + ", \n");


	$('#email__encs')[0].selectionStart = selectionStart;
	$('#email__encs')[0].selectionEnd = selectionEnd;

	if (pvp) {
		pvp = parseFloat(pvp.slice(0, -2).replace(/,/g, '.'));
	} else {
		pvp = 0;
	}

	if (!discount) {
		discount = 0;
	}


	$('.email__cart-table').append('<tr id="' + sku + '"><td>' + reference + '</td><td><a class="removeCartItem" data-product_sku="' + sku + '" data-product_pvp="' + pvp +'" data-product_discount="' + discount + '">' + $(".email__cart-label-remove").text() +'</a></td></tr>');

	$('.email__cart-label').css("display","block");

	//Make calculations
	var current_pvp      = parseFloat($('#email__totals-pvp').html().slice(0, -2).replace(',', '.'));
	var current_discount = parseFloat($('#email__totals-discount').html().slice(0, -2).replace(',', '.'));
	var current_total    = parseFloat($('#email__totals-total').html().slice(0, -2).replace(',', '.'));

	var totals_pvp      = (current_pvp + pvp).toFixed(2);
	var totals_discount = (current_discount + (pvp * discount / 100)).toFixed(2);
	var totals_total    = (current_total + pvp - (pvp * discount / 100)).toFixed(2);

	$('#email__totals-pvp').html(totals_pvp.replace('.', ',') + ' €');
	$('#email__totals-discount').html(totals_discount.replace('.', ',') + ' €');
	$('#email__totals-total').html(totals_total.replace('.', ',') + ' €');
}

//Remove Items From Basket
function removeFromBasket(sku, pvp, discount) {

	var current_pvp      = parseFloat($('#email__totals-pvp').html().slice(0, -2).replace(',', '.'));
	var current_discount = parseFloat($('#email__totals-discount').html().slice(0, -2).replace(',', '.'));
	var current_total    = parseFloat($('#email__totals-total').html().slice(0, -2).replace(',', '.'));

	var totals_pvp      = (current_pvp - pvp).toFixed(2);
	var totals_discount = (current_discount - (pvp * discount / 100)).toFixed(2);
	var totals_total    = (Math.abs(current_total - (pvp - (pvp * discount / 100)))).toFixed(2);

	$('#email__totals-pvp').html(totals_pvp.replace('.', ',') + ' €');
	$('#email__totals-discount').html(totals_discount.replace('.', ',') + ' €');
	$('#email__totals-total').html(totals_total.replace('.', ',') + ' €');

	const row_desc = ($("#" + sku + " td:eq(0)")).text();
	var textarea = $("#email__encs").val();

	textarea = textarea.replace(row_desc + ', ','');
	textarea = textarea.replace(/^\s*[\r\n]/gm,'');

	if (!textarea) {
		$('.email__cart-label').css("display","none");
	}

	$("#email__encs").val(textarea);
	$("#" + sku).remove();
}

function highlightbody(ii,dd,cc,ss){
	setTimeout(function(){
		$('#term__body').css('backgroundColor','hsl('+ cc +','+ ss + '%,'+ii+'%)');
	}, dd);
}


function lightenTable(c,s) {
	$('#js-status').css('backgroundColor','hsl('+ c+ ', ' + s +'%, 74%)');
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
				$('#js-status').css('backgroundColor','rgba(0,0,0,0)');
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

function build_image( image_url ) {

	const classname = 'term__image_wrp';
	var d__wrp = document.createElement("div");
	d__wrp.className = classname;

	if ( image_url) {
		var img_el = document.createElement( 'img' );
		img_el.src = image_url;
		img_el.className= 'term__image';
		d__wrp.appendChild(img_el);
	}


	return d__wrp;
}

function build_header( header ) {

	const classname = 'product__wrap term__info';

	var contains_span_ref = document.createElement( 'span' );
	var content_ref = document.createTextNode( header );
	contains_span_ref.className= 'term__vendor';
	contains_span_ref.appendChild( content_ref );
	var d__wrp = document.createElement("div");
	d__wrp.className = classname;

	d__wrp.appendChild(contains_span_ref);

	return d__wrp;
}
function build_main( main ){

	const classname = 'product__wrap product__found';
	var term__bodyfrag = build_line( main, classname );

	return term__bodyfrag;
}
function build_xrefs( xrefs ){

	const classname = 'product__wrap product__equivalence';
	var term__bodyfrag = document.createDocumentFragment();
	xrefs.forEach( function( result ) {
		term__bodyfrag.appendChild( build_line( result, classname ) );
	});

	return term__bodyfrag;
}

function build_brand( $brand ) {

	var content_text_ref_vendor = document.createTextNode( $brand ),
	content_span_ref_vendor = document.createElement( 'span' );
	content_span_ref_vendor.className = 'term__vendor';
	content_span_ref_vendor.appendChild( content_text_ref_vendor );
	return content_span_ref_vendor;

}

function build_reference( ref, discount_leter ) {

	// 2.0 create element
	var col__ref = document.createElement( 'p' );
	col__ref.className = 'term__data term__ref__data';

	// 2.1 add price
	var contains_span_ref = document.createElement( 'span' );
	var content_ref = document.createTextNode( ref );
	contains_span_ref.className= 'term__text__query';
	contains_span_ref.appendChild( content_ref );
	col__ref.appendChild(contains_span_ref);

	// 2.2 add discount letter
	var content_span_ref_letter = '';
	if ( discount_leter !== '' ) {

		const discount_letter_text = ' (' + discount_leter + ')';

		var content_text_ref_letter = document.createTextNode( discount_letter_text ),
		content_span_ref_letter = document.createElement( 'span' );

		content_span_ref_letter.appendChild(content_text_ref_letter);
		content_span_ref_letter.className= 'term__letter';
	}

	col__ref.appendChild(content_span_ref_letter);
	return col__ref;
}

function build_pvp( pvp, discount ) {

	var contains_pvp = '';
	if ( pvp === "" ) {
		contains_pvp = "-";
	} else {
		contains_pvp = pvp;
	}

	// 3.0 create element
	var contains_span_pvp = document.createElement("span");
	contains_span_pvp.className= "term__text__pvp";


	// 3.1 add pvp
	var content_pvp = document.createTextNode(contains_pvp);
	contains_span_pvp.appendChild(content_pvp);


	// 3.2 add audience
	var content_text_price_audience = document.createTextNode('( ' + impstock_data.rP + ')'),
	content_span_price_audience = document.createElement('span');

	content_span_price_audience.appendChild(content_text_price_audience);
	content_span_price_audience.className= "term__audience";
	contains_span_pvp.appendChild(content_span_price_audience);

	/* 3.3 discount value */
	var discount_value = '';
	if( discount !== '' ) {
		discount_value += discount + '%';
	}
	var content_text_ref_discount = document.createTextNode( discount_value ),
		content_span_ref_discount = document.createElement("span");
	content_span_ref_discount.appendChild(content_text_ref_discount);
	content_span_ref_discount.className = "term__discount";
	contains_span_pvp.appendChild(content_span_ref_discount);


	// return col
	return contains_span_pvp;
}

function build_order_btn( stock_qty, stock_reserved, product_ref, product_name, pvp, discount ) {

	// 4.0 create element
	var col__order_button = document.createElement( 'button' );
	var contains_stk = '';
	var contains_stk_class = '';

	var qt_int       = stock_qty.replace( ',', '.' );
	var qt_ttl       = false;
	var qty_add_cart = false;
	const term__qt   = 1;

	// 3.1 calculate stock
	// 3.1.1 calculate remainder after reserved
	if ( null !== stock_reserved ){
		var stock_class_base = 'term__avail btn glyphicon ';
		var qt_res = stock_reserved.replace( ',', '.' );
		qt_ttl = qt_int - qt_res;
		if ( ~~qt_ttl >= ~~term__qt && ~~qt_int >= ~~term__qt ) { // binary compare
			contains_stk_class = 'glyphicon-ok btn-success';
			qty_add_cart = true;
		} else if ( ~~qt_ttl < ~~term__qt && ~~qt_int >= ~~term__qt ) {
			qty_add_cart = false;
			contains_stk_class = 'glyphicon-remove btn-warning';
		} else if ( ~~qt_ttl < ~~term__qt && ~~qt_int < ~~term__qt ) {
			qty_add_cart = false;
			contains_stk_class = 'glyphicon-remove btn-danger';
		}
	} else { // 3.1.2 no reserved orders
		if ( ~~qt_int > ~~term__qt ) { // binary compare
			qty_add_cart = true;
			contains_stk_class = 'glyphicon-ok btn-success';
		} else if ( ~~qt_int === ~~term__qt ) {
			qty_add_cart = false;
			contains_stk_class = 'glyphicon-remove btn-warning';
		} else if ( ~~qt_int < ~~term__qt ) {
			qty_add_cart = false;
			contains_stk_class = 'glyphicon-remove btn-danger';
		}
	}

	// 3.2 create button
	var contains_span_stk = document.createElement("span"),
	content_stk = document.createTextNode( contains_stk );
	contains_span_stk.className = stock_class_base + contains_stk_class;
	contains_span_stk.appendChild(content_stk);

	// if there's at least one item
	if( qty_add_cart ) {
		var add_to_cart_text = document.createTextNode( impstock_data.addToOrder );
		col__order_button.appendChild(add_to_cart_text);
		col__order_button.className = "term__cart term__qty__data js-add__cart";
	} else { // request info
		var add_to_cart_text = document.createTextNode( impstock_data.getDeliveryDate );

		col__order_button.className = "term__cart term__not-available js-add__cart js-ask-avail";
		col__order_button.appendChild(add_to_cart_text);
	}

	col__order_button.dataset.product_sku = product_ref;
	col__order_button.dataset.product_name = product_name;
	col__order_button.dataset.product_pvp = pvp;
	col__order_button.dataset.product_discount = discount;

	col__order_button.appendChild(contains_span_stk);

	return col__order_button;
}

function build_overlay() {
	var d__ovl = document.createElement("div"),
	h__msg = document.createElement("h2"),
	i__chk = document.createElement("i");

	d__ovl.className = "product__overlay";
	h__msg.className = "product__overlay__title";
	i__chk.className = "glyphicon glyphicon-ok btn btn-success";
	// div.product_overlay has h2 and i
	var h__msg_text = document.createTextNode( impstock_data.addedToOrder );
	h__msg.appendChild(h__msg_text);
	d__ovl.appendChild(h__msg);
	d__ovl.appendChild(i__chk);

	return d__ovl;
}

function build_line ( result, classname ) {

	// no repaints
	var term__bodyfrag = document.createDocumentFragment();

	var d__wrp       = document.createElement("div");
	d__wrp.className = classname;

	var d__inn       = document.createElement("div");
	d__inn.className = "product__inner";

	// add columns
	/** e = [
	 * 0: 'vendor_name'
	 * 1: $ref_vendor,
	 * 2: $price_formatted,
	 * 3: stock_qty,
	 * 4: discount,
	 * 5: stock_res,
	 * 6: $discount_value ---- not used
	 * 7: $product_name   ---- not used
	 * ]
	 */


	// 1 - brand
	var brand_col = build_brand( result[0] );
	d__inn.appendChild( brand_col );

	// 2 - reference
	var ref_col = build_reference( result[1], result[4] );
	d__inn.appendChild( ref_col );

	// 3 - price
	var php_col = build_pvp( result[2], result[6] );
	d__inn.appendChild( php_col );

	// 4 - order button
	var order_btn = build_order_btn( result[3], result[5], result[1], result[7], result[2], result[6] );
	d__inn.appendChild( order_btn );

	// add to wrapper element
	d__wrp.appendChild( d__inn );

	// add overlay
	var overlay = build_overlay();
	d__wrp.appendChild( overlay );

	// add to fragment
	term__bodyfrag.appendChild( d__wrp );

	return term__bodyfrag;

}
function search_term() {

	var term__text = jQuery("#term__text").val();
	var client_code = jQuery("#client__code").val();
	var client_id = jQuery("#client__id").val();
	var page_id = jQuery("#page_id").val();
	var post_data = {
		action: 'get_terms',
		term_text: term__text,
		client_code: client_code,
		client_id: client_id,
		page_id: page_id,
		getterms_nonce: impstock_data.gettermsNonce
	};

	$('#term__body').empty();

	jQuery.post( impstock_data.ajaxurl, post_data , function(response) {

		var term__body = {};
		var term__body = document.getElementById("term__body");
		if ( ( response === '' || response === 0 ) || ! ( response.match || response.alts ) ) {
			term__body.textContent = '';
			lightenTable(0,100); // red
			return;
		}

		term__body.textContent = '';
		if ( response.match ) {

			for ( const result of response.match ) {
				var div__row = document.createElement( 'div' );
				div__row.className = 'row product__line';

				div__row.appendChild( build_image( result.image ) );
				div__row.appendChild( build_header( result.header ) );
				div__row.appendChild( build_main( result.main ) );

				if (typeof result.xrefs != "undefined") {
					div__row.appendChild( build_xrefs( result.xrefs ) );
				} else {
					return;
				}

				term__body.appendChild( div__row );

			}

		}
		if ( response.alts ) {
			for ( const result of response.alts ) {
				var div__row = document.createElement( 'div' );
				div__row.className = 'row product__line';

				div__row.appendChild( build_header( result.header ) );
				div__row.appendChild( build_main( result.main ) );

				if (typeof result.xrefs != "undefined") {
					div__row.appendChild( build_xrefs( result.xrefs ) );
				} else {
					return;
				}

				term__body.appendChild( div__row );
			}

		}

	}, 'json')
	.fail(function( e ) {
	})
	.always(function( e ) {
	});
}

jQuery(document).ready(function() {

	$(document).on('click', '.removeCartItem', function (e) {
		var self = $(this);
		var product_sku      = self.data('product_sku');
		var product_pvp      = self.data('product_pvp');
		var product_discount = self.data('product_discount');
		removeFromBasket(product_sku, product_pvp, product_discount);
	}),

	$(document).on('click', '.js-btn-toggle-cart', function (e) {
		e.preventDefault(),
		toggle_cart()
	}),
	$(document).on('click', '.js-btn-toggle-lists', function (e) {
		e.preventDefault(),
		toggle_lists()
	});

	$('.js-show-support').on( 'click', function( e ) {
		hide_support_table( '.js-support-list' );
		show_support_table( '.' + $(this).data( 'tableid' ) );
	});
	$('.js-hide-support').on( 'click', function( e ) {
		hide_support_table( '.js-support-list' );
	});

	$('#term__qt').bind('keydown',function(e){
		return isNumeric(e);
	});

	$(document).on("click", '#btn-submit-search',function(e) {
		e.preventDefault();
		search_term();

	});

	$(document).on( 'click', '.js-add__cart', function() {
		var self = $(this);
		var product_sku      = self.data('product_sku');
		var product_name     = self.data('product_name');
		var product_pvp      = self.data('product_pvp');
		var product_discount = self.data('product_discount');
		var ref_extra = '';
		if ( $(this).hasClass('js-ask-avail') ) {
			ref_extra = ' - Pedir Prazo de Entrega';
		}

		addToBasket(product_sku, product_sku + ' ' + product_name + ref_extra, product_pvp, product_discount );


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

}(jQuery));

//# sourceMappingURL=impstock.js.map