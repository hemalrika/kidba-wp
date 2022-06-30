<?php
$kidba_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
$categories = get_the_terms( $post->ID, 'category' );?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog mb-90 format-audio'); ?>>
    <?php if ( !empty( $kidba_audio_url ) ): ?>
        <div class="postbox__audio embed-responsive embed-responsive-16by9 ">
            <?php echo wp_oembed_get( $kidba_audio_url ); ?>
                <?php if ( !empty($futexo_blog_date) ): ?>
                <div class="top_date">
                    <span><?php print get_the_date('d M', get_the_ID()); ?></span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;?>

	<div class="single-blog-txt">
		<div class="single-blog-info d-flex flex-wrap align-items-center">
				<span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i class="icofont-calendar"></i></span><?php echo get_the_date(); ?></span>
				<span class="d-flex align-items-center lh-0 mb-20"><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><span class="fz-14 mr-10"><i class="icofont-user-alt-7"></i></span><?php print get_the_author();?></a></span>
				<span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i `class="icofont-speech-comments"></i></span><?php comments_number();?></span>
		</div>

		<div class="kidba-post-content-single">
			<h3 class="blog-page-blog-single-title mb-20"><?php the_title(); ?></h3>
			<div class="single-blog-p">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="blog-details-bottom d-flex flex-wrap justify-content-lg-between justify-content-center px-40">
		<div class="btn-box-2 flex-wrap justify-content-center mb-20 mr-25">
			<?php print kidba_get_tag();?>
		</div>
		<div class="btn-box-2 mb-20">
			<?php echo do_shortcode('[Sassy_Social_Share]'); ?>
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
			<?php if(!empty($prev_title)) : ?>
			<a href="<?php echo esc_url($prev_title_link); ?>" class="blog-nav-txt d-block mb-30">
				<span class="blog-nav-title d-block fw-bold color-9 tt-uppercase mb-15"><i class="icofont-double-left"></i> <?php echo esc_attr__('Previous Article', 'kidba'); ?></span>
				<span class="d-block"><?php echo esc_html($prev_title); ?></span>
			</a>
			<?php endif; ?>
		</div>
		<div class="col-sm-6">
			<?php if(!empty($next_title)) : ?>
				<a href="<?php echo esc_url($next_title_link); ?>" class="text-end blog-nav-txt d-block mb-30">
					<span class="blog-nav-title d-block fw-bold color-9 tt-uppercase mb-15"><?php echo esc_attr__('Next Article', 'kidba'); ?> <i class="icofont-double-right"></i></span>
					<span class="d-block"><?php echo esc_html($next_title); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
