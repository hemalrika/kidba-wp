<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial extends Widget_Base {

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
		return 'tp-testimonial';
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
		return __( 'TP Testimonial', 'tp-core' );
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
		return 'eicon-post-list';
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
				'label' => esc_html__( 'Slider Style', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Design Style', 'tp-core' ),
					'type1'	  => esc_html__( 'Style 1', 'tp-core' ),
				],
			]
		);
		
        $repeater = new Repeater;
        $repeater->add_control( 'field_condition',
			[
				'label' => esc_html__( 'Field Condition', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
                'label_block' => true,
				'default' => 'style-1',
				'options' => [
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
				],
			]
		);
        $repeater->add_control(
			'testimonial_label',
			[
				'label' => esc_html__( 'Testimonial Label', 'plugin-name' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'Client Says?', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type testimonial label here', 'plugin-name' ),
                'condition' => [
                    'field_condition' => ['style-1']
                ]
			]
		);
        $repeater->add_control(
			'testimonial_details',
			[
				'label' => esc_html__( 'Testimonial Details', 'plugin-name' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
				'default' => esc_html__( '“Praesent scelerisque, odio eu ermentum malesuada, nisi arcu volutpat nisl, sit met convallis nunc turpis eget volutpat. Suspendisse potenti.”', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type testimonial details here', 'plugin-name' ),
                'condition' => [
                    'field_condition' => ['style-1']
                ]
			]
		);
        $repeater->add_control(
			'testimonial_author_name',
			[
				'label' => esc_html__( 'Author Name', 'plugin-name' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'Amelia', 'plugin-name' ),
				'placeholder' => esc_html__( 'Type testimonial author name here', 'plugin-name' ),
                'condition' => [
                    'field_condition' => ['style-1']
                ]
			]
		);
        $repeater->add_control(
			'testimonial_author_image',
			[
				'label' => esc_html__( 'Author Image', 'plugin-name' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'field_condition' => ['style-1']
                ]
			]
		);
        $this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Testimonial List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'plugin-name' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'plugin-name' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
					],
				],
				'title_field' => '{{{ testimonial_label }}}',
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
                    '{{WRAPPER}} .feedback-title-area .feedback-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .feedback-title-area .feedback-title' => 'font-size: {{SIZE}}px;',
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
                    '{{WRAPPER}} .feedback-title-area .feedback-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .feedback-title-area .feedback-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .feedback-title-area .feedback-title' => 'opacity: {{VALUE}} ;',
                ]
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .feedback-title-area .feedback-title'
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
               'label' => esc_html__( 'About Content Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .single-feedback .feedback-txt' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_about_size',
            [
                'label' => esc_html__( 'About Content Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .single-feedback .feedback-txt' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .single-feedback .feedback-txt' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .single-feedback .feedback-txt' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .single-feedback .feedback-txt ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_about_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .single-feedback .feedback-txt'
            ]
        );
		$this->add_control( 'content_author_heading',
            [
                'label' => esc_html__( 'Author Name', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_author_color',
           [
               'label' => esc_html__( 'Author Name Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .single-feedback .client-name' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_author_size',
            [
                'label' => esc_html__( 'Author Name Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .single-feedback .client-name' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_author_left',
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
                    '{{WRAPPER}} .single-feedback .client-name' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_author_top',
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
                    ' {{WRAPPER}} .single-feedback .client-name' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_author_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .single-feedback .client-name ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_author_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .single-feedback .client-name'
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
        <!-- testimonial begin -->
        <div class="testimonial">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="clients">
                            <?php foreach($settings['slides'] as $key => $slide) :
                                $this->add_render_attribute( 'testimonial_author_image', 'src', $slide['testimonial_author_image']['url'] );
                                $this->add_render_attribute( 'testimonial_author_image', 'alt', \Elementor\Control_Media::get_image_alt( $slide['testimonial_author_image'] ) );
                                $this->add_render_attribute( 'testimonial_author_image', 'title', \Elementor\Control_Media::get_image_title( $slide['testimonial_author_image'] ) );
                                $this->add_render_attribute( 'testimonial_author_image', 'class', 'my-custom-class' );    
                            ?>
                                <div class="single-client">
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'testimonial_author_image' ); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-6">
                        <div class="client-feedback pr-70 pl-30">
                            <?php foreach($settings['slides'] as $slide) : ?>
                            <div class="single-feedback">
                                <div class="feedback-title-area">
                                    <div class="quote-icon mb-30">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/quote.png" alt="“">
                                    </div>
                                    <?php if(!empty($slide['testimonial_label'])) : ?>
                                        <h2 class="feedback-title mt--3 mb-17"><?php echo esc_html($slide['testimonial_label']); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($slide['testimonial_details'])) : ?>
                                    <p class="feedback-txt mb-25"><?php echo tp_element_kses_basic($slide['testimonial_details']); ?></p>
                                <?php endif; ?>
                                <?php if(!empty($slide['testimonial_details'])) : ?>
                                    <div  class="divider bg-white rounded-pill mb-20"></div>
                                    <h4 class="client-name mt--2 mb--2"><?php echo esc_html($slide['testimonial_author_name']); ?></h4>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial end -->
	<?php }
}
