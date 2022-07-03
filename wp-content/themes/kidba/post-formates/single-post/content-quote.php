<?php
$post_gallery = function_exists('get_field') ? get_field('post_gallery') : '';
$categories = get_the_terms( $post->ID, 'category' );?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog mb-90  format-gallery'); ?>>
    <div class="single-blog-txt">
        <div class="kidba-post-content-single">
            <div class="single-blog-p has-quote-text">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</article>
<div class="blog-nav mb-55">
	<?php
		$prev = get_previous_post();
		$next = get_next_post();
		$prev_title = $prev ? $prev->post_title : '';
		$prev_title_link = $prev->guid;
		$next_title = $next ? $next->post_title : '';
		$next_title_link = $next->guid ? $next->guid : '';
	?>
	<div class="row">
		<div class="col-sm-6">
			<?php if(!empty($prev_title_link)) : ?>
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
