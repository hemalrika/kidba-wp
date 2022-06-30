<?php

class widget_about extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		$widget_ops = array('description' => esc_html__('About Widget.','tp-toolkit') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'about' );
		 parent::__construct( 'about', esc_html__('TP Toolkit About','tp-toolkit'), $widget_ops, $control_ops );
	}


	
	// Widget Output
	function widget($args, $instance) {

		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
        $description = empty($instance['description']) ? '' : $instance['description'];
        $label_social = empty($instance['label_social']) ? '' : $instance['label_social'];
        $social_list_from_customizer = get_theme_mod('tp_social_list_widget'); 
    ?>
        <?php echo $before_widget; ?>
            <?php
                if($title) {
                    echo $before_title . $title . $after_title;
                }
            ?>
            <p class="footer-card-txt text-white mb-30 pr-30">
                <?php echo esc_html($description); ?>
            </p>
            <?php if(!empty($social_list_from_customizer)) : ?>
            <?php if(!empty($label_social)) : ?>
            <span class="footer-follow-dialogue d-block mb-23"><?php echo esc_html($label_social); ?></span>
            <?php endif; ?>
            <div class="footer-socials">
                <?php foreach($social_list_from_customizer as $customizer_social) :
                    $social_icon = $customizer_social['social_icon'];
                    $social_url = $customizer_social['social_url'];
                    ?>
                    <a href="<?php echo esc_url($social_url); ?>" target="_blank" class="footer-social"><i class="icofont-<?php echo esc_attr($social_icon); ?>"></i></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php echo $after_widget;

	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['label_social'] = strip_tags($new_instance['label_social']);

		
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '');
		$defaults = array('description' => '');
		$defaults = array('label_social' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
        $social_list_from_customizer = get_theme_mod('tp_social_list_widget'); ?>

		<p>
			<label style="display: block;margin-bottom: 7px;" for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:','tp-toolkit'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label style="display: block;margin-bottom: 7px;" for="<?php echo $this->get_field_id('description'); ?>"><?php esc_html_e('Description:','tp-toolkit'); ?></label>
			<textarea class="widefat" style="width: 216px;height: 100px;" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $instance['description']; ?></textarea>
		</p>

        <?php if($social_list_from_customizer) : ?>
            <p>
                <label style="display: block;margin-bottom: 7px;" for="<?php echo $this->get_field_id('label_social'); ?>"><?php esc_html_e('Social Label:','tp-toolkit'); ?></label>
                <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('label_social'); ?>" name="<?php echo $this->get_field_name('label_social'); ?>" value="<?php echo $instance['label_social']; ?>" />
            </p>
        <?php endif; ?>
        <p>
		  <?php esc_html_e('You can customize the social list from Dashboard > Appearance > Customize > TP Widgets > about','tp-toolkit'); ?>

		</p>
	<?php
	}
}

// Add Widget
function widget_social_list_init() {
	register_widget('widget_about');
}
add_action('widgets_init', 'widget_social_list_init');

?>