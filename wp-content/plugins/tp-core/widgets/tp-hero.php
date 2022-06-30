<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-hero';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'TP Hero', 'tp-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tp-cat' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tp-hero' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'tp-core' ),
			]
		);
		$this->add_control( 'hero_style',
            [
                'label' => esc_html__( 'Hero Style', 'tp-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 01', 'tp-core'),
					'style2' => esc_html__('Style 02', 'tp-core'),
				]
            ]
        );
		$this->add_control( 'hero_image',
            [
                'label' => esc_html__( 'Image', 'tp-core' ),
                'type' => Controls_Manager::MEDIA,
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'hero_subtitle',
            [
                'label' => esc_html__( 'Hero Sub Title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'A New Approach to',
                'pleaceholder' => esc_html__( 'Enter item subtitle here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'hero_title',
            [
                'label' => esc_html__( 'Hero Title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Study Of',
                'pleaceholder' => esc_html__( 'Enter item title here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$repeater = new Repeater();
		$repeater->add_control( 'hero_title_slide',
            [
                'label' => esc_html__( 'Hero Slide title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__('Kids', 'tp-core'),
                'pleaceholder' => esc_html__( 'Custom Hero Slide Title.', 'tp-core' ),
            ]
        );
		$this->add_control( 'slider_title_items',
            [
                'label' => esc_html__( 'Slide Title Items', 'tp-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
		$this->add_control( 'hero_content',
            [
                'label' => esc_html__( 'Hero Content', 'tp-core' ),
                'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('We provide best solutions for a Clean Environment If you need any help in cleaning or maintenance.', 'tp-core'),
                'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter item content here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'button_1_title',
            [
                'label' => esc_html__( 'Button 1 Title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
				'default' => esc_html__('admission now', 'tp-core'),
                'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter Button Title Here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'button_1_link',
            [
                'label' => esc_html__( 'Button 1 Link', 'tp-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
                'pleaceholder' => esc_html__( 'Enter Button Link Here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'button_2_title',
            [
                'label' => esc_html__( 'Button 2 Title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
				'default' => esc_html__('admission now', 'tp-core'),
                'label_block' => true,
                'pleaceholder' => esc_html__( 'Enter Button Title Here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		$this->add_control( 'button_2_link',
            [
                'label' => esc_html__( 'Button 2 Link', 'tp-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
                'pleaceholder' => esc_html__( 'Enter Button Link Here.', 'tp-core' ),
				'condition' => [
					'hero_style' => 'style1'
				]
            ]
        );
		
	

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'tp-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control( 'home_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .tp-core-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'title_color',
           [
               'label' => esc_html__( 'Title Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-core-banner-title' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'title_size',
            [
                'label' => esc_html__( 'Title Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .tp-core-banner-title' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'title_left',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-core-banner-title' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'title_top',
            [
                'label' => esc_html__( 'Top', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    ' {{WRAPPER}} .tp-core-banner-title' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'title_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-banner-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-banner-title'
            ]
        );
		$this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'subtitle_color',
           [
               'label' => esc_html__( 'Subtitle Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-core-hero-subtitle' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'subtitle_size',
            [
                'label' => esc_html__( 'Subtitle Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-core-hero-subtitle' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'subtitle_left',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-core-hero-subtitle' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'subtitle_top',
            [
                'label' => esc_html__( 'Top', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    ' {{WRAPPER}} .tp-core-hero-subtitle' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-hero-subtitle ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-hero-subtitle'
            ]
        );
		
		$this->add_control( 'second_subtitle_heading',
            [
                'label' => esc_html__( 'SECOND SUBTITLE', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'second_subtitle_color',
           [
               'label' => esc_html__( 'Second Subtitle Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .content-header .content-description ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'second_subtitle_size',
            [
                'label' => esc_html__( 'Second Subtitle Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .content-header .content-description' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'second_subtitle_left',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-header .content-description' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'second_subtitle_top',
            [
                'label' => esc_html__( 'Top', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    ' {{WRAPPER}} .content-header .content-description' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'second_subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .content-header .content-description ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'second_subtitle_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' =>  \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content-header .content-description'
            ]
        );
		$this->add_control( 'content_hero_heading',
            [
                'label' => esc_html__( 'Hero Content', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_hero_color',
           [
               'label' => esc_html__( 'content_hero Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-core-hero-content-text' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_hero_size',
            [
                'label' => esc_html__( 'content_hero Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-core-hero-content-text' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_hero_left',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-core-hero-content-text' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_hero_top',
            [
                'label' => esc_html__( 'Top', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    ' {{WRAPPER}} .tp-core-hero-content-text' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_hero_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-hero-content-text ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_hero_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-hero-content-text'
            ]
        );
		$this->end_controls_section();
		/**
		 * End Controls Section
		 */
		/**
		 * Start Controls Section
		 */
        $this->start_controls_section('btn_styling',
            [
                'label' => esc_html__( ' Button Style', 'tp-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		$this->add_control( 'button_one_label',
            [
                'label' => esc_html__( 'Button One', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content .def-btn.btn-2 '
            ]
        );
        
		$this->add_responsive_control( 'btn_left',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}  .tp-core-content .def-btn.btn-2' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-content .def-btn.btn-2 ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'tp-core' ),
                'selector' => '{{WRAPPER}} .tp-core-content .def-btn.btn-2 ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-2 ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
       
		$this->add_control( 'btn_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
					'{{WRAPPER}} .tp-core-content .def-btn.btn-2, .def-btn.btn-2::after' => 'background: {{VALUE}};'
               ]
           ]
        );
		
		$this->add_control( 'brn_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-2 ' => 'opacity: {{VALUE}} ;']
            ]
        );
		$this->add_control( 'button_two_label',
            [
                'label' => esc_html__( 'Button Two', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->add_responsive_control( 'btn_padding_2',
            [
                'label' => esc_html__( 'Padding', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo_2',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content .def-btn.btn-3 '
            ]
        );
        
		$this->add_responsive_control( 'btn_left_2',
            [
                'label' => esc_html__( 'Left', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}  .tp-core-content .def-btn.btn-3' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color_2',
            [
                'label' => esc_html__( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-content .def-btn.btn-3 ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_2',
                'label' => esc_html__( 'Border', 'tp-core' ),
                'selector' => '{{WRAPPER}} .tp-core-content .def-btn.btn-3 ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius_2',
            [
                'label' => esc_html__( 'Border Radius', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-3 ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
       
		$this->add_control( 'btn_bgclr_2',
           [
               'label' => esc_html__( 'Background Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
					'{{WRAPPER}} .tp-core-content .def-btn.btn-3, .def-btn.btn-3::after' => 'background: {{VALUE}};'
               ]
           ]
        );
		
		$this->add_control( 'brn_opacity_important_style_2',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .tp-core-content .def-btn.btn-3 ' => 'opacity: {{VALUE}} ;']
            ]
        );
		/**
		 * End Controls Section
		 */
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('title');
        $bg_image = $settings['hero_image']['url'];
        $bg_image = $bg_image ? $bg_image: '';
    ?>
		<?php if($settings['hero_style'] == 'style1') : ?>		
            <!-- banner begin -->
                <div class="banner pt-185 pb-190" <?php echo $bg_image ? 'data-background='.esc_url($bg_image).'': ''; ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-sm-11">
                                <div class="banner-txt tp-core-content">
                                    <?php if(!empty($settings['hero_subtitle'])) : ?>
                                    <h3 class="banner-subtitle tp-core-hero-subtitle mt--9 mb-10"><?php echo esc_html($settings['hero_subtitle']); ?></h3>
                                    <?php endif; ?>
                                    <h1 class="banner-title tp-core-banner-title mb-20 cd-headline push">
                                        <?php if(!empty($settings['hero_title'])) : ?>
                                            <span><?php echo esc_html($settings['hero_title']); ?></span>
                                        <?php endif; ?>
                                        <span class="cd-words-wrapper">
                                            <?php foreach($settings['slider_title_items'] as $key => $title_single) : 
                                                if($key == 0) {
                                                    $visibleClass = "is-visible";
                                                } else {
                                                    $visibleClass = "";
                                                }
                                            ?>
                                                <?php if(!empty($title_single['hero_title_slide'])) : ?>
                                                <b class="<?php echo esc_attr($visibleClass); ?>"><?php echo esc_html($title_single['hero_title_slide']); ?></b>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </span>
                                    </h1>
                                    <?php if(!empty($settings['hero_content'])) : ?>
                                    <p class="tp-core-hero-content-text banner-paragraph mb-11"><?php echo tp_element_kses_basic($settings['hero_content']); ?></p>
                                    <?php endif; ?>
                                    <div class="btn-box sm-padd-btn pt-35">
                                        <?php if(!empty($settings['button_1_title'])) : ?>
                                            <a href="<?php echo esc_url($settings['button_1_link']); ?>" class="def-btn btn-2"><?php echo esc_html($settings['button_1_title']); ?></a>
                                        <?php endif; ?>
                                        <?php if(!empty($settings['button_2_title'])) : ?>
                                            <a href="<?php echo esc_url($settings['button_2_link']); ?>" class="def-btn btn-3"><?php echo esc_html($settings['button_2_title']); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- banner end -->
		<?php endif; ?>
	<?php }

}
