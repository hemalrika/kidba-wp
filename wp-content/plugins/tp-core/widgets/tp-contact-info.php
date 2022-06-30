<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Core;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Contact_Info extends Widget_Base {

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
		return 'tp-demo';
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
		return __( 'TP Contact Info', 'tp-core' );
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
				'label' => esc_html__( 'Design Style', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'style-1',
				'options' => [
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style-2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
		$this->add_control(
			'adress_title',
			[
				'label' => esc_html__( 'Address Title', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'ADDRESS', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your address title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
		$this->add_control(
			'adress_info',
			[
				'label' => esc_html__( 'Address Info', 'tp-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type your address title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'phone_title',
			[
				'label' => esc_html__( 'Phone Title', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'PHONE', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your phone title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'phone_number',
			[
				'label' => esc_html__( 'Phone Number', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '+880178 56 78 90', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'phone_link',
			[
				'label' => esc_html__( 'Phone Link', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '+880178567890', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'email_title',
			[
				'label' => esc_html__( 'email Title', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'EMAIL', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your email title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'email_address',
			[
				'label' => esc_html__( 'Email Address Text', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'admin@gmail.com', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'email_link',
			[
				'label' => esc_html__( 'Email Address Link', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'admin@gmail.com', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1','style-2']
				]
			]
		);
        $this->add_control(
			'website_title',
			[
				'label' => esc_html__( 'Website Title', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'VISIT US', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-2']
				]
			]
		);
        $this->add_control(
			'website_link_text',
			[
				'label' => esc_html__( 'Website Link Text', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'www.yoursite.com', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-2']
				]
			]
		);
		$this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Website Link', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-social-link.com', 'tp-core' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'design_style' => ['style-2']
				]
			]
		);
        $this->add_control(
			'social_title',
			[
				'label' => esc_html__( 'Social Title', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'SOCIAL', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your social title here', 'tp-core' ),
				'condition' => [
					'design_style' => ['style-1']
				]
			]
		);
        $repeater = new Repeater;
		$repeater->add_control( 'field_condition',
			[
				'label' => esc_html__( 'Field Conditino', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'style-1',
				'options' => [
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style-2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
        $repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Social Icon', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'field_condition' => ['style-1']
				]
			]
		);
        $repeater->add_control(
			'social_link',
			[
				'label' => esc_html__( 'Social Icon Link', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-social-link.com', 'tp-core' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'field_condition' => ['style-1']
				]
			]
		);
        $this->add_control(
			'icon_list',
			[
				'label' => esc_html__( 'Icon List', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'default' => [
                    'social_icons' => [
                        'icofont-instagram'
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
               'selectors' => ['{{WRAPPER}} .tp-core-content .tp-core-title' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}} .tp-core-content .tp-core-title' => 'font-size: {{SIZE}}px;' ],
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
                'selectors' => ['{{WRAPPER}} .tp-core-content .tp-core-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content .tp-core-title'
            ]
        );
        $this->add_control( 'content_text_heading',
            [
                'label' => esc_html__( 'text Content', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_text_color',
           [
               'label' => esc_html__( 'content_text Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tp-core-content p, {{WRAPPER}} .tp-core-content a' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_text_size',
            [
                'label' => esc_html__( 'Content Text Color Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .tp-core-content p,{{WRAPPER}} .tp-core-content a ' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_text_left',
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
                    '{{WRAPPER}} .tp-core-content p, {{WRAPPER}} .tp-core-content a' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_text_top',
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
                    ' {{WRAPPER}} .tp-core-content p, {{WRAPPER}} .tp-core-content a' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_text_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tp-core-content p, {{WRAPPER}} .tp-core-content a ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_text_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tp-core-content p, {{WRAPPER}} .tp-core-content a'
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
        <?php
            if($settings['design_style'] == 'style-1') :
        ?>
            <div class="contact-info kitba-contact tp-core-content">
                <p class="contact-info-txt mt--6 mb-20">
                    <?php if(!empty($settings['adress_title'])) : ?>
                        <span class="contact-info-sub-txt tp-core-title fw-bold color-9"><?php echo esc_html($settings['adress_title']); ?></span>
                    <?php endif; ?>
                    <?php if(!empty($settings['adress_info'])) : ?>
                        <?php echo tp_element_kses_basic($settings['adress_info']); ?>
                    <?php endif; ?>
                </p>
                <p class="contact-info-txt mt--6 mb-20">
                    <?php if(!empty($settings['phone_title'])) : ?>
                        <span class="contact-info-sub-txt tp-core-title fw-bold color-9"><?php echo esc_html($settings['phone_title']); ?></span>
                    <?php endif; ?>
                    <?php if(!empty($settings['phone_number'])) : ?>
                    <a href="tel:<?php echo $settings['phone_link'] ? esc_url($settings['phone_link']) : ''; ?>"><?php echo esc_html($settings['phone_number']); ?></a>
                    <?php endif; ?>
                </p>
                <p class="contact-info-txt mt--6 mb-20">
                    <?php if(!empty($settings['email_title'])) : ?>
                        <span class="contact-info-sub-txt tp-core-title fw-bold color-9"><?php echo esc_html($settings['email_title']); ?></span>
                    <?php endif; ?>
                    <?php if(!empty($settings['email_address'])) : ?>
                        <a href="mailto:<?php echo $settings['email_link'] ? esc_url($settings['email_link']) : ''; ?>"><?php echo esc_html($settings['email_address']); ?></a>
                    <?php endif; ?>
                </p>
                <p class="contact-info-txt mt--6 mb--8">
                    <?php if(!empty($settings['social_title'])) : ?>
                        <span class="contact-info-sub-txt tp-core-title fw-bold color-9 tt-uppercase"><?php echo esc_html($settings['social_title']); ?></span>
                    <?php endif; ?>
                    <?php if(!empty($settings['icon_list'])) : ?>
                        <?php foreach($settings['icon_list'] as $key => $slide) : ?>
                            <a class="contact-social mr-20" href="<?php echo $slide['social_link']['url'] ? esc_url($slide['social_link']['url']) : ''; ?>">
                                <?php Icons_Manager::render_icon( $slide['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
			<?php elseif($settings['design_style'] == 'style-2') :
				if ( ! empty( $settings['website_link']['url'] ) ) {
					$this->add_link_attributes( 'website_link', $settings['website_link'] );
				}	
			?>
				<div class="contact-info-wrapper tp-core-content">
					<ul>
						<li>
							<i class="icofont-google-map"></i>
							<div class="contact-info-content">
								<?php if(!empty($settings['adress_title'])) : ?>
									<span class="contact-info-content-text tp-core-title"><?php echo esc_html($settings['adress_title']); ?></span>
								<?php endif; ?>
								<?php if(!empty($settings['adress_info'])) : ?>
									<p class="mb-0"><?php echo tp_element_kses_basic($settings['adress_info']); ?></p>
								<?php endif; ?>
							</div>
						</li>
						<li>
							<i class="icofont-phone"></i>
							<div class="contact-info-content">
								<?php if(!empty($settings['phone_title'])) : ?>
									<span class="contact-info-content-text tp-core-title tp-core-title"><?php echo esc_html($settings['phone_title']); ?></span>
								<?php endif; ?>
								<?php if(!empty($settings['phone_number'])) : ?>
									<a href="tel:<?php echo $settings['phone_link'] ? esc_url($settings['phone_link']) : ''; ?>"><?php echo esc_html($settings['phone_number']); ?></a>
								<?php endif; ?>
							</div>
							
						</li>
						<li>
							<i class="icofont-envelope-open"></i>
							<div class="contact-info-content">
								<?php if(!empty($settings['email_address'])) : ?>
									<span class="contact-info-content-text tp-core-title"><?php echo esc_html($settings['email_title']); ?></span>
								<?php endif; ?>
								<?php if(!empty($settings['email_address'])) : ?>
									<a href="mailto:<?php echo $settings['email_link'] ? esc_url($settings['email_link']) : ''; ?>"><?php echo esc_html($settings['email_address']); ?></a>
								<?php endif; ?>
							</div>
							
						</li>
						<li>
							<i class="icofont-globe"></i>
							<div class="contact-info-content">
								<?php if(!empty($settings['website_title'])) : ?>
									<span class="contact-info-content-text tp-core-title"><?php echo esc_html($settings['website_title']); ?></span>
								<?php endif; ?>
								<?php if(!empty($settings['website_link_text'])) : ?>
									<a <?php echo $this->get_render_attribute_string( 'website_link' ); ?>><?php echo esc_html($settings['website_link_text']); ?></a>
								<?php endif; ?>
							</div>
						</li>
					</ul>
				</div>
        <?php endif; ?>
	<?php }
}
