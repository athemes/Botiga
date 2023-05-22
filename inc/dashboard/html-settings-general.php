<?php

/**
 * Settings - General
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-card botiga-dashboard-card-no-box-shadow">
    <div class="botiga-dashboard-card-header">
        <h2 class="bt-mb-10px"><?php echo esc_html__( 'Botiga Pro License', 'botiga' ); ?></h2>
        <p class="bt-text-color-grey"><?php echo esc_html__( 'Activate your license key for Botiga Pro to get latest theme updates automatically updates right from your WordPress Dashboard.', 'botiga' ); ?> </p>
    </div>
    <div class="botiga-dashboard-card-body">
        <?php do_action( 'botiga_pro_license_form' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>

        <div class="botiga-dashboard-content-expand bt-mt-20px" data-bt-toggle-expand style="max-width: 360px;">
            <div class="botiga-dashboard-content-expand-title">
                <a href="#" class="botiga-dashboard-content-expand-link">
                    <?php echo botiga_dashboard_get_setting_icon( 'info' ); ?>
                    <?php echo esc_html__( 'Instructions', 'botiga' ); ?>
                </a>
            </div>
            <div class="botiga-dashboard-content-expand-content bt-toggle-expand-content">
                <ul class="botiga-dashboard-content-expand-list">
                    <li class="bt-d-flex">
                        <?php echo botiga_dashboard_get_setting_icon( 'arrow' ); ?>
                        <?php echo sprintf(
                            esc_html__( 'To get your key, please login to your %1$saThemes account%2$s.', 'botiga' ),
                            '<a href="https://www.athemes.com/login/" target="_blank">',
                            '</a>'
                        ); ?>
                    </li>
                    <li class="bt-d-flex">
                        <?php echo botiga_dashboard_get_setting_icon( 'arrow' ); ?>
                        <?php echo esc_html__( 'In licenses section, click on the 🔑 key icon. A license number will appear. Copy and paste the number here', 'botiga' ); ?>
                    </li>
                    <li class="bt-d-flex">
                        <?php echo botiga_dashboard_get_setting_icon( 'arrow' ); ?>
                        <?php echo esc_html__( 'Voilà! you have successfully unlock all premium features', 'botiga' ); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>