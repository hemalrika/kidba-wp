<?php
function tp_core_tutor_course_layout() {
    $kidba_tutor_course_layout_customize = get_theme_mod('kidba_tutor_course_layout_customize', 'layout-1');
    if($kidba_tutor_course_layout_customize == 'layout-1') {
        courseCardLayoutOne();
    }
}
add_action('choose-course-layout', 'tp_core_tutor_course_layout');

/**
 * Course Layout 01
 */
function courseCardLayoutOne() {
    $taxonomy = "course-category";
    $course_id = get_the_ID();
    $course_duration = get_post_meta($course_id, '_course_duration', true)? get_post_meta($course_id, '_course_duration', true): array();
    $_tutor_course_level = get_post_meta($course_id, '_tutor_course_level', true);
    $course_hours = $course_duration ? $course_duration['hours']: '';
    $course_min = $course_duration ? $course_duration['minutes']: '';
    $course_sec = $course_duration ? $course_duration['seconds']: '';
    $tp_core_classes = get_tp_core_post_category_list_by_slug($taxonomy, $course_id);
    $tp_course_price = get_tp_core_course_price();
?>
    <div class="class-card mb-40">
        <div class="part-img">
            <?php if(!empty($tp_course_price)) : ?>
            <div class="kb-class-fee-wrap-1 p-rel fix">
                <span class="class-fee"><?php echo esc_html($tp_course_price); ?></span>
                <span class="kb-class-tooltip-1"><?php echo esc_html__('Tution Fee', 'kidba'); ?></span>
            </div>
            <?php endif; ?>
            <?php if(has_post_thumbnail()) : ?>
                <a href="<?php echo get_the_permalink($course_id); ?>"><img src="<?php echo get_the_post_thumbnail_url($course_id, 'full'); ?>" class="w-100" alt="image"></a>
            <?php endif; ?>
        </div>
        <div class="part-txt p-40 px-30">
            <?php tp_core_post_category_list_by_id($course_id, $taxonomy); ?>
            <h3 class="class-title mt--7 mb-6 name"><a href="<?php echo get_the_permalink($course_id); ?>"><?php echo get_the_title(); ?></a></h3>
            <p class="mt--8 mb--8"><?php echo wp_trim_words(get_the_excerpt(), 13); ?></p>
            <div class="class-info mt-30 d-flex justify-content-between">
                <?php if(!empty($_tutor_course_level)) : ?>
                <div class="box box-1 text-center">
                    <span class="amount d-block fz-18 color-3 fw-bold mt--8 mb--8"><?php echo esc_html($_tutor_course_level); ?></span>
                </div>
                <?php endif; ?>
                <div class="vertical-border"></div>
                <?php if(!empty($course_duration)) : ?>
                <div class="box box-1 text-center">
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
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php }