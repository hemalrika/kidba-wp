<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kidba
 */

get_header();
$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
?>

	<main id="primary" class="site-main">

		<div class="container">
			<div class="row">
				<div class="col-lg-<?php print esc_attr( $blog_column );?>">
					<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'post-formates/content', 'search' );
					endwhile;
					the_posts_navigation();
					else :
					get_template_part( 'post-formates/content', 'none' );
					endif;
					?>
				</div>
				<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
					<div class="col-lg-4">
						<div class="blog__sidebar pl-30">
							<?php get_sidebar();?>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
