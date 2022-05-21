<?php
// Enqueue styles para o child theme
function unifield_child_enqueue_styles() {
	// Enqueue parent style
	$theme_version = wp_get_theme()->get( 'Version' );
	$parent_style  = 'unifield-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', [], $theme_version );

	// Enqueue child style
	wp_enqueue_style(
		'unifield-child-style',
		get_stylesheet_directory_uri() . '/assets/css/style.css',
		[ $parent_style, 'unifield-responsive' ],
		$theme_version
	);

	wp_enqueue_style(
		'dba-style',
		get_stylesheet_directory_uri() . '/dist/css/dba_theme.css',
		[ $parent_style, 'unifield-responsive' ],
		$theme_version
	);

	wp_dequeue_style( 'nivo-slider' );
	wp_deregister_style( 'nivo-slider' );

	wp_dequeue_script( 'jquery-nivo-slider' );
	wp_deregister_script( 'jquery-nivo-slider' );
}
add_action( 'wp_enqueue_scripts', 'unifield_child_enqueue_styles' );


function unifield_child_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_register_script(
		'dba-scripts',
		get_stylesheet_directory_uri() . '/dist/js/dba_theme.js',
		//get_stylesheet_directory_uri() . '/dist/js/dba_theme.min.js',
		[ 'jquery' ],
		$theme_version,
		false
	);

	wp_enqueue_script( 'dba-scripts' );
	wp_localize_script( 'dba-scripts', 'ajax_obj', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
}
add_action( 'wp_enqueue_scripts', 'unifield_child_enqueue_scripts' );


// put this into your theme's functions.php file
// swap out the default image online 10
// build the facebook og meta tags based on defaults
// or if on a page or post, pull information off that object
function opengraph_tags() {
	// defaults
	$title   = get_bloginfo( 'title' );
	$excerpt = get_bloginfo( 'description' );
	// for non posts/pages, like /blog, just use the current URL
	$permalink = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if ( is_single() || is_page() ) {
		global $post;
		setup_postdata( $post );
		$post_id   = $post->ID;
		$title     = get_the_title();
		$permalink = get_the_permalink();
		if ( has_post_thumbnail( $post_id) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' )[0];
		}
		$excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $post_id ) );
		if ( $excerpt ) {
			$excerpt = strip_tags( $excerpt );
			$excerpt = str_replace( '', "'", $excerpt );
		}
	}
	?>

<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:description" content="<?php echo $excerpt; ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo $permalink; ?>"/>
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<meta property="og:image" content="<?php echo $img_src; ?>"/>

	<?php
}
add_action( 'wp_head', 'opengraph_tags', 5 );
function ogp_post_description() {
	global $post;
	$description = null;
	if ( defined( 'WP_OGP_POST_DESCRIPTION_KEY' ) ) {
		$description = get_post_meta( $post->ID, WP_OGP_POST_DESCRIPTION_KEY, true );
	}
	if ( empty( $description ) ) {
		$description = get_the_excerpt();
	}
	return $description;
}

add_action( 'after_setup_theme', 'unifield_child_setup' );
function unifield_child_setup() {
	add_theme_support(
		'custom-header',
		[
			'default-text-color' => false,
			'header-text'        => false,
		]
	);
}
add_action( 'init', 'unifield_child_init' );
function unifield_child_init() {
	remove_action( 'wp_enqueue_scripts', 'unifield_ie_stylesheet', 10 );
}

function unifield_child_get_social_icons() {
	$dba_wp_upload_dirs = wp_get_upload_dir();
	$dba_wp_basedir = '/wp-content/uploads';

	if ( ! empty( $dba_wp_upload_dirs['baseurl'] ) ) {
		$dba_wp_basedir = $dba_wp_upload_dirs['baseurl'];
	}


	$social_icons = sprintf(
		'<div class="social_btns">
			<a href="https://twitter.com/dontbeafraid" target="_blank">
				<img src="%1$s/2017/07/btn_twitter.jpg" width="40" height="40" alt="Twitter" name="twitter" class="socialIcon">
			</a>
			<a href="https://www.facebook.com/dontbeafraidrecordings" target="_blank">
				<img src="%1$s/2017/07/btn_facebook.jpg" width="40" height="40" alt="Facebook" name="facebook" class="socialIcon">
			</a>
			<a href="http://soundcloud.com/dontbeafraid" target="_blank">
				<img src="%1$s/2017/07/btn_soundcloud.jpg" width="40" height="40" alt="Soundcloud" name="Soundcloud" class="socialIcon">
			</a>
			<a href="http://www.youtube.com/user/dontbeafraidrecs" target="_blank">
				<img src="%1$s/2017/07/btn_youtube.jpg" width="40" height="40" alt="Youtube" name="youtube" class="socialIcon">
			</a>
		</div>',
		$dba_wp_basedir
	);
	return $social_icons;
}
/**
 *  relate categories with pages links
 *
 */
function unifield_child_rel_cat_pages( $cat ) {
	$rel = [
		'artists'  => 'artists',
		'news'     => 'news',
		'magazine' => 'magazine',
		'podcasts' => 'podcast',

	];
	$page = $rel[ $cat ] ?? '/';
	return $page;
}

function unifield_child_get_post_header() {
	$category = get_the_category();
	if ( empty( $category[0] ) ) {
		return;
	}
	$cat_name = strtolower( $category[0]->cat_name );
	$page_name = unifield_child_rel_cat_pages( $cat_name );

	$post_header = sprintf(
		'<div class="container">
			<div class="post-category__title template-title %1$s-category">
				<a href="%2$s">%3$s</a>
			</div>
		</div>',
		esc_attr( $cat_name ),
		esc_url( '/' . $page_name ),
		strtoupper( $page_name )
	);
	return $post_header;
}

function unifield_child_get_page_header( $title_name = '', $url ) {

	$post_header = sprintf(
		'<div class="container">
			<div class="post-category__title template-title %1$s-category">
				<a href="%2$s">%3$s</a>
			</div>
		</div>',
		esc_attr( strtolower( $title_name ) ),
		esc_url( $url ),
		strtoupper( $title_name )
	);
	return $post_header;
}
add_action( 'wp_ajax_dba_load_more_action', 'dba_get_category_ajax' );
add_action( 'wp_ajax_nopriv_dba_load_more_action', 'dba_get_category_ajax' );
function dba_get_category_ajax() {

	$order = 'ASC';
	if ( isset( $_REQUEST['order'] ) ) {
		$order = $_REQUEST['order'];
	}
	$posts_per_page = 10;
	if ( isset( $_REQUEST['posts_per_page'] ) ) {
		$posts_per_page = (int) $_REQUEST['posts_per_page'];
	}

	$mode = 'grid';
	if ( isset( $_REQUEST['mode'] ) ) {
		$mode = $_REQUEST['mode'];
	}
	if ( isset( $_REQUEST['category'] ) && isset( $_REQUEST['page'] ) ) {

		$result = [
			'html' => dba_get_category_posts(
				$_REQUEST['category'],
				$_REQUEST['page'],
				$order,
				$posts_per_page,
				$mode
			),
			'page' => $_REQUEST['page'] + 1,
		];

	}

	return wp_send_json_success( $result );
}

function dba_get_category_posts(
	int $category_id,
	int $page_nr = 1,
	string $order = 'ASC',
	int $posts_per_page = 10,
	string $mode = 'grid' ) {

	$args = [
		'cat'            => $category_id,
		'paged'          => $page_nr,
		'order'          => $order,
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
	];

	$query = new WP_Query( $args );

	$class_name = get_category( $category_id )->slug;

	if ( $mode === 'grid' ) {
		return dba_get_grid_layout( $query, $class_name );
	}

	return dba_get_row_layout( $query, $class_name );
}

function dba_get_row_layout( $query, $class_name ) {
	$html = '';
	while ( $query->have_posts() ) {
		$query->the_post();
		$html .= sprintf(
			'<div class="%1$s__item">
				<div class="%1$s__item-image"><a href="%3$s">%2$s</a></div>
				<div class="%1$s__item-content">
					<div class="%1$s__item-content-title">
						<a href="%3$s">%4$s</a>
					</div>
					<div class="%1$s__item-content-date">%5$s</div>
					<p class="%1$s__item-content-excerpt">%6$s</p>
					<div class="%1$s__item-content-more">
						<a href="%3$s">%7$s</a>
					</div>
				</div>
			</div>',
			$class_name,
			get_the_post_thumbnail( $query->post->ID, [ '300', '300' ] ),
			get_the_permalink(),
			get_the_title(),
			get_the_date(),
			get_post_meta( $query->post->ID, 'excerpt' )[0],
			__( 'more »', 'unifield-child' ),
		);
	}
	return $html;
}

function dba_get_grid_layout( $query, $class_name ) {
	$html = '';
	while ( $query->have_posts() ) {
		$query->the_post();
		$html .= sprintf(
			'<div class="%1$s__item">
				<div class="%1$s__item-image"><a href="%3$s">%2$s</a></div>
				<div class="%1$s__item-content">
					<div class="%1$s__item-content-title">
						<a href="%3$s">%4$s</a>
					</div>
					<div class="%1$s__item-content-more">
						<a href="%3$s">%5$s</a>
					</div>
				</div>
			</div>',
			$class_name,
			get_the_post_thumbnail( $query->post->ID, [ '300', '300' ] ),
			get_the_permalink(),
			get_the_title(),
			__( 'more »', 'unifield-child' ),
		);
	}
	return $html;
}
