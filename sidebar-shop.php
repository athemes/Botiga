<?php
/**
 * The sidebar for shop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

if ( ! is_active_sidebar( 'shop-sidebar-1' ) && ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php do_action( 'botiga_before_sidebar' ); ?>
	<?php if( ! is_active_sidebar( 'shop-sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	} else {
		dynamic_sidebar( 'shop-sidebar-1' );
	} ?>
	<?php do_action( 'botiga_after_sidebar' ); ?>
</aside><!-- #secondary -->