<?php 
/*************************************************
## kidba Typography
*************************************************/
function kidba_customizer_styling() { ?>
<style type="text/css">

/* Header_1 Top Style */
<?php if(get_theme_mod('choose_default_header') == 'header-style-1') : ?>
	<?php if (get_theme_mod( 'header_menu_color' )) { ?>
		.navbar-nav li a {
			color: <?php echo esc_attr(get_theme_mod( 'header_menu_color' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'header_menu_hover_color' )) { ?>
		.navbar-nav li a:hover, .navbar-nav > li:hover > a {
			color: <?php echo esc_attr(get_theme_mod( 'header_menu_hover_color' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'header_submenumenu_border_color' )) { ?>
		.dropdown-menu {
			border-color: <?php echo esc_attr(get_theme_mod( 'header_submenumenu_border_color' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_background_color' )) { ?>
	.header-style-1 .top-header{
		background: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_background_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_icon_color' )) { ?>
	.header-style-1 .top-left .header-txt i {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_icon_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_text_color' )) { ?>
	.header-style-1 .header-txt, .header-txt a {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_text_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_text_hover_color' )) { ?>
	.header-style-1 .header-txt a:hover {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_text_hover_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_button_text_color' )) { ?>
	.header-style-1 .kidba_header_top_button .kidba_btn {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_button_text_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_top_button_text_hover_color' )) { ?>
	.header-style-1 .kidba_header_top_button .kidba_btn:hover {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_top_button_text_hover_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'logo_size' )) { ?>
	.header-style-1 .logo img {
		width: <?php echo esc_attr(get_theme_mod( 'logo_size' ) ); ?>px;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'header_logo_bg_color' )) { ?>
	.header-style-1 .logo {
		background-color: <?php echo esc_attr(get_theme_mod( 'header_logo_bg_color' ) ); ?>;
	}
	<?php } ?>
<?php  endif; ?>

/* Header_1 Right Style */
<?php if(get_theme_mod('choose_default_header') == 'header-style-1') : ?>
	<?php if (get_theme_mod( 'kidba_header_main_right_button_bg_color' )) { ?>
	.def-btn {
		background: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_bg_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_main_right_button_bg_hover_color' )) { ?>
	.def-btn:after {
		background: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_bg_hover_color' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_main_right_button_text_color' )) { ?>
	.def-btn {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_text_color' ) ); ?>;
	}
	<?php } ?>

	<?php if (get_theme_mod( 'kidba_header_main_right_button_text_hover_color' )) { ?>
	.def-btn:hover {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_text_hover_color' ) ); ?>;
	}
	<?php } ?>
<?php endif; ?>









/* Header_2 Style */
<?php if(get_theme_mod('choose_default_header') == 'header-style-2') : ?>
	<?php if (get_theme_mod( 'header_menu_color_2' )) { ?>
		.navbar-nav li a {
			color: <?php echo esc_attr(get_theme_mod( 'header_menu_color_2' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'header_menu_hover_color_2' )) { ?>
		.navbar-nav li a:hover, .navbar-nav > li:hover > a {
			color: <?php echo esc_attr(get_theme_mod( 'header_menu_hover_color_2' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'header_submenumenu_border_color_2' )) { ?>
		.dropdown-menu {
			border-color: <?php echo esc_attr(get_theme_mod( 'header_submenumenu_border_color_2' ) ); ?>;
		}
	<?php } ?>
	<?php if (get_theme_mod( 'header_logo_bg_color_2' )) { ?>
	.header-style-1 .logo {
		background-color: <?php echo esc_attr(get_theme_mod( 'header_logo_bg_color_2' ) ); ?>;
	}
	<?php } ?>
	/* right side */
	<?php if (get_theme_mod( 'kidba_header_main_right_button_bg_color_2' )) { ?>
	.def-btn {
		background: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_bg_color_2' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_main_right_button_bg_hover_color_2' )) { ?>
	.def-btn:after {
		background: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_bg_hover_color_2' ) ); ?>;
	}
	<?php } ?>
	<?php if (get_theme_mod( 'kidba_header_main_right_button_text_color_2' )) { ?>
	.def-btn {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_text_color_2' ) ); ?>;
	}
	<?php } ?>

	<?php if (get_theme_mod( 'kidba_header_main_right_button_text_hover_color_2' )) { ?>
	.def-btn:hover {
		color: <?php echo esc_attr(get_theme_mod( 'kidba_header_main_right_button_text_hover_color_2' ) ); ?>;
	}
	<?php } ?>
<?php endif; ?>

/* Breadcrum Style */
<?php if (get_theme_mod( 'breadcrumb_text_color' )) { ?>
.kidba_breadcrumb_title, nav.breadcrumb-trail.breadcrumbs span, .breadcrumb-trail.breadcrumbs > span a span, nav.breadcrumb-trail.breadcrumbs {
	color: <?php echo esc_attr(get_theme_mod( 'breadcrumb_text_color' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_text_hover_color' )) { ?>
.breadcrumb-trail.breadcrumbs > span a:hover span {
	color: <?php echo esc_attr(get_theme_mod( 'breadcrumb_text_hover_color' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_bg_img_ovelay_color' )) { ?>
.breadcrumb_overlay:before {
	background-color: <?php echo esc_attr(get_theme_mod( 'breadcrumb_bg_img_ovelay_color' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_bg_img_ovelay_color_opacity' )) { ?>
	.breadcrumb_overlay:before {
		opacity: <?php echo esc_attr(get_theme_mod( 'breadcrumb_bg_img_ovelay_color_opacity' ) ); ?>;
	}
<?php } else {?>
	.breadcrumb_overlay:before {
		opacity: 0;
	}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_background_position_select' )) { ?>
.kidba_breadcrumb_area {
	background-position: <?php echo esc_attr(get_theme_mod( 'breadcrumb_background_position_select' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_background_size_select' )) { ?>
.kidba_breadcrumb_area {
	background-size: <?php echo esc_attr(get_theme_mod( 'breadcrumb_background_size_select' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'breadcrumb_background_blendmode_select' )) { ?>
.kidba_breadcrumb_area {
	background-blend-mode: <?php echo esc_attr(get_theme_mod( 'breadcrumb_background_blendmode_select' ) ); ?>;
}
<?php } ?>

/***
* Footer Style 01
*/
<?php if (get_theme_mod( 'footer_background_size' )) { ?>
.kidba_footer_area {
	background-size: <?php echo esc_attr(get_theme_mod( 'footer_background_size' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'footer_background_position_select' )) { ?>
.kidba_footer_area {
	background-position: <?php echo esc_attr(get_theme_mod( 'footer_background_position_select' ) ); ?>;
}
<?php } ?>
<?php if (get_theme_mod( 'footer_background_blendmode_select' )) { ?>
.kidba_footer_area {
	background-blend-mode: <?php echo esc_attr(get_theme_mod( 'footer_background_blendmode_select' ) ); ?>;
}
<?php } ?>






</style>
<?php }

add_action('wp_head','kidba_customizer_styling');

?>