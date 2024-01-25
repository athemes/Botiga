<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php botiga_schema( 'article' ); ?>>

	<?php 
	/**
	 * Hook 'botiga_entry_header'
	 *
	 * @since 1.0.0
	 */
	if ( apply_filters( 'botiga_entry_header', true ) ) : ?>
	<header class="entry-header">
		<?php 
		/**
		 * Hook 'botiga_before_title'
		 *
		 * @since 1.0.0
		 */
		do_action( 'botiga_before_title' ); ?>
		<?php the_title( '<h1 class="entry-title page-title" '. botiga_get_schema( 'headline' ) .'>', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<?php botiga_post_thumbnail(); ?>

	<?php 
	/**
	 * Hook 'botiga_before_page_entry_content'
	 *
	 * @since 1.0.0
	 */
	do_action( 'botiga_before_page_entry_content' ); ?>

	<div class="entry-content" <?php botiga_schema( 'entry_content' ); ?>>
		<?php

		/**
		 * Hook 'botiga_before_page_the_content'
		 *
		 * @since 1.0.0
		 */
		do_action( 'botiga_before_page_the_content' );

		the_content();

		/**
		 * Hook 'botiga_after_page_the_content'
		 *
		 * @since 1.0.0
		 */
		do_action( 'botiga_after_page_the_content' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'botiga' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php 
	/**
	 * Hook 'botiga_after_page_entry_content'
	 *
	 * @since 1.0.0
	 */
	do_action( 'botiga_after_page_entry_content' ); ?>

	<?php 
	/**
	 * Hook 'botiga_entry_footer'
	 *
	 * @since 1.0.0
	 */
	if ( get_edit_post_link() && apply_filters( 'botiga_entry_footer', true ) ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'botiga' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
