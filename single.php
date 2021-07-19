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

	<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'botiga_before_single_post_content' );

			get_template_part( 'template-parts/content', 'single' );

			do_action( 'botiga_after_single_post_content' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
do_action( 'botiga_do_sidebar' );
get_footer();
