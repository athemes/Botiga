<?php
/**
 * Footer Builder
 * HTML Component
 * 
 * @package Botiga_Pro
 */ 

$footer_html_content = get_theme_mod( 'footer_html_content', '' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
if( ! $footer_html_content ) {
    return '';
} ?>

<div class="bhfb-builder-item bhfb-component-html" data-component-id="html">
    <?php $this->customizer_edit_button(); ?>
    <div class="footer-html">
        <?php echo wp_kses_post( $footer_html_content ); ?>
    </div>
</div>