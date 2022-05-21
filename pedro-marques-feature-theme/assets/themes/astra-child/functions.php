<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style';
	$theme        = wp_get_theme();

	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		[],
		$theme->parent()->get( 'Version' )
	);

	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		[ $parenthandle ],
		$theme->get( 'Version' )
	);

	wp_enqueue_style(
		'main-style',
		get_stylesheet_directory_uri() . '/dist/css/astra_theme.css',
		[],
		$theme->get( 'Version' )
	);

	wp_enqueue_script(
		'main-script',
		get_stylesheet_directory_uri() . '/dist/js/astra_theme.js',
		[ 'jquery' ],
		$theme->get( 'Version' ),
		true
	);
}

add_action( 'after_setup_theme', 'wpdocs_child_theme_setup' );
function wpdocs_child_theme_setup() {
	load_child_theme_textdomain( 'astra-child', get_stylesheet_directory() . '/languages' );
}

add_filter( 'excerpt_more', 'replace_excerpt_more' );
function replace_excerpt_more( $more ) {
	return '…';
}

add_filter( 'excerpt_length', 'change_excerpt_length', 10 );
function change_excerpt_length( $length ) {
	return 120;
}

add_action( 'wp_footer', 'theme_add_backtotop_button' );
function theme_add_backtotop_button() {
	echo '<a href="#" class="topbutton"></a>';
}

add_filter( 'query_vars', 'create_query_vars' );
function create_query_vars( $qvars ) {
	$qvars[] = 'filter';
	return $qvars;
}

// Remove Posts side menu
add_action( 'admin_menu', 'remove_default_post_type' );
function remove_default_post_type() {
	remove_menu_page( 'edit.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-post' );
}

// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );
function remove_draft_widget() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

//Add settings page for setting parliamentary dossier image on frontpage
add_action( 'admin_menu', 'register_parliamentary_dossier_settings_page' );
function register_parliamentary_dossier_settings_page() {
	add_submenu_page( 'options-general.php', __( 'Parliamentary Dossier Settings', 'astra-child' ), __( 'Parliamentary Dossier', 'astra-child' ), 'manage_options', 'media-selector', 'parliamentary_dossier_settings_page_callback' );
}

//Settings page callback of parliamentary dossier
function parliamentary_dossier_settings_page_callback() {

	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) {
		update_option( 'parliamentary_dossier_attachment_id', absint( $_POST['image_attachment_id'] ) );
	}

	wp_enqueue_media();

	printf(
		'<h1>%1$s</h1>
		<h2 style="font-size: 20px;">%2$s</h2>
		<form method="post">
			<div class="image-preview-wrapper" style="margin-bottom:15px;">
				<img id="image-preview" src="%3$s" height="400">
			</div>
			<input id="upload_image_button" type="button" class="button" value="%4$s" />
			<input type="hidden" name="image_attachment_id" id="image_attachment_id" value="%5$s">
			<input type="submit" name="submit_image_selector" value="%6$s" class="button-primary">
			<p>%7$s</p>
		</form>',
		esc_html__( 'Parliamentary Dossier', 'astra-child' ),
		esc_html__( 'Frontpage Image', 'astra-child' ),
		esc_html( wp_get_attachment_url( get_option( 'parliamentary_dossier_attachment_id' ) ) ),
		esc_html__( 'Upload image', 'astra-child' ),
		esc_html( get_option( 'parliamentary_dossier_attachment_id' ) ),
		esc_html__( 'Save', 'astra-child' ),
		esc_html__( 'Recomended resolution: 356x659.', 'astra-child' ),
	);
}

//Load jquery script for media library in parilimentary dossier settings
add_action( 'admin_footer', 'parliamentary_dossier_print_scripts' );
function parliamentary_dossier_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'parliamentary_dossier_attachment_id', 0 );

	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

}

/**
 * Get the sliders items
 *
 * @return WP_Query Contains the items
 */
function get_slider_images() {
	$args = [
		'post_type' => 'slider',
		'order'     => 'ASC',
		'orderby'   => 'menu_order',
	];

	return new \WP_Query( $args );
}

/**
 * Get the topics items
 *
 * @return WP_Query Contains the items
 */
function get_topics() {
	$args = [
		'post_type'      => 'topic',
		'posts_per_page' => 10,
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'meta_query'     => [
			[
				'key'     => 'is_featured',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],
	];

	return new \WP_Query( $args );
}

/**
 * Get the topic terms
 *
 * @return WP_Term_Query
 */
function get_topics_terms() {
	$term_args = [
		'taxonomy'   => 'topics',
		'hide_empty' => false,
		'fields'     => 'all',
	];

	return new \WP_Term_Query( $term_args );
}

/**
 * Get topics by term name
 *
 * @param  string $term  Name of the term
 * @return WP_Term_Query Contains the items
 */
function get_topics_by_term( $term ) {
	$args = [
		'post_type'      => 'topic',
		'posts_per_page' => 10,
		'order'          => 'DESC',
		'orderby'        => 'menu_order',
		'tax_query'      => [
			[
				'taxonomy'         => 'topics',
				'field'            => 'name',
				'terms'            => $term,
				'include_children' => false,
			],
		],
	];

	return new \WP_Query( $args );
}

/**
 * Get the news items
 *
 * @param  int   $posts_per_page (Optional) Max items per page
 * @param  mixed $term           (Optional) Term name. Put false to get all.
 * @param  array $exclude        (Optional) List of IDs to exclude
 * @return WP_Query                        Contains the items
 */
function get_news( $posts_per_page = 3, $term = false, $exclude = [] ) {

	$args = [
		'post_type'      => 'event',
		'posts_per_page' => $posts_per_page,
		'order'          => 'DESC',
		'orderby'        => 'event-date',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'event-recent-activity',
				'compare' => '!=',
				'value'   => 1,
				'type'    => 'numeric',
			],
			[
				'key'     => 'is_featured',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],
	];

	if ( $term ) {
		$args['tax_query'] = [
			[
				'taxonomy'         => 'topics',
				'field'            => 'name',
				'terms'            => $term,
				'include_children' => false,
			],
		];
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}

/**
 * Get news extra items
 *
 * @param  int    $posts_per_page (Optional) Max items per page
 * @param  array  $exclude        (Optional) List of IDs to exclude
 * @param  mixed  $term           (Optional) Term name. Put false to get all.
 * @param  string $order          (Optional) Date ASC or DESC
 * @return WP_Query                         Contains the items
 */
function get_news_extra( $posts_per_page = 0, $exclude = [], $term = false, $order = 'DESC' ) {
	$args = [
		'post_type'      => 'event',
		'posts_per_page' => $posts_per_page,
		'order'          => $order,
		'orderby'        => 'event-date',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'event-recent-activity',
				'compare' => '!=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],
	];

	if ( $term ) {
		$args['tax_query'] = [
			[
				'taxonomy'         => 'topics',
				'field'            => 'name',
				'terms'            => $term,
				'include_children' => false,
			],
		];
	}

	if ( $posts_per_page > 0 ) {
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}

/**
 * Get recent activity items
 *
 * @param  int   $posts_per_page (Optional) Max items per page
 * @param  mixed $term           (Optional) Term name. Put false to get all.
 * @param  array $exclude        (Optional) List of IDs to exclude
 * @return WP_Query                        Contains the items
 */
function get_recent_activity( $posts_per_page = 3, $term = false, $exclude = [] ) {
	$args = [
		'post_type'      => 'event',
		'posts_per_page' => $posts_per_page,
		'order'          => 'DESC',
		'orderby'        => 'event-date',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'event-recent-activity',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
			[
				'key'     => 'is_featured',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],
	];

	if ( $term ) {
		$args['tax_query'] = [
			[
				'taxonomy'         => 'topics',
				'field'            => 'name',
				'terms'            => $term,
				'include_children' => false,
			],
		];
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}

/**
 * Get recent activity extra items
 *
 * @param  int    $posts_per_page (Optional) Max items per page
 * @param  array  $exclude        (Optional) List of IDs to exclude
 * @param  mixed  $term           (Optional) Term name. Put false to get all.
 * @param  string $order          (Optional) Date ASC or DESC
 * @return WP_Query                         Contains the items
 */
function get_recent_activity_extra( $posts_per_page = 0, $exclude = [], $term = false, $order = 'DESC' ) {
	$args = [
		'post_type'      => 'event',
		'posts_per_page' => $posts_per_page,
		'order'          => $order,
		'orderby'        => 'event-date',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'event-recent-activity',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],
	];

	if ( $term ) {
		$args['tax_query'] = [
			[
				'taxonomy'         => 'topics',
				'field'            => 'name',
				'terms'            => $term,
				'include_children' => false,
			],
		];
	}

	if ( $posts_per_page > 0 ) {
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}

/**
 * Get the external links
 *
 * @return WP_Query Contains the items
 */
function get_external_link() {
	$args = [
		'post_type' => 'external-link',
		'order'     => 'ASC',
		'orderby'   => 'menu_order',
	];

	return new \WP_Query( $args );
}

/**
 * Get external links
 *
 * @return html Return html with the external links
 */
function get_external_links() {
	$html          = '';
	$external_link = get_external_link();

	if ( $external_link->have_posts() ) {
		$html_links = '';

		$post_count = 0;
		while ( $external_link->have_posts() ) {
			$external_link->the_post();

			$external_link_url   = get_post_meta( $external_link->posts[ $post_count ]->ID, 'external-link-url' )[0];
			$external_link_image = get_the_post_thumbnail();

			if ( $external_link_url && $external_link_image ) {
				$html_links .= sprintf(
					'<div class="footer-external-link__item">
						<div class="footer-external-link__item-image">
							<a target="_blank" href="%1$s">%2$s</a>
						</div>
					</div>',
					esc_url( $external_link_url ),
					wp_kses_post( $external_link_image ),
					esc_html( get_the_title() ),
				);
			}
			$post_count++;
		}
	}
	$html = sprintf(
		'<section class="footer-external-link">
			%1$s
		</section>',
		$html_links
	);

	return $html;
}
add_shortcode( 'external-links', 'get_external_links' );

/**
 * Get the dossier items
 *
 * @param  int $posts_per_page  (Optional) Max items per page
 * @return WP_Query                        Contains the items
 */
function get_dossier( $posts_per_page = 3 ) {
	$args = [
		'post_type'      => 'dossier',
		'posts_per_page' => $posts_per_page,
		'order'          => 'DESC',
		'orderby'        => 'dossier-date',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'is_featured',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],

	];

	return new \WP_Query( $args );
}

/**
 * Get the extra dossier items.
 *
 * @param  int    $posts_per_page  (Optional) Max items per page
 * @param  array  $exclude         (Optional) List of IDs to exclude
 * @param  string $order           (Optional) Date ASC or DESC
 * @return WP_Query                           Contains the items
 */
function get_dossier_extra( $posts_per_page = 0, $exclude = [], $order = 'DESC' ) {
	$args = [
		'post_type' => 'dossier',
		'order'     => 'dossier-date',
		'orderby'   => $order,
	];

	if ( $posts_per_page > 0 ) {
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}

/**
 * Get related posts by cpt
 *
 * @param  mixed $post
 * @param  mixed $cpt
 * @return WP_Query Contains the items
 */
function get_related_posts( $post, $cpt ) {
	if ( $post->post_parent ) {
		$parent_id = wp_get_post_parent_id( $post->ID );
		$args      = [
			'post_type'      => $cpt,
			'posts_per_page' => 10,
			'post_parent'    => $parent_id,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post__not_in'   => [ $post->ID ],
		];
	} else {
		$args = [
			'post_type'      => $cpt,
			'posts_per_page' => 10,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post__not_in'   => [ $post->ID ],
		];
	}

	return new \WP_Query( $args );
}

/**
 * Get the gallery items
 *
 * @param  int $posts_per_page  (Optional) Max items per page
 * @return WP_Query                        Contains the items
 */
function get_gallery( $posts_per_page = 6 ) {
	$args = [
		'post_type'      => 'gallery',
		'posts_per_page' => $posts_per_page,
		'order'          => 'ASC',
		'orderby'        => 'menu-order',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'is_highlighted',
				'compare' => '=',
				'value'   => 1,
				'type'    => 'numeric',
			],
		],

	];

	return new \WP_Query( $args );
}

/**
 * Get the gallery items.
 *
 * @param  int $posts_per_page  (Optional) Max items per page
 * @param  array $exclude       (Optional) List of IDs to exclude
 * @return WP_Query                        Contains the items
 */
function get_gallery_extra( $posts_per_page = 0, $exclude = [] ) {
	$args = [
		'post_type' => 'gallery',
		'order'     => 'ASC',
		'orderby'   => 'menu-order',
	];

	if ( $posts_per_page > 0 ) {
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( is_array( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	return new \WP_Query( $args );
}
