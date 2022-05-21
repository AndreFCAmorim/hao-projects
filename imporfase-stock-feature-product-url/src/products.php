<?php
add_filter( 'wp_title', 'wp_impstock_custom_page_title' );
function wp_impstock_custom_page_title() {
	$products_ref = get_query_var ( 'ref' );
	if ( ! empty ( $products_ref ) ) {
		$product_data = get_impstock_data_from_ref( $products_ref );
		if ( ! empty( $product_data ) ) {
			return $products_ref . ' - ' . $product_data[0][0]['description'] . ' | ' . get_bloginfo( 'name' );
		}
			return $products_ref . ' | ' . get_bloginfo( 'name' );
	} else {
		return the_title() . ' | ' . get_bloginfo( 'name' );
	}
}

add_action( 'init', 'wp_impstock_route_rules' );
function wp_impstock_route_rules() {
	add_rewrite_rule( 'products/([^/]*)/?$', 'products/?ref=$1' );
}


add_action( 'init', 'wp_impstock_register_param' );
function wp_impstock_register_param() {
	global $wp;
	$wp->add_query_var( 'ref' );
}

add_action( 'wp_ajax_my_ajax_action', 'wp_impstock_handle_ajax' );
add_action( 'wp_ajax_nopriv_my_ajax_action', 'wp_impstock_handle_ajax' );
function wp_impstock_handle_ajax() {

	if ( isset( $_REQUEST['ref'] ) ) {

		if ( empty( $_REQUEST['ref'] ) ) {
			$html['operation'] = 'show-all';
			$html['records']   = render_impstock_count_records_all_products( 10, 1 );
			$html['content']   = render_impstock_content_all_products( 10, 1 );
		} else {
			$html['operation'] = 'search';
			$html['records']   = render_impstock_count_records_from_search( $_REQUEST['ref'] );
			$html['content']   = render_impstock_content_from_search( $_REQUEST['ref'] );
		}

		$result = [
			'operation' => $html['operation'],
			'records'   => $html['records'],
			'content'   => $html['content'],
		];

		return wp_send_json_success( $result );

	}

	if ( isset( $_REQUEST['max_rows'] ) ) {

		$html['records']    = render_impstock_count_records_all_products( $_REQUEST['max_rows'], $_REQUEST['page'] );
		$html['content']    = render_impstock_content_all_products( $_REQUEST['max_rows'], $_REQUEST['page'] );
		$html['navigation'] = render_impstock_pagination( $_REQUEST['max_rows'], $_REQUEST['page'] );

		$result = [
			'records'    => $html['records'],
			'content'    => $html['content'],
			'navigation' => $html['navigation'],
		];

		return wp_send_json_success( $result );
	}

	if ( isset( $_REQUEST['client_cart'] ) ) {

		$admin_email = 'vendas@imporfase.com';

		if ( WP_ENV === 'development' ) {
			$admin_email = 'andre@hopeandoak.agency';
		}

		$mail_status = send_impstock_order( $admin_email, $_REQUEST['client_cart'], $_REQUEST['client_name'], $_REQUEST['client_email'], $_REQUEST['client_phone'] );

		if ( $mail_status ) {
			$result = __( 'Thank you for your order.', 'impstock' );
			return wp_send_json_success( $result );
		} else {
			$result = __( "It wasn't possible to process your order. Please try again later.", 'impstock' );
			return wp_send_json_error( $result );
		}
	}

}

function get_impstock_data_from_ref( $ref ) {
	$url          = site_url() . '/wp-json/hao/v1/product/' . $ref . '/';
	$response     = wp_remote_get( esc_url_raw( $url ) );
	$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

	return $api_response;
}

function get_impstock_data( $limit, $products_page ) {
	$url          = site_url() . '/wp-json/hao/v1/all-products/' . $limit . '/' . $products_page . '/';
	$response     = wp_remote_get( esc_url_raw( $url ) );
	$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

	return $api_response;
}

function get_impstock_total_pages( $limit ) {
	$url          = site_url() . '/wp-json/hao/v1/all-products/' . $limit . '/0/';
	$response     = wp_remote_get( esc_url_raw( $url ) );
	$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

	return $api_response;
}

function get_impstock_total_rows() {
	$url          = site_url() . '/wp-json/hao/v1/all-products/0/0/';
	$response     = wp_remote_get( esc_url_raw( $url ) );
	$api_response = json_decode( wp_remote_retrieve_body( $response ), true );

	return $api_response;
}

function get_impstock_vendor_name( $vendor_id ) {
	$allowed_vendors = [
		3   => 'Veneporte',
		8   => 'Outros Fabricantes',
		13  => 'Fabriscape',
		30  => 'Walker',
		31  => 'Klarius',
		32  => 'Bosal',
		33  => 'BM Catalysts',
		34  => 'Cat & Pipes',
		35  => 'FA1',
		38  => 'EEC',
		43  => 'JMJ',
		47  => 'Imporspeed',
		143 => 'Polmo',
		221 => 'Walker',
	];

	if ( empty( $allowed_vendors[ $vendor_id ] ) ) {
		return;
	}

	return $allowed_vendors[ $vendor_id ];
}

function get_impstock_ref() {
	$url          = site_url() . '/wp-json/hao/v1/ref-products/';
	$response     = wp_remote_get( esc_url_raw( $url ) );
	$api_response = json_decode( wp_remote_retrieve_body( $response ), true );
	return $api_response;
}

function render_impstock_count_records_from_search( $ref ) {
	$search_result         = get_impstock_data_from_ref( $ref );
	$search_products_count = $search_result[1];

	$html = __( 'Showing', 'impstock' ) . ' ' . $search_products_count . ' ' . __( 'result(s)', 'impstock' );

	return $html;
}

function render_impstock_content_from_search( $ref ) {
	$html  = '<div id="term__body" class="term__result" style="background-color: rgb(255, 255, 255);">';
	$html .= '<div class="row product__line">';

	$search_result        = get_impstock_data_from_ref( $ref );
	$search_products_data = $search_result[0];

	foreach ( $search_products_data as $product_data ) {
		$vendor = get_impstock_vendor_name( $product_data['vendor_id'] );
		if ( empty( $vendor ) ) {
			continue;
		}

		if ( substr( $product_data['codprimav'], -3 ) === ' 00' ) {
			$html .= '<div class="product__wrap term__info">';
			$html .= '<span class="term__vendor"><a href="' . get_permalink() . substr( $product_data['cdu_index'], 2 ) . '">' . $product_data['description'] . '</a></span>';
			$html .= '</div>';
			$html .= '<div class="term__image_wrp"><img src="' . search_image_xref( $ref ) . '" class="term__image"></div>';
			$html .= '<div class="product__wrap product__found">';
			$html .= '<div class="product__inner">';
			$html .= '<span class="term__vendor">' . $vendor . '</span>';
			$html .= '<p class="term__data term__ref__data">';
			$html .= '<span class="term__text__query">';

			if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
				$html .= $product_data['cdu_index'];
			} else {
				$html .= $product_data['ref_vendor'];
			}
			$html .= '</span>';
			$html .= '<span class="term__letter">' . $product_data['discount'] . '</span>';
			$html .= '</p>';
			$html .= '<span class="term__text__pvp">' . round( $product_data['price'], 2 ) . '&nbsp;€';
			$html .= '<span class="term__audience">( PVP)</span>';
			$html .= '<span class="term__discount"></span>';
			$html .= '</span>';
			if ( $product_data['stock_qty'] == 0 ) {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__not-available js-add__cart js-ask-avail" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Request estimated time of delivery', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-remove btn-danger"></span></button>';
			} else {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__qty__data js-add__cart" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Add to cart', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-ok btn-success"></span></button>';
			}
			$html .= '</div>';
			$html .= '<div class="product__overlay">';
			$html .= '<h2 class="product__overlay__title">' . __( 'Added!', 'impstock' ) . '</h2>';
			$html .= '<i class="glyphicon glyphicon-ok btn btn-success"></i>';
			$html .= '</div>';
			$html .= '</div>';
		} else {
			$html .= '<div class="product__wrap product__equivalence">';
			$html .= '<div class="product__inner">';
			$html .= '<span class="term__vendor">' . $vendor . '</span>';
			$html .= '<p class="term__data term__ref__data">';
			$html .= '<span class="term__text__query">';
			if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
				$html .= $product_data['cdu_index'];
			} else {
				$html .= $product_data['ref_vendor'];
			}
			$html .= '</span>';
			$html .= '<span class="term__letter">' . $product_data['discount'] . '</span>';
			$html .= '</p>';
			$html .= '<span class="term__text__pvp">' . round( $product_data['price'], 2 ) . '&nbsp;€';
			$html .= '<span class="term__audience">( PVP)</span>';
			$html .= '<span class="term__discount"></span>';
			$html .= '</span>';
			if ( $product_data['stock_qty'] == 0 ) {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__not-available js-add__cart js-ask-avail" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Request estimated time of delivery', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-remove btn-danger"></span></button>';
			} else {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__qty__data js-add__cart" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Add to cart', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-ok btn-success"></span></button>';
			}
			$html .= '</div>';
			$html .= '<div class="product__overlay">';
			$html .= '<h2 class="product__overlay__title">' . __( 'Added!', 'impstock' ) . '</h2>';
			$html .= '<i class="glyphicon glyphicon-ok btn btn-success"></i>';
			$html .= '</div>';
			$html .= '</div>';
		}
	}

	if ( $search_result[1] == 0 ) {
		$html .= '<h2>' . __( "We coudn	't find any product with that reference!", 'impstock' ) . '</h2>';
	}

	return $html;
}

function render_impstock_count_records_all_products( $products_limit, $products_page ) {
	$products_total_rows['real'] = get_impstock_total_rows();
	if ( intval( $products_page * $products_limit ) < $products_total_rows['real'] ) {
		$products_total_rows['calc'] = intval( $products_page * $products_limit );
	} else {
		$products_total_rows['calc'] = $products_total_rows['real'];
	};

	$start_count = intval( ( $products_page * $products_limit ) - $products_limit + 1 ) . '-' . $products_total_rows['calc'];
	$end_count   = $products_total_rows['real'];

	$html = __( 'Showing', 'impstock' ) . ' ' . $start_count . ' ' . __( 'of', 'impstock' ) . ' ' . $end_count . ' ' . __( 'result(s)', 'impstock' );

	return $html;
}

function render_impstock_content_all_products( $products_limit, $products_page ) {
	$html  = '<div id="term__body" class="term__result" style="background-color: rgb(255, 255, 255);">';
	$html .= '<div class="row product__line">';

	$all_products     = get_impstock_data( $products_limit, $products_page );
	$total_rows_count = get_impstock_total_rows();

	foreach ( $all_products as $product_data ) {
		$vendor = get_impstock_vendor_name( $product_data['vendor_id'] );
		if ( empty( $vendor ) ) {
			continue;
		}

		if ( substr( $product_data['codprimav'], -3 ) === ' 00' ) {

			$html .= '<div class="product__wrap term__info">';
			$html .= '<span class="term__vendor"><a href="' . get_permalink() . substr( $product_data['cdu_index'], 2 ) . '">' . $product_data['description'] . '</a></span>';
			$html .= '</div>';
			if ( substr( $product_data['cdu_index'], 0, 2 ) === '00' ) {
				if ( ! empty( search_image_xref( substr( $product_data['cdu_index'], 2 ) ) ) ) {
					$html .= '<div class="term__image_wrp"><img src="' . search_image_xref( substr( $product_data['cdu_index'], 2 ) ) . '" class="term__image"></div>';
				}
			} else {
				if ( ! empty( search_image_xref( $product_data['cdu_index'] ) ) ) {
					$html .= '<div class="term__image_wrp"><img src="' . search_image_xref( $product_data['cdu_index'] ) . '" class="term__image"></div>';
				}
			}
			$html .= '<div class="product__wrap product__found">';
			$html .= '<div class="product__inner">';
			$html .= '<span class="term__vendor">' . $vendor . '</span>';
			$html .= '<p class="term__data term__ref__data">';
			$html .= '<span class="term__text__query">';

			if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
				$html .= $product_data['cdu_index'];
			} else {
				$html .= $product_data['ref_vendor'];
			}
			$html .= '</span>';
			$html .= '<span class="term__letter">' . $product_data['discount'] . '</span>';
			$html .= '</p>';
			$html .= '<span class="term__text__pvp">' . round( $product_data['price'], 2 ) . '&nbsp;€';
			$html .= '<span class="term__audience">( PVP)</span>';
			$html .= '<span class="term__discount"></span>';
			$html .= '</span>';
			if ( $product_data['stock_qty'] == 0 ) {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__not-available js-add__cart js-ask-avail" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Request estimated time of delivery', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-remove btn-danger"></span></button>';
			} else {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__qty__data js-add__cart" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Add to cart', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-ok btn-success"></span></button>';
			}
			$html .= '</div>';
			$html .= '<div class="product__overlay">';
			$html .= '<h2 class="product__overlay__title">' . __( 'Added!', 'impstock' ) . '</h2>';
			$html .= '<i class="glyphicon glyphicon-ok btn btn-success"></i>';
			$html .= '</div>';
			$html .= '</div>';
		} else {
			$html .= '<div class="product__wrap product__equivalence">';
			$html .= '<div class="product__inner">';
			$html .= '<span class="term__vendor">' . $vendor . '</span>';
			$html .= '<p class="term__data term__ref__data">';
			$html .= '<span class="term__text__query">';
			if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
				$html .= $product_data['cdu_index'];
			} else {
				$html .= $product_data['ref_vendor'];
			}
			$html .= '</span>';
			$html .= '<span class="term__letter">' . $product_data['discount'] . '</span>';
			$html .= '</p>';
			$html .= '<span class="term__text__pvp">' . round( $product_data['price'], 2 ) . '&nbsp;€';
			$html .= '<span class="term__audience">( PVP)</span>';
			$html .= '<span class="term__discount"></span>';
			$html .= '</span>';
			if ( $product_data['stock_qty'] == 0 ) {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__not-available js-add__cart js-ask-avail" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Request estimated time of delivery', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-remove btn-danger"></span></button>';
			} else {
				if ( $product_data['ref_vendor'] === 'NULL' || empty( $product_data['ref_vendor'] ) ) {
					$sku = $product_data['cdu_index'];
				} else {
					$sku = $product_data['ref_vendor'];
				}
				$html .= '<button class="term__cart term__qty__data js-add__cart" data-product_sku="' . $sku . '" data-product_name="' . $product_data['description'] . '">' . __( 'Add to cart', 'impstock' ) . '<span class="term__avail btn glyphicon glyphicon-ok btn-success"></span></button>';
			}
			$html .= '</div>';
			$html .= '<div class="product__overlay">';
			$html .= '<h2 class="product__overlay__title">' . __( 'Added!', 'impstock' ) . '</h2>';
			$html .= '<i class="glyphicon glyphicon-ok btn btn-success"></i>';
			$html .= '</div>';
			$html .= '</div>';
		}
	}

	if ( $total_rows_count == 0 ) {
		$html .= '<h2>' . __( "We coudn	't find any product with that reference!", 'impstock' ) . '</h2>';
	}

	return $html;
}

function render_impstock_pagination( $limit, $products_page ) {
	$total_pages = get_impstock_total_pages( $limit );
	$html        = '';

	//PEVIOUS
	if ( $products_page == 1 ) {
		$html .= '<li class="disabled">';
	} else {
		$html .= '<li>';
	}
	$html .= '<a onclick="navigate_products(this)">' . __( 'Previous', 'impstock' ) . '</a>';
	$html .= '</li>';

	//FIRST
	if ( $products_page == 1 ) {
		$html .= '<li class="active">';
		$html .= '<a onclick="navigate_products(this)">1</a>';
	} else {
		$html .= '<li>';
		$html .= '<a onclick="navigate_products(this)">1</a>';
	}
	$html .= '</li>';

	//SEPARATOR = ...
	if ( $products_page > 7 ) {
		$html .= '<li class="seperator">';
		$html .= '<a>...</a>';
		$html .= '</li>';
	}

	//PAGES BEFORE CURRENT
	$page_limit_before_current = 5;
	for ( $count = 0; $count < $page_limit_before_current; $count++ ) {

		if ( intval( $products_page - $page_limit_before_current + $count ) <= 1 ) { //Prevent negative numbers
			continue;
		}

		if ( $count != $products_page ) {
			$html .= '<li>';
			$html .= '<a onclick="navigate_products(this)">' . intval( $products_page - $page_limit_before_current + $count ) . '</a>';
			$html .= '</li>';
		}
	}

	//CURRENT - NOT FIRST AND NOT LAST
	if ( $products_page > 1 && $products_page < $total_pages ) {
		$html .= '<li class="active">';
		$html .= '<a onclick="navigate_products(this)">' . $products_page . '</a>';
		$html .= '</li>';
	}

	//PAGES AFTER CURRENT
	$page_limit_after_current = 5;
	for ( $count = $products_page; $count < $total_pages; $count++ ) {

		if ( $count != $products_page ) {
			$html .= '<li>';
			$html .= '<a onclick="navigate_products(this)">' . $count . '</a>';
			$html .= '</li>';
		}

		if ( $page_limit_after_current == 0 ) {
			break;
		} else {
			$page_limit_after_current--;
		}
	}

	//SEPARATOR = ...
	if ( $products_page < $total_pages - 6 ) {
		$html .= '<li class="seperator">';
		$html .= '<a>...</a>';
		$html .= '</li>';
	}

	//LAST
	if ( $products_page == $total_pages ) {
		$html .= '<li class="active">';
		$html .= '<a onclick="navigate_products(this)">' . $total_pages . '</a>';
	} else {
		$html .= '<li>';
		$html .= '<a onclick="navigate_products(this)">' . $total_pages . '</a>';
	}
	$html .= '</li>';

	//NEXT
	if ( $products_page == $total_pages ) {
		$html .= '<li class="disabled">';
	} else {
		$html .= '<li>';
	}
	$html .= '<a onclick="navigate_products(this)">' . __( 'Next', 'impstock' ) . '</a>';
	$html .= '</li>';

	return $html;

}

function generate_impstock_sitemap( $permalink, $sitemap_file ) {
	$products_data = get_impstock_ref();

	$sitemap  = '<?xml version="1.0" encoding="UTF-8"?>';
	$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	foreach ( $products_data as $product ) {
		if ( empty( $product['codprimav'] ) ) {
			continue;
		}

		if ( substr( $product['cdu_index'], 0, 2 ) === '00' ) {
			$link = $permalink . substr( $product['cdu_index'], 2 );
		} else {
			$link = $permalink . $product['cdu_index'];
		}

		$sitemap .= '<url>';
		$sitemap .= '<loc>' . $link . '</loc>';
		$sitemap .= '<priority>1.0</priority>';
		$sitemap .= '<lastmod>' . gmdate( 'Y-m-d' ) . '</lastmod>';
		$sitemap .= '<changefreq>daily</changefreq>';
		$sitemap .= '</url>';
	}

	$sitemap .= '</urlset>';

	$fp = fopen( ABSPATH . $sitemap_file, 'w' );
	fwrite( $fp, $sitemap );
	fclose( $fp );
}

function send_impstock_order( $admin_email, $client_cart, $client_name, $client_email, $client_phone ) {
	if ( ! is_email( $client_email ) ) {
		return false;
	}

	$headers = [ 'Content-Type: text/html; charset=UTF-8' ];

	$client_cart = str_replace( ',', '<br>', $client_cart );

	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date      = gmdate( 'd/m/Y' );
	$time      = gmdate( 'H:i:s' );

	$imp_msg_subject = 'Nova encomenda no site - ' . get_bloginfo( 'name' );

	$imp_msg_body_html = '<br>
	<h2>Encomenda Via Internet.</h2>
	Tel: {' . $client_phone . '}<br>
	Email: {' . $client_email . '}<br>
	Nome: {' . $client_name . '}<br>
	Refs: {' . $client_cart . '}<br>
	Data: ' . $date . ' ' . $time . '<br>
	IP: {' . $ipaddress . '}<br>
	';

	$client_msg_subject = 'Obrigado pela sua encomenda';

	$client_msg_body_html = '
	<h2>A sua encomenda foi enviada com sucesso</h2>
	<p>Em breve receberá um mail com mais informação e detalhes de pagamento.<br>
		Confirme os seus dados enviados:</p>
	<p>
	Tel: {' . $client_phone . '}<br>
	Email: {' . $client_email . '}<br>
	Nome: {' . $client_name . '}<br>
	Refs: {<br>' . $client_cart . '}<br>
	</p>

	<p>Imporfase<br>
	geral@imporfase.com | (+351) 229 410 780 | (+351) 939 427 680</p>
	';

	$status = wp_mail( $admin_email, $imp_msg_subject, $imp_msg_body_html, $headers );
	if ( $status === false ) {
		return $status;
	}

	$status = wp_mail( $client_email, $client_msg_subject, $client_msg_body_html, $headers );
	return $status;
}
