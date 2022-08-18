<?php
/**
 * Footer Builder
 * Shortcode Component
 * 
 * @package Botiga_Pro
 */ 

$footer_shortcode_content = get_theme_mod( 'footer_shortcode_content', '' );
if( ! $footer_shortcode_content ) {
    return '';
} ?>

<div class="bhfb-builder-item bhfb-component-shortcode" data-component-id="shortcode">
    <?php $this->customizer_edit_button(); ?>
    <div class="header-shortcode">
        <?php echo do_shortcode( $footer_shortcode_content ); ?>
    </div>
</div>