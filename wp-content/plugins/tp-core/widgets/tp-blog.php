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
class TP_Blog extends Widget_Base {
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
		return 'tp-blog';
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
		return __( 'TP Blog', 'tp-core' );
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
				],
			]
		);
		$this->add_control( 'column',
			[
				'label' => esc_html__( 'Column', 'tp-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-xl-4',
				'options' => [
					'col-xl-6'	  => esc_html__( '2 Columns', 'tp-core' ),
					'col-xl-4' 	  => esc_html__( '3 Columns', 'tp-core' ),
					'col-xl-3'	  => esc_html__( '4 Columns', 'tp-core' ),
				],
			]
		);
		
        $this->add_control( 'post_count',
            [
                'label' => esc_html__( 'Posts Per Page', 'tp-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 3
            ]
        );
		
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->tp_get_categories(),
                'description' => 'Select Category(s)',
				'label_block' => true,
            ]
        );
		
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'naturally' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->tp_get_posts(),
                'description' => 'Select Specific Post(s)',
				'label_block' => true,
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
                'default' => 'DESC'
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
                'default' => 'date',
            ]
        );
		
        $this->add_control( 'image_width',
            [
                'label' => esc_html__( 'Image Width', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '370',
                'pleaceholder' => esc_html__( 'Set the product image width.', 'tp-core' )
            ]
        );
		
        $this->add_control( 'image_height',
            [
                'label' => esc_html__( 'Image Height', 'tp-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '260',
                'pleaceholder' => esc_html__( 'Set the product image height.', 'tp-core' )
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

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'tp-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'tp-core' ),
					'uppercase' => __( 'UPPERCASE', 'tp-core' ),
					'lowercase' => __( 'lowercase', 'tp-core' ),
					'capitalize' => __( 'Capitalize', 'tp-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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
	
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $settings['post_count'],
			'order'          => 'DESC',
			'post_status'    => 'publish',
            'post__in'       => $settings['post_filter'],
            'order'          => $settings['order'],
			'orderby'        => $settings['orderby'],
            'category__in'     => $settings['category_filter'],
		);
        $count = 1;
		$loop = new \WP_Query( $args );  
    ?>
        <!-- blog begin -->
        <div class="latest-news">
            <div class="container">
                <div class="row justify-content-center">
                    <?php if($loop->have_posts()) : ?>
                        <?php while($loop->have_posts()) : $loop->the_post();
                            $id = get_the_ID();
                            $att=get_post_thumbnail_id();
                            $image_src = wp_get_attachment_image_src($att, 'full');
                            if(!empty($image_src)) {
                                $image_src = $image_src[0];
                            }
                            if($settings['image_width'] && $settings['image_height']){
                                $imageresize = tp_core_resize( $image_src, $settings['image_width'], $settings['image_height'], true, true, true );  
                            } else {
                                $imageresize = $image_src;
                            }     
                    ?>
                            <div class="<?php echo esc_attr($settings['column']); ?> col-lg-6 col-md-6">
                                <div class="blog-card mb-40">
                                    <div class="part-img w_100">
                                        <?php if(!empty($imageresize)) : ?>
                                            <a href="<?php echo get_the_permalink(); ?>"><img src="<?php echo esc_url($imageresize) ?>" alt="Image"></a>
                                        <?php endif; ?>
                                        <span class="lv-part-blog-calendar-date">
                                            <i class="icofont-calendar"></i> <?php echo get_the_date(); ?>
                                        </span>
                                    </div>
                                    <div class="blog-card-txt p-40 px-30">
                                        <h3 class="blog-title mt--2 mb-20"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?>.</a></h3>
                                        <p class="mb--8"><?php echo wp_trim_words(get_the_excerpt(), 11); ?></p>
                                    </div>
                                    <div class="blog-bottom-part px-30 d-flex justify-content-between align-items-center">
                                        <span class="blog-single-stat py-20"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/user.png" class="mr-10" alt="Heart">23 Like</span>
                                        <?php
                                            if(get_comments_number() > 1) {
                                                $html = '<span class="blog-single-stat py-20">
                                                <img src="'.get_template_directory_uri().'/assets/images/comment-icon.png" class="mr-10" alt="Comment">'.
                                                get_comments_number()
                                                .' Comments</span>';
                                            } else {
                                                $html = '<span class="blog-single-stat py-20">
                                                <img src="'.get_template_directory_uri().'/assets/images/comment-icon.png" class="mr-10" alt="Comment">'.
                                                esc_html__('No Comment', 'tp-core').'<span>';
                                            }
                                            echo $html;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- blog end -->
	<?php }
}
