<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'TP Slider', 'tp-core' );
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
		return 'eicon-slider-album';
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

        $this->add_control( 'auto_play',
        [
            'label' => esc_html__( 'Auto Play', 'tp-core' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'True', 'tp-core' ),
            'label_off' => esc_html__( 'False', 'tp-core' ),
            'return_value' => 'true',
            'default' => 'false',
        ]
    );

    $this->add_control( 'auto_speed',
        [
            'label' => esc_html__( 'Auto Speed', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '1600',
            'pleaceholder' => esc_html__( 'Set auto speed.', 'tp-core' ),
            'condition' => ['auto_play' => 'true']
        ]
    );
    
    $this->add_control( 'dots',
        [
            'label' => esc_html__( 'Dots', 'tp-core' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'True', 'tp-core' ),
            'label_off' => esc_html__( 'False', 'tp-core' ),
            'return_value' => 'true',
            'default' => 'true',
        ]
    );
    
    $this->add_control( 'arrows',
        [
            'label' => esc_html__( 'Arrows', 'tp-core' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'True', 'tp-core' ),
            'label_off' => esc_html__( 'False', 'tp-core' ),
            'return_value' => 'true',
            'default' => 'false',
        ]
    );

    $this->add_control( 'slide_speed',
        [
            'label' => esc_html__( 'Slide Speed', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '1200',
            'pleaceholder' => esc_html__( 'Set slide speed.', 'tp-core' ),
        ]
    );
    $defaultbg = plugins_url( 'assets/images/slider-1.jpg', __DIR__ );
    
    $repeater = new Repeater();
    $repeater->add_control( 'slider_image',
        [
            'label' => esc_html__( 'Image', 'tp-core' ),
            'type' => Controls_Manager::MEDIA,
        ]
    );

    $repeater->add_control( 'slider_title',
        [
            'label' => esc_html__( 'Item Title', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Gerthesim Tend Inder Prosur',
            'pleaceholder' => esc_html__( 'Enter item title here.', 'tp-core' )
        ]
    );
    
    $repeater->add_control( 'slider_subtitle',
        [
            'label' => esc_html__( 'Item Subtitle', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Only this week. Don’t miss...',
            'pleaceholder' => esc_html__( 'Enter item subtitle here.', 'tp-core' )
        ]
    );
    $repeater->add_control( 'slider_content',
        [
            'label' => esc_html__( 'Item Content', 'tp-core' ),
            'type' => Controls_Manager::TEXTAREA,
            'label_block' => true,
            'pleaceholder' => esc_html__( 'Enter item content here.', 'tp-core' )
        ]
    );
    $repeater->add_control( 'slider_btn_title',
        [
            'label' => esc_html__( 'Button Title', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'admission now',
            'pleaceholder' => esc_html__( 'Enter button title here', 'tp-core' )
        ]
    );
    $repeater->add_control( 'slider_btn_link',
        [
            'label' => esc_html__( 'Button Link', 'tp-core' ),
            'type' => Controls_Manager::URL,
            'label_block' => true,
            'placeholder' => esc_html__( 'Place URL here', 'tp-core' )
        ]
    );
    $repeater->add_control( 'slider_btn_title_2',
        [
            'label' => esc_html__( 'Button Title 2', 'tp-core' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Our Classes',
            'pleaceholder' => esc_html__( 'Enter button title here', 'tp-core' )
        ]
    );
    $repeater->add_control( 'slider_btn_link_2',
        [
            'label' => esc_html__( 'Button Link 2', 'tp-core' ),
            'type' => Controls_Manager::URL,
            'label_block' => true,
            'placeholder' => esc_html__( 'Place URL here', 'tp-core' )
        ]
    );
    
    $this->add_control( 'slider_items',
        [
            'label' => esc_html__( 'Slide Items', 'tp-core' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'slider_image' => ['url' => $defaultbg],
                    'slider_title' => 'Kids Education',
                    'slider_subtitle' => 'A New Approach to',
                    'slider_content' => 'We provide best solutions for a Clean Environment If you need<br> any help in cleaning or maintenance.',
                ],
                [
                    'slider_image' => ['url' => $defaultbg],
                    'slider_title' => 'Child Education',
                    'slider_subtitle' => 'A New Approach to',
                    'slider_content' => 'We provide best solutions for a Clean Environment If you need<br> any help in cleaning or maintenance.',
                ],
                [
                    'slider_image' => ['url' => $defaultbg],
                    'slider_title' => 'Kids Education',
                    'slider_subtitle' => 'A New Approach to',
                    'slider_content' => 'We provide best solutions for a Clean Environment If you need<br> any help in cleaning or maintenance.',
                ]
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
        $this->add_control( 'content_heading',
            [
                'label' => esc_html__( 'CONTENT', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_responsive_control( 'home_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'title_color',
           [
               'label' => esc_html__( 'Title Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-title' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'title_size',
            [
                'label' => esc_html__( 'Title Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .tp-content-wrapper .tp-core-title' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'title_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
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
                    '{{WRAPPER}} .tp-content-wrapper .tp-core-title' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'title_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
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
                    ' {{WRAPPER}} .tp-content-wrapper .tp-core-title' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'title_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-title'
            ]
        );
        $this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'subtitle_color',
           [
               'label' => esc_html__( 'Subtitle Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-subtitle' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'subtitle_size',
            [
                'label' => esc_html__( 'Subtitle Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-content-wrapper .tp-core-subtitle' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'subtitle_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
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
                    '{{WRAPPER}} .tp-content-wrapper .tp-core-subtitle' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'subtitle_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
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
                    ' {{WRAPPER}} .tp-content-wrapper .tp-core-subtitle' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-subtitle ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-subtitle'
            ]
        );
        $this->add_control( 'slider_content_heading',
            [
                'label' => esc_html__( 'Slider Content', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'slider_content_color',
           [
               'label' => esc_html__( 'Slider Content Color', 'bacola-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-content-wrapper p ' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'slider_content_size',
            [
                'label' => esc_html__( 'Slider Content Size', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-content-wrapper p' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'slider_content_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
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
                    '{{WRAPPER}} .tp-content-wrapper p' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'slider_content_top',
            [
                'label' => esc_html__( 'Top', 'bacola-core' ),
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
                    ' {{WRAPPER}} .tp-content-wrapper p' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'slider_content_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_content_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-content-wrapper p'
            ]
        );
		$this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('btn_styling',
            [
                'label' => esc_html__( ' Button Style', 'bacola-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'title_button_style_1',
            [
                'label' => esc_html__( 'Button 1', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-btn '
            ]
        );
        
		$this->add_responsive_control( 'btn_left',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
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
                    '{{WRAPPER}}  .tp-content-wrapper .tp-core-btn' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'bacola-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-btn ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'bacola-core' ),
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-btn ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
       
		$this->add_control( 'brn_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn ' => 'opacity: {{VALUE}} ;']
            ]
        );
        $this->add_control( 'title_button_style_2',
            [
                'label' => esc_html__( 'Button 2', 'bacola-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'btn_padding_2',
            [
                'label' => esc_html__( 'Padding', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],              
            ]
        );
  	    
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo_2',
                'label' => esc_html__( 'Typography', 'bacola-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-btn-2 '
            ]
        );
        
		$this->add_responsive_control( 'btn_left_2',
            [
                'label' => esc_html__( 'Left', 'bacola-core' ),
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
                    '{{WRAPPER}}  .tp-content-wrapper .tp-core-btn-2' => 'margin-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'btn_color_2',
            [
                'label' => esc_html__( 'Color', 'bacola-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-content-wrapper .tp-core-btn-2 ' => 'color: {{VALUE}};']
            ]
        );
       
	    $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_2',
                'label' => esc_html__( 'Border', 'bacola-core' ),
                'selector' => '{{WRAPPER}} .tp-content-wrapper .tp-core-btn-2 ',
            ]
        );
        
		$this->add_responsive_control( 'btn_border_radius_2',
            [
                'label' => esc_html__( 'Border Radius', 'bacola-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn-2 ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'],
            ]
        );
		$this->add_control( 'brn_opacity_important_style_2',
            [
                'label' => esc_html__( 'Opacity', 'bacola-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .tp-content-wrapper .tp-core-btn-2 ' => 'opacity: {{VALUE}} ;']
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
    <!-- banner begin -->
    <div class="kitba-banner-area">
        <div class="slider-active swiper-container">
            <div class="swiper-wrapper">
                <?php foreach($settings['slider_items'] as $slide) :
                    $image_url = $slide['slider_image']['url'];
                    $slider_btn_title = $slide['slider_btn_title'] ? $slide['slider_btn_title']: '';
                    $slider_btn_title_2 = $slide['slider_btn_title_2'] ? $slide['slider_btn_title_2']: '';
                    if ( ! empty( $slide['slider_btn_link']['url'] ) ) {
                        $this->add_link_attributes( 'slider_btn_link', $slide['slider_btn_link'] );
                    }
                    if ( ! empty( $slide['slider_btn_link_2']['url'] ) ) {
                        $this->add_link_attributes( 'slider_btn_link_2', $slide['slider_btn_link_2'] );
                    }
                ?>
                <div class="swiper-slide bg_cover" data-enable-autoplay="<?php echo $settings['auto_play'] ? "true": "false"; ?>" data-swiper-autoplay="<?php echo esc_attr($settings['auto_speed']); ?>" data-background="<?php echo esc_url($image_url); ?>">
                    <div class="banner-2">
                        <div class="single-banner-slide kitba-slide-height">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="banner-txt tp-content-wrapper">
                                            <?php if(!empty($slide['slider_subtitle'])) : ?>
                                                <h3 class="tp-core-subtitle banner-subtitle-2 mt--9 mb-10"  data-animation="fadeInUp" data-delay=".3s"><?php echo tp_element_kses_basic($slide['slider_subtitle']); ?></h3>
                                            <?php endif; ?>
                                            <?php if(!empty($slide['slider_title'])) : ?>
                                            <h1 class="banner-title-2 tp-core-title mb-20 mt-0" data-animation="fadeInUp" data-delay=".5s"><?php echo tp_element_kses_basic($slide['slider_title']); ?></h1>
                                            <?php endif; ?>
                                            <?php if(!empty($slide['slider_content'])) : ?>
                                            <p class="banner-paragraph-2 mb-11" data-animation="fadeInUp" data-delay=".7s"><?php echo tp_element_kses_basic($slide['slider_content']); ?></p>
                                            <?php endif; ?>
                                            <div class="banner-btn btn-box sm-padd-btn pt-35">
                                                <?php if(!empty($slider_btn_title)) : ?>
                                                    <a data-animation="fadeInUp" data-delay=".8s" class="def-btn btn-2 tp-core-btn" <?php echo $this->get_render_attribute_string( 'slider_btn_link' ); ?> ><?php echo esc_html($slider_btn_title); ?></a>
                                                <?php endif; ?>
                                                <?php if(!empty($slider_btn_title_2)) : ?>
                                                    <a class="def-btn btn-3 tp-core-btn-2" data-animation="fadeInUp" data-delay=".9s" <?php echo $this->get_render_attribute_string( 'slider_btn_link_2' ); ?> ><?php echo esc_html($slider_btn_title_2); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- banner end -->
	<?php }
}
