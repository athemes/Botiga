<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$is_products_filter_page = isset( $_GET['tab'] ) && 'products-filter' === $_GET['tab'] ? true : false;
$is_templates_builder_page = isset( $_GET['tab'] ) && 'templates-builder' === $_GET['tab'] ? true : false;

ob_start();
echo '<nav class="botiga-dashboard-tabs-nav" data-tab-wrapper-id="main">';
    echo '<ul>';

        $num = 0; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        $nav_tab = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

        foreach ($this->settings['tabs'] as $nav_tab_id => $nav_tab_title) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

            if ( $nav_tab_id === 'products-filter' || $nav_tab_id === 'templates-builder' ) {
                continue;
            }

            if ($this->settings['has_pro'] && $nav_tab_id === 'free-vs-pro') {
                continue;
            }

            $nav_tab_link   = add_query_arg(array( 'page' => $this->settings['menu_slug'], 'tab' => $nav_tab_id ), admin_url('admin.php')); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $nav_tab_active = (($nav_tab && $nav_tab === $nav_tab_id) || (!$nav_tab && $num === 0)) ? 'active' : ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

            printf('<li class="botiga-dashboard-tabs-nav-item %s"><a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="%s">%s</a></li>', esc_attr($nav_tab_active), esc_attr($nav_tab_id), esc_html($nav_tab_title));

            ++$num;
        }

    echo '</ul>';
echo '</nav>';
$output = ob_get_clean();

if ( $is_products_filter_page || $is_templates_builder_page ) {
	return;
}

echo wp_kses_post( $output );
