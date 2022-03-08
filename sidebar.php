<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php do_action( 'botiga_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php do_action( 'botiga_after_sidebar' ); ?>
</aside><!-- #secondary -->
