<?php
/**
 * Header/Footer Builder
 * HTML Component 2
 * 
 * @package Botiga_Pro
 */ 

$header_html_content = get_theme_mod( 'botiga_section_hb_component__html2_content', '' );
if( ! $header_html_content ) {
    return '';
} ?>

<div class="bhfb-builder-item bhfb-component-html2" data-component-id="html2">
    <?php $this->customizer_edit_button(); ?>
    <div class="header-html">
        <?php echo wp_kses_post( $header_html_content ); ?>
    </div>
</div>