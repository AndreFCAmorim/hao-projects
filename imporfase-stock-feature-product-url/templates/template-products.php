<?php
/**
 * Template Name: Products Page
 * Template Post Type: page
 */

//Search REF
$products_ref = get_query_var ( 'ref' );
?>

<article <?php post_class( ' col-xs-12 col-md-12' ); ?>>

	<?php
	$title_class = '';
	if ( isset( $header_thumbnail ) ) {
		$title_class = ' header_thumbnail';
	}
	?>
	<header>
		<h1 class="entry-title tac"><?php the_title(); ?></h1>
	</header>


	<div class="before-shop-main">
		<div class="row">
			<div id="products_breadcrumbs" class="col-xs-12 col-md-9 col-sm-12">
				<nav class="woocommerce-breadcrumb">
					<a href="<?php echo esc_html( site_url() ); ?>"><?php esc_html_e( 'Home', 'impstock' ); ?></a>&nbsp;/&nbsp;<?php the_title(); ?>
				</nav>
				<p id="woocommerce-result-count"></p>
				<div class="dataTables_length" id="tablepress-4_length">
					<label><?php esc_html_e( 'Show', 'impstock' ); ?> <select id="max_rows" name="tablepress-4_length" aria-controls="tablepress-4" class="">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select> <?php esc_html_e( 'records', 'impstock' ); ?></label>
				</div>
			</div>
			<div id="search__form" class="form-horizontal">
				<div class="col-md-3">
					<div class="form-group ">
						<label class="floatl" for="search__ref"><?php esc_html_e( 'Reference', 'impstock' ); ?></label>
						<input type="text" required="" class="form-control " id="search__ref" name="search__ref" value="<?php echo esc_html( $products_ref ); ?>" tabindex="1" placeholder="ref*">
					</div>
					<p class="hidden-xs hidden-sm "><?php esc_html_e( 'Press', 'impstock' ); ?> <kbd><?php esc_html_e( 'enter', 'impstock' ); ?></kbd> <?php esc_html_e( 'to search', 'impstock' ); ?></p>
				</div>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 row-sidebar-toggle desktop">
				<span class="hestia-sidebar-open btn btn-border">
					<i class="fas fa-filter" aria-hidden="true"></i>
				</span>
			</div>
		</div>

		<ul class="pagination"></ul>

	</div>

	<div class="entry-content"></div>

	<ul class="pagination"></ul>


	<div class="email__order">
		<!-- &#x25B2; and &#x25BC; -->
		<div class="email__toggle">
			<button id="btn-toggle-cart" class="btn btn-info btn-sm js-btn-toggle-cart js-show-cart-mode">
				<div class="js-show-cart">
					<span class="chevron">&#x25B2;</span><?php esc_html_e( 'Show Cart', 'impstock' ); ?>
				</div>
				<div class="js-hide-cart">
					<span class="chevron">&#x25BC;</span><?php esc_html_e( 'Hide Cart', 'impstock' ); ?>
				</div>
			</button>
		</div>
		<form
			id = "email__form"
			class = "form-horizontal col-md-12 float-label make-order"
			method = "post">
			<div class="col-md-12">
				<div class="form-group" >

					<textarea
						class = "form-control"
						id    = "email__encs"
						name  = "email__encs"
						value = ""
						cols  = "55"
						rows  = "2"
						placeholder ="<?php esc_html_e( 'Reference list*', 'impstock' ); ?>" required></textarea>
					<label class="" for="email__encs"><?php esc_html_e( 'References to order', 'impstock' ); ?></label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group ">
					<input
						type  = "text"
						class = "form-control "
						id    = "client__name"
						name  = "client__name"
						value = ""
						placeholder ="<?php esc_html_e( 'Your name*', 'impstock' ); ?>" required>
					<label class="" for="client__name"><?php esc_html_e( 'Your name', 'impstock' ); ?></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group ">

					<input
						type  = "email"
						class = "form-control"
						id    = "email__email"
						name  = "email__email"
						value = ""
						placeholder ="<?php esc_attr_e( 'Your email*', 'impstock' ); ?>" required>
					<label class="" for="email__email"><?php esc_html_e( 'Your email address', 'impstock' ); ?></label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group ">
					<input
						type  = "text"
						class = "form-control "
						id    = "phone__phone"
						name  = "phone__phone"
						value = ""
						placeholder ="<?php esc_attr_e( 'Your phone*', 'impstock' ); ?>" required>
					<label class="" for="phone__phone"><?php esc_html_e( 'Your phone number', 'impstock' ); ?></label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group ">
					<input type="hidden" name="client__id" id="client__id" value="">
					<input type="hidden" name="email__send" value="sendrefs">
					<input type="submit" value="<?php esc_attr_e( 'Send', 'impstock' ); ?>" id="btn-submit-order" class="btn btn-default below30">
				</div>
			</div>
			<div style="font-size: 18px; text-align:center; display:none;" id="email__status" class="col-md-12"></div>
		</form>
	</div>
</article>

<script>
	start_load_products();
</script>
