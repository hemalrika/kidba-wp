<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kidba
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kidba_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kidba_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kidba_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kidba_pingback_header' );

// kidba_classes_sidebar
function kidba_classes_sidebar_func() {
    if ( is_active_sidebar( 'classes-sidebar' ) ) {

        dynamic_sidebar( 'classes-sidebar' );
    }
}
add_action( 'kidba_classes_sidebar', 'kidba_classes_sidebar_func', 20 );

function kidba_get_tag() {
    $html = '';
    if ( has_tag() ) {
		$html .= '<div class="kidba-custom-tag">';
        $html .= get_the_tag_list( '', ' ', '' );
		$html .= '</div>';
    }
    return $html;
}