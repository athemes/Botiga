<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

get_header();
?>
	<?php
	/**
	 * Hook 'botiga_content_class'
	 *
	 * @since 1.0.0
	 */
	$botiga_content_class = apply_filters( 'botiga_content_class', '' );
	?>
	<main id="primary" class="site-main <?php echo esc_attr( $botiga_content_class ); ?>" <?php botiga_schema( 'blog' ); ?>>
		<?php 
		/**
		 * Hook 'botiga_do_archive_content'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'botiga_do_archive_content' ); ?>
	</main><!-- #main -->

<?php
/**
 * Hook 'botiga_do_sidebar'
 * 
 * @since 1.0.0
 */
do_action( 'botiga_do_sidebar' );
get_footer();
