<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kidba
 */

get_header();
$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
if(isset($_GET['s'])) {
	$search = $_GET['s'];
}
?>

	<main id="primary" class="blog-area pt-125 pb-30">
		<div class="container">
			<div class="row">
				<div class="col-lg-<?php print esc_attr( $blog_column );?>">
					<div class="blog__wrapper mr-35">
						<?php
							if ( have_posts() ):
							if ( is_home() && !is_front_page() ):
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
						</header>
						<?php
							endif;?>
						<?php
							/* Start the Loop */
							while ( have_posts() ): the_post(); ?>
							<?php
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								if(is_single()) {
									get_template_part( 'post-formates/single-post/content', get_post_format() );
								} else {
									get_template_part( 'post-formates/content', get_post_format() );
								}
								endwhile;
							?>
								<div class="basic-pagination pagination justify-content-left mb-40 mt-50">
									<?php kidba_pagination( '<i class="icofont-simple-left"></i>', '<i class="icofont-simple-right"></i>', '', ['class' => ''] );?>
								</div>
							<?php
							else:
								get_template_part( 'post-formates/content', 'none' );
							endif;
						?>

					</div>
				</div>

				<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
					<div class="col-lg-4">
						<div class="blog__sidebar pl-30">
							<?php dynamic_sidebar('blog-sidebar');?>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
