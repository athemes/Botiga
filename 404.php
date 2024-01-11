<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Botiga
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php 
		/**
		 * Hook 'botiga_404_content'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'botiga_404_content' ); ?>
	</main><!-- #main -->

<?php
get_footer();
