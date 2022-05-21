<?php

namespace HopeandOak\WP\Theme\Hao;


final class Theme {

	/**
	 * Theme version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	public $components = null;

	/**
	 * The single instance of the class.
	 *
	 * @var Theme
	 */
	protected static $instance = null;

	/**
	 * Theme Constructor.
	 */
	public function __construct() {
		$this->define_constants();

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init() {

		$this->init_hooks();

		do_action( 'hao_theme_loaded' );

		$components_list = [];

		foreach ( $components_list as $component ) {
			if ( $component instanceof Startable ) {
				$component->start();
			}
		}
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {

		add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );
		add_action( 'template_redirect', [ $this, 'redirect_to_specific_page' ] );

		add_filter( 'bazaar_qodef_meta_box_post_types_save', [ $this, 'jj_activity_meta_box_functions' ] );
		add_filter( 'bazaar_qodef_meta_box_post_types_remove', [ $this, 'jj_activity_meta_box_functions' ] );
		add_filter( 'bazaar_qodef_set_scope_for_meta_boxes', [ $this, 'jj_activity_scope_meta_box_functions' ] );
		add_filter( 'bazaar_qodef_get_native_fonts_list', [ $this, 'jj_add_fonts' ] );

		add_action( 'widgets_init', [ $this, 'sidebar_init' ] );

	}


	/**
	 * Define Theme Constants.
	 */
	private function define_constants() {

		define( 'THEME_NAME', 'hao' );
		define( 'THEME_VERSION', $this->version );
		define( 'THEME_MAX_NUMBERPOSTS', '100' );
	}
	/**
	 * Setup theme.
	 *
	 */
	public function setup_theme() {

		// Set Localization
		load_theme_textdomain( 'hao' );

		// Enable support for post thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		// Add HTML5 markup structure.
		add_theme_support( 'html5', [
			'search-form',
			'gallery',
			'caption',
		] );

//		add_theme_support( 'disable-custom-colors' );

		$base_uri = get_stylesheet_directory_uri();
		$base_dir = get_stylesheet_directory();

		$this->components = [

			'clean' => new Clean(),
	//		'media' => new Media( $base_dir, $base_uri ),
		];

		/**
		 * Remove/add components.
		 *
		 * Note: if you add a component, make sure it implements a method "ready()".
		 */
		$this->components = apply_filters( 'hao_theme_starter_components', $this->components );

		foreach ( $this->components as $instance ) {
			if ( method_exists( $instance, 'ready' ) ) {
				$instance->ready();
			}
		}
	}

}
