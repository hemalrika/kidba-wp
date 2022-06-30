<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Banner_Box extends Widget_Base {

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
		return 'tp-banner-box';
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
		return __( 'TP Banner Box', 'tp-core' );
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
		return 'eicon-banner';
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
					'select-type' => esc_html__( 'Select Style', 'tp-core' ),
					'style1'	  => esc_html__( 'Style 1', 'tp-core' )
				],
			]
		);
		$this->add_control(
			'banner_img',
			[
				'label' => esc_html__( 'Banner Image', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'design_style' => ['style1']
                ]
			]
		);
        $this->add_control(
			'banner_icon',
			[
				'label' => esc_html__( 'Banner Icon', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition' => [
                    'design_style' => ['style1']
                ]
			]
		);
        $this->add_control(
			'banner_link',
			[
				'label' => esc_html__( 'BannerLink', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
                'condition' => [
                    'design_style' => ['style1']
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
        $this->add_control( 'content_icon_box_heading',
            [
                'label' => esc_html__( 'Icon Box', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
        $this->add_control( 'content_icon_box_bg_color',
           [
               'label' => esc_html__( 'Icon Box Background', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .feature-img .bg-gradient-1' => 'background: {{VALUE}};']
           ]
        );
        $this->add_responsive_control( 'content_icon_box_height',
            [
                'label' => esc_html__( 'Height', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-img.p-relative a.video-btn' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
        $this->add_responsive_control( 'content_icon_box_width',
            [
                'label' => esc_html__( 'Width', 'tp-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .feature-img.p-relative a.video-btn' => 'width: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		$this->add_control( 'content_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_icon_color',
           [
               'label' => esc_html__( 'Icon Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .feature-img.p-relative a.video-btn i' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .feature-img.p-relative a.video-btn i' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_icon_left',
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
                    '{{WRAPPER}} .feature-img.p-relative a.video-btn i' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_icon_top',
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
                    ' {{WRAPPER}} .feature-img.p-relative a.video-btn i' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_icon_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .feature-img.p-relative a.video-btn i ' => 'opacity: {{VALUE}} ;']
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
        <div class="feature-img p-relative">
            <?php if(!empty($settings['banner_img']['url'])) : ?>
                <img src="<?php echo esc_url($settings['banner_img']['url']); ?>" alt="<?php echo esc_attr__('Banner Image', 'tp-core'); ?>">
            <?php endif; ?>
            <?php if(!empty($settings['banner_icon']['value'])) : ?>
                <a href="<?php echo $settings['banner_link']['url'] ? $settings['banner_link']['url']: ''; ?>" class="video-btn bg-gradient-1 p-absolute bottom-0 right-0 text-center text-white tp-banner-icon-link">
                    <?php Icons_Manager::render_icon( $settings['banner_icon'], ['aria-hidden' => 'true', 'class' => 'tp-banner-icon'] ); ?>
                </a>
            <?php endif; ?>
        </div>
	<?php }
}
