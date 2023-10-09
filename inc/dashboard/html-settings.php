<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if  ( empty( $this->settings['settings'] ) ) {
	return;
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="botiga-dashboard-row">
    <div class="botiga-dashboard-column">
        <div class="botiga-dashboard-card botiga-dashboard-card-top-spacing botiga-dashboard-card-tabs-divider">
            <div class="botiga-dashboard-card-body">

                <div class="botiga-dashboard-row">
                    <div class="botiga-dashboard-column botiga-dashboard-column-2">

                        <nav class="botiga-dashboard-tabs-nav botiga-dashboard-tabs-nav-vertical botiga-dashboard-tabs-nav-with-icons botiga-dashboard-tabs-nav-no-negative-margin" data-tab-wrapper-id="settings-tab">
                            <ul>
                                <?php foreach ( $this->settings['settings'] as $tab_id => $tab_title ) : 
                                    $current_tab = (isset($_GET['current_tab'])) ? sanitize_text_field(wp_unslash($_GET['current_tab'])) : key(array_slice($this->settings['settings'], 0, 1)); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                    $tab_active  = ( ($current_tab && $current_tab === $tab_id) || (!$current_tab && $tab_id === 'general' ) ) ? ' active' : '';

                                    ?>

                                    <li class="botiga-dashboard-tabs-nav-item<?php echo esc_attr( $tab_active ); ?>">
                                        <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="settings-tab-<?php echo esc_attr( $tab_id ); ?>">
                                            <?php echo botiga_dashboard_get_setting_icon( $tab_id ); ?>
                                            <?php echo esc_html( $tab_title ); ?>
                                        </a>
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </nav>

                    </div>
                    <div class="botiga-dashboard-column botiga-dashboard-column-10">

                        <?php 
						$current_tab = ( isset( $_GET['current_tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['current_tab'] ) ) : '';

						foreach( $this->settings[ 'settings' ] as $tab_id => $tab_title ) : 
							$tab_active = ( ($current_tab && $current_tab === $tab_id) || (!$current_tab && $tab_id === 'general') ) ? ' active' : '';

							?>	
                            <div class="botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="settings-tab">					
                                <div class="botiga-dashboard-tab-content<?php echo esc_attr( $tab_active ); ?>" data-tab-content-id="settings-tab-<?php echo esc_attr( $tab_id ); ?>">
                                    <?php require get_template_directory() . '/inc/dashboard/html-settings-'. $tab_id .'.php'; ?>
                                </div>
                            </div>
						<?php endforeach; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
