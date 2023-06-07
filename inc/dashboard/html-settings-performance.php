<?php

/**
 * Settings - Performance
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
                    <h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Load Google Fonts Locally', 'botiga' ); ?></h2>
                    <p class="bt-text-color-grey"><?php esc_html_e('Activate this option to load the Google fonts locally.', 'botiga'); ?></p>
                </div>
                <div class="botiga-dashboard-module-card-header-actions bt-pt-0">
                    <div class="botiga-dashboard-box-link">
                        <?php if (Botiga_Modules::is_module_active('local-google-fonts')) : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-danger botiga-dashboard-module-activation" data-module-id="local-google-fonts" data-module-activate="false">
                                <?php echo esc_html__( 'Deactivate', 'botiga' ); ?>
                            </a>
                        <?php else : ?>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-module-activation" data-module-id="local-google-fonts" data-module-activate="true">
                                <?php echo esc_html__( 'Activate', 'botiga' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>