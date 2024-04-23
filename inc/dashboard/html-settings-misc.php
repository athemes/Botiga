<?php

/**
 * Settings - Miscellaneous
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
                    <h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Add hover delay to all navigation dropdowns', 'botiga' ); ?></h2>
                    <p class="bt-text-color-grey"><?php esc_html_e('Enable this option to add a slightly hover delay to the navigation dropdowns.', 'botiga'); ?></p>
                </div>
                <div class="botiga-dashboard-module-card-header-actions bt-pt-0">
                    <div class="botiga-dashboard-box-link">
                        <?php if ( get_option( 'botiga_dropdowns_hover_delay', 'yes' ) === 'yes' ) : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-danger botiga-dashboard-option-switcher" data-option-id="botiga_dropdowns_hover_delay" data-option-activate="false">
                                <?php echo esc_html__( 'Deactivate', 'botiga' ); ?>
                            </a>
                        <?php else : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-option-switcher" data-option-id="botiga_dropdowns_hover_delay" data-option-activate="true">
                                <?php echo esc_html__( 'Activate', 'botiga' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>