function start_artists_first_load(){
	jQuery(function($) {
			$.ajax({
				type:     "post",
				dataType: "json",
				url:      ajax_obj.ajax_url,
				data: {
					action:   "my_ajax_action",
					page:     1,
					category: $(".artists-load-more-row__button").attr('data-category-id'),
				},
				success: function(response) {
					if( response.success == true ) {
						$(".artists").append( response.data['html'] );
					}
					else {
						console.log('Error...');
						console.log(response);
					}
				}
			});
	});
}


jQuery(function($) {
	$(".artists-load-more-row__button").click(function(){
		$.ajax({
			type:     "post",
			dataType: "json",
			url:      ajax_obj.ajax_url,
			data: {
				action:   "my_ajax_action",
				page:     $(".artists-load-more-row__button").attr('data-next-page'),
				category: $(".artists-load-more-row__button").attr('data-category-id'),
			},
			success: function(response) {
				if( response.success == true ) {
					$(".artists").append( response.data['html'] );
					let total_pages = $(".artists-load-more-row__button").attr('data-total-pages');
					if ( response.data['page'] > total_pages ) {
						$(".artists-load-more-row__button").css('display', 'none');
					} else {
						$(".artists-load-more-row__button").attr('data-next-page', response.data['page']);
					}
				}
				else {
					console.log('Error...');
					console.log(response);
				}
			}
		});
	});
});
;function start_magazine_first_load(){
	jQuery(function($) {
			$.ajax({
				type:     "post",
				dataType: "json",
				url:      ajax_obj.ajax_url,
				data: {
					action:   "my_ajax_action",
					page:     1,
					category: $(".magazine-load-more-row__button").attr('data-category-id'),
				},
				success: function(response) {
					if( response.success == true ) {
						$(".magazine").append( response.data['html'] );
					}
					else {
						console.log('Error...');
						console.log(response);
					}
				}
			});
	});
}


jQuery(function($) {
	$(".magazine-load-more-row__button").click(function(){
		$.ajax({
			type:     "post",
			dataType: "json",
			url:      ajax_obj.ajax_url,
			data: {
				action:   "my_ajax_action",
				page:     $(".magazine-load-more-row__button").attr('data-next-page'),
				category: $(".magazine-load-more-row__button").attr('data-category-id'),
			},
			success: function(response) {
				if( response.success == true ) {
					$(".magazine").append( response.data['html'] );
					let total_pages = $(".magazine-load-more-row__button").attr('data-total-pages');
					if ( response.data['page'] > total_pages ) {
						$(".magazine-load-more-row__button").css('display', 'none');
					} else {
						$(".magazine-load-more-row__button").attr('data-next-page', response.data['page']);
					}
				}
				else {
					console.log('Error...');
					console.log(response);
				}
			}
		});
	});
});
;function start_news_first_load(){
	jQuery(function($) {
			$.ajax({
				type:     "post",
				dataType: "json",
				url:      ajax_obj.ajax_url,
				data: {
					action:   "my_ajax_action",
					page:     1,
					category: $(".news-load-more-row__button").attr('data-category-id'),
				},
				success: function(response) {
					if( response.success == true ) {
						$(".news").append( response.data['html'] );
					}
					else {
						console.log('Error...');
						console.log(response);
					}
				}
			});
	});
}


jQuery(function($) {
	$(".news-load-more-row__button").click(function(){
		$.ajax({
			type:     "post",
			dataType: "json",
			url:      ajax_obj.ajax_url,
			data: {
				action:   "my_ajax_action",
				page:     $(".news-load-more-row__button").attr('data-next-page'),
				category: $(".news-load-more-row__button").attr('data-category-id'),
			},
			success: function(response) {
				if( response.success == true ) {
					$(".news").append( response.data['html'] );
					let total_pages = $(".news-load-more-row__button").attr('data-total-pages');
					if ( response.data['page'] > total_pages ) {
						$(".news-load-more-row__button").css('display', 'none');
					} else {
						$(".news-load-more-row__button").attr('data-next-page', response.data['page']);
					}
				}
				else {
					console.log('Error...');
					console.log(response);
				}
			}
		});
	});
});
;function start_podcasts_first_load(){
	jQuery(function($) {
			$.ajax({
				type:     "post",
				dataType: "json",
				url:      ajax_obj.ajax_url,
				data: {
					action:   "my_ajax_action",
					page:     1,
					category: $(".podcasts-load-more-row__button").attr('data-category-id'),
				},
				success: function(response) {
					if( response.success == true ) {
						$(".podcasts").append( response.data['html'] );
					}
					else {
						console.log('Error...');
						console.log(response);
					}
				}
			});
	});
}


jQuery(function($) {
	$(".podcasts-load-more-row__button").click(function(){
		$.ajax({
			type:     "post",
			dataType: "json",
			url:      ajax_obj.ajax_url,
			data: {
				action:   "my_ajax_action",
				page:     $(".podcasts-load-more-row__button").attr('data-next-page'),
				category: $(".podcasts-load-more-row__button").attr('data-category-id'),
			},
			success: function(response) {
				if( response.success == true ) {
					$(".podcasts").append( response.data['html'] );
					let total_pages = $(".podcasts-load-more-row__button").attr('data-total-pages');
					if ( response.data['page'] > total_pages ) {
						$(".podcasts-load-more-row__button").css('display', 'none');
					} else {
						$(".podcasts-load-more-row__button").attr('data-next-page', response.data['page']);
					}
				}
				else {
					console.log('Error...');
					console.log(response);
				}
			}
		});
	});
});

//# sourceMappingURL=dba_theme.js.map