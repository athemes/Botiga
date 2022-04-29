<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
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
<?php wp_body_open(); ?>

<?php do_action( 'botiga_before_site' ); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'botiga' ); ?></a>

	<?php 
	/**
	 * Header
	 */
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		do_action( 'botiga_header' );
	}

	/**
	 * Page Header
	 */
	do_action( 'botiga_before_page_header' );
	do_action( 'botiga_page_header' );
	do_action( 'botiga_after_page_header' );
	
	/**
	 * Main Wrapper
	 */
	do_action( 'botiga_before_main_wrapper' );
	do_action( 'botiga_main_wrapper_start' ); ?>			