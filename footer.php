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

	/**
	 * Hook 'botiga_main_wrapper_end'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'botiga_main_wrapper_end' );

	/**
	 * Hook 'botiga_after_main_wrapper'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'botiga_after_main_wrapper' ); 
	
	/**
	 * Footer
	 */

	/**
	 * Hook 'botiga_footer_before'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'botiga_footer_before' );

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {

		/**
		 * Hook 'botiga_footer'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'botiga_footer' );
	}

	/**
	 * Hook 'botiga_footer_after'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'botiga_footer_after' ); ?>

</div><!-- #page -->

<?php 
/**
 * Hook 'botiga_after_site'
 * 
 * @since 1.0.0
 */
do_action( 'botiga_after_site' ); ?>

<?php wp_footer(); ?>

</body>
</html>
