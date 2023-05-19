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

<div class="botiga-dashboard-card">
    <div class="botiga-dashboard-card-header">
        <h2><?php echo esc_html__( 'Botiga Pro License', 'botiga' ); ?></h2>
    </div>
    <div class="botiga-dashboard-card-body">
        <p><?php echo esc_html__( 'Activate your license key for Botiga Pro to get latest theme updates automatically updates right from your WordPress Dashboard.', 'botiga' ); ?> </p>
        <?php do_action( 'botiga_pro_license_form' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>

        <div class="botiga-dashboard-content-expand">
            <div class="botiga-dashboard-content-expand-title">
                <a href="#" class="botiga-dashboard-content-expand-link">
                    <?php echo esc_html__( 'Instructions', 'botiga' ); ?>
                </a>
            </div>
            <div class="botiga-dashboard-content-expand-content">
                <ul class="botiga-dashboard-content-expand-list">
                    <li>
                        <?php echo sprintf(
                            esc_html__( 'To get your key, please login to your %1$saThemes account%2$s.', 'botiga' ),
                            '<a href="https://www.athemes.com/login/" target="_blank">',
                            '</a>'
                        ); ?>
                    </li>
                    <li>
                        <?php echo esc_html__( 'In licenses section, click on the 🔑 key icon. A license number will appear. Copy and paste the number here', 'botiga' ); ?>
                    </li>
                    <li>
                        <?php echo esc_html__( 'Voilà! you have successfully unlock all premium features', 'botiga' ); ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>