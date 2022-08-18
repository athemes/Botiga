<?php
/**
 * Footer Builder
 * Widget 1 Component
 * 
 * @package Botiga_Pro
 */ 
?>

<div class="bhfb-builder-item bhfb-component-widget1" data-component-id="widget1">
    <?php $this->customizer_edit_button(); ?>
    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
        <div class="footer-widget">
            <div class="widget-column">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>