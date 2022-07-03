<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog mb-90'); ?>>
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
		<figure class="blog-image w_100">
			<?php  
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0]; 
			?>
			<img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>">
		</figure>
	<?php } ?>

	<div class="single-blog-txt">
		<div class="single-blog-info d-flex flex-wrap align-items-center">
				<span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i class="icofont-calendar"></i></span><?php echo get_the_date(); ?></span>
				<span class="d-flex align-items-center lh-0 mb-20"><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><span class="fz-14 mr-10"><i class="icofont-user-alt-7"></i></span><?php print get_the_author();?></a></span>
				<span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i `class="icofont-speech-comments"></i></span><?php comments_number();?></span>
		</div>

		<div class="kidba-post-content-single">
			<div class="single-blog-p">
				<?php the_content(); ?>
					<?php
						wp_link_pages( [
							'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'kidba' ),
							'after'       => '</div>',
							'link_before' => '<span class="page-number">',
							'link_after'  => '</span>',
						] );
					?>
			</div>
		</div>
	</div>
	<div class="blog-details-bottom d-flex flex-wrap justify-content-lg-between justify-content-center px-40">
		<div class="btn-box-2 flex-wrap justify-content-center mb-20 mr-25">
			<?php print kidba_get_tag();?>
		</div>
		<?php
		if ( shortcode_exists( 'Sassy_Social_Share' ) ) {
			echo '<div class="btn-box-2 mb-20">';
			echo do_shortcode('[Sassy_Social_Share]');
			echo '</div>';
		}
		?>
	</div>
</article>
<div class="blog-nav mb-55">
	<?php
		$prev = get_previous_post();
		$next = get_next_post();
		$prev_title = $prev ? $prev->post_title : '';
		$prev_title_link = $prev ? $prev->guid: '';
		$next_title = $next ? $next->post_title : '';
		$next_title_link = $next ? $next->guid : '';
	?>	<div class="row">
		<div class="col-sm-6">
			<?php if(!empty($prev_title)) : ?>
			<a href="<?php echo esc_url($prev_title_link); ?>" class="blog-nav-txt d-block mb-30">
				<span class="blog-nav-title d-block fw-bold color-9 tt-uppercase mb-15"><i class="icofont-double-left"></i> <?php echo esc_attr__('Previous Article', 'kidba'); ?></span>
				<span class="d-block"><?php echo wp_strip_all_tags($prev_title); ?></span>
			</a>
			<?php endif; ?>
		</div>
		<div class="col-sm-6">
			<?php if(!empty($next_title)) : ?>
				<a href="<?php echo esc_url($next_title_link); ?>" class="text-end blog-nav-txt d-block mb-30">
					<span class="blog-nav-title d-block fw-bold color-9 tt-uppercase mb-15"><?php echo esc_attr__('Next Article', 'kidba'); ?> <i class="icofont-double-right"></i></span>
					<span class="d-block"><?php echo wp_strip_all_tags($next_title); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
