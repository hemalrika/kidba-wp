<?php

class tp_widget_social_list extends WP_Widget {
	function __construct() {
		$widget_desc = array('description' => esc_html__('TP Core Social List Widget','tp-toolkit') );
		$widget_dimension_control = array( 'width' => 300, 'height' => 350, 'id_base' => 'social_list_dimension' );
		parent::__construct('social_list_dimension', esc_html__('TP Core Social List Widget', 'tp-toolkit'), $widget_desc, $widget_dimension_control);
	}



	// widget output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		echo $before_widget;
		if($title) {
			echo $before_title . $title . $after_title;
		} ?>
		<?php $tp_sociallist = get_theme_mod( 'tp_social_list_widget' ); ?>
		<?php if($tp_sociallist) : ?>
			<div class="widget-body">
				<?php foreach($tp_sociallist as $social_single) : ?>
					<p>Icon: <?php echo $social_single['social_icon']; ?></p>
					<p>URL: <?php echo $social_single['social_url']; ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	<?php echo $after_widget; }



	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}


	// widget form
	function form($instance) {
		$defaults = array('title' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','tp-toolkit'); ?></label>
			<input type="text" class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
		  <?php esc_html_e('You can customize the social list from Dashboard > Appearance > Customize > Bacola Widgets > Social List','tp-toolkit'); ?>

		</p>
	<?php }


}

// Add Widget
function tp_widget_social_list_init() {
	register_widget('tp_widget_social_list');
}
add_action('widgets_init', 'tp_widget_social_list_init');