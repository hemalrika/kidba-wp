<?php
/**
 * kidba functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kidba
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function kidba_setup() {
	load_theme_textdomain( 'kidba', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'kidba' ),
		),
	);
	register_nav_menus(
		array(
			'footer-menu' => esc_html__( 'Footer Menu', 'kidba' ),
		),
	);

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
	add_theme_support(
		'custom-background',
		apply_filters(
			'kidba_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	add_theme_support( 'post-formats', [
        'image',
        'audio',
        'video',
        'gallery',
        'quote',
    ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 30,
			'width'       => 130,
			'flex-width'  => true,
			'flex-height' => true,
			'unlink-homepage-logo' => true,
		)
	);
}
add_action( 'after_setup_theme', 'kidba_setup' );

function kidba_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kidba_content_width', 640 );
}
add_action( 'after_setup_theme', 'kidba_content_width', 0 );

/*
 * Register widget area.
 */
function kidba_widgets_init() {
    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_style_3_switch', false );

	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'kidba' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add Blog Sidebar.', 'kidba' ),
			'before_widget' => '<section id="%1$s" class="blog-sidebar-box mb-50 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="blog-sidebar-title-box px-30"><h4 class="blog-sidebar-title mb-0">',
			'after_title'   => '</h4></div>',
		)
	);
	//Footer widgets
	$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'kidba' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer %1$s', 'kidba' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer-card mb-50 footer-col-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-card-title mt--2 pb-20 mb-30">',
            'after_title'   => '</h4>',
        ] );
    }
    // footer 2
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer 2 - %1$s', 'kidba' ), $num ),
            'id'            => 'footer-2-' . $num,
            'description'   => sprintf( esc_html__( 'Footer 2-%1$s', 'kidba' ), $num ),
            'before_widget' => '<div id="%1$s" class="kidba_footer_widget footer-col-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="kidba_footer_title">',
            'after_title'   => '</h4>',
        ] );
    }
	if(class_exists('WooCommerce')) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop Sidebar', 'kidba' ),
				'id'            => 'shop',
				'description'   => esc_html__( 'Add Shop Sidebar.', 'kidba' ),
				'before_widget' => '<section id="%1$s" class="blog-sidebar-box mb-50 %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="blog-sidebar-title-box px-30"><h4 class="blog-sidebar-title mb-0">',
				'after_title'   => '</h4></div>',
			)
		);
	}
}
add_action( 'widgets_init', 'kidba_widgets_init' );



define( 'KIDBA_THEME_DIR', get_template_directory() );
define( 'KIDBA_THEME_URI', get_template_directory_uri() );
define( 'KIDBA_THEME_CSS_DIR', KIDBA_THEME_URI . '/assets/css/' );
define( 'KIDBA_THEME_JS_DIR', KIDBA_THEME_URI . '/assets/js/' );
define( 'KIDBA_THEME_INC', KIDBA_THEME_DIR . '/inc/' );
define( 'KIDBA_THEME_HOOK', KIDBA_THEME_INC . 'hooks/' );
define( 'KIDBA_THEME_CLASS', KIDBA_THEME_INC . 'classes/' );

/*
 * Enqueue Admin scripts and styles.
 */
function kidba_admin_custom_scripts() {
	wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/style/css/customizer-style.css',array());
    wp_register_script( 'kidba-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'kidba-admin-custom' );
}
add_action( 'admin_enqueue_scripts', 'kidba_admin_custom_scripts' );


/*
 * Enqueue Theme scripts and styles.
 */
function kidba_scripts() {
	// all CSS
	wp_enqueue_style('animate',KIDBA_THEME_CSS_DIR.'animate.min.css' );
	wp_enqueue_style('animate-headline',KIDBA_THEME_CSS_DIR.'animate-headline.css' );
	wp_enqueue_style('bootstrap',KIDBA_THEME_CSS_DIR.'bootstrap.min.css' );
	wp_enqueue_style('icofont',KIDBA_THEME_CSS_DIR.'icofont.min.css' );
	wp_enqueue_style('jquery-ui',KIDBA_THEME_CSS_DIR.'jquery-ui.css' );
	wp_enqueue_style('magnific-popup',KIDBA_THEME_CSS_DIR.'magnific-popup.css' );
	wp_enqueue_style('modal-video',KIDBA_THEME_CSS_DIR.'modal-video.min.css' );
	wp_enqueue_style('nice-select',KIDBA_THEME_CSS_DIR.'nice-select.css' );
	wp_enqueue_style('odometer',KIDBA_THEME_CSS_DIR.'odometer.min.css' );
	wp_enqueue_style('slick',KIDBA_THEME_CSS_DIR.'slick.css' );
	wp_enqueue_style('swiper-bundle',KIDBA_THEME_CSS_DIR.'swiper-bundle.css' );
	wp_enqueue_style('meanmenu',KIDBA_THEME_CSS_DIR.'meanmenu.css' );
	wp_enqueue_style('meanmenu',KIDBA_THEME_CSS_DIR.'meanmenu.css' );
	wp_enqueue_style('kidba-core',KIDBA_THEME_CSS_DIR.'kidba-core.css', null, time() );
	wp_enqueue_style('kidba-custom',KIDBA_THEME_CSS_DIR.'kidba-custom.css', null, time() );
	wp_enqueue_style('kidba-unit',KIDBA_THEME_CSS_DIR.'kidba-unit.css', null, time() );
	if(class_exists('WooCommerce')) {
		wp_enqueue_style('kidba-woo-shop',KIDBA_THEME_CSS_DIR.'kidba-woo-shop.css', null, time() );
	}
	if(function_exists('tutor')) {
		wp_enqueue_style('kidba-tutor-lms',KIDBA_THEME_CSS_DIR.'kidba-tutor-lms.css', null, time() );
	}
	wp_enqueue_style( 'kidba-style', get_stylesheet_uri(), array(), _S_VERSION );

    // all js
    wp_enqueue_script( 'bootstrap-bundle', KIDBA_THEME_JS_DIR . 'bootstrap.bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', KIDBA_THEME_JS_DIR . 'wow.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-ui', KIDBA_THEME_JS_DIR . 'jquery-ui.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-modal-video', KIDBA_THEME_JS_DIR . 'jquery-modal-video.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-appear', KIDBA_THEME_JS_DIR . 'jquery.appear.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'odometer', KIDBA_THEME_JS_DIR . 'odometer.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-meanmenu', KIDBA_THEME_JS_DIR . 'jquery.meanmenu.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'isotop-pkgd', KIDBA_THEME_JS_DIR . 'isotope.pkgd.min.js', [ 'jquery', 'imagesloaded' ], '', true );
    wp_enqueue_script( 'jquery-magnific-popup', KIDBA_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', KIDBA_THEME_JS_DIR . 'jquery.nice-select.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'animate-headline', KIDBA_THEME_JS_DIR . 'animate-headline.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'slick', KIDBA_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', KIDBA_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'kidba-ajax_callback', KIDBA_THEME_JS_DIR . 'ajax_callback.js', [ 'jquery' ], time(), true );
    wp_enqueue_script( 'simple-pagination', KIDBA_THEME_JS_DIR . 'simple-pagination.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'kidba-main', KIDBA_THEME_JS_DIR . 'main.js', [ 'jquery' ], time(), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kidba_scripts' );





require KIDBA_THEME_INC . 'template-helper.php';
require KIDBA_THEME_INC . 'custom-header.php';
require KIDBA_THEME_INC . 'template-tags.php';
require KIDBA_THEME_INC . 'template-functions.php';
include_once KIDBA_THEME_INC . '/style/php/customizer-style.php';
include_once KIDBA_THEME_INC . 'class-wp-bootstrap-navwalker.php';
include_once KIDBA_THEME_INC . 'class-ocdi-importer.php';
require_once KIDBA_THEME_INC . 'class-tgm-plugin-activation.php';
if(class_exists('WooCommerce')) {
	require_once KIDBA_THEME_INC . 'hooks/woocommerce-hooks.php';
	require_once KIDBA_THEME_INC . 'functions/woo-functions.php';
}
if(function_exists('tutor')) {
	include_once KIDBA_THEME_INC . '/functions/tutor-functions.php';
	require_once KIDBA_THEME_CLASS . 'tutor-classes-course-layout.php';
	require_once KIDBA_THEME_HOOK . 'tutor-hooks.php';
}
if ( defined( 'JETPACK__VERSION' ) ) {
	require KIDBA_THEME_INC . 'jetpack.php';
}
/***
 * WooCommerce Support
 */
add_theme_support('woocommerce');
