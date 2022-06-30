<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kidba
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- preloader and scroll up added based on customizer -->

<?php wp_body_open(); ?>


<!-- header start -->
<?php do_action( 'kidba_header_style' );?>
<!-- header end -->
<!-- before main content start -->
<?php do_action( 'kidba_before_main_content' );?>
<!-- before main content end -->

