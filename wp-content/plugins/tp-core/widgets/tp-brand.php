<?php
namespace TPCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Brand extends Widget_Base {

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
		return 'tp-brand';
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
		return __( 'TP Brand', 'tp-core' );
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
				'default' => 'type1',
				'options' => [
					'style-1'	  => esc_html__( 'Style 1', 'tp-core' ),
					'style-2'	  => esc_html__( 'Style 2', 'tp-core' ),
				],
			]
		);
		$repeater = new Repeater;
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Brand List', 'tp-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => 'Brand List',
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
            <!-- partner begin -->
            <div class="partner">
                <div class="container">
                    <div class="partner-slider">
                        <?php foreach($settings['slides'] as $slide) : 
                            $this->add_render_attribute( 'image', 'src', $slide['image']['url'] );
                            $this->add_render_attribute( 'image', 'alt', \Elementor\Control_Media::get_image_alt( $slide['image'] ) );
                            $this->add_render_attribute( 'image', 'title', \Elementor\Control_Media::get_image_title( $slide['image'] ) );
                            $this->add_render_attribute( 'image', 'class', 'my-custom-class' );    
                        ?>
                        <div class="single-partner elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- partner end -->
	<?php }
}
