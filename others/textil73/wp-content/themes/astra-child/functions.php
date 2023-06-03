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
	
}

/**
* Add category image on header
*/
function woocommerce_category_image_on_header() {
    if ( is_product_category() ) {
      global $wp_query;
	  
	  $image = null;
      $cat       = $wp_query->get_queried_object();
	  
      $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
      $image        = wp_get_attachment_url( $thumbnail_id );
	  
	  if (  !is_null($image)  ) {
          //echo '<img class="arch-desc-img" src="' . $image . '" width="auto" height="auto" />';
		  echo wp_get_attachment_image($thumbnail_id, 'large');
      }
	}
}
add_action( 'woocommerce_before_main_content', 'woocommerce_category_image_on_header', 16 );


/**
* Enqueue button javascript script.
*/
add_action( 'wp_enqueue_scripts', 'add_back_to_top_button_script' );
function add_back_to_top_button_script() {
	$theme = wp_get_theme();
	wp_enqueue_script( 'back-to-top', get_stylesheet_directory_uri() . '/js/back-to-top.js', [ 'jquery' ], $theme->get( 'Version' ), true );
}


/**
* Add button HTML to the footer section.
*/
add_action( 'wp_footer', 'add_back_to_top_button_style' );
function add_back_to_top_button_style() {
	echo '<a href="#" id="topbutton"></a>';
}
