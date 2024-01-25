<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Botiga
 */

get_header();

/**
 * Hook 'botiga_content_class'
 *
 * @since 1.0.0
 */
$content_class = apply_filters( 'botiga_content_class', '' );

?>

	<main id="primary" class="site-main <?php echo esc_attr( $content_class ); ?>" <?php botiga_schema( 'blog' ); ?>>
		<?php 
		/**
		 * Hook 'botiga_do_single_content'
		 *
		 * @since 1.0.0
		 */
		do_action( 'botiga_do_single_content' ); ?>
	</main><!-- #main -->

<?php
/**
 * Hook 'botiga_do_sidebar'
 *
 * @since 1.0.0
 */
do_action( 'botiga_do_sidebar' );
get_footer();
