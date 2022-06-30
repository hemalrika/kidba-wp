<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */
use TUTOR\Input;
global $post, $authordata;
$course_id = get_the_ID();
$product_id = tutor_utils()->get_course_product_id();
$product = wc_get_product( $product_id );
$date		= Input::has( 'date' ) ? tutor_get_formated_date( 'Y-m-d' , Input::get( 'date' ) ) : '';
$search		= Input::get( 'search', '' );
$toal_student = 0;
$toal_student     		= tutor_utils()->get_total_students( $search, $course_id, $date );
$isLoggedIn = is_user_logged_in();
$enable_guest_course_cart = tutor_utils()->get_option('enable_guest_course_cart');
$required_loggedin_class = '';
if ( ! $isLoggedIn && ! $enable_guest_course_cart){
	$required_loggedin_class = apply_filters('tutor_enroll_required_login_class', 'tutor-open-login-modal');
}
$is_enrolled           = apply_filters( 'tutor_alter_enroll_status', tutor_utils()->is_enrolled() );
$lesson_url            = tutor_utils()->get_course_first_lesson();
$is_administrator      = tutor_utils()->has_user_role( 'administrator' );
$author_info = tutor_utils()->get_tutor_user( get_the_author_meta('ID') );
$author_name = $author_info->display_name;
$completed_lessons = tutor_utils()->get_lesson_count_by_course();
$profile_url        = tutor_utils()->profile_url( $authordata->ID, true );
$paged    = Input::get( 'paged', 1, Input::TYPE_INT );
$per_page = tutor_utils()->get_option( 'pagination_per_page' );
$offset   = ( $per_page * $paged ) - $per_page;
$date		= Input::has( 'date' ) ? tutor_get_formated_date( 'Y-m-d' , Input::get( 'date' ) ) : '';
$is_instructor         = tutor_utils()->is_instructor_of_this_course();
$course_content_access = (bool) get_tutor_option( 'course_content_access_for_ia' );
$is_privileged_user    = $course_content_access && ( $is_administrator || $is_instructor );
$tutor_course_sell_by  = apply_filters( 'tutor_course_sell_by', null );
$is_public             = get_post_meta( get_the_ID(), '_tutor_is_public_course', true ) == 'yes';
$course_duration = get_post_meta($course_id, '_course_duration', true);
$course_hours = $course_duration['hours'];
$course_min = $course_duration['minutes'];
$course_sec = $course_duration['seconds'];
?>
<div class="sidebar-box px-30 p-30 mb-40">
    <div class="course__video">
        <div class="course__video-thumb w-img mb-25">
            <?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
        </div>
        <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
            <div class="course__video-price">
                <h5><?php esc_html_e( 'Free', 'tutor' ); ?></h5>
            </div>
        </div>
        <div class="course__video-content mb-35">
            <ul class="ms-0">
                <?php if(!empty($is_administrator)) : ?>
                <li class="d-flex align-items-center">
                    <div class="course__video-icon"><i class="icofont-home"></i></div>
                    <div class="course__video-info">
                    <h5><a href="<?php echo esc_url($profile_url); ?>"><?php echo esc_html__('Instructor :', 'kidba'); ?></span> <?php echo esc_html($author_name); ?></a><span></h5>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(!empty($completed_lessons)) : ?>
                <li class="d-flex align-items-center">
                    <div class="course__video-icon"><i class="icofont-book-alt"></i></div>
                    <div class="course__video-info">
                    <h5><span><?php echo esc_html__('Lectures :', 'kidba'); ?></span><?php echo esc_html($completed_lessons); ?></h5>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(!empty($course_duration)) : ?>
                <li class="d-flex align-items-center">
                    <div class="course__video-icon"><i class="icofont-clock-time"></i></div>
                    <div class="course__video-info">
                    <h5><span><?php echo esc_html__('Duration :', 'kidba'); ?></span>
                        <?php if(!empty($course_hours)) : ?>
                            <?php echo esc_html($course_hours); ?>
                            <?php endif; ?>
                            <?php if(!empty($course_min)) : ?>
                                : <?php echo esc_html($course_min); ?>
                            <?php endif; ?>
                            <?php if(!empty($course_sec)) : ?>
                                : <?php echo esc_html($course_sec); ?> 
                            <?php endif; ?>
                    </h5>
                    </div>
                </li>
                <?php endif; ?>
                <li class="d-flex align-items-center">
                    <div class="course__video-icon"><i class="icofont-student"></i></div>
                    <div class="course__video-info">
                    <h5><span><?php echo esc_html__('Enrolled :', 'kidba'); ?></span><?php echo esc_html($toal_student); ?> <?php echo esc_html__('students', 'kidba'); ?></h5>
                    </div>
                </li>
                <li class="d-flex align-items-center">
                    <div class="course__video-icon"><i class="icofont-student"></i></div>
                    <div class="course__video-info">
                    <h5><span><?php echo esc_html__('Last Updated :', 'kidba'); ?></span><?php echo get_tutor_option( 'enable_course_update_date' ) ? get_the_modified_date( get_option( 'date_format' ) ) : null; ?></h5>
                    </div>
                </li>
            </ul>
        </div>
        <div class="course__payment mb-35">
            <h3><?php echo esc_html__('Payment', 'kidba'); ?></h3>
            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/payment-1.png" alt="img">
            </a>
        </div>
        <div class="tutor-course-single-btn-group <?php echo is_user_logged_in() ? '' : 'tutor-course-entry-box-login'; ?>" data-login_url="<?php echo $login_url; ?>">
        <form class="tutor-enrol-course-form" method="post">
            <?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
            <input type="hidden" name="tutor_course_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
            <input type="hidden" name="tutor_course_action" value="_tutor_course_enroll_now">
            <?php
                if ($product) {
                    if(tutor_utils()->is_course_added_to_cart($product_id, true)){
                        ?>
                            <a href="<?php echo wc_get_cart_url(); ?>" class="def-btn border-0 d-block tutor-btn tutor-btn-outline-primary tutor-btn-lg tutor-btn-block tutor-woocommerce-view-cart">
                                <?php _e('View Cart', 'tutor'); ?>
                            </a>
                        <?php
                    } else {
                        $sale_price = $product->get_sale_price();
                        $regular_price = $product->get_regular_price();
                        ?>
                        <div class="tutor-course-sidebar-card-pricing tutor-d-flex tutor-align-end tutor-justify-between">
                            <div>
                                <span class="tutor-fs-4 tutor-fw-bold tutor-color-black">
                                    <?php echo wc_price( $sale_price ? $sale_price : $regular_price ); ?>
                                </span>
                                <?php if( $regular_price && $sale_price && $sale_price!=$regular_price ): ?>
                                    <del class="tutor-fs-7 tutor-color-muted tutor-ml-8">
                                        <?php echo wc_price($regular_price); ?>
                                    </del>
                                <?php endif; ?>
                            </div>
                        </div>
                        <form action="<?php echo esc_url( apply_filters( 'tutor_course_add_to_cart_form_action', get_permalink( get_the_ID() ) ) ); ?>" method="post" enctype="multipart/form-data">
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"  class="def-btn border-0 d-block tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-add-to-cart-button <?php echo $required_loggedin_class; ?>">
                                <span class="btn-icon tutor-icon-cart-filled"></span>
                                <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
                            </button>
                        </form>
                        <?php
                    }
                } else {
                    ?>
                    <p class="tutor-alert-warning">
                        <?php _e( 'Please make sure that your product exists and valid for this course', 'tutor' ); ?>
                    </p>
                    <?php
                }
                
            ?>
        </form>
    </div>
    </div>
</div>
<?php
