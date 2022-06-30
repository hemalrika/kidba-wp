<?php
    use TUTOR\Input;
	// Utility data
    global $post, $authordata;
	$is_enrolled           = apply_filters( 'tutor_alter_enroll_status', tutor_utils()->is_enrolled() );
	$lesson_url            = tutor_utils()->get_course_first_lesson();
	$is_administrator      = tutor_utils()->has_user_role( 'administrator' );
    $author_info = tutor_utils()->get_tutor_user( get_the_author_meta('ID') );
    $author_name = $author_info->display_name;
    $completed_lessons = tutor_utils()->get_lesson_count_by_course();
    $profile_url        = tutor_utils()->profile_url( $authordata->ID, true );
    $course_id = get_the_ID();
    $paged    = Input::get( 'paged', 1, Input::TYPE_INT );
    $per_page = tutor_utils()->get_option( 'pagination_per_page' );
    $offset   = ( $per_page * $paged ) - $per_page;
    $date		= Input::has( 'date' ) ? tutor_get_formated_date( 'Y-m-d' , Input::get( 'date' ) ) : '';
    $search		= Input::get( 'search', '' );
    $toal_student = 0;
    $toal_student     		= tutor_utils()->get_total_students( $search, $course_id, $date );
	$is_instructor         = tutor_utils()->is_instructor_of_this_course();
	$course_content_access = (bool) get_tutor_option( 'course_content_access_for_ia' );
	$is_privileged_user    = $course_content_access && ( $is_administrator || $is_instructor );
	$tutor_course_sell_by  = apply_filters( 'tutor_course_sell_by', null );
	$is_public             = get_post_meta( get_the_ID(), '_tutor_is_public_course', true ) == 'yes';
    $course_duration = get_post_meta($course_id, '_course_duration', true);
    $course_hours = $course_duration['hours'];
    $course_min = $course_duration['minutes'];
    $course_sec = $course_duration['seconds'];
    
	// Monetization info
	$monetize_by              = tutor_utils()->get_option( 'monetize_by' );
	$is_purchasable           = tutor_utils()->is_course_purchasable();

	// Get login url if
	$is_tutor_login_disabled = ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true );
	$auth_url                = $is_tutor_login_disabled ? ( isset( $_SERVER['REQUEST_SCHEME'] ) ? wp_login_url( $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) : '' ) : '';
	$default_meta = array(
		array(
			'icon_class' => 'tutor-icon-mortarboard',
			'label'      => __( 'Total Enrolled', 'tutor' ),
			'value'      => tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() . ' ' . __("Total Enrolled", "tutor") : null,
		),
		array(
			'icon_class' => 'tutor-icon-clock-line',
			'label'      => __( 'Duration', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_duration' ) ? ( get_tutor_course_duration_context() ? get_tutor_course_duration_context() . ' ' . __("Duration", "tutor") : false ) : null,
		),
		array(
			'icon_class' => 'tutor-icon-refresh-o',
			'label'      => __( 'Last Updated', 'tutor' ),
			'value'      => get_tutor_option( 'enable_course_update_date' ) ? get_the_modified_date( get_option( 'date_format' ) ) . ' ' . __("Last Updated", "tutor") : null,
		),
	);

	// Add level if enabled
	if(tutor_utils()->get_option('enable_course_level', true, true)) {
		array_unshift($default_meta, array(
			'icon_class' => 'tutor-icon-level',
			'label'      => __( 'Level', 'tutor' ),
			'value'      => get_tutor_course_level( get_the_ID() ),
		));
	}

	// Right sidebar meta data
	$sidebar_meta = apply_filters('tutor/course/single/sidebar/metadata', $default_meta, get_the_ID() );
	$login_url = tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ? '' : wp_login_url( tutor()->current_url );
?>

<div class="tutor-cards tutor-card-md tutor-sidebar-card">
	<div class="tutor-card-bodys">
		<?php
		if ( $is_enrolled || $is_privileged_user) {
			ob_start();

			// Course Info
			$completed_percent   = tutor_utils()->get_course_completed_percent();
			$is_completed_course = tutor_utils()->is_completed_course();
			$retake_course       = tutor_utils()->can_user_retake_course();
			$course_id           = get_the_ID();
			$course_progress     = tutor_utils()->get_course_completed_percent( $course_id, 0, true );
			?>
			<!-- course progress -->
			<?php if ( tutor_utils()->get_option('enable_course_progress_bar', true, true) && is_array( $course_progress ) && count( $course_progress ) ) : ?>
                <div class="sidebar-box px-30 p-30 mb-40">
                    <div class="course__video">
                        <div class="course__video-thumb w-img mb-25">
                            <?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
                        </div>
                        <div class="tutor-course-progress-wrapper tutor-mb-32">
                            <h3 class="tutor-color-black tutor-fs-5 tutor-fw-bold tutor-mb-16">
                                <?php esc_html_e( 'Course Progress', 'tutor' ); ?>
                            </h3>
                            <div class="list-item-progress">
                                <div class="tutor-fs-6 tutor-color-secondary tutor-d-flex tutor-align-center tutor-justify-between">
                                    <span class="progress-steps">
                                        <?php echo esc_html( $course_progress['completed_count'] ); ?>/
                                        <?php echo esc_html( $course_progress['total_count'] ); ?>
                                    </span>
                                    <span class="progress-percentage">
                                        <?php echo esc_html( $course_progress['completed_percent'] . '%' ); ?>
                                        <?php esc_html_e( 'Complete', 'tutor' ); ?>
                                    </span>
                                </div>
                                <div class="tutor-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $course_progress['completed_percent'] ); ?>%;">
                                    <span class="tutor-progress-value" area-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            $start_content = '';
                            // The user is enrolled anyway. No matter manual, free, purchased, woocommerce, edd, membership
                            do_action( 'tutor_course/single/actions_btn_group/before' );
                            // Show Start/Continue/Retake Button
                            if ( $lesson_url ) {
                                $button_class = 'tutor-btn def-btn border-0 d-block' .
                                                ( $retake_course ? 'tutor-btn-outline-primary' : 'tutor-btn-primary' ) .
                                                ' tutor-btn-block' .
                                                ( $retake_course ? ' tutor-course-retake-button' : '' );

                                // Button identifier class
                                $button_identifier = 'start-continue-retake-button';
                                $tag               = $retake_course ? 'button' : 'a';
                                ob_start();
                                ?>
                                    <<?php echo $tag; ?> <?php echo $retake_course ? 'disabled="disabled"' : ''; ?> href="<?php echo esc_url( $lesson_url ); ?>" class="<?php echo esc_attr( $button_class . ' ' . $button_identifier ); ?>" data-course_id="<?php echo esc_attr( get_the_ID() ); ?>">
                                    <?php
                                    if ( $retake_course ) {
                                        esc_html_e( 'Retake This Course', 'tutor' );
                                    } elseif ( $completed_percent <= 0 ) {
                                        esc_html_e( 'Start Learning', 'tutor' );
                                    } else {
                                        esc_html_e( 'Continue Learning', 'tutor' );
                                    }
                                    ?>
                                    </<?php echo $tag; ?>>
                                    <?php
                                    $start_content = ob_get_clean();
                            }
                            echo apply_filters( 'tutor_course/single/start/button', $start_content, get_the_ID() );?>
                        <?php
                        // Show Course Completion Button.
                        if ( ! $is_completed_course ) {
                            ob_start();
                            ?>
                            <form method="post" class="tutor-mt-20">
                                <?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>

                                <input type="hidden" value="<?php echo esc_attr( get_the_ID() ); ?>" name="course_id"/>
                                <input type="hidden" value="tutor_complete_course" name="tutor_action"/>

                                <button type="submit" class="def-btn border-0 d-block tutor-btn tutor-btn-outline-primary tutor-btn-block" name="complete_course_btn" value="complete_course">
                                    <?php esc_html_e( 'Complete Course', 'tutor' ); ?>
                                </button>
                            </form>
                            <?php
                            echo apply_filters( 'tutor_course/single/complete_form', ob_get_clean() );
                        }
                        ?>
                        <?php
                            // check if has enrolled date.
                            $post_date = is_object( $is_enrolled ) && isset( $is_enrolled->post_date ) ? $is_enrolled->post_date : '';
                            if ( '' !== $post_date ) :
                            ?>
                            <div class="tutor-fs-7 tutor-color-muted tutor-mt-20 tutor-d-flex">
                                <span class="tutor-fs-5 tutor-color-success tutor-icon-purchase-mark tutor-mr-8"></span>
                                <span class="tutor-enrolled-info-text">
                                    <?php esc_html_e( 'You enrolled in this course on', 'tutor' ); ?>
                                    <span class="tutor-fs-7 tutor-fw-bold tutor-color-success tutor-ml-4 tutor-enrolled-info-date">
                                        <?php
                                            echo esc_html( tutor_i18n_get_formated_date( $post_date, get_option( 'date_format' ) ) );
                                        ?>
                                    </span>
                                </span>
                            </div>
                        <?php endif; ?>
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
                            <button type="submit" class="def-btn border-0 d-block tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-enroll-course-button tutor-static-loader">
                                <?php esc_html_e( 'Enroll now', 'tutor' ); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
			<?php endif; ?>
			<?php
			do_action( 'tutor_course/single/actions_btn_group/after' );
			echo apply_filters( 'tutor/course/single/entry-box/is_enrolled', ob_get_clean(), get_the_ID() );
		} else if ( $is_public ) {
			// Get the first content url
			$first_lesson_url = tutor_utils()->get_course_first_lesson( get_the_ID(), tutor()->lesson_post_type );
			!$first_lesson_url ? $first_lesson_url = tutor_utils()->get_course_first_lesson( get_the_ID() ) : 0;
			ob_start();
			?>
				<a href="<?php echo esc_url( $first_lesson_url ); ?>" class="tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block">
					<?php esc_html_e( 'Start Learning', 'tutor' ); ?>
				</a>
			<?php
			echo apply_filters( 'tutor/course/single/entry-box/is_public', ob_get_clean(), get_the_ID() );
		} else {
			// The course enroll options like purchase or free enrolment
			$price = apply_filters( 'get_tutor_course_price', null, get_the_ID() );

			if ( tutor_utils()->is_course_fully_booked( null ) ) {
				ob_start();
				?>
					<div class="tutor-alert tutor-warning tutor-mt-28">
						<div class="tutor-alert-text">
							<span class="tutor-icon-circle-info tutor-alert-icon tutor-mr-12" area-hidden="true"></span>
							<span>
								<?php esc_html_e( 'This course is full right now. We limit the number of students to create an optimized and productive group dynamic.', 'tutor' ); ?>
							</span>
						</div>
					</div>
				<?php
				echo apply_filters( 'tutor/course/single/entry-box/fully_booked', ob_get_clean(), get_the_ID() );
			} elseif ( $is_purchasable && $price && $tutor_course_sell_by ) {
				// Load template based on monetization option
				ob_start();
				tutor_load_template( 'single.course.add-to-cart-' . $tutor_course_sell_by );
				echo apply_filters( 'tutor/course/single/entry-box/purchasable', ob_get_clean(), get_the_ID() );
			} else {
				ob_start();
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
								<button type="submit" class="def-btn border-0 d-block tutor-btn tutor-btn-primary tutor-btn-lg tutor-btn-block tutor-mt-24 tutor-enroll-course-button tutor-static-loader">
									<?php esc_html_e( 'Enroll now', 'tutor' ); ?>
								</button>
							</form>
						</div>
                        </div>
					</div>
				<?php
				echo apply_filters( 'tutor/course/single/entry-box/free', ob_get_clean(), get_the_ID() );
			}
		}

		do_action('tutor_course/single/entry/after', get_the_ID());
		?>
	</div>
<?php
if ( ! is_user_logged_in() ) {
	tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php' );
}
?>
