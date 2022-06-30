<?php
/**
 * single.php
 * @package WordPress
 * @subpackage Bacola
 * @since Bacola 1.0
 * 
 */
 ?>

<?php get_header(); ?>

<div class="blog pt-120 pb-70">
	<div class="container">
	
		<?php if( get_theme_mod( 'tp_blog_layout' ) == 'left-sidebar') { ?>
			<div class="row content-wrapper sidebar-left">
				<div id="sidebar" class="col-lg-4">
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					<?php } ?>
				</div>
				<div class="col-lg-8">
					<div class="blog-content-wrapper ml-30">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-formates/single-post/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php comments_template(); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'bacola') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } elseif( get_theme_mod( 'tp_blog_layout' ) == 'full-width') { ?>
			<div class="row content-wrapper">
				<div class="col-12 col-lg-10 offset-lg-1 content-primary">
					<div class="single-posts">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-formates/single-post/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php comments_template(); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'bacola') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
				<div class="row content-wrapper sidebar-right">
					<div class="col-lg-8">
						<div class="single-posts mr-30">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-formates/single-post/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php comments_template(); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'bacola') ?></h2>

							<?php endif; ?>
						</div>
					</div>
					<div id="sidebar" class="col-lg-4">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="row content-wrapper">
					<div class="col-12 col-lg-10 offset-lg-1 content-primary">
						<div class="single-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-formates/single-post/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php comments_template(); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'bacola') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } ?>
			
		<?php } ?>

	</div>
</div>

<?php get_footer(); ?>