<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Heading extends Widget_Base {

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
		return 'tp-heading';
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
		return __( 'TP Heading', 'tp-core' );
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
		return 'eicon-heading';
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
				'type' => Controls_Manager::SELECT2,
				'default' => 'style1',
				'options' => [
					'style1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevselement'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevselement'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevselement'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'Title Heading', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Heading',
                'pleaceholder' => esc_html__( 'Enter Title Heading here.', 'tp-core' ),
                'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
        $this->add_control( 'subtitle_text',
            [
                'label' => esc_html__( 'Subtitle Text', 'tp-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Subtitle',
                'pleaceholder' => esc_html__( 'Enter Subtitle Text here.', 'tp-core' ),
                'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
        $this->add_control( 'description',
            [
                'label' => esc_html__( 'Description Text', 'tp-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter Description Text here.', 'tp-core' ),
                'condition' => [
                    'design_style' => ['style2']
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

		$this->add_control( 'title_heading_label',
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
               'selectors' => ['{{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .section-heading .section-title, {{WRAPPER}} .tp-core-content .tp-core-title'
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
               'selectors' => ['{{WRAPPER}} .section-heading .heading-sub-txt, {{WRAPPER}} .tp-core-content .tp-core-subtitle' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}}  .section-heading .heading-sub-txt,{{WRAPPER}} .tp-core-content .tp-core-subtitle' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .section-heading .heading-sub-txt, {{WRAPPER}} .tp-core-content .tp-core-subtitle' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .section-heading .heading-sub-txt, {{WRAPPER}} .tp-core-content .tp-core-subtitle' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .section-heading .heading-sub-txt, {{WRAPPER}} .tp-core-content .tp-core-subtitle ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .section-heading .heading-sub-txt, {{WRAPPER}} .tp-core-content .tp-core-subtitle'
            ]
        );
        $this->add_control( 'content_heading',
            [
                'label' => esc_html__( 'Content', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_color',
           [
               'label' => esc_html__( 'Subtitle Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-core-content p' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_size',
            [
                'label' => esc_html__( 'Content Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .tp-core-content p' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_left',
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
                    '{{WRAPPER}} .tp-core-content p' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_top',
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
                    ' {{WRAPPER}} .tp-core-content p' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-content p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content p'
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
            <div class="section-heading">
                <?php if(!empty($settings['title_heading'])) : ?>
                    <h2 class="section-title mt--8 mb-25"><?php echo esc_html($settings['title_heading']); ?></h2>
                <?php endif; ?>
                <?php if(!empty($settings['subtitle_text'])) : ?>
                    <p class="heading-sub-txt mt--1 mb--8"><?php echo tp_element_kses_basic($settings['subtitle_text']); ?></p>
                <?php endif; ?>
            </div>
        <?php elseif($settings['design_style'] == 'style2') : ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="feature-txt-area tp-core-content text-center">
                            <h2 class="feature-title mt--16 mb-50">
                                <?php if(!empty($settings['title_heading'])) : ?>
                                    <span class="tp-core-title"><?php echo esc_html($settings['title_heading']); ?></span>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle_text'])) : ?>
                                    <span class="feature-sub-title-2 d-block mt-1 tp-core-subtitle"><?php echo esc_html($settings['subtitle_text']); ?></span></h2>
                                <?php endif; ?>
                                <?php if(!empty($settings['description'])) : ?>
                                    <p class="mb--8"><?php echo tp_element_kses_basic($settings['description']); ?></p>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	<?php }
}
