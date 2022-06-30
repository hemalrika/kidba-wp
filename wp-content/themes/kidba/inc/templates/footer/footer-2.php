<?php 
$kidba_footer_logo = get_theme_mod( 'kidba_footer_logo' );

/*
cmt_section_footer_1: start section Footer 1
*/
$footer_bg_image_2 = get_theme_mod('footer_bg_image_2', get_template_directory_uri() . '/assets/img/logo/logo.png');
$footer_bg_color_2 = get_theme_mod('footer_bg_color_2', __('#1a1a1a', 'kidba') );
$kidba_copyright_2 = get_theme_mod('kidba_copyright_2');
$kidba_footer_topbar_switch_2 = get_theme_mod('kidba_footer_topbar_switch_2', false);
$kidba_footer_social_menu_switch_2 = get_theme_mod('kidba_footer_social_menu_switch_2', true);
$kidba_footer_topbar_repeater_2 = get_theme_mod('kidba_footer_topbar_repeater_2', array());
$copyright_center_col_2 = $kidba_footer_social_menu_switch_2 ? 'col-xl-3 col-lg-4 order-1 order-lg-0' : 'col-12 text-center order-1 order-lg-0';
 // footer_columns_2
 $footer_columns_2 = 0;
 $footer_widget_limit_2 = get_theme_mod( 'footer_widget_limit_2', 4 );
 $footer_widget_column_2 = get_theme_mod( 'footer_widget_column_2', 4 );

 for ( $num = 1; $num <= $footer_widget_limit_2; $num++ ) {
     if ( is_active_sidebar( 'footer-' . $num ) ) {
         $footer_columns_2++;
     }
 }

 switch ( $footer_widget_limit_2 ) {
     case '2':
        switch($footer_widget_column_2) {
            case '2':
                $footer_class_2[1] = 'col-lg-6 col-md-6';
                $footer_class_2[2] = 'col-lg-6 col-md-6';
                $footer_class_2[3] = 'col-lg-6 col-md-6';
                $footer_class_2[4] = 'col-lg-6 col-md-6';
                break;
            default:
                $footer_class_2[1] = 'col-lg-6 col-md-6 col-sm-6 kidba_footer_info';
                $footer_class_2[2] = 'col-lg-6 col-md-6 col-sm-6 footer_widget_list pl-90';
                $footer_class_2[3] = 'col-lg-6 col-md-6 col-sm-6 footer_widget_list';
                $footer_class_2[4] = 'col-lg-6 col-md-6 col-sm-6';
            break;
        }
        break;
    case '3':
        switch($footer_widget_column_2) {
            case '2':
                $footer_class_2[1] = 'col-lg-6 col-md-6';
                $footer_class_2[2] = 'col-lg-6 col-md-6';
                $footer_class_2[3] = 'col-lg-6 col-md-6';
                $footer_class_2[4] = 'col-lg-6 col-md-6';
                break;
            case '3':
                $footer_class_2[1] = 'col-xl-4 col-lg-6 col-md-5';
                $footer_class_2[2] = 'col-xl-4 col-lg-6 col-md-7';
                $footer_class_2[3] = 'col-xl-4 col-lg-6';
                break;
            default:
                $footer_class_2[1] = 'col-lg-4 col-md-6 col-sm-6 kidba_footer_info';
                $footer_class_2[2] = 'col-lg-4 col-md-6 col-sm-6 footer_widget_list pl-90';
                $footer_class_2[3] = 'col-lg-4 col-md-6 col-sm-6 footer_widget_list';
                $footer_class_2[4] = 'col-lg-4 col-md-6 col-sm-6';
            break;
        }
        break;
    case '4':
        switch($footer_widget_column_2) {
            case '2':
                $footer_class_2[1] = 'col-lg-6 col-md-6';
                $footer_class_2[2] = 'col-lg-6 col-md-6';
                $footer_class_2[3] = 'col-lg-6 col-md-6';
                $footer_class_2[4] = 'col-lg-6 col-md-6';
                break;
            case '3':
                $footer_class_2[1] = 'col-xl-4 col-lg-6 col-md-5';
                $footer_class_2[2] = 'col-xl-4 col-lg-6 col-md-7';
                $footer_class_2[3] = 'col-xl-4 col-lg-6';
                $footer_class_2[4] = 'col-xl-4 col-lg-6';
                break;
            case '4':
                $footer_class_2[1] = 'col-xl-4 col-lg-3 col-sm-6';
                $footer_class_2[2] = 'col-xl-2 col-lg-3 col-sm-6';
                $footer_class_2[3] = 'col-xl-2 col-lg-2 col-sm-6';
                $footer_class_2[4] = 'col-xl-4 col-lg-4 col-sm-6';
                break;
            default:
                $footer_class_2[1] = 'col-xl-4 col-lg-3 col-sm-6';
                $footer_class_2[2] = 'col-xl-2 col-lg-3 col-sm-6';
                $footer_class_2[3] = 'col-xl-2 col-lg-2 col-sm-6';
                $footer_class_2[4] = 'col-xl-4 col-lg-4 col-sm-6';
            break;
        }
        break;
     default:
         $footer_class_2 = 'col-xl-3 col-lg-3 col-md-6';
         break;
 } 
 
 ?>


<div class="footer-2 kidba-footer-2" data-background="<?php echo esc_url($footer_bg_image_2); ?>" data-bg-color="<?php echo esc_attr($footer_bg_color_2); ?>">
    <div class="footer-2-wrapper">
            <?php if(!empty($kidba_footer_topbar_switch_2)) : ?>
                <div class="footer-info">
                    <div class="container">
                        <?php if(!empty($kidba_footer_topbar_repeater_2)) : ?>
                            <div class="row g-0">
                                <?php foreach($kidba_footer_topbar_repeater_2 as $key_2 => $topbar_single_2) : ?>
                                <div class="col-xl-4 col-lg-4">
                                    <div class="footer-single-info p-35 px-30 d-flex align-items-center <?php echo $key_2 > 0 ? esc_attr__('border-l', 'kidba'): ''; ?>">
                                        <?php if(!empty($topbar_single_2['contact_icon'])) : ?>
                                        <div class="footer-info-icon-wrap mr-20">
                                            <i class="icofont-<?php echo esc_attr($topbar_single_2['contact_icon']); ?>"></i>
                                        </div>
                                        <?php endif; ?>
                                        <div class="footer-info-txt-area">
                                            <?php if(!empty($topbar_single_2['contact_label'])) : ?>
                                                <p class="footer-info-title text-white mt--1 mb-11"><?php echo esc_html($topbar_single_2['contact_label']) ?></p>
                                            <?php endif; ?>
                                            <?php if(!empty($topbar_single_2['contact_number'])) : ?>
                                                <h4 class="footer-info-txt text-white mb--3"><a href="tel:<?php echo $topbar_single_2['contact_link'] ? $topbar_single_2['contact_link']: '#'; ?>"><?php echo esc_html($topbar_single_2['contact_number']) ?></a></h4>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $key_2 += 1; endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="main-footer pt-120 pb-70">
                    <div class="row">
                        <?php
                            for ( $num = 1; $num <= $footer_columns_2; $num++ ) {
                                if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class_2[$num] ) . '">';
                                dynamic_sidebar( 'footer-' . $num );
                                print '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
    </div>
    <?php if(!empty($kidba_copyright_2 || $kidba_footer_social_menu_switch_2)) : ?>
    <div class="bottom-footer p-30">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="<?php echo esc_attr($copyright_center_col_2); ?>">
                <?php kidba_copyright_2_text(); ?>
                </div>
                <?php if( !empty($kidba_footer_social_menu_switch_2) ) : ?>
                <div class="col-xl-8 col-lg-8 order-0 order-lg-1">
                    <div class="footer-social-box d-flex justify-content-end">
                        <?php kidba_footer_social(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>