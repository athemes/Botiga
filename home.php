<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

get_header();
?>
	
	<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>" <?php botiga_schema( 'blog' ); ?>>
		<?php do_action( 'botiga_do_archive_content' ); ?>
	</main><!-- #main -->

<?php
do_action( 'botiga_do_sidebar' );
get_footer();
