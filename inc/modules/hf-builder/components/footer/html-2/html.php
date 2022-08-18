<?php
/**
 * Footer Builder
 * HTML Component 2
 * 
 * @package Botiga_Pro
 */ 

$footer_html2_content = get_theme_mod( 'botiga_section_fb_component__html2_content', '' );
if( ! $footer_html2_content ) {
    return '';
} ?>

<div class="bhfb-builder-item bhfb-component-html2" data-component-id="html2">
    <?php $this->customizer_edit_button(); ?>
    <div class="footer-html">
        <?php echo wp_kses_post( $footer_html2_content ); ?>
    </div>
</div>