<?php
/**
 * Header/Footer Builder
 * WPML Language Switcher Component
 * 
 * @package Botiga_Pro
 */ ?>

<div class="bhfb-builder-item bhfb-component-wpml_switcher" data-component-id="wpml_switcher">
    <?php $this->customizer_edit_button();
    do_action( 'wpml_add_language_selector' ); ?>
</div>