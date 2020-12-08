<?php
/**
 * arc10 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package arc10
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'arc10_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function arc10_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on arc10, use a find and replace
		 * to change 'arc10' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'arc10', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'arc10' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'arc10_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'arc10_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arc10_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'arc10_content_width', 640 );
}
add_action( 'after_setup_theme', 'arc10_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arc10_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'arc10' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'arc10' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'arc10_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arc10_scripts() {
	wp_enqueue_style( 'slick-css', get_template_directory_uri().'/css/slick.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/css/slick-theme.css' );
	wp_enqueue_style( 'arc10-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'arc10-aos', 'https://unpkg.com/aos@next/dist/aos.css', array(), _S_VERSION );
	wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/7da7605743.js', array(), _S_VERSION );
	wp_style_add_data( 'arc10-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'));
	wp_enqueue_script( 'arc10-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'arc10-aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'arc10_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action( 'init', 'register_testimonials_type' );
function register_testimonials_type() {
	$labels = array(
		'name'               => _x( 'Testimonial', 'Testimonial' ),
		'singular_name'      => _x( 'Testimonial', 'testimonial'),
		'menu_name'          => _x( 'Testimonial', 'Portfolio'),
		'name_admin_bar'     => _x( 'Testimonial', 'add new testimonial'),
		'add_new'            => _x( 'Add New', 'Testimonial'),
		'add_new_item'       => __( 'Add New Testimonial'),
		'new_item'           => __( 'New Testimonial'),
		'edit_item'          => __( 'Edit Testimonial'),
		'view_item'          => __( 'View Testimonial'),
		'all_items'          => __( 'All Testimonials'),
		'search_items'       => __( 'Search Testimonials'),
		'parent_item_colon'  => __( 'Parent Testimonials:'),
		'not_found'          => __( 'No testimonials found.'),
		'not_found_in_trash' => __( 'No testimonials found in Bin.')
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Create a testimonial.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial'),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'has_front'			 => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor' , 'excerpt', 'author', 'custom-fields', 'page-attributes')
	);
	register_post_type( 'testimonial', $args );
}

add_action( 'init', 'register_portfolio_type' );
function register_portfolio_type() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'Portfolio' ),
		'singular_name'      => _x( 'Portfolio', 'portfolio'),
		'menu_name'          => _x( 'Portfolio', 'Portfolio'),
		'name_admin_bar'     => _x( 'Portfolio', 'add new portfolio'),
		'add_new'            => _x( 'Add New', 'Portfolio'),
		'add_new_item'       => __( 'Add New Portfolio'),
		'new_item'           => __( 'New Portfolio'),
		'edit_item'          => __( 'Edit Portfolio'),
		'view_item'          => __( 'View Portfolio'),
		'all_items'          => __( 'All Portfolios'),
		'search_items'       => __( 'Search Portfolios'),
		'parent_item_colon'  => __( 'Parent Portfolios:'),
		'not_found'          => __( 'No portfolios found.'),
		'not_found_in_trash' => __( 'No portfolios found in Bin.')
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Create a portfolio listing.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_rest'       => true,
		'taxonomies'          => array( 'portfolio_categories' ),
		'supports'           => array( 'title', 'editor' , 'thumbnail', 'excerpt', 'author', 'custom-fields', 'page-attributes')
	);
	register_post_type( 'case_study', $args );
}

function create_portfolio_taxonomies() {
	$labels = array(
		'name'              => _x( 'Categories', 'Portfolio' ),
		'singular_name'     => _x( 'Category', 'Portfolio' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Portfolios' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);

	$args = array(
		'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'portfolio_categories', array( 'portfolio' ), $args );
}

/**
 * Implement the Custom Blocks.
 */
require_once( get_template_directory() . '/inc/custom-blocks.php' );
