<?php 
if ( !defined('ABSPATH') ) { 
    exit;
}

/*
Plugin Name: TP Toolkit
Plugin URI: https://themephi.net/
Description: TP Toolkit Plugin
Version: 1.0.0
Author: ThemePhi
Author URI: https://themephi.net/
*/

// declare constructors
define( 'TP_TOOLKIT_VER', '1.0.0' );
define( 'TP_TOOLKIT_DIR', plugin_dir_path( __FILE__ ) );
define( 'TP_TOOLKIT_URL', plugin_dir_url( __FILE__ ) );
define("PLUGIN_URL", plugins_url());




final class TP_toolkit {
	private static $instance;
	function __construct() {
		add_action('plugins_loaded', [$this, 'init']);
		add_action( 'init', [$this, 'tp_load_plugin_textdomain'] );
	}
	public function init() {
		require_once TP_TOOLKIT_DIR . '/inc/custom-post.php';
		require_once TP_TOOLKIT_DIR . '/inc/class-tp-kirki.php';
		require_once TP_TOOLKIT_DIR . '/inc/kirki-customizer.php';
		require_once TP_TOOLKIT_DIR . '/widgets/widget-social-list.php';
		require_once TP_TOOLKIT_DIR . '/widgets/widget-about.php';
		require_once TP_TOOLKIT_DIR . '/widgets/widget-subscribe.php';
		require_once TP_TOOLKIT_DIR . '/widgets/widget-latest-posts-sidebar.php';
		require_once TP_TOOLKIT_DIR . '/widgets/widget-post-cat-list.php';
	}
	// Load textdomain
	function tp_load_plugin_textdomain() {
		load_plugin_textdomain( 'tp-toolkit', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof TP_toolkit ) ) {
			self::$instance = new TP_toolkit;
		}
		return self::$instance;
	}
}
TP_toolkit::instance();
