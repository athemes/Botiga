<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

echo '<nav class="botiga-dashboard-tabs-nav" data-tab-wrapper-id="main">';
    echo '<ul>';

        $num = 0; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

        $section = ( isset( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

        foreach ($this->settings['tabs'] as $tab_id => $tab_title) { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

            if ($this->settings['has_pro'] && $tab_id === 'free-vs-pro') {
                continue;
            }

            $tab_link   = add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => $tab_id), admin_url('themes.php')); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
            $tab_active = (($section && $section === $tab_id) || (!$section && $num === 0)) ? 'active' : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

            echo sprintf('<li class="botiga-dashboard-tabs-nav-item %s"><a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="%s">%s</a></li>', esc_attr($tab_active), esc_attr($tab_id), esc_html($tab_title));

            $num++;
        }

    echo '</ul>';
echo '</nav>';