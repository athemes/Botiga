<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

$botiga_sidebar_id = '';

if ( is_home() && ! is_front_page() ) {
  $botiga_sidebar_id = get_theme_mod( 'blog_archive_sidebar', 'sidebar-1' );
} else if ( is_singular( array( 'post', 'page' ) ) ) {
  $botiga_sidebar_mod  = get_theme_mod( 'blog_single_sidebar', 'sidebar-1' );
  $botiga_sidebar_meta = get_post_meta( get_the_ID(), '_botiga_sidebar', true );
  $botiga_sidebar_id   = ( ! empty( $botiga_sidebar_meta ) ) ? $botiga_sidebar_meta : $botiga_sidebar_mod;
}

if ( empty( $botiga_sidebar_id ) ) {
  $botiga_sidebar_id = 'sidebar-1';
}

$botiga_custom_sidebars = json_decode( get_theme_mod( 'custom_sidebars', '[]' ), true );

if ( ! empty( $botiga_custom_sidebars ) ) {
  foreach ( $botiga_custom_sidebars as $botiga_custom_sidebar ) {
    if ( ! empty( $botiga_custom_sidebar['conditions'] ) && botiga_get_display_conditions( $botiga_custom_sidebar['conditions'], false ) ) {
      $botiga_sidebar_id = sanitize_key( $botiga_custom_sidebar['name'] );
    }
  }
}

if ( ! is_active_sidebar( $botiga_sidebar_id ) ) {
	return;
}

?>

<aside id="secondary" class="widget-area">
	<?php do_action( 'botiga_before_sidebar' ); ?>
	<?php dynamic_sidebar( $botiga_sidebar_id ); ?>
	<?php do_action( 'botiga_after_sidebar' ); ?>
</aside><!-- #secondary -->
