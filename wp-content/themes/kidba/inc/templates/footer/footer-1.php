<?php 
$kidba_footer_logo = get_theme_mod( 'kidba_footer_logo' );

/*
cmt_section_footer_1: start section Footer 1
*/
$footer_bg_image = get_theme_mod('footer_bg_image', get_template_directory_uri() . '/assets/img/logo/logo.png');
$footer_bg_color = get_theme_mod('footer_bg_color', __('#1a1a1a', 'kidba') );
$kidba_copyright = get_theme_mod('kidba_copyright');
$kidba_footer_topbar_switch = get_theme_mod('kidba_footer_topbar_switch', false);
$kidba_footer_social_menu_switch = get_theme_mod('kidba_footer_social_menu_switch', true);
$kidba_footer_topbar_repeater = get_theme_mod('kidba_footer_topbar_repeater', array());
$copyright_center_col = $kidba_footer_social_menu_switch ? 'col-xl-3 col-lg-4 order-1 order-lg-0' : 'col-12 text-center order-1 order-lg-0';
 // footer_columns
 $footer_columns = 0;
 $footer_widget_limit = get_theme_mod( 'footer_widget_limit', 4 );
 $footer_widget_column = get_theme_mod( 'footer_widget_column', 4 );

 for ( $num = 1; $num <= $footer_widget_limit; $num++ ) {
     if ( is_active_sidebar( 'footer-' . $num ) ) {
         $footer_columns++;
     }
 }

 switch ( $footer_widget_limit ) {
     case '2':
        switch($footer_widget_column) {
            case '2':
                $footer_class[1] = 'col-lg-6 col-md-6';
                $footer_class[2] = 'col-lg-6 col-md-6';
                $footer_class[3] = 'col-lg-6 col-md-6';
                $footer_class[4] = 'col-lg-6 col-md-6';
                break;
            default:
                $footer_class[1] = 'col-lg-6 col-md-6 col-sm-6 kidba_footer_info';
                $footer_class[2] = 'col-lg-6 col-md-6 col-sm-6 footer_widget_list pl-90';
                $footer_class[3] = 'col-lg-6 col-md-6 col-sm-6 footer_widget_list';
                $footer_class[4] = 'col-lg-6 col-md-6 col-sm-6';
            break;
        }
        break;
    case '3':
        switch($footer_widget_column) {
            case '2':
                $footer_class[1] = 'col-lg-6 col-md-6';
                $footer_class[2] = 'col-lg-6 col-md-6';
                $footer_class[3] = 'col-lg-6 col-md-6';
                $footer_class[4] = 'col-lg-6 col-md-6';
                break;
            case '3':
                $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
                $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
                $footer_class[3] = 'col-xl-4 col-lg-6';
                break;
            default:
                $footer_class[1] = 'col-lg-4 col-md-6 col-sm-6 kidba_footer_info';
                $footer_class[2] = 'col-lg-4 col-md-6 col-sm-6 footer_widget_list pl-90';
                $footer_class[3] = 'col-lg-4 col-md-6 col-sm-6 footer_widget_list';
                $footer_class[4] = 'col-lg-4 col-md-6 col-sm-6';
            break;
        }
        break;
    case '4':
        switch($footer_widget_column) {
            case '2':
                $footer_class[1] = 'col-lg-6 col-md-6';
                $footer_class[2] = 'col-lg-6 col-md-6';
                $footer_class[3] = 'col-lg-6 col-md-6';
                $footer_class[4] = 'col-lg-6 col-md-6';
                break;
            case '3':
                $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
                $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
                $footer_class[3] = 'col-xl-4 col-lg-6';
                $footer_class[4] = 'col-xl-4 col-lg-6';
                break;
            case '4':
                $footer_class[1] = 'col-xl-4 col-lg-3 col-sm-6';
                $footer_class[2] = 'col-xl-2 col-lg-3 col-sm-6';
                $footer_class[3] = 'col-xl-2 col-lg-2 col-sm-6';
                $footer_class[4] = 'col-xl-4 col-lg-4 col-sm-6';
                break;
            default:
                $footer_class[1] = 'col-xl-4 col-lg-3 col-sm-6';
                $footer_class[2] = 'col-xl-2 col-lg-3 col-sm-6';
                $footer_class[3] = 'col-xl-2 col-lg-2 col-sm-6';
                $footer_class[4] = 'col-xl-4 col-lg-4 col-sm-6';
            break;
        }
        break;
     default:
         $footer_class = 'col-xl-3 col-lg-3 col-md-6';
         break;
 } 
 
 ?>
<!-- kidba_footer_area-start -->
<div class="footer kidba-footer-1" data-background="<?php echo esc_url($footer_bg_image); ?>" data-bg-color="<?php echo esc_attr($footer_bg_color); ?>">
    <div class="container">
        <?php if(!empty($kidba_footer_topbar_switch)) : ?>
        <div class="footer-info">
            <?php if(!empty($kidba_footer_topbar_repeater)) : ?>
            <div class="row g-0">
                <?php foreach($kidba_footer_topbar_repeater as $key => $topbar_single) : ?>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="footer-single-info p-35 px-30 d-flex align-items-center <?php echo $key > 0 ? esc_attr__('border-l', 'kidba'): ''; ?>">
                            <?php if(!empty($topbar_single['contact_icon'])) : ?>
                            <div class="footer-info-icon-wrap mr-20">
                                <i class="icofont-<?php echo esc_attr($topbar_single['contact_icon']); ?>"></i>
                            </div>
                            <?php endif; ?>
                            <div class="footer-info-txt-area">
                                <?php if(!empty($topbar_single['contact_label'])) : ?>
                                    <p class="footer-info-title text-white mt--1 mb-11"><?php echo esc_html($topbar_single['contact_label']) ?></p>
                                <?php endif; ?>
                                <?php if(!empty($topbar_single['contact_number'])) : ?>
                                    <h4 class="footer-info-txt text-white mb--3"><a href="tel:<?php echo $topbar_single['contact_link'] ? $topbar_single['contact_link']: '#'; ?>"><?php echo esc_html($topbar_single['contact_number']) ?></a></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $key += 1; endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
        <div class="main-footer pt-120 pb-70">
            <div class="row">
                <?php
                for ( $num = 1; $num <= $footer_columns; $num++ ) {
                    if ( !is_active_sidebar( 'footer-' . $num ) ) {
                        continue;
                    }
                    print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                    dynamic_sidebar( 'footer-' . $num );
                    print '</div>';
                }
                ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php if(!empty($kidba_copyright || $kidba_footer_social_menu_switch)) : ?>
    <div class="bottom-footer p-30">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="<?php echo esc_attr($copyright_center_col); ?>">
                <?php kidba_copyright_text(); ?>
                </div>
                <?php if( !empty($kidba_footer_social_menu_switch) ) : ?>
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
</div>
<!-- kidba_footer_area-end -->