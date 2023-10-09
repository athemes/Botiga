<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Botiga
 */

get_header();
?>

	<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>" <?php botiga_schema( 'blog' ); ?>>
		<?php do_action( 'botiga_do_single_content' ); ?>
	</main><!-- #main -->

<?php
do_action( 'botiga_do_sidebar' );
get_footer();
