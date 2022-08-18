<?php
/**
 * Header/Footer Builder
 * Shortcode Component
 * 
 * @package Botiga_Pro
 */ 

$header_shortcode_content = get_theme_mod( 'header_shortcode_content', '' );
if( ! $header_shortcode_content ) {
    return '';
} ?>

<div class="bhfb-builder-item bhfb-component-shortcode" data-component-id="shortcode">
    <?php $this->customizer_edit_button(); ?>
    <div class="header-shortcode">
        <?php echo do_shortcode( $header_shortcode_content ); ?>
    </div>
</div>