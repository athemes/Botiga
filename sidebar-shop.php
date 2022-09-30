<?php

/**
 * The sidebar for shop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

$botiga_shop_sidebar_id = '';

if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
  $botiga_shop_sidebar_id = get_theme_mod( 'shop_sidebar', 'shop-sidebar-1' );
} else if ( is_singular( 'product' ) ) {
  $botiga_shop_sidebar_mod  = get_theme_mod( 'shop_single_sidebar', 'shop-sidebar-1' );
  $botiga_shop_sidebar_meta = get_post_meta( get_the_ID(), '_botiga_sidebar', true );
  $botiga_shop_sidebar_id   = ( ! empty( $botiga_shop_sidebar_meta ) ) ? $botiga_shop_sidebar_meta : $botiga_shop_sidebar_mod;
}

if ( empty( $botiga_shop_sidebar_id ) ) {
  $botiga_shop_sidebar_id = 'shop-sidebar-1';
}

$botiga_custom_sidebars = json_decode( get_theme_mod( 'custom_sidebars', '[]' ), true );

if ( ! empty( $botiga_custom_sidebars ) ) {
  foreach ( $botiga_custom_sidebars as $botiga_custom_sidebar ) {
    if ( ! empty( $botiga_custom_sidebar['conditions'] ) && botiga_get_display_conditions( $botiga_custom_sidebar['conditions'], false ) ) {
      $botiga_shop_sidebar_id = sanitize_key( $botiga_custom_sidebar['name'] );
    }
  }
}

if ( ! is_active_sidebar( $botiga_shop_sidebar_id ) && ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>

<aside id="secondary" class="widget-area">
	<?php do_action( 'botiga_before_sidebar' ); ?>
	<?php if( is_active_sidebar( $botiga_shop_sidebar_id ) ) {
		dynamic_sidebar( $botiga_shop_sidebar_id );
	} else {
		dynamic_sidebar('sidebar-1');
	} ?>
	<?php do_action('botiga_after_sidebar'); ?>
</aside><!-- #secondary -->