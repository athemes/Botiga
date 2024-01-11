<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php botiga_schema( 'article' ); ?>>

	<?php 
	/**
	 * Hook 'botiga_loop_post'
	 *
	 * @since 1.0.0
	 */
	do_action( 'botiga_loop_post' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
