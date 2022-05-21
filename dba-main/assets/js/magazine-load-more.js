jQuery(function($) {
	$('.magazine-load-more-row__button').click(function(){
		$button = $('.magazine-load-more-row__button');
		$.ajax({
			type:     'post',
			dataType: 'json',
			url:      ajax_obj.ajax_url,
			data: {
				action:         'dba_load_more_action',
				category:       $button.attr('data-category-id'),
				page:           $button.attr('data-next-page'),
				order:          $button.attr('data-order'),
				posts_per_page: $button.attr('data-posts-per-page'),
				mode:           $button.attr('data-mode'),
			},
			success: function(response) {
				if( response.success == true ) {
					$('.magazine').append( response.data['html'] );
					if ( response.data['html'] === '' ) {
						$('.magazine-load-more-row__button').css('display', 'none');
						return;
					}
					$('.magazine-load-more-row__button').attr('data-next-page', response.data['page']);
					return;
				}

				console.log( 'Error...' );
				console.log( response );
			}
		});
	});
});
