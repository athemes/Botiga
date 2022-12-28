<?php
/**
 * Template Name: Botiga Canvas
 * Template for botiga canvas
 *
 * This tempalte won't display the header, footer and sidebar. But you can display them with the filter 'botiga_template_canvas_remove_header_footer'
 * 
 * @package Botiga
 */

// Remove header and footer from canvas template
if( apply_filters( 'botiga_template_canvas_remove_header_footer', true ) ) {
    remove_all_actions( 'botiga_header' );
    remove_all_actions( 'botiga_footer' );
}

get_header();

$hide_page_title = get_post_meta( $post->ID, '_botiga_hide_page_title', true );

?>

<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php 
get_footer();