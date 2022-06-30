<?php
$post_gallery = function_exists('get_field') ? get_field('post_gallery') : '';
$categories = get_the_terms( $post->ID, 'category' );?>


<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog mb-50 format-gallery'); ?>>
    <?php if ( !empty( $post_gallery ) ): ?>
        <div class="blog-image-slider">
            <?php foreach ( $post_gallery as $image ): ?>
                <img src="<?php echo esc_url($image['full_image_url']); ?>" alt="<?php echo esc_attr($image['caption']); ?>">
            <?php endforeach; ?>
        </div>
    <?php endif;?>
    <div class="single-blog-txt p-40 px-45">
        <div class="single-blog-info d-flex flex-wrap align-items-center">
            <span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i class="icofont-calendar"></i></span><?php echo get_the_date(); ?></span>
            <span class="d-flex align-items-center lh-0 mb-20"><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><span class="fz-14 mr-10"><i class="icofont-user-alt-7"></i></span><?php print get_the_author();?></a></span>
            <a href="<?php comments_link();?>"><span class="d-flex align-items-center lh-0 mb-20"><span class="fz-14 mr-10"><i class="icofont-speech-comments"></i></span><?php comments_number();?></span></a>
        </div>
        <h3 class="blog-page-blog-title mb-20"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="single-blog-p"><?php echo get_the_excerpt(); ?></p>
        <div class="blog_button mt-30">
            <a href="<?php the_permalink(); ?>" class="def-btn"><?php echo esc_html__('read more', 'kidba'); ?></a>
        </div>
    </div>
</article>