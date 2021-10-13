<?php
/**
 * Max Mega Menu Compatibility
 *
 * @package Botiga
 */

function botiga_maxmegamenu_theme( $themes ) {
    $themes["default_1634144833"] = array(
        'title' => 'Botiga Theme',
        'container_background_from' => 'rgba(34, 34, 34, 0)',
        'container_background_to' => 'rgba(34, 34, 34, 0)',
        'menu_item_background_hover_from' => 'rgba(34, 34, 34, 0)',
        'menu_item_background_hover_to' => 'rgba(51, 51, 51, 0)',
        'menu_item_link_color' => 'rgb(33, 33, 33)',
        'menu_item_link_color_hover' => 'rgb(113, 113, 113)',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'toggle_background_from' => 'rgba(34, 34, 34, 0)',
        'toggle_background_to' => 'rgba(34, 34, 34, 0)',
        'mobile_menu_force_width' => 'on',
        'mobile_background_from' => 'rgb(33, 33, 33)',
        'mobile_background_to' => 'rgb(33, 33, 33)',
        'mobile_menu_item_link_font_size' => '14px',
        'mobile_menu_item_link_color' => '#ffffff',
        'mobile_menu_item_link_text_align' => 'left',
        'mobile_menu_item_link_color_hover' => '#ffffff',
        'mobile_menu_item_background_hover_from' => 'rgb(33, 33, 33)',
        'mobile_menu_item_background_hover_to' => 'rgb(33, 33, 33)',
        'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}',
    );
    return $themes;
}
add_filter( 'megamenu_themes', 'botiga_maxmegamenu_theme' );