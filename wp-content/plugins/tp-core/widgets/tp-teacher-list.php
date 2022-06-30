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
class TP_Teacher_List extends Widget_Base {
    
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
		return 'tp-teacher-list';
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
		return __( 'TP Teacher List', 'tp-core' );
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
		return 'eicon-user-circle-o';
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
					'style1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
        
		$this->end_controls_section();
		// member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Members List', 'tp-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tp-core' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tp-core' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tp-core' ),
                'default' => __( 'TPCore Member Title', 'tp-core' ),
                'placeholder' => __( 'Type title here', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tp-core' ),
                'default' => __( 'TPCore Officer', 'tp-core' ),
                'placeholder' => __( 'Type designation here', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'tp-core' ),
                'default' => __( '#', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tp-core' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tp-core' ),
                'label_off' => __( 'No', 'tp-core' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tp-core' ),
                'placeholder' => __( 'Add your profile link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tp-core' ),
                'placeholder' => __( 'Add your email link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tp-core' ),
                'placeholder' => __( 'Add your phone link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tp-core' ),
                'default' => __( '#', 'tp-core' ),
                'placeholder' => __( 'Add your facebook link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tp-core' ),
                'default' => __( '#', 'tp-core' ),
                'placeholder' => __( 'Add your twitter link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tp-core' ),
                'default' => __( '#', 'tp-core' ),
                'placeholder' => __( 'Add your instagram link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tp-core' ),
                'placeholder' => __( 'Add your linkedin link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tp-core' ),
                'placeholder' => __( 'Add your youtube link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tp-core' ),
                'placeholder' => __( 'Add your Google Plus link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tp-core' ),
                'placeholder' => __( 'Add your flickr link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tp-core' ),
                'placeholder' => __( 'Add your vimeo link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tp-core' ),
                'placeholder' => __( 'Add your hehance link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tp-core' ),
                'placeholder' => __( 'Add your dribbble link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tp-core' ),
                'placeholder' => __( 'Add your pinterest link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tp-core' ),
                'placeholder' => __( 'Add your github link', 'tp-core' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tp-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tp-core' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tp-core' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tp-core' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tp-core' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tp-core' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tp-core' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h5',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tp-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tp-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tp-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tp-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-title' => 'text-align: {{VALUE}};'
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
               'selectors' => ['{{WRAPPER}} .tpcore-el-title' => 'color: {{VALUE}};']
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
                'selectors' => [ '{{WRAPPER}} .tpcore-el-title' => 'font-size: {{SIZE}}px;' ],
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
                    '{{WRAPPER}} .tpcore-el-title' => 'padding-left: {{SIZE}}{{UNIT}}',
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
                    ' {{WRAPPER}} .tpcore-el-title' => 'padding-top: {{SIZE}}{{UNIT}}',
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
                'selectors' => ['{{WRAPPER}} .tpcore-el-title' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tpcore-el-title'
            ]
        );
		$this->add_control( 'content_subtitle_heading',
            [
                'label' => esc_html__( 'subtitle Content', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_subtitle_color',
           [
               'label' => esc_html__( 'content_subtitle Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .staff-position' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_subtitle_size',
            [
                'label' => esc_html__( 'content_subtitle Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}  .staff-position' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_subtitle_left',
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
                    '{{WRAPPER}} .staff-position' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_subtitle_top',
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
                    ' {{WRAPPER}} .staff-position' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_subtitle_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .staff-position ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_subtitle_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .staff-position'
            ]
        );
		$this->add_control( 'content_subtitle_list_heading',
            [
                'label' => esc_html__( 'subtitle List', 'tp-core' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		
		$this->add_control( 'content_subtitle_list_color',
           [
               'label' => esc_html__( 'content_subtitle_list Color', 'tp-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}}  .staff-position' => 'color: {{VALUE}};']
           ]
        );
		
		$this->add_control( 'content_subtitle_list_size',
            [
                'label' => esc_html__( 'content_subtitle_list Size', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}   .staff-position' => 'font-size: {{SIZE}}px;' ],
            ]
        );
		
		$this->add_responsive_control( 'content_subtitle_list_left',
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
                    '{{WRAPPER}}  .staff-position' => 'padding-left: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_responsive_control( 'content_subtitle_list_top',
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
                    ' {{WRAPPER}}  .staff-position' => 'padding-top: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
		
		$this->add_control( 'content_subtitle_list_opacity_important_style',
            [
                'label' => esc_html__( 'Opacity', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => '',
                'selectors' => ['{{WRAPPER}}  .staff-position ' => 'opacity: {{VALUE}} ;']
            ]
        );
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_subtitle_list_typo',
                'label' => esc_html__( 'Typography', 'tp-core' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}}  .staff-position'
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
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'title', 'class', 'staff-name tpcore-el-title' );
        ?>
		<?php if(!empty($settings['slides'])) : ?>
		<div class="container">
			<div class="row justify-content-center">
				<?php foreach ( $settings['slides'] as $slide ) :
					$title = tp_element_kses_basic( $slide['title' ] );
					$slide_url = esc_url($slide['slide_url']);

					$image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
					if ( ! $image ) {
						$image = $slide['image']['url'];
					}            
				?>
					<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
						<div class="staff-card mb-40">
							<div class="staff-card-img w_100 mb-25">
								<a href="<?php echo esc_url( $slide_url ); ?>"><img src="<?php print esc_url($image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>"></a>
								<div class="kb-staff-card-social-share-1-1">
                                    <?php if( !empty($slide['show_social'] ) ) : ?>
                                    <div class="kb-staff-card-social-share-1-1">
                                    <a href="#0" class="staff-social-btn bg-3"><i class="icofont-plus"></i></a>
                                    <?php if( !empty($slide['web_title'] ) ) : ?>
                                    <a class="staff-social-btn  bg-1" href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="icofont-globe"></i></a>
                                    <?php endif; ?>  

                                    <?php if( !empty($slide['email_title'] ) ) : ?>
                                    <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="icofont-envelope"></i></a>
                                    <?php endif; ?>  

                                    <?php if( !empty($slide['phone_title'] ) ) : ?>
                                    <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="icofont-phone"></i></a>
                                    <?php endif; ?>  

                                    <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                    <a class="staff-social-btn" href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="icofont-facebook"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-1" href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="icofont-twitter"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-3" href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="icofont-instagram"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                    <a class="staff-social-btn" href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="icofont-linkedin"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-1" href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="icofont-brand-youtube"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-2" href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="icofont-google-plus"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                    <a class="staff-social-btn" href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="icofont-frank-minus"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-3" href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="icofont-vimeo"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['behance_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-2" href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="icofont-behance"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-3" href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="icofont-dribbble"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-1" href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="icofont-pinterest"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                    <a class="staff-social-btn bg-2" href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="icofont-github"></i></a>
                                    <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
							</div>
							<div class="part-txt d-flex align-items-center justify-content-center">
								<div class="text-center">
								<?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
									tag_escape( $settings['title_tag'] ),
									$this->get_render_attribute_string( 'title' ),
									$title,
									$slide_url
								); ?>
								<?php if( !empty($slide['designation']) ) : ?>
									<p class="staff-position mb-0"><?php echo tp_element_kses_basic( $slide['designation'] ); ?></p>
								<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	<?php }
}
