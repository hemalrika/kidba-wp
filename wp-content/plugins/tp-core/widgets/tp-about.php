<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About extends Widget_Base {

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
		return 'tp-about';
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
		return __( 'TP About', 'tp-core' );
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
		return 'eicon-lightbox-expand';
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
		return [ 'tp-core' ];
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

		$this->add_control( 'design_style',
			[
				'label' => esc_html__( 'Design Style', 'tp-core' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => 'style1',
				'options' => [
					'style1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style2'	  => esc_html__( 'Style 2', 'tp-core' ),
					'style3'	  => esc_html__( 'Style 3', 'tp-core' ),
					'style4'	  => esc_html__( 'Style 4', 'tp-core' )
				],
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__( 'About Title', 'tp-core' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'About Kindergarten School', 'tp-core' ),
				'placeholder' => esc_html__( 'Type about title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style1', 'style2', 'style3', 'style4']
				]
			]
		);
		$this->add_control(
			'about_description',
			[
				'label' => esc_html__( 'About Description', 'tp-core' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type about description here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style1', 'style2', 'style3', 'style4']
				]
			]
		);
        $this->add_control(
			'app_image',
			[
				'label' => esc_html__( 'App Image', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
					'design_style' => ['style2', 'style3']
				]
			]
		);
        $this->add_control(
			'app_link',
			[
				'label' => esc_html__( 'App Link', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'tp-core' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
                'condition' => [
					'design_style' => ['style2', 'style3']
				]
			]
		);
        $this->add_control(
			'app_image_2',
			[
				'label' => esc_html__( 'App Image 2', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
					'design_style' => ['style2', 'style3']
				]
			]
		);
        $this->add_control(
			'app_link_2',
			[
				'label' => esc_html__( 'App Link 2', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'tp-core' ),
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
                'condition' => [
					'design_style' => ['style2', 'style3']
				]
			]
		);
		$repeater = new Repeater();
		$repeater->add_control( 'field_condition',
			[
				'label' => esc_html__( 'Field Condition', 'tp-core' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => 'style1',
				'options' => [
					'style1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style2'	  => esc_html__( 'Style 2', 'tp-core' ),
					'style3'	  => esc_html__( 'Style 3', 'tp-core' ),
					'style4'	  => esc_html__( 'Style 4', 'tp-core' )
				]
			]
		);
		$repeater->add_control(
			'about_service_list_text',
			[
				'label' => esc_html__( 'Service Text', 'tp-core' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'About Service List Content', 'tp-core' ),
				'placeholder' => esc_html__( 'Type about service list here', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2', 'style3']
				]
			]
		);
		$repeater->add_control(
			'about_service_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-core' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
					'field_condition' => ['style1']
				]
			]
		);
		$this->add_control( 'about_service_list',
            [
                'label' => esc_html__( 'About Service List', 'bacola-core' ),
				'label_block' => true,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
				'default' => [
					[
						'about_service_list_text' => 'Donec facilisis aliquet ultrices. Cras ut ultricies.',
					],
					[
						'about_service_list_text' => 'Fusce euismod at massa eget blandit quisque.',
					]
				]
            ]
        );
		$this->add_control(
			'about_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'tp-core' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type about button text here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style1', 'style4']
				]
			]
		);
		$this->add_control(
			'about_btn_link',
			[
				'label' => esc_html__( 'Link', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'design_style' => ['style1', 'style4']
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
		$this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
		
		$this->add_control( 'title_color',
           [
               'label' => esc_html__( 'Title Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                    '{{WRAPPER}} .tp-el-widget-about .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app-download-txt .section-title' => 'color: {{VALUE}};',
                ]
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
                'selectors' => [
                    '{{WRAPPER}} .tp-el-widget-about .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .app-download-txt .section-title' => 'font-size: {{SIZE}}px;',
                ],
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
                    '{{WRAPPER}} .tp-el-widget-about .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title' => 'padding-left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .app-download-txt .section-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .tp-el-widget-about .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title' => 'padding-top: {{SIZE}}{{UNIT}}',
                    ' {{WRAPPER}} .app-download-txt .section-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => [
                    '{{WRAPPER}} .tp-el-widget-about .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title' => 'opacity: {{VALUE}} ;',
                    '{{WRAPPER}} .app-download-txt .section-title' => 'opacity: {{VALUE}} ;',
                ]
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .p-el-widget-atbout .tp-el-title, {{WRAPPER}} .tp-el-desc .tp-el-title, {{WRAPPER}} .app-download-txt .section-title'
            ]
        );
		$this->add_control( 'content_about_heading',
            [
                'label' => esc_html__( 'About Content', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_about_color',
           [
               'label' => esc_html__( 'content_about Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                    '{{WRAPPER}} .tp-el-widget-about.tp-el-content p, {{WRAPPER}} .app-download-txt p, .tp-el-desc p' => 'color: {{VALUE}};'
               ]
           ]
        );
		
		$this->add_control( 'content_about_size',
            [
                'label' => esc_html__( 'content_about Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .tp-el-widget-about.tp-el-content p, {{WRAPPER}} .app-download-txt p, .tp-el-desc p' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_about_left',
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
                    '{{WRAPPER}} .tp-el-widget-about.tp-el-content p, {{WRAPPER}} .app-download-txt p, .tp-el-desc p' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_about_top',
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
                    ' {{WRAPPER}} .tp-el-widget-about.tp-el-content p, {{WRAPPER}} .app-download-txt p, .tp-el-desc p' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_about_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-el-widget-about.tp-el-content p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_about_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-el-widget-about.tp-el-content p, {{WRAPPER}} .app-download-txt p, .tp-el-desc p'
            ]
        );
		$this->add_control( 'content_about_list_heading',
            [
                'label' => esc_html__( 'About List', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_about_list_color',
           [
               'label' => esc_html__( 'content_about_list Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-el-content.tp-el-widget-about .about-list' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_about_list_size',
            [
                'label' => esc_html__( 'content_about_list Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-el-content.tp-el-widget-about .about-list' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_about_list_left',
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
                    '{{WRAPPER}} .tp-el-content.tp-el-widget-about .about-list' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_about_list_top',
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
                    ' {{WRAPPER}} .tp-el-content.tp-el-widget-about .about-list' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_about_list_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-el-content.tp-el-widget-about .about-list ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_about_list_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-el-content.tp-el-widget-about .about-list'
            ]
        );
		$this->add_control( 'button_label',
            [
                'label' => esc_html__( 'Button', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn '
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
                    '{{WRAPPER}}  .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'tp-core' ),
                'selector' => '{{WRAPPER}} .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-el-widget-about .def-btn.btn-2 ,{{WRAPPER}} .tp-el-desc .tp-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
       
		$this->add_control( 'btn_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
					'{{WRAPPER}} .tp-el-widget-about .def-btn.btn-2, {{WRAPPER}} .tp-el-desc .tp-el-btn, .def-btn.btn-2::after' => 'background: {{VALUE}};'
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
                'selectors' => ['{{WRAPPER}}  .tp-el-widget-about .def-btn.btn-2 ,{{WRAPPER}} .tp-el-desc .tp-el-btn' => 'opacity: {{VALUE}} ;']
            ]
        );
		$this->end_controls_section();
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
		$settings = $this->get_settings_for_display();?>
        <?php if($settings['design_style'] == 'style1') : ?>
		<div class="about-area">
            <div class="container">
                <div class="tp-el-content tp-el-widget-about">
					<div class="row justify-content-end">
						<div class="col-xl-6 col-lg-7 col-md-8 col-sm-12">
							<?php if(!empty($settings['about_title'])) : ?>
								<h2 class="tp-el-title about-title mt--8 mb-25"><?php echo esc_html($settings['about_title']); ?></h2>
							<?php endif; ?>
							<?php if(!empty($settings['about_description'])) : ?>
								<p class="fw-bolds mt--1 mb-16"><?php echo tp_element_kses_basic($settings['about_description']); ?></p>
							<?php endif; ?>
							<?php foreach($settings['about_service_list'] as $about) : ?>
								<?php if(!empty($about['about_service_list_text'])) : ?>
									<span class="about-list d-block  mb-15">
										<?php if(!empty($about['about_service_icon'])) : ?>
											<span class="mr-15"><?php Icons_Manager::render_icon( $about['about_service_icon'], ['aria-hidden' => 'true', 'class' => 'tp-core-icon'] ); ?></span>
										<?php endif; ?>
										<?php if(!empty($about['about_service_list_text'])) : ?>
											<?php echo esc_html($about['about_service_list_text']); ?>
										<?php endif; ?>
									</span>
								<?php endif; ?>
							<?php endforeach; ?>
							<div class="btn-box pt-50">
								<?php if(!empty($settings['about_btn_text'])) : ?>
									<a href="<?php echo $settings['about_btn_link']['url'] ? esc_url($settings['about_btn_link']['url']): ''; ?>" class="def-btn btn-2"><?php echo esc_html($settings['about_btn_text']); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <?php elseif($settings['design_style'] == 'style2') :
            if ( ! empty( $settings['app_link']['url'] ) ) {
                $this->add_link_attributes( 'app_link', $settings['app_link'] );
            } 
            if ( ! empty( $settings['app_link_2']['url'] ) ) {
                $this->add_link_attributes( 'app_link_2', $settings['app_link_2'] );
            }
        ?>
            <div class="app-download-txt mb-50 mb-md-0">
                <div class="section-heading mb-50">
                    <?php if(!empty($settings['about_title'])) : ?>
                    <h2 class="section-title mt--8 mb-25 cd-headline rotate-1">
                        <?php echo tp_element_kses_basic($settings['about_title']); ?>
                        <?php if(!empty($settings['about_service_list'])) : ?>
                        <span class="cd-words-wrapper" style="width: 309.438px;">
                            <?php foreach($settings['about_service_list'] as $key => $slide) :
                                $hidden_class = $key > 0 ? 'is-hidden':'is-visible' ;   
                            ?>
                                <?php if(!empty($slide['about_service_list_text'])) : ?>
                                    <b class="<?php echo esc_attr($hidden_class); ?>"><?php echo esc_html($slide['about_service_list_text']); ?></b>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </span>
                        <?php endif; ?>
                    </h2>
                    <?php endif; ?>
                    <?php if(!empty($settings['about_description'])) : ?>
                    <p class="heading-sub-txt mt--1 mb--8"><?php echo tp_element_kses_basic($settings['about_description']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="btn-box">
                    <?php if(!empty($settings['app_image']['url'])) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'app_link' ); ?> class="app-download-btn mr-75">
                        <img src="<?php echo esc_url($settings['app_image']['url']); ?>" class="filter-shadow-3" alt="App Store">
                    </a>
                    <?php endif; ?>
                    <?php if(!empty($settings['app_image_2']['url'])) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'app_link_2' ); ?> class="app-download-btn">
                        <img src="<?php echo esc_url($settings['app_image_2']['url']); ?>" class="filter-shadow-2" alt="Play Store">
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php elseif($settings['design_style'] == 'style3') :
                if ( ! empty( $settings['app_link']['url'] ) ) {
                    $this->add_link_attributes( 'app_link', $settings['app_link'] );
                } 
                if ( ! empty( $settings['app_link_2']['url'] ) ) {
                    $this->add_link_attributes( 'app_link_2', $settings['app_link_2'] );
                }
            ?>
            <!-- app download begin -->
            <div class="app-download-2-area">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-5 col-lg-6 col-sm-8">
                            <div class="tp-el-desc">
                                <h2 class="tp-el-title section-title mt--8 mb-25 white-text cd-headline rotate-1">
                                    <?php if(!empty($settings['about_title'])) : ?>
                                        <?php echo tp_element_kses_basic($settings['about_title']); ?>
                                    <?php endif; ?>
                                    <span class="cd-words-wrapper">
                                    <?php foreach($settings['about_service_list'] as $key => $slide) :
                                        $hidden_class = $key > 0 ? 'is-hidden':'is-visible' ;
                                    ?>
                                        <?php if(!empty($slide['about_service_list_text'])) : ?>
                                            <b class="<?php echo esc_attr($hidden_class); ?>"><?php echo esc_html($slide['about_service_list_text']); ?></b>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </span>
                                </h2>
                                <?php if(!empty($settings['about_description'])) : ?>
                                    <p class="app-download-txt white-text mt--2 mb-50"><?php echo tp_element_kses_basic($settings['about_description']); ?></p>
                                <?php endif; ?>
                                <div class="btn-box mt--8">
                                    <?php if(!empty($settings['app_image']['url'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string('app_link'); ?> class="def-btn tp-el-btn">
                                            <img src="<?php echo esc_url($settings['app_image']['url']); ?>" class="filter-shadow-3" alt="<?php echo __('Play Store', 'tp-core'); ?>">
                                        </a>
                                        <?php endif; ?>
                                        <?php if(!empty($settings['app_image_2']['url'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string( 'app_link_2' ); ?> class="def-btn btn-3 tp-el-btn">
                                            <img src="<?php echo esc_url($settings['app_image_2']['url']); ?>" class="filter-shadow-2" alt="<?php echo __('Play Store', 'tp-core'); ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- app download end -->
            <?php elseif($settings['design_style'] == 'style4') :
                if ( ! empty( $settings['about_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'about_btn_link', $settings['about_btn_link'] );
                }
            ?>
            <div class="about-2 tp-el-desc">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7">
                            <?php if(!empty($settings['about_title'])) : ?>
                                <h2 class="tp-el-title about-title mt--8 mb-25"><?php echo esc_html($settings['about_title']); ?></h2>
                            <?php endif; ?>
                            <?php if(!empty($settings['about_description'])) : ?>
                                <p class="mt--1 mb-35"><?php echo tp_element_kses_basic($settings['about_description']); ?></p>
                            <?php endif; ?>
                            <?php if(!empty($settings['about_btn_text'])) : ?>
                            <div class="btn-box mt--3">
                                <a <?php echo $this->get_render_attribute_string('about_btn_link'); ?> class="def-btn tp-el-btn btn-2"><?php echo esc_html($settings['about_btn_text']); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	<?php }
}
