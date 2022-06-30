<?php foreach ( $reviews as $review ) :
    $avatar_img = get_avatar($review->user_id);
?>
    <?php $profile_url = tutor_utils()->profile_url( $review->user_id, false ); ?>
    <div class="class-comment mb-15">
        <?php if(!empty($avatar_img)) : ?>
        <div class="class-comment-img mr-30">
            <?php echo $avatar_img; ?>
        </div>
        <?php endif; ?>
        <div class="class-comment-txt">
            <?php if(!empty( $review->comment_author)) : ?>
                <h4 class="class-comment-username mt--1 mb-15"><?php echo esc_html( $review->comment_author); ?></h4>
                <?php endif; ?>
                <?php tutor_utils()->star_rating_generator_v2( $review->rating, null, true, 'tutor-is-sm' ); ?>
            <p class="class-comment-details mb-15"><?php echo htmlspecialchars( $review->comment_content ); ?></p>
            <div class="class-comment-actions">
                <?php echo sprintf( __( '%s ago', 'tutor' ), human_time_diff( strtotime( $review->comment_date ) ) ); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>