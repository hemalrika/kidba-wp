<?php
namespace TPCore;

use TPCore\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'tp-hero', plugins_url( '/assets/js/tp-hero.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'tp-core-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'tp-core-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		require_once( __DIR__ . '/widgets/tp-hero.php' );
		require_once( __DIR__ . '/widgets/tp-featured-list.php' );
		require_once( __DIR__ . '/widgets/tp-heading.php' );
		require_once( __DIR__ . '/widgets/tp-banner-box.php' );
		require_once( __DIR__ . '/widgets/tp-about.php' );
		require_once( __DIR__ . '/widgets/tp-curse-tab.php' );
		require_once( __DIR__ . '/widgets/tp-teacher-list.php' );
		require_once( __DIR__ . '/widgets/tp-edu-count.php' );
		require_once( __DIR__ . '/widgets/tp-gallery.php' );
		require_once( __DIR__ . '/widgets/tp-testimonial.php' );
		require_once( __DIR__ . '/widgets/tp-brand.php' );
		require_once( __DIR__ . '/widgets/tp-blog.php' );
		require_once( __DIR__ . '/widgets/tp-slider.php' );
		require_once( __DIR__ . '/widgets/tp-image.php' );
		require_once( __DIR__ . '/widgets/tp-cta.php' );
		require_once( __DIR__ . '/widgets/tp-contact-info.php' );
		require_once( __DIR__ . '/widgets/tp-contact-form.php' );

		// Register Widgets
		$widgets_manager->register( new Widgets\TP_Hero() );
		$widgets_manager->register( new Widgets\TP_Featured_List() );
		$widgets_manager->register( new Widgets\TP_Heading() );
		$widgets_manager->register( new Widgets\TP_Banner_Box() );
		$widgets_manager->register( new Widgets\TP_About() );
		$widgets_manager->register( new Widgets\TP_Curse_Tab() );
		$widgets_manager->register( new Widgets\TP_Teacher_List() );
		$widgets_manager->register( new Widgets\TP_Edu_Count() );
		$widgets_manager->register( new Widgets\TP_Gallery() );
		$widgets_manager->register( new Widgets\TP_Testimonial() );
		$widgets_manager->register( new Widgets\TP_Brand() );
		$widgets_manager->register( new Widgets\TP_Blog() );
		$widgets_manager->register( new Widgets\TP_Slider() );
		$widgets_manager->register( new Widgets\TP_Image() );
		$widgets_manager->register( new Widgets\TP_Cta() );
		$widgets_manager->register( new Widgets\TP_Contact_Info() );
		$widgets_manager->register( new Widgets\TP_Contact_Form() );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		require_once( __DIR__ . '/classes/tp-core-icons.php' );
		require_once( __DIR__ . '/classes/tp-core-class.php' );
		require_once( __DIR__ . '/inc/aq_resizer.php' );
		new Page_Settings();
		new TP_Core_Icon();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
