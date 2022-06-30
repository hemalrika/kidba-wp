
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kidba
 */

get_header();
?>

<div class="page-area pt-120 pb-120">
    <div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="kidba-page-content">
					<?php
						if ( have_posts() ):
							while ( have_posts() ): the_post();
								get_template_part( 'post-formates/content', 'page' );
							endwhile;
						else:
							get_template_part( 'post-formates/content', 'none' );
						endif;
					?>
				</div>
			</div>
		</div>
    </div>
</div>

<?php
get_footer();
