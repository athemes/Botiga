<?php
/**
 * Header/Footer Builder
 * Search Component
 * 
 * @package Botiga_Pro
 */
// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$search_layout = get_theme_mod( 'bhfb_search_layout', 'hidden' );

$search_html = apply_filters( 'botiga_header_builder_search_form_output_prepend_content', '' );

if( $search_layout === 'hidden' ) {
    $search_html .= '<a href="#" class="header-search" title="'. esc_attr__( 'Search for a product', 'botiga' ) .'">';
        $search_html .= botiga_get_header_search_icon();
    $search_html .= '</a>';
}

$search_html .= apply_filters( 'botiga_header_builder_search_form_output_append_content', '' );

echo '<div class="bhfb-builder-item bhfb-component-search" data-component-id="search">'; 
    $this->customizer_edit_button();    
    echo $search_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
echo '</div>';
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound