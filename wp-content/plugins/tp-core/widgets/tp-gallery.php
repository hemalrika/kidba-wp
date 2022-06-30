<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Gallery extends Widget_Base {

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
		return 'tp-gallery';
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
		return __( 'TP Gallery', 'tp-core' );
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
		return 'eicon-gallery-grid';
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

		$this->add_control( 'slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'tp-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'type1',
				'options' => [
					'select-type' => esc_html__( 'Select Style', 'tp-core' ),
					'type1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'type2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
		
        $repeater = new Repeater();
        $repeater->add_control(
        'gallery_images',
        [
            'label' => esc_html__( 'Gallery Images', 'tp-core' ),
            'type' => \Elementor\Controls_Manager::GALLERY,
            'default' => [],
        ]
		);
        $repeater->add_control(
			'gallery_image_button_text',
			[
				'label' => esc_html__( 'Gallery Button Text', 'tp-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( ' Smart school psd', 'tp-core' ),
				'placeholder' => esc_html__( 'Type your gallery button text here', 'tp-core' ),
			]
		);
        $this->add_control(
			'slide_images',
			[
				'label' => esc_html__( 'Gallery Images', 'tp-core' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ gallery_image_button_text }}}',
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
		$settings = $this->get_settings_for_display();?>
        <!-- gallery begin -->
        <div class="gallery p-120">
            <div class="container">
                <?php if(!empty($settings['slide_images'])) : ?>
                <div class="wrap">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="control-panel d-flex justify-content-center mb-50 mt--1">
                                <div class="controls d-inline-flex" id="controls">
                                    <button class="gallery-filter-btn bg-transparent border-0 active color-4 mr-20 pb-17" data-filter="*">Show all</button>
                                    <?php foreach($settings['slide_images'] as $key => $slide) :
                                        $i = isset($i) ? $i : 5;
                                        $color_class = 'color-'.$i.'';
                                    ?>
                                        <?php if(!empty($slide['gallery_image_button_text'])) : ?>
                                            <button class="<?php echo esc_attr($color_class); ?> gallery-filter-btn color-4 mr-20 pb-17 bg-transparent border-0" data-filter=".slide-<?php echo esc_attr($key); ?>"><?php echo esc_html($slide['gallery_image_button_text']); ?></button>
                                        <?php endif;$i++; ?>
                                    <?php  endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 gallery-images">
                    <?php foreach($settings['slide_images'] as $key => $slide) : ?>
                        <?php if(!empty($slide['gallery_images'])) : ?>
                            <?php foreach($slide['gallery_images'] as $image) :
                                $image_url = $image['url'];    
                                $image_alt = get_post_meta( $image['id'], '_wp_attachment_image_alt', true );
                                $image_caption = wp_get_attachment_caption($image['id']);
                            ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 gallery-image slide-<?php echo esc_attr($key); ?>">
                                    <div class="img w_100">
                                        <img src="<?php echo $image_url ? esc_url($image_url) : '';  ?>" alt="<?php echo $image_alt ? esc_attr($image_alt): ''; ?>">
                                    </div>
                                    <div class="gallery-txt p-absolute text-center d-flex flex-column align-items-center justify-content-center">
                                        <a class="gallery-popup mb-20" href="<?php echo $image_url ? esc_url($image_url) : ''; ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/expand.png" alt="View">
                                        </a>
                                        <h3 class="gallery-title mt--3 mb-10"><a href="class-details.html"><?php echo $image_caption ? esc_html($image_caption) : ''; ?></a></h3>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="gallery-btn text-center mt-70" id="load-photos">
                                <button class="def-btn">View All Photos</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <!-- gallery end -->
	<?php }
}
