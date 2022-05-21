//Show Products on Page Load
function start_load_products(){
	var products_limit = document.getElementById("max_rows").options[document.getElementById("max_rows").selectedIndex].value;
	var ref = document.getElementById("search__ref").value;

	if ( ref !== '') {

		(function($) {
			$(document).ready(function() {
				$.ajax({
							type:     "post",
							dataType: "json",
							url:      ajax_obj.ajax_url,
							data: {
								action: "my_ajax_action",
								ref:    ref,
							},
							success: function(response) {
								if( response.success == true ) {
									if ( response.data['operation'] === "search") {
										$("#tablepress-4_length").css("display", "none");
										$(".pagination").css("display", "none");
									} else {
										$("#tablepress-4_length").css("display", "block");
										$(".pagination").css("display", "block");
									}
									$("#woocommerce-result-count").html(response.data['records']);
									$(".entry-content").html(response.data['content']);
								} else {
									console.log('Error...');
									console.log(response);
								}
							}
						});
			});
		})(jQuery);

		return;
	}

		(function($) {
			$(document).ready(function() {
				$.ajax({
							type:     "post",
							dataType: "json",
							url:      ajax_obj.ajax_url,
							data: {
								action:   "my_ajax_action",
								max_rows: products_limit,
								page:     1,
							},
							success: function(response) {
								if( response.success == true ) {
									$("#woocommerce-result-count").html(response.data['records']);
									$(".entry-content").html(response.data['content']);
									$(".pagination").css("display", "block");
									$(".pagination").html(response.data['navigation']);
								}
								else {
									console.log('Error...');
									console.log(response);
								}
							}
						});
			});
		})(jQuery);

}

//Function for navigation
function navigate_products(e){
	var products_limit = document.getElementById("max_rows").options[document.getElementById("max_rows").selectedIndex].value;
	var products_page = e.innerHTML;

	if (products_page === "Previous"){
		products_page = parseInt(document.getElementsByClassName("active")[0].innerText);
		products_page = parseInt(products_page) - 1;

	} else if (products_page === "Next"){
		products_page = parseInt(document.getElementsByClassName("active")[0].innerText);
		products_page = parseInt(products_page) + 1;

	}

	(function($) {
		$(document).ready(function() {
			$.ajax({
						type:     "post",
						dataType: "json",
						url:      ajax_obj.ajax_url,
						data: {
							action:   "my_ajax_action",
							max_rows: products_limit,
							page:     products_page,
						},
						success: function(response) {
							if( response.success == true ) {
								$("#woocommerce-result-count").html(response.data['records']);
								$(".entry-content").html(response.data['content']);
								$(".pagination").css("display", "block");
								$(".pagination").html(response.data['navigation']);
								window.scrollTo(0, 0);
							}
							else {
								console.log('Error...');
								console.log(response);
							}
						}
					});
		});
	})(jQuery);
}

(function($) {
	$(document).ready(function() {
		//Function for products display limit
		$("#max_rows").change( function(e) {
			var products_limit = $("#max_rows").children("option:selected").val();

			$.ajax({
					type:     "post",
					dataType: "json",
					url:      ajax_obj.ajax_url,
					data: {
						action:   "my_ajax_action",
						max_rows: products_limit,
						page:     1,
					},
					success: function(response) {
						if( response.success == true ) {
							$("#woocommerce-result-count").html(response.data['records']);
							$(".entry-content").html(response.data['content']);
							$(".pagination").css("display", "block");
							$(".pagination").html(response.data['navigation']);
						}
						else {
							console.log('Error...');
							console.log(response);
						}
					}
				});
		});

		//Function for search ref click enter key
		$("#search__ref").keyup( function(e) {
			var page_title = $("#page_title").html();
			if (e.keyCode === 13) {
				$.ajax({
					type:     "post",
					dataType: "json",
					url:      ajax_obj.ajax_url,
					data: {
						action: "my_ajax_action",
						ref:    $("#search__ref").val(),
					},
					success: function(response) {
						if( response.success == true ) {
							if ( response.data['operation'] === "search") {
								$("#tablepress-4_length").css("display", "none");
								$(".pagination").css("display", "none");
							} else {
								$("#tablepress-4_length").css("display", "block");
								$(".pagination").css("display", "block");
							}
							$("#woocommerce-result-count").html(response.data['records']);
							$(".entry-content").html(response.data['content']);
						} else {
							console.log('Error...');
							console.log(response);
						}
					}
				});
			}
		});

		//Function for sending email
		$(".make-order").submit( function(e) {
			e.preventDefault();
			$.ajax({
				type:     "post",
				dataType: "json",
				url:      ajax_obj.ajax_url,
				data: {
					action:       "my_ajax_action",
					client_cart:  $("#email__encs").val(),
					client_name:  $("#client__name").val(),
					client_email: $("#email__email").val(),
					client_phone: $("#phone__phone").val(),
				},
				success: function(response) {
					if( response.success == true ) {
						$("#email__encs").val('');
						$("#client__name").val('');
						$("#email__email").val('');
						$("#phone__phone").val('');

						$("#email__status").css({"display": "block", "background-color": "#54790d", "color": "#ffffff"});
						$("#email__status").html( response.data );
						setTimeout(
							function()
							{
								$("#email__status").css({"display": "block", "background-color": "#ffffff", "color": "#ffffff"});
								$("#email__status").html('');
							}, 5000);
					} else {
						$("#email__status").css({"display": "block", "background-color": "#e81010", "color": "#ffffff"});
						$("#email__status").html( response.data );
						setTimeout(
							function()
							{
								$("#email__status").css({"display": "block", "background-color": "#ffffff", "color": "#ffffff"});
								$("#email__status").html('');
							}, 5000);
					}
				}
			});
		});


	});
})(jQuery);
