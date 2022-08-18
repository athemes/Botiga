<?php
/**
 * Footer Builder
 * Copyright/credits Component CSS Output
 * 
 * @package Botiga_Pro
 */

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_text_color', '', '.bhfb .botiga-credits' );

// Links Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_links_color', '', '.bhfb .botiga-credits a' );

// Links Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_links_color_hover', '', '.bhfb .botiga-credits a:hover' );

// Text Alignment
$text_align = get_theme_mod( 'botiga_section_fb_component__copyright_text_alignment', 'left' );
$css .= '
    .bhfb-component-copyright .botiga-credits {
        text-align: '. esc_attr( $text_align ) .'
    }
';