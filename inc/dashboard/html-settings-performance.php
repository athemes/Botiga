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
    <div class="botiga-dashboard-card-header">
        <h2><?php echo esc_html__( 'Performance', 'botiga' ); ?></h2>
    </div>
    <div class="botiga-dashboard-card-body">
    
        <div class="botiga-dashboard-box botiga-dashboard-settings-box">
            <div class="botiga-dashboard-settings-row">
                <div class="botiga-dashboard-settings-column-left">
                    <div class="botiga-dashboard-box-title"><?php esc_html_e('Load Google Fonts', 'botiga'); ?></div>
                    <div class="botiga-dashboard-box-content"><?php esc_html_e('Activate this option to load the Google fonts locally.', 'botiga'); ?></div>
                </div>
                <div class="botiga-dashboard-settings-column-right">
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