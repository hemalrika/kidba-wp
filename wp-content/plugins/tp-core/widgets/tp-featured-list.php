<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Featured_List extends Widget_Base {

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
		return 'tp-featured-list';
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
		return __( 'TP Featured List', 'tp-core' );
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
		$repeater = new Repeater();
		$repeater->add_control( 'field_condition',
			[
				'label' => esc_html__( 'Field Condition', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'style1',
				'options' => [
					'select-type' => esc_html__( 'Select Style', 'tp-core' ),
					'style1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style2'	  => esc_html__( 'Style 2', 'tp-core' )
				],
			]
		);
		$repeater->start_controls_tabs(
			'choose_featured_icon_img'
		);
		$repeater->start_controls_tab(
			'featured_image_tab',
			[
				'label' => esc_html__( 'Image', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
			]
		);
		$repeater->add_control(
			'featured_image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'featured_icon_tab',
			[
				'label' => esc_html__( 'Icon', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
			]
		);
		$repeater->add_control(
			'featured_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control( 'featured_title',
            [
                'label' => esc_html__( 'Featured Title', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Active Learning',
                'pleaceholder' => esc_html__( 'Enter featured title here.', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
            ]
        );
		$repeater->add_control( 'featured_title_link',
            [
                'label' => esc_html__( 'Featured Title Link', 'tp-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
                'pleaceholder' => esc_html__( 'Enter featured title Link here.', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
            ]
        );
		$repeater->add_control( 'featured_content',
            [
                'label' => esc_html__( 'Featured Content', 'tp-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Since have been visonary relable sofware engnern partne.',
                'pleaceholder' => esc_html__( 'Enter featured content here.', 'tp-core' ),
				'condition' => [
					'field_condition' => ['style1', 'style2']
				]
            ]
        );
		$this->add_control( 'feature_list',
            [
                'label' => esc_html__( 'Featured List', 'bacola-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
				'default' => [
						[
							'featured_image' => ['url' => plugins_url( 'assets/images/icons/feat-icon-1.png', __DIR__ )],
							'featured_title' => 'Active Learning',
							'featured_content' => 'Since have been visonary relable sofware engnern partne.'
						],
						[
							'featured_image' => ['url' =>  plugins_url( 'assets/images/icons/feat-icon-2.png', __DIR__ )],
							'featured_title' => 'Parents Day',
							'featured_content' => 'Since have been visonary relable sofware engnern partne.'
						],
						[
							'featured_image' => ['url' =>  plugins_url( 'assets/images/icons/feat-icon-3.png', __DIR__ )],
							'featured_title' => 'Expert Teachers',
							'featured_content' => 'Since have been visonary relable sofware engnern partne.'
						],
						[
							'featured_image' => ['url' =>  plugins_url( 'assets/images/icons/feat-icon-4.png', __DIR__ )],
							'featured_title' => 'Music Lessons',
							'featured_content' => 'Since have been visonary relable sofware engnern partne.'
						],
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
		$this->add_responsive_control( 'content_icon_img_space',
            [
                'label' => esc_html__( 'Icon / Image Right Space', 'tp-core' ),
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
                    '{{WRAPPER}} .feature-part-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                ]
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
               'selectors' => ['{{WRAPPER}} .feature-txt .feature-sub-title' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}} .feature-txt .feature-sub-title' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .feature-txt .feature-sub-title' => 'padding-left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .feature-txt .divider' => 'margin-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .feature-txt .feature-sub-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .feature-txt .feature-sub-title ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .feature-txt .feature-sub-title'
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
               'selectors' => ['{{WRAPPER}} .feature-txt p' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}}  .feature-txt p' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .feature-txt p' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .feature-txt p' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .feature-txt p ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_hero_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .feature-txt p'
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
               'selectors' => ['{{WRAPPER}} .feature-part-icon i' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}}  .feature-part-icon i' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .feature-part-icon i' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .feature-part-icon i' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .feature-part-icon i ' => 'opacity: {{VALUE}} ;']
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
        <?php if($settings['design_style'] == 'style-1') : 
            if(empty($settings['feature_list'])) {
                return;
            }    
        ?>
        <?php if(!empty($settings['feature_list'])) : ?>
		<div class="row r-gap-40 has-gradient-service mb-30 mb-lg-0">
			<?php foreach($settings['feature_list'] as $feature) : 
					$featured_image_url = $feature['featured_image']['url'];
					$featured_image_icon = $feature['featured_icon']['value'];
					$featured_title = $feature['featured_title'];
					$featured_content = $feature['featured_content'];
					$featured_title_link = $feature['featured_title_link']['url'];
				?>
				<div class="col-xl-6 col-md-6">
					<div class="feature-box d-flex">
						<?php if(!empty($featured_image_url || $featured_image_icon)) : ?>
						<div class="feature-part-icon mr-30">
							<?php if(!empty($featured_image_url)) : ?>
								<img src="<?php echo esc_url($featured_image_url); ?>" class="filter-shadow-1" alt="<?php echo esc_attr__('Image', 'tp-core'); ?>">
							<?php elseif(!empty($featured_image_icon)) : ?>
								<?php Icons_Manager::render_icon( $feature['featured_icon'], ['aria-hidden' => 'true', 'class' => 'tp-core-icon'] ); ?>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="feature-txt">
							<?php if(!empty($featured_title)) : ?>
								<h3 class="feature-sub-title mt--7 mb--8"><a href="<?php echo $featured_title_link ? $featured_title_link: ''; ?>"><?php echo esc_html($featured_title); ?></a></h3>
								<div class="divider mt-10 mb-20 bg-gradient-1 rounded-pill"></div>
							<?php endif; ?>
							<?php if(!empty($featured_content)) : ?>
								<p class="mt--6 mb--8"><?php echo esc_html($featured_content); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
        <?php endif; ?>
        <?php elseif($settings['design_style'] == 'style-2') : ?>
            <?php if(!empty($settings['feature_list'])) : ?>
                <div class="kidba-features-wrapper">
                    <?php foreach($settings['feature_list'] as $feature) :
                        $featured_image_url = $feature['featured_image']['url'];
                        $featured_image_icon = $feature['featured_icon']['value'];
                        $featured_title = $feature['featured_title'];
                        $featured_title_link = $feature['featured_title_link']['url'];
                        $featured_content = $feature['featured_content'];
                    ?>
                    <div class="feature-box d-flex mb-40">
                        <?php if(!empty($featured_image_url || $featured_image_icon)) : ?>
                            <div class="feature-part-icon mr-30">
                                <?php if(!empty($featured_image_url)) : ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $feature, 'full', 'featured_image' ); ?>
                                <?php elseif(!empty($featured_image_icon)) : ?>
                                    <?php Icons_Manager::render_icon( $feature['featured_icon'], ['aria-hidden' => 'true', 'class' => 'tp-core-icon'] ); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="feature-txt">
                            <?php if(!empty($featured_title)) : ?>
                                <h3 class="feature-sub-title prnt-clr mt--7 mb--8"><a href="<?php echo $featured_title_link ? $featured_title_link: ''; ?>"><?php echo esc_html($featured_title); ?></a></h3>
                            <?php endif; ?>
                            <?php if(!empty($featured_content)) : ?>
                                <div class="divider bg-gradient-2 rounded-pill rounded-pill-space"></div>
								<p class="mt--6 mb--8"><?php echo tp_element_kses_basic($featured_content); ?></p>
							<?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
	<?php }
}
