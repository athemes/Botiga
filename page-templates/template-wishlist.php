<?php
/**
 * Template Name: Botiga Wishlist
 * Template for botiga wishlist
 *
 * @package Botiga
 */

get_header(); ?>

	<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">

        <section>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
            </header><!-- .page-header -->

            <div class="page-content">

                <?php 
                while( have_posts() ) : the_post();
                    the_content();
                endwhile; ?>

                <?php get_template_part( 'template-parts/content', 'wishlist' ); ?>
            </div><!-- .page-content -->
        </section>

	</main><!-- #main -->

<?php
do_action( 'botiga_do_sidebar' );
get_footer();