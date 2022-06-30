<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package kidba
 */

/** 
 *
 * kidba header
 */

function kidba_check_header() {
    $kidba_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $kidba_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $kidba_header_style == 'header-style-1' && empty($_GET['s']) ) {
        kidba_header_style_1();
    } 
    elseif ( $kidba_header_style == 'header-style-2' && empty($_GET['s']) ) {
        kidba_header_style_2();
    } 
    else {
        /** default header style **/
        if ( $kidba_default_header_style == 'header-style-2' ) {
            kidba_header_style_2();
        } 
        else {
            kidba_header_style_1();
        }
    }

}
add_action( 'kidba_header_style', 'kidba_check_header', 10 );


// Header deafult
function kidba_header_style_1() {
   get_template_part( '/inc/templates/header/header', '1' ); ?>
   <div class="offwrap"></div>
   <!-- sidebar area end -->

<?php
}



/**
 * header style 2
 */
 function kidba_header_style_2() { ?>

   <?php get_template_part( '/inc/templates/header/header', '2' );  ?>
   <!-- side info end -->     
   <div class="offwrap"></div>
   <!-- sidebar area end -->

<?php
}

// kidba_side_info
function kidba_side_info() {

   $kidba_side_logo = get_theme_mod('kidba_side_logo', get_template_directory_uri() . '/assets/img/logo/logo.png');
   $kidba_side_contact_switcher = get_theme_mod('kidba_side_contact_switcher', false);
    $kidba_side_contact_title = get_theme_mod( 'kidba_side_contact_title', __( 'Contact Info', 'kidba' ) );
    $kidba_side_contact_address = get_theme_mod( 'kidba_side_contact_address', __( '12/A, Mirnada City Tower, NYC', 'kidba' ) );
    $kidba_side_contact_phone = get_theme_mod( 'kidba_side_contact_phone', __( '088889797697', 'kidba' ) );
    $kidba_side_contact_phone_link = get_theme_mod( 'kidba_side_contact_phone_link', __( '088889797697', 'kidba' ) );
    $kidba_side_mail = get_theme_mod( 'kidba_side_mail', __( 'info@kidba.com', 'kidba' ) );
    $kidba_side_mail_link = get_theme_mod( 'kidba_side_mail_link', __( 'info@kidba.com', 'kidba' ) );
   
   $kidba_side_contact_switcher = get_theme_mod('kidba_side_contact_switcher', false);
   $kidba_side_social_fb_link = get_theme_mod('kidba_side_social_fb_link', 'kidba');
   $kidba_side_social_twitter_link = get_theme_mod('kidba_side_social_twitter_link', 'kidba');
   $kidba_side_social_linkedin_link = get_theme_mod('kidba_side_social_linkedin_link', 'kidba');
   $kidba_side_social_youtube_link = get_theme_mod('kidba_side_social_youtube_link', 'kidba');

?>
    
   <!-- sidebar area start -->
    <nav class="right_menu_togle">

      <div class="offset-widget offset-logo mb-30 pb-20">
          <div class="row align-items-center justify-content-center">
              <?php if( !empty($kidba_side_logo) ) : ?>
              <div class="col-8">
                <a href="<?php print esc_url( home_url( '/' ) );?>" class="mobile_logo">
                  <img src="<?php print esc_url($kidba_side_logo); ?>" alt="<?php print esc_attr__('Side Logo', 'kidba'); ?>">
                </a>
              </div>
              <?php endif; ?>
              <div class="col-4 text-end">
                <button id="nav-close" class="nav-close"><i class="fal fa-times"></i></button>
              </div>
          </div>
          
      </div>

      <div class="mobile_menu fix"></div>

      <div class="contact-infos mt-40">
          <?php if( !empty($kidba_side_contact_switcher) ) : ?>
          <div class="contact-list mobile_contact mb-40">
              <?php if( !empty($kidba_side_contact_title) ) : ?>
              <h4><?php print esc_html($kidba_side_contact_title); ?></h4>
              <?php endif; ?>
              <?php if( !empty($kidba_side_contact_address) ) : ?>
              <span class="sidebar-address"><i class="fal fa-map-marker-alt"></i><span><?php print esc_html($kidba_side_contact_address); ?></span> </span>
              <?php endif; ?>
              <?php if( !empty($kidba_side_contact_phone) ) : ?>
              <a href="tel:<?php print esc_attr($kidba_side_contact_phone_link); ?>"><i class="fal fa-phone"></i><span><?php print esc_html($kidba_side_contact_phone); ?></span></a>
              <?php endif; ?>
              <?php if( !empty($kidba_side_mail) ) : ?>
              <a href="mailto:<?php print esc_attr($kidba_side_mail_link); ?>" class="theme-3"><i class="far fa-envelope"></i><span><span><?php print esc_html($kidba_side_mail); ?></span></span></a>   
              <?php endif; ?>

          </div>
          <?php endif; ?>

          <?php if(!empty($kidba_side_contact_switcher)) : ?>
          <div class="top_social footer_social offset_social mt-40 mb-30">
              <?php if(!empty($kidba_side_social_fb_link)) : ?>
              <a href="<?php print esc_attr($kidba_side_social_fb_link); ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
              <?php endif; ?>
              <?php if(!empty($kidba_side_social_twitter_link)) : ?>
              <a href="<?php print esc_attr($kidba_side_social_twitter_link); ?>" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
              <?php endif; ?>
              <?php if(!empty($kidba_side_social_linkedin_link)) : ?>
              <a href="<?php print esc_attr($kidba_side_social_linkedin_link); ?>" target="_blank" class="linkedin"><i class="fab fa-linkedin"></i></a>
              <?php endif; ?>
              <?php if(!empty($kidba_side_social_youtube_link)) : ?>
              <a href="<?php print esc_attr($kidba_side_social_youtube_link); ?>" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
              <?php endif; ?>
          </div>
          <?php endif; ?>
      </div>

    </nav>
   <!-- sidebar area end -->
<?php }


/**
 * [kidba_language_list description]
 * @return [type] [description]
 */
function _kidba_language( $mar ) {
    return $mar;
}
function kidba_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul>';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__( 'USA', 'kidba' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'UK', 'kidba' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'CA', 'kidba' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'AU', 'kidba' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _kidba_language( $mar );
}
add_action( 'kidba_language', 'kidba_language_list' );

// favicon logo
function kidba_favicon_logo_func() {
        $kidba_favicon = get_template_directory_uri() . '/assets/img/favicon.png';
        $kidba_favicon_url = get_theme_mod( 'favicon_url', $kidba_favicon );
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $kidba_favicon_url );?>">

    <?php
}
add_action( 'wp_head', 'kidba_favicon_logo_func' );

/*
header_logo
*/
function kidba_header_logo() {
    ?>
    <?php
    $logo_image = get_theme_mod( 'logo_image', get_template_directory_uri() . '/assets/images/logo.png');
    $logo_text = get_theme_mod( 'logo_text', __('Kidba', 'kidba') );
    $kidba_header_main_logoset = get_theme_mod( 'kidba_header_main_logoset', __('image', 'kidba') );
    ?>

      <?php
          if ( has_custom_logo() ) {
              the_custom_logo();
          } else {
            if($kidba_header_main_logoset == 'image') {
                if(!empty($logo_image)) : ?>
                    <img src="<?php echo esc_url($logo_image) ?>" alt="<?php echo esc_attr__('KIDBA', 'kidba'); ?>">
                <?php endif;
            } else { ?>
                <?php if(!empty($logo_text)) : ?>
                    <span><?php echo esc_html($logo_text); ?></span>
                <?php endif; ?>
              <?php
            }
          } 
      ?>
    <?php
}
function kidba_header2_logo() {
    ?>
    <?php
        $logo_image2 = get_theme_mod( 'logo_image2', get_template_directory_uri() . '/assets/images/logo.png');
        $logo_text2 = get_theme_mod( 'logo_text2', __('Kidba', 'kidba') );
        $kidba_header2_main_logoset = get_theme_mod( 'kidba_header2_main_logoset', __('image', 'kidba') );
    ?>

      <?php
          if ( has_custom_logo() ) {
              the_custom_logo();
          } else {
            if($kidba_header2_main_logoset == 'image') {
                if(!empty($logo_image2)) : ?>
                    <img src="<?php echo esc_url($logo_image2) ?>" alt="<?php echo esc_attr__('KIDBA', 'kidba'); ?>">
                <?php endif;
            } else { ?>
                <?php if(!empty($logo_text2)) : ?>
                    <span><?php echo esc_html($logo_text2); ?></span>
                <?php endif; ?>
              <?php
            }
          } 
      ?>
    <?php
}

// header logo
function kidba_header_sticky_logo() {?>
    <?php
        $kidba_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
        $kidba_secondary_logo = get_theme_mod( 'seconday_logo', $kidba_logo_black );
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $kidba_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'kidba' );?>" />
      </a>
    <?php
}

function kidba_mobile_logo() {
    // side info
    $kidba_mobile_logo_hide = get_theme_mod( 'kidba_mobile_logo_hide', false );

    $kidba_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $kidba_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $kidba_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'kidba' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }


/**
 * [kidba_header_menu description]
 * @return [type] [description]
 */
function kidba_header_menu() {
    ?>
    <?php
        $kidba_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navbar-nav p-30 ms-0',
            'container'      => '',
            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
            'walker'         => new WP_Bootstrap_Navwalker,
            'echo'           => false
        ] );
        $kidba_menu = str_replace('menu-item-has-children', 'menu-item-has-children dropdown', $kidba_menu);
        echo $kidba_menu;

    ?>
    <?php
}
function kidba_header_menu_2() {
    ?>
    <?php
        $kidba_menu_2 = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navbar-nav',
            'container'      => '',
            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
            'walker'         => new WP_Bootstrap_Navwalker,
            'echo'           => false
        ] );
        $kidba_menu_2 = str_replace('menu-item-has-children', 'menu-item-has-children dropdown', $kidba_menu_2);
        echo $kidba_menu_2;
    ?>
    <?php
}

/**
 * [kidba_footer_menu description]
 * @return [type] [description]
 */
function kidba_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
        'walker'         => new WP_Bootstrap_Navwalker,
    ] );
}
function kidba_footer_social() {
    $tp_social_list_widget = get_theme_mod('tp_social_list_widget');
    ?>
    <?php foreach($tp_social_list_widget as $kidba_social) : ?>
        <?php if(!empty($kidba_social['social_label'])) : ?>
            <a href="<?php echo $kidba_social['social_url'] ? esc_url($kidba_social['social_url']): ''; ?>" target="_blank" class="bottom-footer-social mr-30"><span  data-bg-color="<?php echo esc_attr($kidba_social['social_color']); ?>" class="footer-social-icon mr-10"><i  class="icofont-<?php echo $kidba_social['social_icon'] ? esc_attr($kidba_social['social_icon']): '';?>"></i></span><?php echo esc_html($kidba_social['social_label']); ?></a>
        <?php endif; ?>
    <?php endforeach; ?>
<?php }

/**
 *
 * kidba footer
 */

function kidba_check_footer() {
    $kidba_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $kidba_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $kidba_footer_style == 'footer-style-1' ) {
        kidba_footer_style_1();
    } elseif ( $kidba_footer_style == 'footer-style-2' ) {
        kidba_footer_style_2();
    } elseif ( $kidba_footer_style == 'footer-style-3' ) {
        kidba_footer_style_3();
    } else {
        /** default footer style **/
        if ( $kidba_default_footer_style == 'footer-style-2' ) {
            kidba_footer_style_2();
        } elseif ( $kidba_default_footer_style == 'footer-style-3' ) {
            kidba_footer_style_3();
        } else {
            kidba_footer_style_1();
        }

    }
}
add_action( 'kidba_footer_style', 'kidba_check_footer', 10 );

/**
 * footer  style_defaut
 */
function kidba_footer_style_1() { ?>
    <?php get_template_part( '/inc/templates/footer/footer', '1' );
    ?>

<?php
}

/**
 * footer  style 2
 */
function kidba_footer_style_2() { ?>
    <?php get_template_part( '/inc/templates/footer/footer', '2' ); ?>
<?php
}

// kidba_copyright
function kidba_copyright_text() {
    $kidba_copyright = get_theme_mod('kidba_copyright', __('© 2022 kidba Designed by ThemePhi', 'kidba'));
    ?>
        <?php if( !empty($kidba_copyright) ) : ?>
            <p class="mb-0"><?php print esc_html($kidba_copyright); ?></a></p>
        <?php endif; ?>
<?php }
function kidba_copyright_2_text() {
    $kidba_copyright_2 = get_theme_mod('kidba_copyright_2', __('© 2022 kidba Designed by ThemePhi', 'kidba'));
    ?>
        <?php if( !empty($kidba_copyright_2) ) : ?>
            <p class="mb-0"><?php print esc_html($kidba_copyright_2); ?></a></p>
        <?php endif; ?>
<?php }

/**
 * [kidba_breadcrumb_func description]
 * @return [type] [description]
 */
function kidba_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;
    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image') : '';
    $select_breadcrumb_page = get_theme_mod('select_breadcrumb_page');
    $search_queried_result = get_search_query();
     $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'page',
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    $post_ids = array();
    if($query->have_posts()) {
        while($query->have_posts()) {
            $query->the_post();
            array_push($post_ids, get_the_ID());
        }
        wp_reset_query();
    }
      function get_breadcrumb_page_by_id_specific2($id)
       {
          $args = array(
              'posts_per_page' => -1,
              'post_type'      => 'page',
              'post_status' => 'publish'
          );
          $query = new WP_Query($args);
          $post_ids = array();
          if($query->have_posts()) {
              while($query->have_posts()) {
                  $query->the_post();
                  array_push($post_ids, get_the_ID());
              }
              wp_reset_query();
          }
          return $post_ids[$id];
      }
      for($i = 0;$i<count($post_ids);$i+=1) {
        $breadcrumb_title_from_page[get_breadcrumb_page_by_id_specific2($i)] = '';
        // fetch title
        $breadcrumb_title_specific  = get_theme_mod('breadcrumb_title_'.get_breadcrumb_page_by_id_specific2($i).'');
        $breadcrumb_title_from_page[get_breadcrumb_page_by_id_specific2($i)] .= get_theme_mod('breadcrumb_title_'.get_breadcrumb_page_by_id_specific2($i).'');
      }
      $title_from_customizer = get_the_title();
      if(!is_home() && !is_archive() && !is_single() && !is_404() && !is_search()) {
        $breadcrumb_title_specific = get_theme_mod('breadcrumb_title_'.$select_breadcrumb_page.'');
        $breadcrumb_title = $breadcrumb_title_specific;
        $title_from_customizer = wp_kses_post( $breadcrumb_title_from_page[get_queried_object_id()]);
        $title_from_customizer = $title_from_customizer ? $title_from_customizer : wp_kses_post(get_the_title());
      }
      
      else if(is_single()) {
        $title_from_customizer = wp_kses_post(get_the_title());
      }
      else {

        $title_from_customizer_blog = get_theme_mod('breadcrumb_title_blog',__( 'Blog', 'kidba' ));
        $title_from_customizer = __('Blog', 'kidba');
        $title_from_customizer = $title_from_customizer_blog ? $title_from_customizer_blog : $title_from_customizer;
      }
      if (is_archive() ) {
          $title_from_customizer = get_the_archive_title();
      }
      $searched_query = array();
      if(is_404()) {
            $searched_query = __('404', 'kidba');    
            $title_from_customizer = 'Search Results for : '.$searched_query;
        }
      if(is_search()) {
        $searched_query = get_search_query();
        if(empty($searched_query)) {
            $searched_query = 'All';
        }
        $title_from_customizer = 'Search Results for : '.$searched_query;
      }
      
     

      $_id = get_the_ID();
      $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';
      if( !empty($_GET['s']) ) {
        $is_breadcrumb = null;
      }
      if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

      $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
      $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

      // get_theme_mod
      $breadcrumb_bg_color = get_theme_mod( 'breadcrumb_bg_color', 'kidba' );
      $bg_img_url = get_template_directory_uri() . '/assets/img/page-title/page-title.jpg';
      $breadcrumb_bg_img = get_theme_mod( 'breadcrumb_bg_img' );

       $breadcrumb_padding_top_field = function_exists('get_field') ? get_field('breadcrumb_padding_top') : '240';
       $breadcrumb_padding_bottom_field = function_exists('get_field') ? get_field('breadcrumb_padding_bottom') : '220';

        $breadcrumb_padding_top_customizer = get_theme_mod('breadcrumb_padding_top', 240);
        $breadcrumb_padding_bottom_customizer = get_theme_mod('breadcrumb_padding_bottom', 240);

        if($breadcrumb_padding_top_field) {
          $breadcrumb_padding_top = $breadcrumb_padding_top_field;
        } else {
          $breadcrumb_padding_top = $breadcrumb_padding_top_customizer;
        }

        if($breadcrumb_padding_bottom_field) {
          $breadcrumb_padding_bottom = $breadcrumb_padding_bottom_field;
        } else {
          $breadcrumb_padding_bottom = $breadcrumb_padding_bottom_customizer;
        }
      $breadcrumb_overlay_class = '';
      if ( $hide_bg_img && empty($_GET['s']) ) {
          $breadcrumb_bg_img = '';
      } else {
          $breadcrumb_bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $breadcrumb_bg_img;
          $breadcrumb_overlay_class = 'breadcrumb_overlay';
      }
    ?>
    <div class="banner breadcrumb-banner pt-190 pb-200 <?php print esc_attr( $breadcrumb_overlay_class );?> <?php print esc_attr( $breadcrumb_class );?>"  data-bg-color="<?php print esc_attr($breadcrumb_bg_color); ?>" data-background="<?php print esc_attr($breadcrumb_bg_img);?>" data-top-space="<?php print esc_attr($breadcrumb_padding_top); ?>px" data-bottom-space="<?php print esc_attr($breadcrumb_padding_bottom); ?>px">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-txt">
                            <h1 class="breadcrumb-title kidba_breadcrumb_title"><?php echo wp_strip_all_tags($title_from_customizer); ?></h1>
                            <nav class="breadcrumb-txt breadcrumb-trail breadcrumbs">
                                <?php 
                                    if(function_exists('bcn_display')) {
                                        $display_text = bcn_display(true);
                                        if($searched_query == 'All') {
                                            $display_text .= $searched_query.'"';
                                        }
                                        echo $display_text;
                                        unset($display_text);
                                    }
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php
    }
}

add_action( 'kidba_before_main_content', 'kidba_breadcrumb_func' );

// kidba_search_form
function kidba_search_form() {
    ?>
      <!-- modal-search-start -->
      <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form method="get" action="<?php print esc_url( home_url( '/' ) );?>" >
                     <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Enter Your Keyword', 'kidba' );?>">
                     <button>
                        <i class="fa fa-search"></i>
                     </button>
               </form>
            </div>
         </div>
      </div>
      <!-- modal-search-end -->
   <?php
}

add_action( 'kidba_before_main_content', 'kidba_search_form' );


/**
 *
 * pagination
 */
if ( !function_exists( 'kidba_pagination' ) ) {

    function _kidba_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function kidba_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<div class="def-pagination d-flex mb-50">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .=$pg ;
            }
            $pagi .= '</div>';
        }

        print _kidba_pagi_callback( $pagi );
    }
}



