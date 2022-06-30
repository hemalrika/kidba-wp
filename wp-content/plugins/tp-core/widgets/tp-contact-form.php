<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
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
class TP_Contact_Form extends Widget_Base {

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
		return 'tp-contact-form';
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
		return __( 'TP Contact Form', 'tp-core' );
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
		return 'eicon-form-horizontal';
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
				'default' => 'style-1',
				'options' => [
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style-2'	  => esc_html__( 'Style 2', 'tp-core' ),
				]
			]
		);
        $this->add_control(
			'contact_title',
			[
				'label' => esc_html__( 'Contact Title', 'tp-core' ),
				'type' =>Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact Us', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'tp-core' ),
                'condition' => [
                    'design_style' => ['style-1', 'style-2']
                ]
			]
		);
        $this->add_control(
			'contact_info',
			[
				'label' => esc_html__( 'Contact Info', 'tp-core' ),
				'type' =>Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Contact Info', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your info here', 'tp-core' ),
                'condition' => [
                    'design_style' => ['style-1', 'style-2']
                ]
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            '_section_cf7',
            [
                'label' => tp_core_is_cf7_activated() ? __('Contact Form 7', 'tp-core') : __('Missing Notice', 'tp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        if (!tp_core_is_cf7_activated()) {
            $this->add_control(
                '_cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __('Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'tp-core'),
                        '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term'))
                        . '" target="_blank" rel="noopener">Contact Form 7</a>',
                        tp_core_get_current_user_display_name()
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->add_control(
                '_cf7_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term')) . '" target="_blank" rel="noopener">Click to install or activate Contact Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
        }
        $this->add_control(
            'form_id',
            [
                'label' => __('Select Your Form', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => __('', 'tp-core')] + \tp_core_get_cf7_forms(),
            ]
        );
        $this->add_control(
            'html_class',
            [
                'label' => __('HTML Class', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __('Add CSS custom class to the form.', 'tp-core'),
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
                    '{{WRAPPER}} .tp-core-content .tp-core-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tp-core-content .tp-core-title' => 'font-size: {{SIZE}}px;',
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
                    '{{WRAPPER}} .tp-core-content .tp-core-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .tp-core-content .tp-core-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .tp-core-content .tp-core-title' => 'opacity: {{VALUE}} ;',
                ]
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content .tp-core-title'
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
                    '{{WRAPPER}} .tp-core-content p' => 'color: {{VALUE}};'
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
                'selectors' => [ '{{WRAPPER}} .tp-core-content p' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .tp-core-content p' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .tp-core-content p' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .tp-core-content p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_about_typo',
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
        <?php if($settings['design_style'] == 'style-1') : ?>
        <div class="contact-wrapp tp-core-content">
            <div class="section-heading mb-50">
                <?php if(!empty($settings['contact_title'])) : ?>
                    <h2 class="tp-core-title section-title mt--9 mb-25"><?php echo tp_element_kses_basic($settings['contact_title']); ?></h2>
                <?php endif; ?>
                <?php if(!empty($settings['contact_info'])) : ?>
                    <p class="heading-sub-txt mt--1 mb--8"><?php echo tp_element_kses_basic($settings['contact_info']); ?></p>
                <?php endif; ?>
            </div>
            <div class="tp-contact-form style-1">
                <?php
                    if (!empty($settings['form_id'])) {
                        echo tp_core_do_shortcode('contact-form-7', [
                            'id' => $settings['form_id'],
                            'html_class' => 'tp-cf7-form ' . tp_core_sanitize_html_class_param($settings['html_class']),
                        ]);
                    }
                ?>
            </div>
        </div>
        <?php elseif($settings['design_style'] == 'style-2') : ?>
            <div class="contact-form-wrapper tp-core-content">
                <?php if(!empty($settings['contact_info'])) : ?>
                    <span class="contact-subtext"><?php echo tp_element_kses_basic($settings['contact_info']); ?></span>
                <?php endif; ?>
                <?php if(!empty($settings['contact_title'])) : ?>
                    <h4 class="contact-titletext tp-core-title mb-40"><?php echo tp_element_kses_basic($settings['contact_title']); ?></h4>
                <?php endif; ?>
                <div class="tp-contact-form style-2">
                    <?php
                        if (!empty($settings['form_id'])) {
                            echo tp_core_do_shortcode('contact-form-7', [
                                'id' => $settings['form_id'],
                                'html_class' => 'tp-cf7-form ' . tp_core_sanitize_html_class_param($settings['html_class']),
                            ]);
                        }
                    ?>
                </div>
            </div>
        <?php endif; ?>
	<?php }
}
