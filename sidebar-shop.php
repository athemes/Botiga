<?php

/**
 * The sidebar for shop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

$shop_sidebar_id = '';

if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) {
	$shop_sidebar_id = get_theme_mod('shop_sidebar', 'shop-sidebar-1');
} else if (is_singular('product')) {
	$shop_sidebar_opt  = get_theme_mod('shop_single_sidebar', 'shop-sidebar-1');
	$shop_sidebar_meta = get_post_meta(get_the_ID(), '_botiga_sidebar', true);
	$shop_sidebar_id   = (!empty($shop_sidebar_meta)) ? $shop_sidebar_meta : $shop_sidebar_opt;
}

if (empty($shop_sidebar_id)) {
	$shop_sidebar_id = 'shop-sidebar-1';
}

$custom_sidebars = json_decode(get_theme_mod('custom_sidebars', '[]'), true);

if (!empty($custom_sidebars)) {
	foreach ($custom_sidebars as $custom_sidebar) {
		if (!empty($custom_sidebar['conditions']) && botiga_get_display_conditions($custom_sidebar['conditions'], false)) {
			$shop_sidebar_id = sanitize_key($custom_sidebar['name']);
		}
	}
}

if (!is_active_sidebar($shop_sidebar_id) && !is_active_sidebar('sidebar-1')) {
	return;
}

?>

<aside id="secondary" class="widget-area">
	<?php do_action('botiga_before_sidebar'); ?>
	<?php if (is_active_sidebar($shop_sidebar_id)) {
		dynamic_sidebar($shop_sidebar_id);
	} else {
		dynamic_sidebar('sidebar-1');
	} ?>
	<?php do_action('botiga_after_sidebar'); ?>
</aside><!-- #secondary -->