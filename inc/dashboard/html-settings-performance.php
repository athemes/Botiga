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
            <div class="botiga-dashboard-module-card-header">
                <div class="botiga-dashboard-module-card-header-info">
                    <h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Load Google Fonts Locally', 'botiga' ); ?></h2>
                    <p class="bt-text-color-grey"><?php esc_html_e('Activate this option to load the Google fonts locally.', 'botiga'); ?></p>
                </div>
                <div class="botiga-dashboard-module-card-header-actions">
                    <div class="botiga-dashboard-box-link">
                        <?php if (Botiga_Modules::is_module_active('local-google-fonts')) : ?>
                            <a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'settings', 'tab' => 'performance', 'deactivate-module' => 'local-google-fonts'), admin_url('themes.php'))); ?>" class="button button-warning botiga-dashboard-deactivate-button">
                                <?php esc_html_e('Deactivate', 'botiga'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'settings', 'tab' => 'performance', 'activate-module' => 'local-google-fonts'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-activate-button">
                                <?php esc_html_e('Activate', 'botiga'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>