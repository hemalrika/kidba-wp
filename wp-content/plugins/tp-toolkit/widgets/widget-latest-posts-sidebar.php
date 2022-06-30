<?php
Class Latest_posts_sidebar_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'tp-latest-posts', 'TP Toolkit Sidebar Posts Image', [
            'description' => 'Latest Post Widget by Kidba',
        ] );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        echo $before_widget;
        if ( $instance['title'] ):
            echo $before_title;?>
	     			<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
	     		<?php echo $after_title; ?>
	     	<?php endif;?>
			 <div class="blog-sidebar-box-body p-30 px-30">
				<ul>
					<?php
						$q = new WP_Query( [
							'post_type'      => 'post',
							'posts_per_page' => ( $instance['count'] ) ? $instance['count'] : '3',
							'order'          => ( $instance['posts_order'] ) ? $instance['posts_order'] : 'DESC',
							'orderby'        => 'date',
						] );

						if ( $q->have_posts() ):
						while ( $q->have_posts() ): $q->the_post();
					?>
						<li>
							<a href="<?php the_permalink();?>" class="popular-post d-flex mb-20">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="popular-post-img mr-20">
										<img src="<?php print esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );?>" alt="image">
									</div>
								<?php endif;?>
								<div class="popular-post-txt">
									<span class="popular-post-date mb-5"><?php echo get_the_time();?></span>
									<span class="popular-post-title"><?php print wp_trim_words( get_the_title(), 7, '' );?></span>
								</div>
							</a>
						</li>
					<?php endwhile; endif;?>
				</ul>
			</div>
		<?php echo $after_widget; ?>
		<?php
}

    public function form( $instance ) {
        $title = !empty( $instance['title'] ) ? $instance['title'] : '';
        $count = !empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tp-toolkits' );
        $posts_order = !empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tp-toolkits' );
        $choose_style = !empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'tp-toolkits' );
        ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name( 'count' ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name( 'posts_order' ); ?>" id="<?php echo $this->get_field_id( 'posts_order' ); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if ( $posts_order === 'ASC' ) {echo 'selected="selected"';}?>>ASC</option>
				<option value="DESC" <?php if ( $posts_order === 'DESC' ) {echo 'selected="selected"';}?>>DESC</option>
			</select>
		</p>

	<?php }

}

add_action( 'widgets_init', function () {
    register_widget( 'Latest_posts_sidebar_Widget' );
} );