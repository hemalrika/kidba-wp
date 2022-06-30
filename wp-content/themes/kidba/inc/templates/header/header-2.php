<?php 
    /*
    cmt_section_header_2: start header 2 section
    */
    $kidba_header2_main_right_switch = get_theme_mod( 'kidba_header2_main_right_switch', false );
    $kidba_header_cart_switcher_2 = get_theme_mod( 'kidba_header_cart_switcher_2', true );
    $kidba_menu_col2 = $kidba_header2_main_right_switch ? 'col-xl-7 col-lg-7' : 'col-xl-10 col-lg-10';
    $kidba_menu_position2 = $kidba_header2_main_right_switch ? 'justify-content-center' : 'justify-content-end';
    $kidba_header_main_button_text_2 = get_theme_mod( 'kidba_header_main_button_text_2', __('Admit Now', 'kidba') );
    $kidba_header_main_button_link_2 = get_theme_mod( 'kidba_header_main_button_link_2', __('#', 'kidba') );
    $kidba_header_main_icon_2 = get_theme_mod( 'kidba_header_main_icon_2', __('shopping-cart', 'kidba') );
    $kidba_header_main_cart_text_2 = get_theme_mod( 'kidba_header_main_cart_text_2');

?>


<!-- header begin -->
<div class="header-2 header-style-1 pt-30 pb-30">
    <div class="header-container style-2 m-auto px-15">
        <div class="row g-0 align-items-center">
            <div class="col-xl-2 col-lg-2">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-6">
                    <div class="logo">
                        <a href="<?php echo esc_url(site_url('/')); ?>">
                            <?php kidba_header2_logo(); ?>
                        </a>
                    </div>
                    </div>
                    <div class="d-lg-none d-flex justify-content-end align-items-center col-6">
                        <div class="kidba-header-sm-cart-btn">
                            <?php if(!empty($kidba_header_cart_switcher_2)) : ?>
                            <div class="nav-cart d-flex align-items-center mr-40 d-inline-bblock">
                                <a href="#" class="nav-cart-icon d-flex justify-content-center align-items-center">
                                    <i class="icofont-<?php echo esc_attr($kidba_header_main_icon_2); ?>"></i>
                                    <span class="item_count"><?php echo esc_html__('05', 'kidba'); ?></span>
                                    <?php if(!empty($kidba_header_main_cart_text_2)) : ?>
                                        <span class="text"><?php echo esc_html($kidba_header_main_cart_text_2); ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- /. cart btn -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="icofont-navigation-menu"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="<?php echo esc_attr($kidba_menu_col2); ?>">
                <nav class="navbar navbar-expand-lg p-0">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse <?php echo esc_attr($kidba_menu_position2); ?>" id="navbarSupportedContent">
                            <?php kidba_header_menu_2(); ?>
                        </div>
                    </div>
                </nav>
            </div>
            <?php if(!empty($kidba_header2_main_right_switch)) : ?>
            <div class="col-xl-3 col-lg-3 d-lg-block d-none">
                <div class="nav-btn d-flex justify-content-end">
                    <?php if(!empty($kidba_header_cart_switcher_2)) : ?>
                    <div class="nav-cart d-flex align-items-center mr-40 d-inline-bblock">
                        <a href="#" class="nav-cart-icon d-flex justify-content-center align-items-center">
                            <i class="icofont-<?php echo esc_attr($kidba_header_main_icon_2); ?>"></i>
                            <span class="item_count"><?php echo esc_html__('05', 'kidba'); ?></span>
                            <?php if(!empty($kidba_header_main_cart_text_2)) : ?>
                                <span class="text"><?php echo esc_html($kidba_header_main_cart_text_2); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($kidba_header_main_button_text_2)) : ?>
                    <a href="<?php echo esc_url($kidba_header_main_button_link_2); ?>" class="def-btn"><?php echo esc_html($kidba_header_main_button_text_2); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- header end -->