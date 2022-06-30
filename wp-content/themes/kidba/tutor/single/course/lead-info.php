<?php

/**
 * Template for displaying lead info
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if (!defined('ABSPATH'))
    exit;
global $post, $authordata;

$profile_url        = tutor_utils()->profile_url( $authordata->ID, true );
$show_author        = tutor_utils()->get_option( 'enable_course_author' );
$course_categories  = get_tutor_course_categories();
$course_id = get_the_ID();
$disable_reviews    = ! get_tutor_option( 'enable_course_review' );
$is_wish_listed     = tutor_utils()->is_wishlisted( $post->ID, get_current_user_id() );
$author_info = tutor_utils()->get_tutor_user( get_the_author_meta('ID') );
$author_ID = $author_info->ID;
$author_info_all_data = get_userdata($author_ID);
$_tutor_course_level = get_post_meta($course_id, '_tutor_course_level', true);
$course_duration = get_post_meta($course_id, '_course_duration', true);
$course_hours = $course_duration['hours'];
$course_min = $course_duration['minutes'];
$course_sec = $course_duration['seconds'];
$user_registered = get_userdata($author_ID)->user_registered;
$tutor_profile_job_title = $author_info->tutor_profile_job_title;
$author_name = $author_info->display_name;
$tp_course_price = get_tp_core_course_price();
?>
<div class="kidba-course-details-head-info">
    <div class="class-details-txt-box">
        <h3 class="class-details-title mt--3 mb-15"><?php the_title(); ?></h3>
             
            <?php
                $course_rating = tutor_utils()->get_course_rating();
                $course_rating_avg = $course_rating->rating_avg;
                $course_rating_count = $course_rating->rating_count;
                if(!empty($course_rating_avg)) {
                    echo esc_html($course_rating_avg);
                }
                tutor_utils()->star_rating_generator_v2($course_rating->rating_avg, $course_rating->rating_count, false);
                if(!empty($course_rating_count)) {
                    echo esc_html($course_rating_count);
                }
            ?>
        <?php if ( $show_author ) : ?>
        <h4 class="class-details-teacher-name"><?php echo esc_html__("Teacher Name :", 'kidba'); ?> <span
                class="color-1"><a href="<?php echo $profile_url; ?>"> <?php echo esc_html($author_name); ?></a></span> <span>
                </span></h4>
        <div class="about-class-box d-flex c-gap-70 r-gap-30 mb-25">
            <?php if(!empty($tutor_profile_job_title)) : ?>
            <h5 class="about-class"><span class="fw-500 color-9"><?php echo esc_html__('Position :', 'kidba'); ?></span>
            <?php echo esc_html($tutor_profile_job_title); ?></h5>
            <?php endif; ?>
            <?php if(!empty($user_registered)) : ?>
                <h5 class="about-class"><span class="fw-500 color-9"><?php echo esc_html__('Join Date :', 'kidba'); ?></span> <?php echo esc_html($user_registered); ?></h5>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="class-info class-details-info d-flex gap-4 pb-40 mt--2 mb-40">
            <?php if(!empty($_tutor_course_level)) : ?>
            <div class="box text-center">
                <span class="single-info d-block mt--4 mb-10"><?php echo esc_html__('Course Label : ','kidba'); ?></span>
                <span class="amount d-block color-3 fw-bold mt--8 mb--8"><?php echo esc_html($_tutor_course_level); ?></span>
            </div>
            <div class="vertical-border"></div>
            <?php endif; ?>
            <?php if(!empty($course_duration)) : ?>
            <div class="box box-1 text-center">
                <span class="single-info d-block fz-14 mt--4 mb-10"><?php echo esc_html__('Duration : ', 'tp-core'); ?></span>
                <span class="amount d-block fz-18 color-1 fw-bold mt--8 mb--8">
                    <?php if(!empty($course_hours)) : ?>
                        <?php echo esc_html($course_hours); ?>
                    <?php endif; ?>
                    <?php if(!empty($course_min)) : ?>
                        : <?php echo esc_html($course_min); ?>
                    <?php endif; ?>
                    <?php if(!empty($course_sec)) : ?>
                        : <?php echo esc_html($course_sec); ?> 
                    <?php endif; ?>
                </span>
            </div>
            <div class="vertical-border"></div>
            <?php endif; ?>
            <?php if(!empty($tp_course_price)) : ?>
            <div class="box text-center">
                <span class="single-info d-block mt--4 mb-10"><?php echo esc_html__('Tution Fee', 'kidba'); ?></span>
                <span class="amount d-block color-2 fw-bold mt--8 mb--8"><?php echo esc_html($tp_course_price); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <div class="tutor-course-details-actions tutor-mt-12 tutor-mt-sm-0">
        <a href="#" class="tutor-btn tutor-btn-ghost tutor-course-wishlist-btn tutor-mr-16" data-course-id="<?php echo get_the_ID(); ?>">
            <i class="<?php echo $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ?> tutor-mr-8"></i> <?php _e('Wishlist', 'tutor'); ?>
        </a>
        <?php
        if ( tutor_utils()->get_option('enable_course_share', false, true, true) ) {
            tutor_load_template_from_custom_path(tutor()->path . '/views/course-share.php', array(), false);
        }
        ?>
    </div>
</div>