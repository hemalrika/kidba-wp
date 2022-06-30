<?php
/**
 * kidba customizer
 *
 * @package kidba
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'Kirki' ) ) {
	return;
}
/**
 * Added Panels & Sections
 */



add_action('sg_customizer_partial', 'hello');

function kidba_customizer_panels_sections( $wp_customize ) {
    /**
    * selective refresh
    */
    $wp_customize->selective_refresh->add_partial('kidba_header_top_welcome_text_partial', array(
        'selector' => '.kidba_header_address_info',
        'settings' => 'kidba_header_top_welcome_text',
        'render_callback' => function() {
            return get_theme_mod('kidba_header_top_welcome_text');
        }
    ));


    /**
    * customizer panel
    */
    $wp_customize->add_panel( 'tp_general_widget', [
        'priority'    => 10,
        'title' => esc_html__( 'TP Widgets', 'tp-toolkit' ),
        'description' => esc_html__( 'You can customize the TP widgets.', 'tp-toolkit' ),
    ] );
    /**
     * Customizer Section
     */
    $sections = array (
        '_social_list_section' => array(
            esc_attr__( 'Social List', 'tp-toolkit' ),
            esc_attr__( 'You can customize the social list widget description.', 'tp-toolkit' )
        )
    );
    foreach($sections as $section_id => $section ) {
        $section_args = array(
            'title' => $section[0],
            'description' => $section[1],
            'panel' => 'tp_general_widget',
            'capability'  => 'edit_theme_options'
        );
        if ( isset( $section[2] ) ) {
            $section_args['type'] = $section[2];
        }
        $wp_customize->add_section( str_replace( '-', '_', $section_id ), $section_args );
    }
    $wp_customize->add_section( 'theme_essential_setting', [
        'title'       => esc_html__( 'Essential Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'section_header_settings', [
        'title'       => esc_html__( 'Header Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Side Info', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'tp-toolkit' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
    ] );
    if(function_exists('tutor')) {
        $wp_customize->add_section( 'tutor_setting', [
            'title'       => esc_html__( 'Tutor Settings', 'tp-toolkit' ),
            'description' => '',
            'priority'    => 22,
            'capability'  => 'edit_theme_options',
        ] );
    }
}

add_action( 'customize_register', 'kidba_customizer_panels_sections' );


function _theme_essential_fields( $fields ) {
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'tp-toolkit' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_preloader',
        'label'    => esc_html__( 'Preloader On/Off', 'tp-toolkit' ),
        'section'  => 'theme_essential_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_search',
        'label'    => esc_html__( 'Serach On/Off', 'tp-toolkit' ),
        'section'  => 'theme_essential_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'tp-toolkit' ),
        'section'  => 'theme_essential_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_theme_essential_fields' );

/*
Header Settings
 */
function _header_fields( $fields ) {


    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.jpg',
            'header-style-2'   => get_template_directory_uri() . '/inc/img/header/header-2.jpg'
        ],
        'default'     => 'header-style-1',
    ];

    /*
    cmt_section_header_topbar_1: start section topbar 1
    */
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header_top_buttonset',
        'label'    => esc_html__( 'Header Top Customize', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

   

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_top_opening_hour_switch',
        'label'    => esc_html__( 'Enable Active Time?', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 0,
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_top_opening_hour',
        'label'    => esc_html__( 'Office Time', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( 'Our Opening Hours Mon- Fri', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_top_opening_hour_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_top_location_switch',
        'label'    => esc_html__( 'Enable Location?', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 0,
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_top_location',
        'label'    => esc_html__( 'Office Location', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( '103 Road kagpur, Dhaka', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_top_location_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_top_number_switch',
        'label'    => esc_html__( 'Enable number?', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 0,
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_top_number',
        'label'    => esc_html__( 'Number Text', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( '+800-123-4567 6587', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_top_number_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_top_link',
        'label'    => esc_html__( 'Number Link', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( '80012345676587', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_top_number_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_background_color',
        'label'    => esc_html__( 'Header top BG color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#23cc88',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];


    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_icon_color',
        'label'    => esc_html__( 'Icon color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_text_color',
        'label'    => esc_html__( 'Text color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_text_hover_color',
        'label'    => esc_html__( 'Text hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];


    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_button_text_color',
        'label'    => esc_html__( 'Button text color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-11',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_button_text_hover_color',
        'label'    => esc_html__( 'Button text hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-11',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_button_bg_color',
        'label'    => esc_html__( 'Button background color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#f94d1c',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-11',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Color',
        'settings' => 'kidba_header_top_button_bg_hover_color',
        'label'    => esc_html__( 'Button background hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#1a1a1a',
        'priority' => 10, 
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-11',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_top_typography',
        'label'    => esc_html__( 'Header Top Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '16px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header-txt, .header-txt a',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_top_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    /*
    cmt_section_header_1: start section header 1
    */

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header_main_switch',
        'label'    => esc_html__( 'Header Customize', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header_main_logoset',
        'label'    => esc_html__( 'Logo Variant', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'image',
        'priority' => 10,
        'choices'     => [
            'image'   => esc_html__( 'Image', 'tp-toolkit' ),
            'text' => esc_html__( 'Text', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo_image',
        'description' => esc_html__( 'Upload a Logo.', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => get_template_directory_uri() . '/assets/images/logo.png',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset',
                'operator' => '==',
                'value'    => 'image',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'slider',
        'settings'    => 'logo_size',
        'description' => esc_html__( 'Logo Size', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default' => '120px',
        'choices'     => [
            'min'  => 120,
            'max'  => 200,
            'step' => 4,
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset',
                'operator' => '==',
                'value'    => 'image',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'text',
        'settings'    => 'logo_text',
        'description' => esc_html__( 'Type Logo Text', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => esc_html__( 'kidba', 'tp-toolkit' ),
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset',
                'operator' => '==',
                'value'    => 'text',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_main_logoset_style',
        'label'    => esc_html__( 'Kitba Header Logo Style', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_logo_bg_color',
        'label' => esc_html__( 'Header logo BG color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => 'transparent',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset_style',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_logo_typography',
        'label'    => esc_html__( 'Logo Text Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '45px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header-style-1 .logo span ',
            ],
        ],        
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset_style',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ],
            [
                'setting'  => 'kidba_header_main_logoset',
                'operator' => '==',
                'value'    => 'text',
            ]
        ],
    ];

    /*
    cmt_section_header_1_style: start section header 1 style
    */

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color',
        'label' => esc_html__( 'Header menu color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#00394F',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_hover_color',
        'label' => esc_html__( 'Header menu hover color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#f94d1c',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_submenumenu_border_color',
        'label' => esc_html__( 'Header submenu border color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#23CC88',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_menu_typography',
        'label'    => esc_html__( 'Header Menu Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '18px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.kidba_main_menu li a ',
            ],
        ],        
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    /*
    cmt_header_1_right: start header 1 right
    */
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_main_right_switch',
        'label'    => esc_html__( 'Header Right Switcher', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 0,
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header_right_buttonset',
        'label'    => esc_html__( 'Header Right Customize', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
        'active_callback' => [ 
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];


    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_button_text',
        'label'    => esc_html__( 'Button Text', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( 'Admit Now', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_button_link',
        'label'    => esc_html__( 'Button Link', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    /*
    cmt_header_1_right_style: start header 1 right style
    */
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_bg_color',
        'label'    => esc_html__( 'Button bg color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#23cc88',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_bg_hover_color',
        'label'    => esc_html__( 'Button bg hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#23cc88',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_text_color',
        'label'    => esc_html__( 'Button text color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_text_hover_color',
        'label'    => esc_html__( 'Button text hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_right_typography',
        'label'    => esc_html__( 'Header Right Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '16px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header-style-1 .def-btn',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ]
        ],
    ];

    /*
    cmt_section_header_2: start header 2 section
    */

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header2_main_switch',
        'label'    => esc_html__( 'Header Customize', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__('Style', 'kidba'),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header2_main_logoset',
        'label'    => esc_html__( 'Logo Variant', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'image',
        'priority' => 10,
        'choices'     => [
            'image'   => esc_html__( 'Image', 'tp-toolkit' ),
            'text' => esc_html__( 'Text', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo_image2',
        'description' => esc_html__( 'Upload a Logo.', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => get_template_directory_uri() . '/assets/images/logo.png',
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_logoset',
                'operator' => '==',
                'value'    => 'image',
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'slider',
        'settings'    => 'logo_size2',
        'description' => esc_html__( 'Logo Size', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default' => '130px',
        'choices'     => [
            'min'  => 120,
            'max'  => 200,
            'step' => 4,
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_logoset',
                'operator' => '==',
                'value'    => 'image',
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'text',
        'settings'    => 'logo_text2',
        'description' => esc_html__( 'Kidba', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => esc_html__( 'kidba', 'tp-toolkit' ),
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_logoset',
                'operator' => '==',
                'value'    => 'text',
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_main_logoset_style_2',
        'label'    => esc_html__( 'Kitba Header Logo Style', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_logo_bg_color_2',
        'label' => esc_html__( 'Header logo BG color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => 'transparent',
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset_style_2',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header2_logo_typography',
        'label'    => esc_html__( 'Logo Text Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '45px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header-container.style-2 .logo span',
            ],
        ],        
        'active_callback' => [
            [
                'setting'  => 'kidba_header_main_logoset_style_2',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'kidba_header2_main_logoset',
                'operator' => '==',
                'value'    => 'text',
            ]
        ],
    ];


    /*
    cmt_section_header_2_style: start section header 2 style
    */

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color_2',
        'label' => esc_html__( 'Header menu color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#00394F',
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_hover_color_2',
        'label' => esc_html__( 'Header menu hover color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#f94d1c',
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_submenumenu_border_color_2',
        'label' => esc_html__( 'Header submenu border color', 'tp-toolkit' ),
        'section'     => 'section_header_settings',
        'default'     => '#23CC88',
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_menu_typography_2',
        'label'    => esc_html__( 'Header Menu Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '18px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.navbar-nav li a',
            ],
        ],        
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    /*
    cmt_header_2_right: start header 2 right
    */
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header2_main_right_switch',
        'label'    => esc_html__( 'Header Right Switcher', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 0,
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'kidba_header2_right_buttonset',
        'label'    => esc_html__( 'Header Right Customize', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_button_text_2',
        'label'    => esc_html__( 'Button Text', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( 'Admit Now', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_button_link_2',
        'label'    => esc_html__( 'Button Link', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_header_cart_switcher_2',
        'label'    => esc_html__( 'Cart Show/Hide?', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => 1,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_icon_2',
        'label'    => esc_html__( 'Cart Icon', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => esc_html__( 'shopping-cart', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'kidba_header_cart_switcher_2',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_header_main_cart_text_2',
        'label'    => esc_html__( 'Cart Text', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
            [
                'setting'  => 'kidba_header_cart_switcher_2',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];
    /*
    cmt_header_2_right_style: start header 2 right style
    */
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_bg_color_2',
        'label'    => esc_html__( 'Button bg color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#23cc88',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_bg_hover_color_2',
        'label'    => esc_html__( 'Button bg hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#23cc88',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_text_color_2',
        'label'    => esc_html__( 'Button text color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'color',
        'settings' => 'kidba_header_main_right_button_text_hover_color_2',
        'label'    => esc_html__( 'Button text hover color', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'default'  => '#fff',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'kidba_header_right_typography_2',
        'label'    => esc_html__( 'Header Right Typography', 'tp-toolkit' ),
        'section'  => 'section_header_settings',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '16px',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.header-style-1 .def-btn',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'kidba_header2_right_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
            [
                'setting'  => 'kidba_header2_main_right_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'kidba_header2_main_switch',
                'operator' => '==',
                'value'    => 'content',
            ],
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ]
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_fields' );

function _tp_widget_customize($fields) {
    $fields[] = array(
        'type' => 'repeater',
        'settings' => 'tp_social_list_widget',
        'label' => esc_attr__( 'Social List Widget', 'tp-toolkit' ),
        'description' => esc_attr__( 'You can set social icons.', 'tp-toolkit' ),
        'section' => '_social_list_section',
        'fields' => array(
            'social_icon' => array(
                'type' => 'text',
                'label' => esc_attr__( 'Icon', 'tp-toolkit' ),
                'description' => esc_attr__( 'You can set an icon. for example; "facebook"', 'tp-toolkit' ),
            ),

            'social_url' => array(
                'type' => 'text',
                'label' => esc_attr__( 'URL', 'tp-toolkit' ),
                'description' => esc_attr__( 'You can set url for the item.', 'tp-toolkit' ),
            ),
            'social_label' => array(
                'type' => 'text',
                'label' => esc_attr__( 'Label', 'tp-toolkit' ),
                'description' => esc_attr__( 'You can set label for the item.', 'tp-toolkit' ),
            ),
            'social_color' => array(
                'type' => 'color',
                'default'     => '#3b5999',
                'label' => esc_attr__( 'Color', 'tp-toolkit' ),
                'description' => esc_attr__( 'You can set color for the item.(optional)', 'tp-toolkit' ),
                'choices'     => [
                    'alpha' => true,
                ],
            ),

        ),
    );
    return $fields;
}
add_filter( 'kirki/fields', '_tp_widget_customize' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {
    // side info settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'kidba_side_logo',
        'label'       => esc_html__( 'Side Logo', 'tp-toolkit' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_side_contact_switcher',
        'label'    => esc_html__( 'Side Contact Switcher', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => 0,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_side_contact_title',
        'label'    => esc_html__( 'Contact Title', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Info', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_side_contact_address',
        'label'    => esc_html__( 'Contact Address', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '12/A, Mirnada City Tower, NYC', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_side_contact_phone',
        'label'    => esc_html__( 'Phone Number', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '088889797697', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'URL',
        'settings' => 'kidba_side_contact_phone_link',
        'label'    => esc_html__( 'Phone Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '088889797697', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_side_mail',
        'label'    => esc_html__( 'Email ID', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'info@kidba.com', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_side_mail_link',
        'label'    => esc_html__( 'Email Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'info@kidba.com', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_contact_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_side_social_switcher',
        'label'    => esc_html__( 'Side Social Switcher', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => 0,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'URL',
        'settings' => 'kidba_side_social_fb_link',
        'label'    => esc_html__( 'Facebook Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_social_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'URL',
        'settings' => 'kidba_side_social_twitter_link',
        'label'    => esc_html__( 'Twitter Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_social_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'URL',
        'settings' => 'kidba_side_social_linkedin_link',
        'label'    => esc_html__( 'Linkedin Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_social_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'URL',
        'settings' => 'kidba_side_social_youtube_link',
        'label'    => esc_html__( 'Youtube Link', 'tp-toolkit' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'kidba_side_social_switcher',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */

function get_breadcrumb_page_by_id() {
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'page',
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    $post_ids = array();
    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();
            array_push($post_ids, get_the_ID());
        }
        wp_reset_query();
    }
    return $post_ids;
}
function get_breadcrumb_page_by_id_specific($id)
 {
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'page',
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    $post_ids = array();
    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();
            array_push($post_ids, get_the_ID());
        }
        wp_reset_query();
    }
    return $post_ids[$id];
}

function _header_page_title_fields( $fields ) {

    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'breadcrumb_buttonset',
        'label'    => esc_html__( 'Breadcrumb Customize', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'select',
        'settings' => 'select_breadcrumb_page',
        'label'    => esc_html__( 'Select Page', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'choices'     => Kirki\Util\Helper::get_posts(
            array(
                'posts_per_page' => -1,
                'post_type'      => 'page',
                'post_status' => 'publish'
            ) ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];
    for($i = 0; $i< count(get_breadcrumb_page_by_id());$i+=1) {
        $fields[] = [
            'type'     => 'text',
            'settings' => 'breadcrumb_title_'.get_breadcrumb_page_by_id_specific($i).'',
            'label'    => esc_html__( 'Breadcrumb Title', 'tp-toolkit' ),
            'section'  => 'breadcrumb_setting',
            'default'  => esc_html__( 'Breadcrumb Title', 'tp-toolkit' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'select_breadcrumb_page',
                    'operator' => '==',
                    'value'    =>  get_breadcrumb_page_by_id_specific($i)
                ],
                [
                    'setting'  => 'breadcrumb_buttonset',
                    'operator' => '==',
                    'value'    => 'content',
                ]
            ],
        ];
    }
    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_title_blog',
        'label'    => esc_html__( 'Blog Title', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( 'Blog', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];
    
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'breadcrumb_text_color',
        'label'       => esc_html__( 'Breadcrumb Text Color', 'tp-toolkit' ),
        'description' => esc_html__( 'Choose any color for text', 'tp-toolkit' ),
        'priority'    => 10,
        'section'     => 'breadcrumb_setting',
        'default'     => '#fff',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'breadcrumb_text_hover_color',
        'label'       => esc_html__( 'Breadcrumb Text Hover Color', 'tp-toolkit' ),
        'description' => esc_html__( 'Choose any color for hover', 'tp-toolkit' ),
        'priority'    => 10,
        'section'     => 'breadcrumb_setting',
        'default'     => '#23cc88',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'breadcrumb_title_typography',
        'label'    => esc_html__( 'Breadcrumb Title Typography', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [ 
            [
                'element' => '.kidba_breadcrumb_title', 
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'typography',
        'settings' => 'breadcrumb_text_typography',
        'label'    => esc_html__( 'Breadcrumb Text Typography', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'priority' => 10, 
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '',
            'text-transform' => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [ 
            [
                'element' => 'nav.breadcrumb-trail.breadcrumbs span, .breadcrumb-trail.breadcrumbs > span a span, nav.breadcrumb-trail.breadcrumbs', 
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Select',
        'settings' => 'breadcrumb_padding_select',
        'label'    => esc_html__( 'Section Padding', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( 240, 'tp-toolkit' ),
        'priority' => 10,
        'choices'     => [
            'padding-top' => esc_html__( 'Padding Top', 'tp-toolkit' ),
            'padding-bottom' => esc_html__( 'Padding Bottom', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'number',
        'settings' => 'breadcrumb_padding_top',
        'label'    => esc_html__( 'Padding Top', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( 240, 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_padding_select',
                'operator' => '==',
                'value'    => 'padding-top',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'number',
        'settings' => 'breadcrumb_padding_bottom',
        'label'    => esc_html__( 'Padding Bottom', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => esc_html__( 220, 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_padding_select',
                'operator' => '==',
                'value'    => 'padding-bottom',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'     => 'Select',
        'settings' => 'breadcrumb_background_select',
        'label'    => esc_html__( 'Background Options', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => 'background-image',
        'priority' => 10,
        'choices'     => [
            'background-image' => esc_html__( 'Background Image', 'tp-toolkit' ),
            'background-color' => esc_html__( 'Background Color', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'tp-toolkit' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'tp-toolkit' ),
        'priority'    => 10,
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/bg/breadcrumb_bg.jpg',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'breadcrumb_bg_img_ovelay_color',
        'label'       => esc_html__( 'Background Image Overlay', 'tp-toolkit' ),
        'description' => esc_html__( 'Choose any color for overlay', 'tp-toolkit' ),
        'priority'    => 10,
        'section'     => 'breadcrumb_setting',
        'default'     => '#000',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'text',
        'settings'    => 'breadcrumb_bg_img_ovelay_color_opacity',
        'label'       => esc_html__( 'Background Image Overlay Opacity', 'tp-toolkit' ),
        'description' => esc_html__( 'Type value from 0.1 to max value 1', 'tp-toolkit' ),
        'priority'    => 10,
        'section'     => 'breadcrumb_setting',
        'default'     => '0.3',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];
    
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'breadcrumb_background_position_select',
        'label'    => esc_html__( 'Background Image Position', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => 'center center',
        'priority' => 10,
        'choices'     => [
            'center center' => esc_html__( 'Center Center', 'tp-toolkit' ),
            'center top' => esc_html__( 'Center Top', 'tp-toolkit' ),
            'center bottom' => esc_html__( 'Center Bottom', 'tp-toolkit' ),
            'right center' => esc_html__( 'Right Center', 'tp-toolkit' ),
            'right top' => esc_html__( 'Right Top', 'tp-toolkit' ),
            'right bottom' => esc_html__( 'Right Bottom', 'tp-toolkit' ),
            'left center' => esc_html__( 'Left Center', 'tp-toolkit' ),
            'left top' => esc_html__( 'Left Top', 'tp-toolkit' ),
            'left bottom' => esc_html__( 'Left Bottom', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];
    
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'breadcrumb_background_size_select',
        'label'    => esc_html__( 'Background Image Size', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => 'cover',
        'priority' => 10,
        'choices'     => [
            'cover' => esc_html__( 'Cover', 'tp-toolkit' ),
            'contain' => esc_html__( 'Contain', 'tp-toolkit' ),
            'auto' => esc_html__( 'Auto', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ]; 

    $fields[] = [
        'type'     => 'Select',
        'settings' => 'breadcrumb_background_blendmode_select',
        'label'    => esc_html__( 'Background Image Blendmode', 'tp-toolkit' ),
        'section'  => 'breadcrumb_setting',
        'default'  => 'normal',
        'priority' => 10,
        'choices'     => [
            'normal' => esc_html__( 'Normal', 'tp-toolkit' ),
            'multiply' => esc_html__( 'Multiply', 'tp-toolkit' ),
            'overlay' => esc_html__( 'Overlay', 'tp-toolkit' ),
            'darken' => esc_html__( 'Darken', 'tp-toolkit' ),
            'lighten' => esc_html__( 'Lighten', 'tp-toolkit' ),
            'color-dodge' => esc_html__( 'Color-dodge', 'tp-toolkit' ),
            'saturation' => esc_html__( 'Saturation', 'tp-toolkit' ),
            'color' => esc_html__( 'Color', 'tp-toolkit' ),
            'luminosity' => esc_html__( 'Luminosity', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'tp-toolkit' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'tp-toolkit' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_background_select',
                'operator' => '==',
                'value'    => 'background-color',
            ],
            [
                'setting'  => 'breadcrumb_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ]
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting

    $fields[] = [
        'type' => 'radio-buttonset',
        'settings' => 'tp_blog_layout',
        'label' => esc_attr__( 'Layout', 'tp-toolkit' ),
        'description' => esc_attr__( 'You can choose a layout.', 'tp-toolkit' ),
        'section' => 'blog_setting',
        'default' => 'right-sidebar',
        'choices' => array(
            'left-sidebar' => esc_attr__( 'Left Sidebar', 'tp-toolkit' ),
            'full-width' => esc_attr__( 'Full Width', 'tp-toolkit' ),
            'right-sidebar' => esc_attr__( 'Right Sidebar', 'tp-toolkit' ),
        ),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Continue Reading', 'tp-toolkit' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'tp-toolkit' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'tp-toolkit' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'tp-toolkit' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => 'footer-style-1',
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.jpg',
            'footer-style-2'   => get_template_directory_uri() . '/inc/img/footer/footer-1.jpg',
        ],
        'default'     => 'footer-style-1',
    ];
    
    /*
    cmt_section_footer_1: start section Footer 1
    */
    $fields[] = [
        'type'     => 'Radio_Buttonset',
        'settings' => 'footer_buttonset',
        'label'    => esc_html__( 'footer Customize', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'content',
        'priority' => 10,
        'choices'     => [
            'content'   => esc_html__( 'Content', 'tp-toolkit' ),
            'style' => esc_html__( 'Style', 'tp-toolkit' ),
        ],
    ];
    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_limit',
        'label'       => esc_html__( 'Widget Limit', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => 4,
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            4 => esc_html__( 'Widget Limit 4', 'tp-toolkit' ),
            3 => esc_html__( 'Widget Limit 3', 'tp-toolkit' ),
            2 => esc_html__( 'Widget Limit 2', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_column',
        'label'       => esc_html__( 'Widget Column', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => 4,
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            4 => esc_html__( 'Widget Column 4', 'tp-toolkit' ),
            3 => esc_html__( 'Widget Column 3', 'tp-toolkit' ),
            2 => esc_html__( 'Widget Column 2', 'tp-toolkit' ),
        ],

        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_select',
        'label'    => esc_html__( 'Background Options', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'background-image',
        'priority' => 10,
        'choices'     => [
            'background-image' => esc_html__( 'Background Image', 'tp-toolkit' ),
            'background-color' => esc_html__( 'Background Color', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'footer_bg_image',
        'label'       => esc_html__( 'Footer Background Image.', 'tp-toolkit' ),
        'description' => esc_html__( 'Footer Background Image.', 'tp-toolkit' ),
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        'section'     => 'footer_setting',
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_size',
        'label'    => esc_html__( 'Background Size', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'cover',
        'priority' => 10,
        'choices'     => [
            'cover' => esc_html__( 'Cover', 'tp-toolkit' ),
            'auto' => esc_html__( 'Auto', 'tp-toolkit' ),
            'contain' => esc_html__( 'Contain', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'revert' => esc_html__( 'Revert', 'tp-toolkit' ),
            'unset' => esc_html__( 'Unset', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_position_select',
        'label'    => esc_html__( 'Background Image Position', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'center center',
        'priority' => 10,
        'choices'     => [
            'center center' => esc_html__( 'Center Center', 'tp-toolkit' ),
            'center top' => esc_html__( 'Center Top', 'tp-toolkit' ),
            'center bottom' => esc_html__( 'Center Bottom', 'tp-toolkit' ),
            'right center' => esc_html__( 'Right Center', 'tp-toolkit' ),
            'right top' => esc_html__( 'Right Top', 'tp-toolkit' ),
            'right bottom' => esc_html__( 'Right Bottom', 'tp-toolkit' ),
            'left center' => esc_html__( 'Left Center', 'tp-toolkit' ),
            'left top' => esc_html__( 'Left Top', 'tp-toolkit' ),
            'left bottom' => esc_html__( 'Left Bottom', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_blendmode_select',
        'label'    => esc_html__( 'Background Image Blendmode', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'normal',
        'priority' => 10,
        'choices'     => [
            'normal' => esc_html__( 'Normal', 'tp-toolkit' ),
            'multiply' => esc_html__( 'Multiply', 'tp-toolkit' ),
            'overlay' => esc_html__( 'Overlay', 'tp-toolkit' ),
            'darken' => esc_html__( 'Darken', 'tp-toolkit' ),
            'lighten' => esc_html__( 'Lighten', 'tp-toolkit' ),
            'color-dodge' => esc_html__( 'Color-dodge', 'tp-toolkit' ),
            'saturation' => esc_html__( 'Saturation', 'tp-toolkit' ),
            'color' => esc_html__( 'Color', 'tp-toolkit' ),
            'luminosity' => esc_html__( 'Luminosity', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'footer_bg_color',
        'label'       => __( 'Footer BG Color', 'tp-toolkit' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => esc_html__( '#1a1a1a', 'tp-toolkit' ),
        'priority'    => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-color',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'image',
        'settings' => 'footer_1_top_logo',
        'label'    => esc_html__( 'Footer Logo', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_1_top_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_copyright',
        'label'    => esc_html__( 'Copyright text', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '© 2022 kidba Designed by ThemePhi', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_footer_social_menu_switch',
        'label'    => esc_html__( 'Footer Social menu Swicher', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_footer_topbar_switch',
        'label'    => esc_html__( 'Footer Topbar Swicher', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'repeater',
        'settings' => 'kidba_footer_topbar_repeater',
        'label'    => esc_html__( 'Footer Contact Repeater', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'priority' => 10,
        
		'fields'   => [
			'contact_icon'   => [
				'type'        => 'select',
				'label'       => esc_html__( 'Contact Icon', 'tp-toolkit' ),
				'description' => esc_html__( 'Please Select A Contact Icon', 'tp-toolkit' ),
                'choices' => [
                    'ui-touch-phone' => __('Phone', 'kidba'),
                    'ui-email' => __('Email', 'kidba'),
                    'building-alt' => __('House', 'kidba'),
                ]
			],
			'contact_label'    => [
				'type'        => 'text',
                'default' => __('Give us a Call', 'kidba'),
				'label'       => esc_html__( 'Contact Label', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a contact label', 'tp-toolkit' ),
				'default'     => '',
			],
			'contact_number'    => [
				'type'        => 'text',
                'default' => __('Give us a Call', 'kidba'),
				'label'       => esc_html__( 'Contact Number', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a contact Number', 'tp-toolkit' ),
				'default'     => '',
			],
			'contact_link'    => [
				'type'        => 'text',
				'label'       => esc_html__( 'Contact Number Link', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a Contact Number Link', 'tp-toolkit' ),
				'default'     => '',
			],
		],
        'active_callback' => [
            [
                'setting'  => 'kidba_footer_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-1',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];

     /*
    cmt_section_footer_2: start section Footer 2
    */
    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_limit_2',
        'label'       => esc_html__( 'Widget Limit', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => 4,
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            4 => esc_html__( 'Widget Limit 4', 'tp-toolkit' ),
            3 => esc_html__( 'Widget Limit 3', 'tp-toolkit' ),
            2 => esc_html__( 'Widget Limit 2', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_column_2',
        'label'       => esc_html__( 'Widget Column', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => 4,
        'placeholder' => esc_html__( 'Select an option...', 'tp-toolkit' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            4 => esc_html__( 'Widget Column 4', 'tp-toolkit' ),
            3 => esc_html__( 'Widget Column 3', 'tp-toolkit' ),
            2 => esc_html__( 'Widget Column 2', 'tp-toolkit' ),
        ],

        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_select_2',
        'label'    => esc_html__( 'Background Options', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'background-image',
        'priority' => 10,
        'choices'     => [
            'background-image' => esc_html__( 'Background Image', 'tp-toolkit' ),
            'background-color' => esc_html__( 'Background Color', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'footer_bg_image_2',
        'label'       => esc_html__( 'Footer Background Image.', 'tp-toolkit' ),
        'description' => esc_html__( 'Footer Background Image.', 'tp-toolkit' ),
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        'section'     => 'footer_setting',
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ]
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_size_2',
        'label'    => esc_html__( 'Background Size', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'cover',
        'priority' => 10,
        'choices'     => [
            'cover' => esc_html__( 'Cover', 'tp-toolkit' ),
            'auto' => esc_html__( 'Auto', 'tp-toolkit' ),
            'contain' => esc_html__( 'Contain', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'revert' => esc_html__( 'Revert', 'tp-toolkit' ),
            'unset' => esc_html__( 'Unset', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_position_select_2',
        'label'    => esc_html__( 'Background Image Position', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'center center',
        'priority' => 10,
        'choices'     => [
            'center center' => esc_html__( 'Center Center', 'tp-toolkit' ),
            'center top' => esc_html__( 'Center Top', 'tp-toolkit' ),
            'center bottom' => esc_html__( 'Center Bottom', 'tp-toolkit' ),
            'right center' => esc_html__( 'Right Center', 'tp-toolkit' ),
            'right top' => esc_html__( 'Right Top', 'tp-toolkit' ),
            'right bottom' => esc_html__( 'Right Bottom', 'tp-toolkit' ),
            'left center' => esc_html__( 'Left Center', 'tp-toolkit' ),
            'left top' => esc_html__( 'Left Top', 'tp-toolkit' ),
            'left bottom' => esc_html__( 'Left Bottom', 'tp-toolkit' ),
            '100% 100%' => esc_html__( '100% 100%', 'tp-toolkit' ),
            '50% 50%' => esc_html__( '50% 50%', 'tp-toolkit' ),
            'initial' => esc_html__( 'Initial', 'tp-toolkit' ),
            'inherit' => esc_html__( 'Inherit', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'Select',
        'settings' => 'footer_background_blendmode_select_2',
        'label'    => esc_html__( 'Background Image Blendmode', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => 'normal',
        'priority' => 10,
        'choices'     => [
            'normal' => esc_html__( 'Normal', 'tp-toolkit' ),
            'multiply' => esc_html__( 'Multiply', 'tp-toolkit' ),
            'overlay' => esc_html__( 'Overlay', 'tp-toolkit' ),
            'darken' => esc_html__( 'Darken', 'tp-toolkit' ),
            'lighten' => esc_html__( 'Lighten', 'tp-toolkit' ),
            'color-dodge' => esc_html__( 'Color-dodge', 'tp-toolkit' ),
            'saturation' => esc_html__( 'Saturation', 'tp-toolkit' ),
            'color' => esc_html__( 'Color', 'tp-toolkit' ),
            'luminosity' => esc_html__( 'Luminosity', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-image',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'footer_bg_color_2',
        'label'       => __( 'Footer BG Color', 'tp-toolkit' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'tp-toolkit' ),
        'section'     => 'footer_setting',
        'default'     => esc_html__( '#1a1a1a', 'tp-toolkit' ),
        'priority'    => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_background_select',
                'operator' => '==',
                'value'    => 'background-color',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'style',
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'image',
        'settings' => 'footer_1_top_logo_2',
        'label'    => esc_html__( 'Footer Logo', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_1_top_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_copyright_2',
        'label'    => esc_html__( 'Copyright text', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( '© 2022 kidba Designed by ThemePhi', 'tp-toolkit' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_footer_social_menu_switch_2',
        'label'    => esc_html__( 'Footer Social menu Swicher', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'kidba_footer_topbar_switch_2',
        'label'    => esc_html__( 'Footer Topbar Swicher', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'tp-toolkit' ),
            'off' => esc_html__( 'Disable', 'tp-toolkit' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];
    $fields[] = [
        'type'     => 'repeater',
        'settings' => 'kidba_footer_topbar_repeater_2',
        'label'    => esc_html__( 'Footer Contact Repeater', 'tp-toolkit' ),
        'section'  => 'footer_setting',
        'priority' => 10,
        
		'fields'   => [
			'contact_icon'   => [
				'type'        => 'select',
				'label'       => esc_html__( 'Contact Icon', 'tp-toolkit' ),
				'description' => esc_html__( 'Please Select A Contact Icon', 'tp-toolkit' ),
                'choices' => [
                    'ui-touch-phone' => __('Phone', 'kidba'),
                    'ui-email' => __('Email', 'kidba'),
                    'building-alt' => __('House', 'kidba'),
                ]
			],
			'contact_label'    => [
				'type'        => 'text',
                'default' => __('Give us a Call', 'kidba'),
				'label'       => esc_html__( 'Contact Label', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a contact label', 'tp-toolkit' ),
				'default'     => '',
			],
			'contact_number'    => [
				'type'        => 'text',
                'default' => __('Give us a Call', 'kidba'),
				'label'       => esc_html__( 'Contact Number', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a contact Number', 'tp-toolkit' ),
				'default'     => '',
			],
			'contact_link'    => [
				'type'        => 'text',
				'label'       => esc_html__( 'Contact Number Link', 'tp-toolkit' ),
				'description' => esc_html__( 'Please enter a Contact Number Link', 'tp-toolkit' ),
				'default'     => '',
			],
		],
        'active_callback' => [
            [
                'setting'  => 'kidba_footer_topbar_switch_2',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'choose_default_footer',
                'operator' => '==',
                'value'    => 'footer-style-2',
            ],
            [
                'setting'  => 'footer_buttonset',
                'operator' => '==',
                'value'    => 'content',
            ],
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function kidba_color_fields( $fields ) {
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'kidba_color_option',
        'label'       => __( 'Theme Color', 'tp-toolkit' ),
        'description' => esc_html__( 'This is a Theme color control.', 'tp-toolkit' ),
        'section'     => 'color_setting',
        'default'     => '#ea1b29',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'kidba_color_fields' );

// 404
function kidba_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_error_404_text',
        'label'    => esc_html__( '400 Text', 'tp-toolkit' ),
        'section'  => '404_page',
        'default'  => esc_html__( '404', 'tp-toolkit' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_error_title',
        'label'    => esc_html__( 'Not Found Title', 'tp-toolkit' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'tp-toolkit' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'kidba_error_desc',
        'label'    => esc_html__( '404 Description Text', 'tp-toolkit' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'tp-toolkit' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'tp-toolkit' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'tp-toolkit' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'kidba_404_fields' );


/**
 * Added Fields
 */
function kidba_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'tp-toolkit' ),
        'section'     => 'typo_setting',
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'kidba_typo_fields' );




/**
 * Added Fields
 */
function kidba_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'kidba_service_slug',
        'label'    => esc_html__( 'Service Slug', 'tp-toolkit' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourservice', 'tp-toolkit' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'kidba_slug_setting' );



if(function_exists('tutor')) {
    function  kidba_tutor_customize($fields) {
        $fields[] = [
            'type'     => 'select',
            'settings' => 'kidba_tutor_course_layout_customize',
            'label'    => esc_html__( 'Course Layout', 'tp-toolkit' ),
            'section'  => 'tutor_setting',
            'default'  => 'layout-1',
            'priority' => 10,
            'choices'     => array(
                'layout-1' => 'Course Layout 01',
                'layout-2' => 'Course Layout 02',
                'layout-3' => 'Course Layout 03'
            )
        ];
        return $fields;
    }
	add_filter( 'kirki/fields', 'kidba_tutor_customize' );
}
/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function kidba_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'tp-toolkit' ) ) {
        $value = Kirki::get_option( kidba_get_theme(), $name );
    }

    return apply_filters( 'kidba_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function kidba_get_theme() {
    return 'kidba';
}