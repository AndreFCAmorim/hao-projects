<?php

add_action('rest_api_init', function() {
	//Get specific data from a product by sku
	register_rest_route('hao/v1', '/product/(?P<sku>[^/]+)', [
		'methods'             => 'GET',
		'callback'            => 'return_impstock_product_data_by_sku',
		'permission_callback' => function() {
			return true;
		},
	]);

	//Get data from all products
	register_rest_route('hao/v1', '/all-products/(?P<nr_per_page>\d+)/(?P<current_page>\d+)', [
		'methods'             => 'GET',
		'callback'            => 'return_impstock_products_data',
		'permission_callback' => function() {
			return true;
		},
	]);

	//Get all product references
	register_rest_route('hao/v1', '/ref-products/', [
		'methods'             => 'GET',
		'callback'            => 'return_impstock_products_ref',
		'permission_callback' => function() {
			return true;
		},
	]);

	//Generate products sitemap
	register_rest_route('hao/v1', '/products-sitemap/(?P<key>[^/]+)', [
		'methods'             => 'GET',
		'callback'            => 'exec_impstock_sitemap_generator',
		'permission_callback' => function() {
			return true;
		},
	]);
});

function return_impstock_product_data_by_sku( $data ) {
	global $wpdb;
	$count    = 0;
	$products = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `codprimav` LIKE '%%%s%%' LIMIT 50", $data['sku'] . ' 00' ) );
	foreach ( $products as $parent ) {
		$equivalences = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `cdu_index` LIKE '%%%s%%'", $parent->cdu_index ) );
		foreach ( $equivalences as $child ) {
			$products_with_equivalences[] = [
				'cdu_index'    => $child->cdu_index,
				'vendor_short' => $child->vendor_short,
				'codprimav'    => $child->codprimav,
				'description'  => $child->description,
				'stock_qty'    => $child->stock_qty,
				'vendor_id'    => $child->vendor_id,
				'vendor_name'  => $child->vendor_name,
				'ref_vendor'   => $child->ref_vendor,
				'stock_res'    => $child->stock_res,
				'price'        => $child->price,
				'discount'     => $child->discount,
				'product_id'   => $child->product_id,
			];
			$count++;
		}
	}
	if ( ! isset( $products_with_equivalences ) ) {
		return;
	}
	return [ $products_with_equivalences, $count ];
}

function return_impstock_products_data( $data ) {
	global $wpdb;

	//If nr_per_page is empty > retuns nothing
	if ( $data['nr_per_page'] == 0 ) {
		$total_rows = $wpdb->get_var( 'SELECT COUNT(*) FROM remote_stock' );
		return $total_rows;
	}

	//If there's no current page > returns the total number of pages
	if ( ( $data['current_page'] == 0 ) ) {
		$total_rows  = $wpdb->get_var( 'SELECT COUNT(*) FROM remote_stock' );
		$total_pages = ceil( $total_rows / $data['nr_per_page'] );
		return $total_pages;
	}

	//Returns N products per page
	$offset   = ( $data['current_page'] - 1 ) * $data['nr_per_page'];
	$products = $wpdb->get_results(
		$wpdb->prepare(
			'SELECT * FROM remote_stock LIMIT %d, %d;',
			$offset, $data['nr_per_page']
		)
	);

	return $products;
}

function return_impstock_products_ref() {
	global $wpdb;
	$products = $wpdb->get_results( 'SELECT cdu_index, codprimav FROM remote_stock GROUP BY cdu_index' );
	return $products;
}

function exec_impstock_sitemap_generator( $data ) {
	$confirmation_key = '83Fk10c9';

	if ( $data['key'] === $confirmation_key ) {
		generate_impstock_sitemap( site_url() . '/products/', 'impstock_sitemap.xml' );
	}

	return '';
}
