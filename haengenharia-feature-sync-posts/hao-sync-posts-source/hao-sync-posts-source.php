<?php
/**
 * Plugin Name:       HaO Sync Posts [ Source ]
 * Plugin URI:        https://hopeandoak.agency
 * Description:       This plugin should be installed in the site that will create, update, delete posts in the remote WordPress site.
 * Version:           1.1
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Hope and Oak Agency
 * Author URI:        https://hopeandoak.agency
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hao-sync-posts
 * Domain Path:       /languages
 */

add_action( 'plugins_loaded', 'language_init' );
function language_init() {
	$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
	load_plugin_textdomain( 'hao-sync-posts', false, $plugin_rel_path );
}

add_action( 'admin_init', 'hao_sync_posts_register' );
function hao_sync_posts_register() {
	register_setting( 'hao_sync_posts_fields', 'hao_sync_posts_url' );
	register_setting( 'hao_sync_posts_fields', 'hao_sync_posts_user' );
	register_setting( 'hao_sync_posts_fields', 'hao_sync_posts_pass' );
	register_setting( 'hao_sync_posts_fields', 'hao_sync_posts_ssl' );
}

add_action( 'admin_menu', 'hao_sync_posts_admin_menu' );
function hao_sync_posts_admin_menu() {
	add_options_page(
		__( 'HaO Sync Posts', 'hao-sync-posts' ),
		__( 'HaO Sync Posts Settings', 'hao-sync-posts' ),
		'manage_options',
		'options_page_slug',
		'hao_sync_posts_settings_page'
	);
}

function hao_sync_posts_settings_page() {
	print( '<div class="wrap">
			<form method="post" action="options.php">'
	);

	settings_fields( 'hao_sync_posts_fields' );
	do_settings_sections( 'hao_sync_posts_fields' );
	submit_button();

	print( '</form>
		</div>'
	);
}

add_action( 'admin_init', 'hao_sync_posts_setup_sections' );
function hao_sync_posts_setup_sections() {
	add_settings_section( 'hao_sync_posts_settings', __( 'Settings', 'hao-sync-posts' ), 'hao_sync_posts_callback', 'hao_sync_posts_fields' );
}

function hao_sync_posts_callback( $args ) {
	$ssl_option        = get_option( 'hao_sync_posts_ssl' );
	$ssl_option_no_ssl = '';
	$ssl_option_ssl    = '';

	if ( ! empty( $ssl_option ) ) {
		if ( $ssl_option === 'false' ) {
			$ssl_option_no_ssl = 'checked';
		} else {
			$ssl_option_ssl = 'checked';
		}
	}
	printf(
		'<label>%1$s</label>
		<br>
		<input name="hao_sync_posts_url" id="hao_sync_posts_url" type="text" value="%2$s" />
		<br><em>%12$s</em>
		<br><br>
		<label>%3$s</label>
		<br>
		<input name="hao_sync_posts_user" id="hao_sync_posts_user" type="text" value="%4$s" />
		<br><br>
		<label>%5$s</label>
		<br>
		<input name="hao_sync_posts_pass" id="hao_sync_posts_pass" type="password" value="%6$s" />
		<br><br>
		<label>%7$s</label>
		<br><br>
		<input type="radio" id="hao_sync_posts_no_ssl" name="hao_sync_posts_ssl" value="false" %8$s>
		<label for="hao_sync_posts_no_ssl">%9$s</label>
		<br><br>
		<input type="radio" id="hao_sync_posts_ssl" name="hao_sync_posts_ssl" value="true" %10$s>
		<label for="hao_sync_posts_ssl">%11$s</label>
		<br>',
		esc_html__( 'URL', 'hao-sync-posts' ),
		esc_html( get_option( 'hao_sync_posts_url' ) ),
		esc_html__( 'User', 'hao-sync-posts' ),
		esc_html( get_option( 'hao_sync_posts_user' ) ),
		esc_html__( 'Password', 'hao-sync-posts' ), // 5
		esc_html( get_option( 'hao_sync_posts_pass' ) ),
		esc_html__( 'Verify SSL ?', 'hao-sync-posts' ),
		esc_html( $ssl_option_no_ssl ),
		esc_html__( 'No', 'hao-sync-posts' ),
		esc_html( $ssl_option_ssl ), // 10
		esc_html__( 'Yes', 'hao-sync-posts' ),
		esc_html__( 'Must end in a slash /', 'hao-sync-posts' ), // 12
	);
}

/**
 * HAO - BEGIN
 */
add_action( 'save_post', 'sync_post_with_remote', 999, 2 ); //On stage get_meta func was returning empty because of priority

function sync_post_with_remote( $post_id, $post ) {
	//Stop if post type isn't cursos
	if ( 'cursos' !== $post->post_type ) {
		return;
	}

	//Credentials to remote ( site A )
	$url  = get_option( 'hao_sync_posts_url' );
	$user = get_option( 'hao_sync_posts_user' );
	$pass = get_option( 'hao_sync_posts_pass' );
	$ssl  = filter_var( get_option( 'hao_sync_posts_ssl' ), FILTER_VALIDATE_BOOLEAN );

	$status = $post->post_status;

	if ( $status === 'trash' ) {
		remote_delete_post( $post, $url, $user, $pass, $ssl );
		return;
	}

	if ( $status === 'draft' ) {
		$remote_post_id = null;
		//Only update. Don't insert to prevent "Untitled - draft" on remote site
		try {
			$remote_post_id = remote_check_if_exists( $post, $url, $ssl );
		} catch ( \Exception $e ) {
			return wp_send_json_error( 'Caught exception: ' . $e->getMessage() );
		}

		if ( empty( $remote_post_id ) ) {
			return;
		}
		remote_update_post( $post, $url, $user, $pass, $ssl, $status, $remote_post_id );
		return;
	}

	if ( $status === 'auto-draft' ) {
		return;
	}

	remote_insert_or_update_post( $post, $url, $user, $pass, $ssl, $status );
}

/**
 * Check if it should insert or update the post in the remote site
 *
 * @param object $post   Post collection data
 * @param string $url    URL of the remote site
 * @param string $user   User of the remote site
 * @param string $pass   Pass of the remote site
 * @param boolean $ssl    Has ssl encryption?
 * @param string $status Status of the post
 */
function remote_insert_or_update_post( $post, $url, $user, $pass, $ssl, $status ) {

	$remote_post_id = null;
	try {
		$remote_post_id = remote_check_if_exists( $post, $url, $ssl );
	} catch ( \Exception $e ) {
		return wp_send_json_error( 'Caught exception: ' . $e->getMessage() );
	}

	if ( empty( $remote_post_id ) ) {
		//Insert
		remote_insert_post( $post, $url, $user, $pass, $ssl, $status );
		return;
	}

	//Update
	remote_update_post( $post, $url, $user, $pass, $ssl, $status, $remote_post_id );
}

/**
 * Check if post exists in the remote site and return the remote post id
 *
 * @param  object $post Post collection data
 * @param  string $url  URL of the remote site
 * @param  boolean $ssl  Has ssl encryption?
 * @return post_id      Get the remote post id if exists
 */
function remote_check_if_exists( $post, $url, $ssl ) {
	$api_response = wp_remote_get(
		$url . 'wp-json/hao/v1/futuro/' . $post->ID,
		[ 'sslverify' => $ssl ]
	);

	if ( is_wp_error( $api_response ) ) {
		$message = $api_response->get_error_message();
		$code    = $api_response->get_error_code();
		throw new \Exception( $message, $code );
	}

	if ( empty( $api_response['body'] ) ) {
		return null;
	}

	$body = json_decode( $api_response['body'] );

	if ( is_null( $body ) ) {
		throw new \Exception(
			\sprintf('Unable to decode JSON: %s', \json_last_error_msg() ),
			\json_last_error()
		);
	}
	if ( empty( $body->post_id ) ) {
		throw new \Exception(
			\sprintf('Unable to decode JSON: %s', \json_last_error_msg() ),
			\json_last_error()
		);
	}
	return $body->post_id;
}

/**
 * Get term ids from taxonomy in the remote site
 *
 * @param  object $post            Post collection data
 * @param  string $url             URL of the remote site
 * @param  string $user            User of the remote site
 * @param  string $pass            Pass of the remote site
 * @param  boolean $ssl             Has ssl encryption?
 * @param  string $taxonomy_local  Name of the local taxonomy
 * @param  string $taxonomy_remote Name of the remote taxonomy
 * @return Array                   Contains ids of the terms in remote site
 */
function remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, $taxonomy_local, $taxonomy_remote ) {
	//Load array with terms of local taxonomy
	$terms = wp_get_post_terms( $post->ID, $taxonomy_local, [ 'fields' => 'names' ] );

	if ( empty( $terms ) ) {
		return [];
	}

	//Get term ids of taxonomy on remote site
	$response_areas = wp_remote_post(
		$url . 'wp-json/hao/v1/futuro/terms', [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'terms'    => $terms,
				'taxonomy' => $taxonomy_remote,
			],
			'sslverify' => $ssl,
		]
	);
	if ( is_wp_error( $response_areas ) ) {
		return wp_send_json_error( $response_areas );
	}

	return json_decode( $response_areas['body'] );
}

/**
 * Get term id of taxonomy on remote site
 *
 * @param  string $url             URL of the remote site
 * @param  string $user            User of the remote site
 * @param  string $pass            Pass of the remote site
 * @param  boolean $ssl             Has ssl encryption?
 * @param  string $term_name       Name of the term
 * @param  string $taxonomy_remote Name of the remote taxonomy
 * @return Array                   Contains ids of the terms in remote site
 */
function remote_get_term_id_by_taxonomy( $url, $user, $pass, $ssl, $term_name, $taxonomy_remote ) {
	//Get term id of taxonomy on remote site
	$response_areas = wp_remote_post(
		$url . 'wp-json/hao/v1/futuro/terms', [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'terms'    => [ $term_name ],
				'taxonomy' => $taxonomy_remote,
			],
			'sslverify' => $ssl,
		]
	);
	if ( is_wp_error( $response_areas ) ) {
		return wp_send_json_error( $response_areas );
	}

	return json_decode( $response_areas['body'] );
}

/**
 * Insert post in the remote site
 *
 * @param  object $post      Post collection data
 * @param  string $url       URL of the remote site
 * @param  string $user      User of the remote site
 * @param  string $pass      Pass of the remote site
 * @param  boolean $ssl       Has ssl encryption?
 * @param  string $status    Status of the post
 */
function remote_insert_post( $post, $url, $user, $pass, $ssl, $status ) {
	$tax_area_term_ids     = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'area', 'futuro-areas-eng' );
	$tax_formato_term_ids  = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'formato', 'formato' );
	$tax_local_term_ids    = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'local', 'local' );
	$tax_destaque_term_ids = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'destaque', 'destaque' );

	$term_formacao_id = remote_get_term_id_by_taxonomy( $url, $user, $pass, $ssl, 'Formação', 'agenda-tipo-evento' );

	wp_remote_post(
		$url . 'wp-json/wp/v2/futuro', [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'title'              => $post->post_title,
				'status'             => $status,
				'slug'               => $post->post_name,
				'type'               => 'futuro',
				'agenda-tipo-evento' => $term_formacao_id,
				'futuro-areas-eng'   => $tax_area_term_ids,
				'formato'            => $tax_formato_term_ids,
				'local'              => $tax_local_term_ids,
				'destaque'           => $tax_destaque_term_ids,
				'acf'                => [
					'data'                           => get_post_meta( $post->ID, 'datainicio', true ), //Date
					'data_fim'                       => get_post_meta( $post->ID, 'datafim', true ), //Date
					'hora'                           => get_post_meta( $post->ID, 'horario', true ), //Text
					'local'                          => '', //It's required on ACF. Delete this if you don't have this meta
					'evento_de_formacao'             => 1,
					'carga_horaria'                  => get_post_meta( $post->ID, 'duracao', true ), //Text
					'sinopse'                        => get_post_meta( $post->ID, 'sinopse', true ), //Text
					'destinatarios'                  => get_post_meta( $post->ID, 'destinatarios', true ), //Text
					'conteudos_programaticos'        => get_post_meta( $post->ID, 'programa', true ), //Text
					'formadores'                     => get_post_meta( $post->ID, 'formador', true ), //Text
					'preco_para_membro'              => get_post_meta( $post->ID, 'precomembro', true ), //Number
					'preco_nao_membro'               => get_post_meta( $post->ID, 'preconaomembro', true ), //Number
					'preco_estudante'                => get_post_meta( $post->ID, 'precoestudante', true ), //Number
					'observacoes'                    => get_post_meta( $post->ID, 'observacoes', true ), //Text
					'link_de_inscricao'              => get_post_meta( $post->ID, 'linkinscricao', true ), //Text
					'remote_post_featured_image_url' => get_the_post_thumbnail_url( $post->ID ),
					'remote_post_id'                 => $post->ID,
				],
			],
			'sslverify' => $ssl, //Let's Encrypt: cURL error 60: SSL certificate problem: certificate has expired
		]
	);

	wp_remote_post(
		$url . 'wp-json/hao/v1/futuro/image', [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'id' => $post->ID,
			],
			'sslverify' => $ssl, //Let's Encrypt: cURL error 60: SSL certificate problem: certificate has expired
		]
	);
}

/**
 * Update post in the remote site
 *
 * @param  object $post      Post collection data
 * @param  string $url       URL of the remote site
 * @param  string $user      User of the remote site
 * @param  string $pass      Pass of the remote site
 * @param  boolean $ssl       Has ssl encryption?
 * @param  string $status    Status of the post
 * @param  int    $remote_id ID of the post in the remote site
 */
function remote_update_post( $post, $url, $user, $pass, $ssl, $status, $remote_id ) {

	hao_remote_clear_terms( $post, $url, $user, $pass, $ssl );
	$tax_area_term_ids     = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'area', 'futuro-areas-eng' );
	$tax_formato_term_ids  = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'formato', 'formato' );
	$tax_local_term_ids    = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'local', 'local' );
	$tax_destaque_term_ids = remote_get_term_ids_by_taxonomy( $post, $url, $user, $pass, $ssl, 'destaque', 'destaque' );

	$term_formacao_id = remote_get_term_id_by_taxonomy( $url, $user, $pass, $ssl, 'Formação', 'agenda-tipo-evento' );

	wp_remote_post(
		$url . 'wp-json/wp/v2/futuro/' . $remote_id, [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'title'              => $post->post_title,
				'status'             => $status,
				'slug'               => $post->post_name,
				'type'               => 'futuro',
				'agenda-tipo-evento' => $term_formacao_id,
				'futuro-areas-eng'   => $tax_area_term_ids,
				'formato'            => $tax_formato_term_ids,
				'local'              => $tax_local_term_ids,
				'destaque'           => $tax_destaque_term_ids,
				'acf'                => [
					'data'                           => get_post_meta( $post->ID, 'datainicio', true ), //Date
					'data_fim'                       => get_post_meta( $post->ID, 'datafim', true ), //Date
					'hora'                           => get_post_meta( $post->ID, 'horario', true ), //Text
					'local'                          => '', //It's required on ACF. Delete this if you don't have this meta
					'evento_de_formacao'             => 1,
					'carga_horaria'                  => get_post_meta( $post->ID, 'duracao', true ), //Text
					'sinopse'                        => get_post_meta( $post->ID, 'sinopse', true ), //Text
					'destinatarios'                  => get_post_meta( $post->ID, 'destinatarios', true ), //Text
					'conteudos_programaticos'        => get_post_meta( $post->ID, 'programa', true ), //Text
					'formadores'                     => get_post_meta( $post->ID, 'formador', true ), //Text
					'preco_para_membro'              => get_post_meta( $post->ID, 'precomembro', true ), //Number
					'preco_nao_membro'               => get_post_meta( $post->ID, 'preconaomembro', true ), //Number
					'preco_estudante'                => get_post_meta( $post->ID, 'precoestudante', true ), //Number
					'observacoes'                    => get_post_meta( $post->ID, 'observacoes', true ), //Text
					'remote_post_featured_image_url' => get_the_post_thumbnail_url( $post->ID ),
					'link_de_inscricao'              => get_post_meta( $post->ID, 'linkinscricao', true ), //Text
				],
			],
			'sslverify' => $ssl, //Let's Encrypt: cURL error 60: SSL certificate problem: certificate has expired
		]
	);

	wp_remote_post(
		$url . 'wp-json/hao/v1/futuro/image', [
			'headers'   => [
				'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
			],
			'body'      => [
				'id' => $post->ID,
			],
			'sslverify' => $ssl, //Let's Encrypt: cURL error 60: SSL certificate problem: certificate has expired
		]
	);
}

/**
 * Delete post in the remote site
 *
 * @param  object $post Post collection data
 * @param  string $url  URL of the remote site
 * @param  string $user User of the remote site
 * @param  string $pass Pass of the remote site
 * @param  boolean $ssl  Has ssl encryption?
 */
function remote_delete_post( $post, $url, $user, $pass, $ssl ) {

	$remote_post_id = null;
	try {
		$remote_post_id = remote_check_if_exists( $post, $url, $ssl );
	} catch ( \Exception $e ) {
		return wp_send_json_error( 'Caught exception: ' . $e->getMessage() );
	}

	if ( ! is_null( $remote_post_id ) ) {
		wp_remote_request(
			$url . 'wp-json/wp/v2/futuro/' . $remote_post_id, [
				'method'    => 'DELETE',
				'headers'   => [
					'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
				],
				'sslverify' => $ssl,
			]
		);
	}
}

function hao_remote_clear_terms( $post, $url, $user, $pass, $ssl ) {
	$remote_post_id = null;
	try {
		$remote_post_id = remote_check_if_exists( $post, $url, $ssl );
	} catch ( \Exception $e ) {
		return wp_send_json_error( 'Caught exception: ' . $e->getMessage() );
	}
	if ( ! is_null( $remote_post_id ) ) {
		wp_remote_post(
			$url . 'wp-json/hao/v1/futuro/clear', [
				'headers'   => [
					'Authorization' => 'Basic ' . base64_encode( $user . ':' . $pass ),
				],
				'body'      => [
					'id'    => $remote_post_id,
				],
				'sslverify' => $ssl,
			]
		);
	}
}