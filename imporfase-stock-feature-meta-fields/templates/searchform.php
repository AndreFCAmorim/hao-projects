<form role="search" method="get" id="header_search" class="search-form form-inline hidden-xs hidden-sm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only"><?php esc_html_e( 'Search for:', 'impstock' ); ?></label>
	<div class="input-group">
		<input type="search" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control input-sm" placeholder="<?php esc_html_e( 'Procurar', 'impstock' ); ?>">
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn noborder btn-sm buttonfy"><i class="glyphicon glyphicon-search lc_soft_white"></i></button>
		</span>
	</div>
</form>
