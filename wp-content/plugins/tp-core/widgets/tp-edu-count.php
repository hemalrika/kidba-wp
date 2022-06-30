<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Edu_Count extends Widget_Base {

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
		return 'tp-edu-count';
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
		return __( 'TP Edu Count', 'tp-core' );
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
		return 'eicon-counter';
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
					'select-type' => esc_html__( 'Select Style', 'tp-core' ),
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style-2'	  => esc_html__( 'Style 2', 'tp-core' ),
					'style-3'	  => esc_html__( 'Style 3', 'tp-core' ),
				],
			]
		);
		
        $repeater = new \Elementor\Repeater();
		$repeater->add_control('field_condition', [
			'label' => esc_html__('Field Condition', 'tp-core'),
			'default' => 'style-1',
			'type' => \Elementor\Controls_Manager::SELECT2,
			'options' => [
				'style-1' => __('style 1', 'tp-core'),
				'style-2' => __('style 2', 'tp-core'),
				'style-3' => __('style 3', 'tp-core'),
			]
		]);
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'field_condition' => ['style-1', 'style-2', 'style-3']
				]
			]
		);
        $repeater->add_control(
			'count_number', [
				'label' => esc_html__( 'Count Number', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '3,500' , 'tp-core' ),
				'label_block' => true,
				'condition' => [
					'field_condition' => ['style-1', 'style-2', 'style-3']
				]
			]
		);
        $repeater->add_control(
			'count_title', [
				'label' => esc_html__( 'Count Title', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Students Enrolled' , 'tp-core' ),
				'label_block' => true,
				'condition' => [
					'field_condition' => ['style-1', 'style-2', 'style-3']
				]
			]
		);
		$repeater->add_control(
			'count_bg_color',
			[
				'label' => esc_html__( 'Count BG Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}}',
				],
				'condition' => [
					'field_condition' => ['style-2']
				]
			]
		);
		$repeater->add_control(
			'count_title_color',
			[
				'label' => esc_html__( 'Count Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-core-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'field_condition' => ['style-2', 'style-3']
				]
			]
		);
		$repeater->add_control(
			'count_number_color',
			[
				'label' => esc_html__( 'Count Number Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-core-number' => 'color: {{VALUE}}',
				],
				'condition' => [
					'field_condition' => ['style-2', 'style-3']
				]
			]
		);
        $this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Count List', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'count_number' => esc_html__( '3,500', 'tp-core' ),
						'count_title' => esc_html__( 'Students Enrolled', 'tp-core' ),
					],
					[
						'count_number' => esc_html__( '912', 'tp-core' ),
						'count_title' => esc_html__( 'Best Awards Won', 'tp-core' ),
					],
					[
						'count_number' => esc_html__( '370', 'tp-core' ),
						'count_title' => esc_html__( 'Classes Completed', 'tp-core' ),
                    ],
					[
						'count_number' => esc_html__( '648', 'tp-core' ),
						'count_title' => esc_html__( 'Our Total Courses', 'tp-core' ),
					]
				],
				'title_field' => '{{{ count_title }}}',
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
        <div class="container">
            <?php if(!empty($settings['slides'])) : ?>
            <div class="row">
				<?php foreach($settings['slides'] as $key => $slide) : 
					$image_url = $slide['image']['url'];
					$box_class = $key % 2 == 0 ? '' : 'pt-120';
				?>
                <div class="col-xl-3 col-md-3 col-6">
                    <div class="counter-box d-flex flex-column align-items-center <?php echo esc_attr($box_class); ?>">
						<?php if(!empty($image_url)) : ?>
                        <div class="counter-img mb--60">
                            <img src="<?php echo esc_url($image_url); ?>" class="filter-shadow-1" alt="<?php echo esc_attr__('Icon', 'tp-core'); ?>">
                        </div>
						<?php endif; ?>
                        <div class="counter-part-txt text-center p-relative">
							<?php if(!empty($slide['count_number'])) : ?>
								<h2 class="counter-txt odometer mb-20" data-count="<?php echo esc_attr($slide['count_number']); ?>"><?php echo esc_html($slide['count_number']); ?></h2>
							<?php endif; ?>
							<?php if(!empty($slide['count_title'])) : ?>
								<p class="counter-sub-txt mt--1 mb--8"><?php echo esc_html($slide['count_title']); ?></p>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
				<?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
		<?php elseif($settings['design_style'] == 'style-2') : ?>
			<!-- counter begin -->
			<div class="counter-2-area">
				<div class="container">
					<?php if(!empty($settings['slides'])) : ?>
					<div class="row justify-content-center">
						<?php foreach($settings['slides'] as $key => $slide) : 
						$image_url = $slide['image']['url'];
						$box_class = $key % 2 == 0 ? '' : ' mt-120';
						$key+=1;
						$gradient_class = "bg-gradient-".$key."";
					?>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
							<div class="counter-box-2 tp-core-content elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?> mb-40 <?php echo esc_attr($gradient_class); ?> <?php echo esc_attr($box_class); ?> h-0 p-50p d-flex flex-column justify-content-center align-items-center">
								<?php if(!empty($image_url)) : ?>
								<div class="counter-icon mb-25">
									<img src="<?php echo esc_url($image_url); ?>" class="filter-shadow-1" alt="<?php echo esc_attr__('Icon', 'tp-core'); ?>">
								</div>
								<?php endif; ?>
								<div class="counter-part-txt text-center p-relative">
									<?php if(!empty($slide['count_number'])) : ?>
										<h2 class="tp-core-number counter-txt odometer mb-10" data-count="<?php echo esc_attr($slide['count_number']); ?>"><?php echo esc_html__('0', 'tp-core'); ?></h2>
									<?php endif; ?>
									<?php if(!empty($slide['count_title'])) : ?>
										<p class="tp-core-title counter-sub-txt mb-0"><?php echo tp_element_kses_basic($slide['count_title']); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- counter end -->
			<?php elseif($settings['design_style'] == 'style-3') : ?>
				<div class="counter-inner">
					<?php if(!empty($settings['slides'])) : ?>
						<div class="container">
							<div class="row">
							<?php foreach($settings['slides'] as $key => $slide) : 
								$image_url = $slide['image']['url'];
								$this->add_render_attribute( 'image', 'src', $slide['image']['url'] );
								$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $slide['image'] ) );
								$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $slide['image'] ) );
								$this->add_render_attribute( 'image', 'class', 'my-custom-class' );
							?>
								<div class="col-md-3 col-6">
									<div class="counter-box  elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?> d-flex flex-column align-items-center mb-40">
										<?php if(!empty($image_url)) : ?>
										<div class="counter-img-2 mb-40">
											<?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
										</div>
										<?php endif; ?>
										<div class="counter-part-txt text-center p-relative">
											<?php if(!empty($slide['count_number'])) : ?>
												<h2 class="counter-txt odometer tp-core-number mb-15" data-count="<?php echo esc_attr($slide['count_number']); ?>"><?php echo esc_html__('0', 'tp-core'); ?></h2>
											<?php endif; ?>
											<?php if(!empty($slide['count_title'])) : ?>
												<p class="counter-sub-txt tp-core-title mb-0"><?php echo tp_element_kses_basic($slide['count_title']); ?></p>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
		<?php endif; ?>
	<?php }
}
