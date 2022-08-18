<?php
/**
 * Footer Builder
 * Widget 2 Component
 * 
 * @package Botiga_Pro
 */ 
?>

<div class="bhfb-builder-item bhfb-component-widget2" data-component-id="widget2">
    <?php $this->customizer_edit_button(); ?>
    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
        <div class="footer-widget">
            <div class="widget-column">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>