<?php

/**
 * Product Filters.
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="botiga-dashboard-row">
    <div class="botiga-dashboard-column">
        <div class="botiga-dashboard-card botiga-products-filter-wrapper">
            <div class="botiga-dashboard-card-body">

                <div class="botiga-dashboard-row">
                    <div class="botiga-dashboard-column botiga-dashboard-column-2">

                        <nav class="botiga-dashboard-tabs-nav botiga-dashboard-tabs-nav-vertical botiga-dashboard-tabs-nav-with-icons botiga-dashboard-tabs-nav-no-negative-margin" data-tab-wrapper-id="products-filter-tab">
                            <ul>
                                <?php 
                                $sections = array(
                                    'filter-presets' => __( 'Filter Presets', 'botiga' ),
                                    'general' => __( 'General', 'botiga' ),
                                    'customization' => __( 'Customization', 'botiga' ),
                                    'seo' => __( 'SEO', 'botiga' ),
                                    'documentation' => __( 'Documentation', 'botiga' ),
                                );

                                foreach ( $sections as $section_id => $section_title ) : 
                                    $tab_active = 'filter-presets' === $section_id ? ' active' : '';
                                    ?>

                                    <?php if ( 'documentation' === $section_id ) : ?>
                                        <li class="botiga-dashboard-tabs-nav-item<?php echo esc_attr( $tab_active ); ?>">
                                            <a href="https://docs.athemes.com/article/pro-product-filters-module/" class="botiga-dashboard-tabs-nav-link no-tabs-link" target="_blank">
                                                <?php echo botiga_dashboard_get_setting_icon( $section_id ); ?>
                                                <?php echo esc_html( $section_title ); ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="botiga-dashboard-tabs-nav-item<?php echo esc_attr( $tab_active ); ?>">
                                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="products-filter-tab-<?php echo esc_attr( $section_id ); ?>">
                                                <?php echo botiga_dashboard_get_setting_icon( $section_id ); ?>
                                                <?php echo esc_html( $section_title ); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </ul>
                        </nav>

                    </div>
                    <div class="botiga-dashboard-column botiga-dashboard-column-10">
                        <?php if ( ! $this->settings['has_pro'] ) : ?>
                            <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
                                <div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                                <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note this feature is available only in Botiga Pro', 'botiga' ); ?></p>
                                <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="botiga-dashboard-external-link" target="_blank">
                                    <?php echo esc_html__( 'Upgrade Now', 'botiga' ); ?>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ( $this->settings['has_pro'] && ( class_exists( 'Botiga_Modules' ) && ! Botiga_Modules::is_module_active( 'shop-filters' ) ) ) : ?>
                            <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
                                <div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                                <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note that to use this feature you need to activate the Product Filters module.', 'botiga' ); ?></p>
                                <a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-module-activation botiga-dashboard-external-link" data-module-id="shop-filters" data-module-activate="true" data-module-after-activation-redirect="<?php echo esc_url( get_admin_url() . 'admin.php?page=botiga-dashboard&module-page=shop-filters&settings-page=filter-presets' ); ?>">
                                    <?php echo esc_html__( 'Activate Product Filters', 'botiga' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php 
						foreach( $sections as $section_id => $section_title ) : 
							$tab_active = 'filter-presets' === $section_id ? ' active' : '';

                            if ( 'documentation' === $section_id ) {
                                continue;
                            }

							?>

                            <div class="botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="products-filter-tab">					
                                <div class="botiga-dashboard-tab-content<?php echo esc_attr( $tab_active ); ?>" data-tab-content-id="products-filter-tab-<?php echo esc_attr( $section_id ); ?>">
                                    
                                    <?php require get_template_directory() . '/inc/dashboard/html-products-filter-'. $section_id .'.php'; ?>

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
