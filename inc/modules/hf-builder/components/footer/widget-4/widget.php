<?php
/**
 * Footer Builder
 * Widget 4 Component
 * 
 * @package Botiga_Pro
 */ 
?>

<div class="bhfb-builder-item bhfb-component-widget4" data-component-id="widget4">
    <?php $this->customizer_edit_button(); ?>
    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
        <div class="footer-widget">
            <div class="widget-column">
                <?php dynamic_sidebar( 'footer-4' ); ?>
            </div>
        </div>
    <?php endif; ?>
</div>