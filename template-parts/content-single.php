<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

?>

<?php
	$single_post_image_placement 	= get_theme_mod( 'single_post_image_placement', 'below' );
	$single_post_meta_position		= get_theme_mod( 'single_post_meta_position', 'above-title' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( 'above' === $single_post_image_placement ) { //if featured image above title
		botiga_single_post_thumbnail();
	} ?>
	
	<header class="entry-header">
		
		<?php if ( 'post' === get_post_type() && 'above-title' === $single_post_meta_position ) : ?>
			<?php botiga_single_post_meta( 'entry-meta-above' ); ?>
		<?php endif; ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() && 'below-title' === $single_post_meta_position ) : ?>
			<?php botiga_single_post_meta( 'entry-meta-below' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( 'below' === $single_post_image_placement ) { //if featured image below title
		botiga_single_post_thumbnail();
	} ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'botiga' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'botiga' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php botiga_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
