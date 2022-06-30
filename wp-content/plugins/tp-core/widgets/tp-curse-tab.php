<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Curse_Tab extends Widget_Base {
	use \TPCore\Traits\Classes\TP_Core_Class_Func;
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
		return 'tp-curse-tab';
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
		return __( 'TP Curse Tab', 'tp-core' );
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
		return 'eicon-tabs';
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
		return [ 'tp-course-tab' ];
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
					'style2'	  => esc_html__( 'Style 2', 'tp-core' )
				],
			]
		);
		$this->start_controls_tabs('cat_exclude_include_tabs');
		$this->start_controls_tab( 'cat_exclude_tab',
            [ 'label' => esc_html__( 'Exclude Category', 'tp-core' ) ]
        );
		$this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Exclude Category', 'tp-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->tp_core_cpt_taxonomies('course-category'),
                'description' => 'Select Category(s)',
                'default' => '',
                'label_block' => true,
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab('cat_include_tab',
            [ 'label' => esc_html__( 'Include Category', 'tp-core' ) ]
        );
		$this->add_control( 'include_category',
            [
                'label' => esc_html__( 'Include Category', 'tp-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->tp_core_cpt_taxonomies('course-category'),
                'description' => 'Select Category(s)',
                'default' => '',
                'label_block' => true,
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'bacol-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bacol-core' ),
					'2' 	  => esc_html__( '2 Columns', 'bacol-core' ),
					'3'		  => esc_html__( '3 Columns', 'bacol-core' ),
					'4'		  => esc_html__( '4 Columns', 'bacol-core' ),
					'5'		  => esc_html__( '5 Columns', 'bacol-core' ),
					'6'		  => esc_html__( '6 Columns', 'bacol-core' ),
					'7'		  => esc_html__( '7 Columns', 'bacol-core' ),
				],
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
			]
		);
		$this->add_control( 'tablet_column',
			[
				'label' => esc_html__( 'Tablet Column', 'bacol-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bacol-core' ),
					'2' 	  => esc_html__( '2 Columns', 'bacol-core' ),
					'3'		  => esc_html__( '3 Columns', 'bacol-core' ),
					'4'		  => esc_html__( '4 Columns', 'bacol-core' ),
					'5'		  => esc_html__( '5 Columns', 'bacol-core' ),
					'6'		  => esc_html__( '6 Columns', 'bacol-core' ),
					'7'		  => esc_html__( '7 Columns', 'bacol-core' ),
				],
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
			]
		);
		$this->add_control( 'mobile_column',
			[
				'label' => esc_html__( 'Mobile Column', 'bacol-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'0' => esc_html__( 'Select Column', 'bacol-core' ),
					'2' 	  => esc_html__( '2 Columns', 'bacol-core' ),
					'3'		  => esc_html__( '3 Columns', 'bacol-core' ),
					'4'		  => esc_html__( '4 Columns', 'bacol-core' ),
					'5'		  => esc_html__( '5 Columns', 'bacol-core' ),
					'6'		  => esc_html__( '6 Columns', 'bacol-core' ),
					'7'		  => esc_html__( '7 Columns', 'bacol-core' ),
				],
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
			]
		);
		$this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'tp-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'tp-core' ),
                    'DESC' => esc_html__( 'Descending', 'tp-core' )
                ],
                'default' => 'ASC',
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
		
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'tp-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'tp-core' ),
                    'menu_order' => esc_html__( 'Menu Order', 'tp-core' ),
                    'rand' => esc_html__( 'Random', 'tp-core' ),
                    'date' => esc_html__( 'Date', 'tp-core' ),
                    'title' => esc_html__( 'Title', 'tp-core' ),
                ],
                'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
            ]
        );
        $this->add_control( 'posts_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => -1,
				'condition' => [
                    'design_style' => ['style1', 'style2']
                ]
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
		$taxonomy = "course-category";
		$count_total_post = wp_count_posts('courses');
		$published_post = $count_total_post->publish;
		$args = array(
			'post_type'   => 'courses',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => $settings['order'],
			'orderby' => $settings['orderby'],
			'hide_empty' => true,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'parent'    => 0,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'id',
					'terms'   => $settings['cat_filter'],
					'operator' => 'NOT IN'
				),
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'id',
					'terms'   => $settings['include_category'],
				),
			),
		);
		$args_no_post = array(
			'post_type'   => 'courses',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => $settings['order'],
			'orderby' => $settings['orderby'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'hide_empty' => true,
			'parent'    => 0,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'id',
					'terms'   => $settings['cat_filter'],
					'operator' => 'NOT IN'
				)
			),
		);
		if(!empty($settings['include_category'])) {
			$courses_query = new WP_Query($args);
		} else {
			$courses_query = new WP_Query($args_no_post);
		}
		?>
		<?php if(!empty($published_post)) : ?>
			<?php if($settings['design_style'] == 'style1') : ?>
			<!-- class begin -->
			<div class="class">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="popular-class-buttons mb-40 text-center" id="filters">
								<button class="class-filter-btn active" data-filter="*">See All</button>
								<?php
									foreach($settings['include_category'] as $key => $cat) :
										$cat_slug = $this->tp_core_get_slug_by_id($taxonomy, $cat);
										$cat_name = $this->tp_core_get_name_by_id($taxonomy, $cat);
								?>
									<?php if(!empty($cat_name)) : ?>
											<button class="class-filter-btn" data-filter="<?php echo ".".esc_attr($cat_slug)."" ?>"><?php echo esc_html($cat_name); ?></button>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="row justify-content-center popular-classes-wrapper">
						<?php
							while($courses_query->have_posts()) : $courses_query->the_post();
							$course_id = get_the_ID();
							$course_duration = get_post_meta($course_id, '_course_duration', true);
							$_tutor_course_level = get_post_meta($course_id, '_tutor_course_level', true);
							$course_hours = $course_duration['hours'];
							$course_min = $course_duration['minutes'];
							$course_sec = $course_duration['seconds'];
							$tp_core_classes = $this->get_tp_core_post_category_list_by_slug($taxonomy, $course_id);
							$tp_course_price = $this->get_tp_core_course_price();
						?>
						<div class="col-xl-4 col-lg-6 col-md-6 popular-class-item <?php echo esc_attr($tp_core_classes); ?>">
							<div class="class-card mb-40">
								<div class="part-img">
									<?php if(!empty($tp_course_price)) : ?>
									<div class="kb-class-fee-wrap-1 p-rel fix">
										<span class="class-fee"><?php echo esc_html($tp_course_price); ?></span>
										<span class="kb-class-tooltip-1"><?php echo esc_html__('Tution Fee', 'kidba'); ?></span>
									</div>
									<?php endif; ?>
									<?php if(has_post_thumbnail()) : ?>
										<a href="<?php echo get_the_permalink($course_id); ?>"><img src="<?php echo get_the_post_thumbnail_url($course_id, 'full'); ?>" class="w-100" alt="image"></a>
									<?php endif; ?>
								</div>
								<div class="part-txt p-40 px-30">
									<?php $this->tp_core_post_category_list_by_id($course_id, $taxonomy); ?>
									<h3 class="class-title mt--7 mb-6 name"><a href="<?php echo get_the_permalink($course_id); ?>"><?php echo get_the_title(); ?></a></h3>
									<p class="mt--8 mb--8"><?php echo wp_trim_words(get_the_excerpt(), 13); ?></p>
									<div class="class-info mt-30 d-flex justify-content-between">
										<?php if(!empty($_tutor_course_level)) : ?>
										<div class="box box-1 text-center">
											<span class="amount d-block fz-18 color-3 fw-bold mt--8 mb--8"><?php echo esc_html($_tutor_course_level); ?></span>
										</div>
										<?php endif; ?>
										<div class="vertical-border"></div>
										<?php if(!empty($course_duration)) : ?>
										<div class="box box-1 text-center">
											<span class="single-info d-block fz-14 mt--4 mb-10"><?php echo esc_html__('Duration : ', 'tp-core'); ?></span>
											<span class="amount d-block fz-18 color-1 fw-bold mt--8 mb--8">
												<?php if(!empty($course_hours)) : ?>
													<?php echo esc_html($course_hours); ?>
												<?php endif; ?>
												<?php if(!empty($course_min)) : ?>
													: <?php echo esc_html($course_min); ?>
												<?php endif; ?>
												<?php if(!empty($course_sec)) : ?>
													: <?php echo esc_html($course_sec); ?> 
												<?php endif; ?>
											</span>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile;wp_reset_query(); ?>

					</div>
					<div class="row">
						<div class="col-12">
							<div id="see-load-more" class="popular-class-btn text-center pt-30 mb-40">
								<button class="def-btn"><?php echo esc_html__('See More Classes', 'tp-core'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- class end -->
			<?php elseif($settings['design_style'] == 'style2') : ?>
				<!-- class begin -->
				<div class="class pt-120 pb-80">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="popular-class-buttons mb-40 text-center"  id="filters">
									<button class="class-filter-btn active" data-filter="*">See all</button>
								<?php
									foreach($settings['include_category'] as $key => $cat) :
										$cat_slug = $this->tp_core_get_slug_by_id($taxonomy, $cat);
										$cat_name = $this->tp_core_get_name_by_id($taxonomy, $cat);
								?>
									<?php if(!empty($cat_name)) : ?>
										<button class="class-filter-btn" data-filter="<?php echo ".".esc_attr($cat_slug)."" ?>"><?php echo esc_html($cat_name); ?></button>
									<?php endif; ?>
								<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="row popular-classes-wrapper">
						<?php
							while($courses_query->have_posts()) : $courses_query->the_post();
							$course_id = get_the_ID();
							$course_duration = get_post_meta($course_id, '_course_duration', true);
							$_tutor_course_level = get_post_meta($course_id, '_tutor_course_level', true);
							$course_hours = $course_duration['hours'];
							$course_min = $course_duration['minutes'];
							$course_sec = $course_duration['seconds'];
							$tp_core_classes = $this->get_tp_core_post_category_list_by_slug($taxonomy, $course_id);
							$tp_course_price = $this->get_tp_core_course_price();
							$image_url = get_the_post_thumbnail_url($course_id, 'full') ? get_the_post_thumbnail_url($course_id, 'full'): '';
						?>
							<div class="col-xl-6 col-lg-12 col-md-12 popular-class-item <?php echo esc_attr($tp_core_classes); ?>">
								<div class="class-card class-card-2 mb-40">
									<div class="part-img" data-background="<?php echo esc_url($image_url); ?>">
										<div class="kb-class-fee-wrap-1 p-rel fix">
											<?php if(!empty($tp_course_price)) : ?>
											<div class="kb-class-fee-wrap-1 p-rel fix">
												<span class="class-fee"><?php echo esc_html($tp_course_price); ?></span>
												<span class="kb-class-tooltip-1"><?php echo esc_html__('Tution Fee', 'kidba'); ?></span>
											</div>
											<?php endif; ?>
										</div>
									</div>
									<div class="popular-class-txt">
										<?php $this->tp_core_post_category_list_by_id($course_id, $taxonomy, 'parent', 'class-catname'); ?>
										<h3 class="class-title mt--7 mb-15"><a href="<?php echo get_the_permalink($course_id); ?>"><?php echo get_the_title(); ?></a></h3>
										<?php if(!empty($course_duration)) : ?>
										<div class="box box-1 mb-10">
											<span class="amount d-block fz-18 color-1 fw-bold mt--8 mb--8">
												<?php if(!empty($course_hours)) : ?>
													<?php echo esc_html($course_hours); ?>
												<?php endif; ?>
												<?php if(!empty($course_min)) : ?>
													: <?php echo esc_html($course_min); ?>
												<?php endif; ?>
												<?php if(!empty($course_sec)) : ?>
													: <?php echo esc_html($course_sec); ?> 
												<?php endif; ?>
											</span>
										</div>
										<?php endif; ?>
										<p class="mt--8 mb--8"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
										<div class="class-info mt-30">
											<div class="box kitba-box-2">
											<?php if(!empty($_tutor_course_level)) : ?>
											<span class="amount d-block fz-18 color-3 fw-bold mt--8 mb--8"><?php echo esc_html($_tutor_course_level); ?></span>
											<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile;wp_reset_query(); ?>
						</div>

						<div class="row">
							<div class="col-12">
								<div id="see-load-more" class="popular-class-btn text-center pt-30 mb-40">
									<button class="def-btn"><?php echo esc_html__('See More Classes', 'kidba'); ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- class end -->
			<?php endif; ?>
		<?php else : ?>
			<h1>Sorry! No Post Found.</h1>
		<?php endif; ?>
		
		
	<?php }
}
