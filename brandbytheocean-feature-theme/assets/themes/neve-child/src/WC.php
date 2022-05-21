<?php
namespace GoodOmens\WP\Theme\JJ;

class WC implements Startable {

	public function start() {

		$this->init_hooks();

	}
	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {

		add_action( 'pre_get_posts', [ $this, 'shop_filter_cat' ] );
		add_filter( 'woocommerce_return_to_shop_text', [ $this, 'return_to_shop' ] );

	}

	public function shop_filter_cat( $query ) {
		if ( is_admin() || ! is_post_type_archive( 'product' ) || ! $query->is_main_query()) {
			return $query;
		}
		$shop_query = [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'jewellery',
			],
		];
		$query->set( 'tax_query', $shop_query );
	}

	public function return_to_shop() {
		return esc_html__( 'Let\'s go shopping!', 'jjtheme' );
	}
}

