<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

?>

	<?php 
	/**
	 * Main Wrapper
	 */
	do_action( 'botiga_main_wrapper_end' );
	do_action( 'botiga_after_main_wrapper' ); 
	
	/**
	 * Footer
	 */
	do_action( 'botiga_footer_before' );
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
		do_action( 'botiga_footer' );
	}
	do_action( 'botiga_footer_after' ); ?>

</div><!-- #page -->

<?php do_action( 'botiga_after_site' ); ?>

<?php wp_footer(); ?>

</body>
</html>
