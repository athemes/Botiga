<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons component
 * 
 * @package Botiga_Pro
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}

echo '<div class="bhfb-builder-item bhfb-component-woo_icons" data-component-id="woo_icons">'; 
    $this->customizer_edit_button();
    
    echo botiga_woocommerce_header_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    
echo '</div>';