<?php

/**
 * Settings - Merchant
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-card">
    <div class="botiga-dashboard-card-body">
        <div class="botiga-dashboard-module-card">
            <div class="botiga-dashboard-module-card-header bt-align-items-center">
                <div class="botiga-dashboard-module-card-header-info">
                    <h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Botiga take control over single product modules display', 'botiga' ); ?></h2>
                    <p class="bt-text-color-grey"><?php esc_html_e('Controls whether the display from Merchant single product modules should be managed by Botiga or Merchant settings. Activating this option means that Botiga will be responsible for managing the display options through Appearance > Customize > WooCommerce > Single Product.', 'botiga'); ?></p>
                </div>
                <div class="botiga-dashboard-module-card-header-actions bt-pt-0">
                    <div class="botiga-dashboard-box-link">
                        <?php if ( get_option( 'botiga_merchant_modules_single_product_integration', true ) ) : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-danger botiga-dashboard-option-switcher" data-option-id="botiga_merchant_modules_single_product_integration" data-option-activate="false">
                                <?php echo esc_html__( 'Deactivate', 'botiga' ); ?>
                            </a>
                        <?php else : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-option-switcher" data-option-id="botiga_merchant_modules_single_product_integration" data-option-activate="true">
                                <?php echo esc_html__( 'Activate', 'botiga' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>