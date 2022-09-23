<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Botiga
 */

$sidebar_id = '';

if (is_home() && !is_front_page()) {
	$sidebar_id = get_theme_mod('blog_archive_sidebar', 'sidebar-1');
} else if (is_singular(array('post', 'page'))) {
	$sidebar_opt  = get_theme_mod('blog_single_sidebar', 'sidebar-1');
	$sidebar_meta = get_post_meta(get_the_ID(), '_botiga_sidebar', true);
	$sidebar_id   = (!empty($sidebar_meta)) ? $sidebar_meta : $sidebar_opt;
}

if (empty($sidebar_id)) {
	$sidebar_id = 'sidebar-1';
}

$custom_sidebars = json_decode(get_theme_mod('custom_sidebars', '[]'), true);

if (!empty($custom_sidebars)) {
	foreach ($custom_sidebars as $custom_sidebar) {
		if (!empty($custom_sidebar['conditions']) && botiga_get_display_conditions($custom_sidebar['conditions'], false)) {
			$sidebar_id = sanitize_key($custom_sidebar['name']);
		}
	}
}

if (!is_active_sidebar($sidebar_id)) {
	return;
}

?>

<aside id="secondary" class="widget-area">
	<?php do_action('botiga_before_sidebar'); ?>
	<?php dynamic_sidebar($sidebar_id); ?>
	<?php do_action('botiga_after_sidebar'); ?>
</aside><!-- #secondary -->