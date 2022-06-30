<?php
$kidba_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
$categories = get_the_terms( $post->ID, 'category' );?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-blog mb-50 format-audio'); ?>>
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