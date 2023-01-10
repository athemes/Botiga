<?php
/**
 * Header/Footer Builder
 * Search Component
 * 
 * @package Botiga_Pro
 */

$search_layout = get_theme_mod( 'bhfb_search_layout', 'hidden' );

$search_html = '';

if( $search_layout === 'hidden' ) {
    $search_html .= '<a href="#" class="header-search" title="'. esc_attr__( 'Search for a product', 'botiga' ) .'">';
        $search_html .= botiga_get_header_search_icon();
    $search_html .= '</a>';
}

if( $search_layout === 'visible' ) {
    $search_html .= '<div class="header-search-form header-search-form-always-visible">';
        if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
            $search_html .= do_shortcode( '[wcas-search-form]' );
        } else {
            $search_html .= get_search_form( false );
        }
    $search_html .= '</div>';
}

echo '<div class="bhfb-builder-item bhfb-component-search" data-component-id="search">'; 
    $this->customizer_edit_button();    
    echo $search_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
echo '</div>';