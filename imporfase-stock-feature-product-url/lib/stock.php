<?php

add_action( 'init', 'imp_init_cookies' );
function imp_init_cookies() {
	if ( ! headers_sent() ) {
		gos_exit_session();
	}
}

function get_client_id( $meta_info, $client_code ) {

	$num_clients = [];
	if ( ! empty( $meta_info['client'] ) ) {
		$num_clients = $meta_info['client'];
	}
	if ( empty( $num_clients ) || count( $num_clients ) === 0 ) {
		return false;
	}
	$num_clients = (int) array_pop( $num_clients );

	for ( $i = 0; $i <= $num_clients; $i++ ) {

		$key = 'client_' . $i . '_code';

		if ( empty( $meta_info[ $key ] ) && empty( $meta_info[ $key ][0] ) ) {
			continue;
		}
		$client_meta_code = $meta_info[ $key ][0];
		if ( $client_meta_code === $client_code ) {
			return $i;
		}
	}
	return false;
}

function get_client_field( $meta_info, $id, $field ) {

	$key = 'client_' . $id . '_' . $field;
	if ( empty( $meta_info[ $key ] ) || empty( $meta_info[ $key ][0] ) ) {
		return '';
	}
	return $meta_info[ $key ][0];
}


function validate_user() {

	$post_id = get_the_ID();
	if ( ! isset( $_COOKIE[ 'bawmpp-postpass_' . COOKIEHASH ] ) ) {
		return false;
	}
	$pass_used = $_COOKIE[ 'bawmpp-postpass_' . COOKIEHASH ];
	$passwords = get_post_meta( $post_id, '_morepasswords', true );
	$password  = '';

	if ( empty( $passwords ) || ! is_array( $passwords ) ) {
		return false;
	}

	foreach ( $passwords as $password ) {
		$hashcode = md5( COOKIEHASH . stripslashes( $password ) );
		if ( $pass_used === $hashcode ) {
			return $password;
		}
	}
	$password = false;

	return false;

}

function gos_exit_session() {
	if ( ! isset( $_POST['gos_exit'] ) || $_POST['gos_exit'] !== 'exit' ) {
		return;
	}
	$baw_cookie  = 'bawmpp-postpass_' . COOKIEHASH;
	$pass_cookie = 'wp-postpass_' . COOKIEHASH;
	if ( isset( $baw_cookie ) ) {
			setcookie( $baw_cookie, '', time() - 1000 );
			setcookie( $baw_cookie, '', time() - 1000, '/' );
	}
	if ( isset( $pass_cookie ) ) {
			setcookie( $pass_cookie, '', time() - 1000 );
			setcookie( $pass_cookie, '', time() - 1000, '/' );
	}
	header( 'Location: ' . home_url() );

}

function compare_walker( $ref__walker, $term_text ) {

	$partial_compare = false;

	$is_walker_4digits = substr( $ref__walker, 0, 1 ) === '0' &&
		substr( $ref__walker, 1, 1 ) === '0' &&
		strlen( $term_text ) == 4;
	$is_walker_5digits = substr( $ref__walker, 0, 1 ) === '0' && strlen( $term_text ) == 5;

	if ( $is_walker_4digits || $is_walker_5digits ) {
		$partial_compare = strpos( mb_strtolower( $ref__walker ), mb_strtolower( $term_text ) );
	}
	return mb_strtolower( $ref__walker ) === mb_strtolower( $term_text ) || $partial_compare;
}


function insert_client_hit( $term_text, $products, $client_code ) {
	global $wpdb;

	$table_name_main   = $wpdb->prefix . 'search';
	$table_name_rel    = $wpdb->prefix . 'search_rel';
	$table_name_client = $wpdb->prefix . 'search_client';
	$wpdb->query( 'BEGIN', $wpdb->dbh );

	$wpdb->insert(
		$table_name_main,
		array(
			'search_id' => '0',
			's_date'    => current_time( 'mysql', 1 ),
			'item'      => $term_text,
			'results'   => count( $products ),
		),
		array(
			'%d',
			'%s',
			'%s',
			'%d',
		)
	);
	$search_id = $wpdb->insert_id;

	$client_result = $wpdb->get_row(
		$wpdb->prepare(
			'SELECT client_id from ' . $wpdb->prefix . 'search_client WHERE code = %s',
			$client_code
		)
	);

	// if new client, insert new client and get id
	if ( null === $client_result ) {
		$wpdb->insert(
			$table_name_client,
			array(
				'client_id' => '0',
				'code' => $client_code,
				'name' => $term_text,
			),
			array(
				'%d',
				'%s',
				'%s',
			)
		);
		$client_id = $wpdb->insert_id;
	} else {
		$client_id = $client_result->client_id;
	}

	// insert search
	if ( ! empty( $client_id ) ) {
		$wpdb->insert(
			$table_name_rel,
			array(
				'client_id' => $client_id,
				'search_id' => $search_id,
			),
			array(
				'%d',
				'%d',
			)
		);
	}
}

add_action( 'wp_ajax_nopriv_get_terms', 'impor_ajax_get_terms' );

function impor_ajax_get_terms() {

	if ( empty( $_POST['getterms_nonce'] ) || ! wp_verify_nonce( $_POST['getterms_nonce'], 'getterm-nonce' ) ) {
		wp_send_json_error();
	}

	$term_text   = sanitize_text_field( $_POST['term_text'] );
	$client_code = sanitize_text_field( $_POST['client_code'] );
	$client_id   = sanitize_text_field( $_POST['client_id'] );
	$page_id     = sanitize_text_field( $_POST['page_id'] );


	if ( empty( $term_text ) ) {
		wp_send_json_error( 'error missing search' );
	}
	if ( ! isset( $client_id ) || $client_id === false ) {
		wp_send_json_error( 'error missing client id' );
	}
	if ( empty( $client_code ) ) {
	
		wp_send_json_error();
	}
	if ( empty( $page_id ) ) {
		$page_id = get_the_ID();
	}
	global $wpdb;

	// cdu_index, vendor_short, codprimav, description, stock_qty, vendor_id, vendor_name, ref_vendor, stock_res, price, discount, product_id
	$products = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `codprimav` LIKE '%%%s%%' LIMIT 50", $term_text . ' 00' ) );

	$solution = [];
	$response = [];

	if ( ! empty( $products ) ) {
		insert_client_hit( $term_text, $products, $client_code );
	}

	$iter = 0;

	$allowed_vendors = [ // vendor_id => vendor_name
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
	];

	$client_discounts = [];

	$meta_info = get_post_meta( $page_id );

	$client_discounts_count = get_client_field( $meta_info, $client_id, 'discounts' );
	for ( $i = 0; $i <= $client_discounts_count; $i++ ) {

		$key_character = 'client_' . $client_id . '_discounts_' . $i . '_character';
		$key_discount  = 'client_' . $client_id . '_discounts_' . $i . '_discount';

		if ( empty( $meta_info[ $key_character ] ) && empty( $meta_info[ $key_character ][0] ) ) {
			continue;
		}
		if ( empty( $meta_info[ $key_discount ] ) && empty( $meta_info[ $key_discount ][0] ) ) {
			continue;
		}

		$discount_key   = $meta_info[ $key_character ][0];
		$discount_value = $meta_info[ $key_discount ][0];

		$client_discounts[ $discount_key ] = $discount_value;
	}

	// main match
	foreach ( $products as $product_info ) {

		//                          ref        pvp          stock      discount   reserved
		// cdu_index, vendor_short, codprimav, description, stock_qty, vendor_id, vendor_name, ref_vendor, stock_res, price, discount, product_id
		if ( ! array_key_exists( $product_info->vendor_id, $allowed_vendors ) ) {
			continue;
		}

		// setup image
		$solution['match'][ $iter ]['image'] = search_image_xref( $term_text );

		$product_name = $product_info->description;

		$solution['match'][ $iter ]['header'][] = $product_name;

		$ref_vendor = $product_info->ref_vendor;

		if ( $product_info->ref_vendor === 'NULL' || $product_info->ref_vendor === '0' ) {
			$ref_vendor = $product_info->cdu_index;
		}

		$price_formatted = custom_money( $product_info->price );

		$discount_value = '';
		if ( array_key_exists( mb_strtolower( $product_info->discount ), $client_discounts ) ) {
			$discount_value = $client_discounts[ mb_strtolower( $product_info->discount ) ];
		}

		$solution['match'][ $iter ]['main'] = [
			$allowed_vendors[ $product_info->vendor_id ],
			$ref_vendor,
			$price_formatted,
			$product_info->stock_qty,
			$product_info->discount,
			$product_info->stock_res,
			$discount_value,
			$product_name,
		];

		if ( $product_info->cdu_index === 'NULL' ) {
			$iter++;
			continue;
		}
		$equivalences = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `cdu_index` LIKE '%%%s%%'", $product_info->cdu_index ) );

		foreach ( $equivalences as $equivalences_info ) {
			if ( $product_info->vendor_id === $equivalences_info->vendor_id ) {
				continue;
			}

			//                                   ref        pvp            stock       discount   reserved
			// cdu_index, vendor_short, codprimav, description, stock_qty, vendor_id, vendor_name, ref_vendor, stock_res, price, discount, product_id
			if ( ! array_key_exists( $equivalences_info->vendor_id, $allowed_vendors ) ) {
				continue;
			}

			$ref_vendor = $equivalences_info->ref_vendor;
			if ( $equivalences_info->ref_vendor == 'NULL' || $equivalences_info->ref_vendor == '0' ) {
				$ref_vendor = $equivalences_info->cdu_index;
			}

			$price_formatted = custom_money( $equivalences_info->price );

			$discount_value = '';
			if ( array_key_exists( mb_strtolower( $equivalences_info->discount ), $client_discounts ) ) {
				$discount_value = $client_discounts[ mb_strtolower( $equivalences_info->discount ) ];
			}

			$solution['match'][ $iter ]['xrefs'][] = [
				$allowed_vendors[ $equivalences_info->vendor_id ],
				$ref_vendor,
				$price_formatted,
				$equivalences_info->stock_qty,
				$equivalences_info->discount,
				$equivalences_info->stock_res,
				$discount_value,
				$product_name,
			];
		}
		$iter++;
	}

	// Alternatives
	$iter     = 0;
	$products = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `ref_vendor` LIKE '%%%s%%' LIMIT 50", $term_text ) );
	foreach ( $products as $product_info ) {

		//                          ref        pvp          stock      discount   reserved
		// cdu_index, vendor_short, codprimav, description, stock_qty, vendor_id, vendor_name, ref_vendor, stock_res, price, discount, product_id
		if ( ! array_key_exists( $product_info->vendor_id, $allowed_vendors ) ) {
			continue;
		}

		$product_name = $product_info->description;
		$solution['alts'][ $iter ]['header'][] = $product_name;

		$ref_vendor = $product_info->ref_vendor;

		if ( $product_info->ref_vendor == 'NULL' || $product_info->ref_vendor == '0' ) {
			$ref_vendor = $product_info->cdu_index;
		}

		$price_formatted = custom_money( $product_info->price );

		$discount_value = '';
		if ( array_key_exists( mb_strtolower( $product_info->discount ), $client_discounts ) ) {
			$discount_value = $client_discounts[ mb_strtolower( $product_info->discount ) ];
		}

		$solution['alts'][ $iter ]['main'] = [
			$allowed_vendors[ $product_info->vendor_id ],
			$ref_vendor,
			$price_formatted,
			$product_info->stock_qty,
			$product_info->discount,
			$product_info->stock_res,
			$discount_value,
			$product_name,
		];

		if ( $product_info->cdu_index === 'NULL' ) {
			$iter++;
			continue;
		}
		$equivalences = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM remote_stock WHERE `cdu_index` LIKE '%%%s%%'", $product_info->cdu_index ) );

		$solution['alts'][ $iter ]['xrefs'] = [];
		foreach ( $equivalences as $equivalences_info ) {
			if ( $product_info->vendor_id === $equivalences_info->vendor_id ) {
				continue;
			}

			if ( ! array_key_exists( $equivalences_info->vendor_id, $allowed_vendors ) ) {
				continue;
			}

			$ref_vendor = $equivalences_info->ref_vendor;
			if ( $equivalences_info->ref_vendor === 'NULL' || $equivalences_info->ref_vendor === '0' ) {
				$ref_vendor = $equivalences_info->cdu_index;
			}

			$price_formatted = custom_money( $equivalences_info->price );

			$discount_value = '';
			if ( array_key_exists( mb_strtolower( $equivalences_info->discount ), $client_discounts ) ) {
				$discount_value = $client_discounts[ mb_strtolower( $equivalences_info->discount ) ];
			}

			$solution['alts'][ $iter ]['xrefs'][] = [
				$allowed_vendors[ $equivalences_info->vendor_id ],
				$ref_vendor,
				$price_formatted,
				$equivalences_info->stock_qty,
				$equivalences_info->discount,
				$equivalences_info->stock_res,
				$discount_value,
				$product_name,
			];
		}
		$iter++;
	}

	$response = json_encode( $solution );
	header( 'Content-Type: application/json' );

	echo $response;
	die();

}

function validate_form( $post ) {
	if ( ! isset( $post['email__send'] ) ||
		! isset( $post['email__encs'] ) ) {
			return false;
	}

	if ( $post['email__send'] !== 'sendrefs' ) {
		return false;
	}

	$client_mail = filter_var( sanitize_text_field( $post['email__email'] ), FILTER_VALIDATE_EMAIL );

	//$client_telf = sanitize_text_field( $post['email__telf'] );
	$client_code = sanitize_text_field( $post['client__code'] );
	$client_refs = sanitize_text_field( $post['email__encs'] );

	$client_telf = empty( $client_telf ) ? 'Sem nome' : $client_telf;
	$client_code = empty( $client_code ) ? 'Sem codigo' : $client_code;
	$client_refs = empty( $client_refs ) ? 'Sem refs' : $client_refs;

	return [
		'client_mail' => $client_mail,
		'client_telf' => $client_telf,
		'client_code' => $client_code,
		'client_refs' => $client_refs,
	];
}

function search_image_xref( $term_text ) {

	global $wpdb;
	$wild       = '%';
	$esc_sql    = $wild . $wpdb->esc_like( $term_text ) . $wild;
	$image_xref = $wpdb->get_results( $wpdb->prepare( 'SELECT `cross_ref` FROM imp_stock_img WHERE`walker_ref` LIKE %s', $esc_sql ) );

	$full_url = null;
	foreach ( $image_xref as $image_ref ) {
		$image_ref   = trim( $image_ref->cross_ref );
		$abs_path    = WP_CONTENT_DIR;
		$full_path   = $abs_path . '/stock-images/klarius/' . $image_ref . '.png';
		$file_exists = file_exists( $full_path );
		if ( $file_exists ) {

			$full_url = WP_CONTENT_URL . '/stock-images/klarius/' . $image_ref . '.png';
			break;
		}
	}
	return $full_url;
}

function custom_money( $price ) {

	$amount = new \NumberFormatter( 'pt_PT', \NumberFormatter::CURRENCY );
	//$amount->setAttribute( \NumberFormatter::MAX_FRACTION_DIGITS, 0 ) ;
	return $amount->format( $price );

}

function send_email( $data ) {

	$client_msg_subject = 'Imporfase Stock - Client ' . $data['client_code'];

	if ( WP_ENV === 'development' ) {

		$sales_email = 'web@43.lc';

		$obj = (object) array(
			'body' => array(
				'message' => 'success',
			),
		);
		return $obj;
	}
	require_once ABSPATH . '/sendgrid-php/sendgrid-php.php';
	$sales_email = 'vendas@imporfase.com';
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date = date( 'd/m/Y' );
	$time = date( 'H:i:s' );

	$imp_msg_body_html = "<br>
	<h2>Encomenda Via Internet.</h2>
	Tel: {$data['client_telf']}<br>
	Email: {$data['client_mail']}<br>
	Código: {$data['client_code']}<br>
	Refs: {$data['client_refs']}<br>
	Data: $date $time<br>
	IP: {$ipaddress}<br>
	";
	$imp_msg_body_txt = "
	Tel: {$data['client_telf']}\n
	Email: {$data['client_mail']}\n
	Código: {$data['client_code']}\n
	Refs: {$data['client_refs']}\n
	Data: $date $time\n
	IP: {$ipaddress}\n
	";

	$client_msg_body_html = "
	<h2>A sua encomenda foi enviada com sucesso</h2>
	<p>Em breve receberá um mail com mais informação e detalhes de pagamento.<br>
		Confirme os seus dados enviados:</p>
	<p>
	Tel: {$data['client_telf']}<br>
	Email: {$data['client_mail']}<br>
	Código: {$data['client_code']}<br>
	Refs: {$data['client_refs']}<br>
	</p>

	<p>Imporfase<br>
	geral@imporfase.com | (+351) 229 410 780 | (+351) 939 427 680</p>
	";

	$client_msg_body_txt = "
	A sua encomenda foi enviada com sucesso\n\n
	Em breve receberá um mail com mais informação e detalhes de pagamento.\n
	Confirme os seus dados enviados:\n\n

	Email: {$data['client_mail']}\n
	Código: {$data['client_code']}\n
	Refs: {$data['client_refs']}\n

	Imporfase\n
	imporfase@gmail.com | (+351) 229 410 780 | (+351) 939 427 680\n\n
	";

	$email_status = '';

	$sendgrid = new SendGrid( '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' );
	$email = new SendGrid\Email();
	$email
	->addTo( $sales_email )
	->setFrom( $data['client_mail'] )
	->setSubject( $client_msg_subject )
	->setText( $imp_msg_body_txt )
	->setHtml( $imp_msg_body_html )
	->addCategory( 'Imporfase::Stock-Online' );

	try {
		$email_status = $sendgrid->send( $email );
	} catch ( \SendGrid\Exception $e ) {
		echo $e->getCode();
		foreach ( $e->getErrors() as $er ) {
			echo $er;
		}
	}
	return $email_status;
}
