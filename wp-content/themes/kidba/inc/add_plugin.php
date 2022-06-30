<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme madison for publication on ThemeForest
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action( 'tgmpa_register', 'kidba_register_required_plugins' );

function kidba_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = [
        [
            'name'     => esc_html__( 'Elementor Page Builder', 'kidba' ),
            'slug'     => 'elementor',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'futexo' ),
            'slug'     => 'contact-form-7',
            'required' => false,
        ],
        [
            'name'         => esc_html__( 'Advanced Custom Fields', 'kidba' ),
            'slug'         => 'advanced-custom-fields',
            'required'     => true,
        ],
        [
            'name'     => esc_html__( 'Mailchimp For WP', 'kidba' ),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ],
        array(
            'name'     =>  esc_html__('Kirki Customizer Framework','kidba'),
            'slug'     => 'kirki',
            'required' => false,
        ),
        [
            'name'     => esc_html__( 'One Click Demo Import', 'kidba' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'ACF Photo Gallery', 'kidba' ),
            'slug'     => 'navz-photo-gallery',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Sassy Social Share', 'kidba' ),
            'slug'     => 'sassy-social-share',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Tutor LMS', 'kidba' ),
            'slug'     => 'tutor',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'WooCommerce', 'kidba' ),
            'slug'     => 'woocommerce',
            'required' => false,
        ],
    ];
    $config = [
        'id'           => 'kidba', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true, // Show admin notices or not.
        'dismissable'  => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message'      => '', // Message to output right before the plugins table.

        'strings'      => [
            'page_title'                      => esc_html__( 'Install Required Plugins', 'kidba' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'kidba' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'kidba' ),
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'kidba' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'kidba' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'kidba'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'kidba'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'kidba'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'kidba'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'kidba'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'kidba'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'kidba'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'kidba'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'kidba'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'kidba' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'kidba' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'kidba' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'kidba' ),
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'kidba' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'kidba' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'kidba' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'kidba' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'kidba' ),
            'nag_type'                        => '',
        ],
    ];
    tgmpa( $plugins, $config );
}
