<?php

/**
 * Templates Builder.
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-row botiga-templates-builder-wrapper">
    <div class="botiga-dashboard-column">
        <div class="botiga-dashboard-card bt-pl-0">
            <div class="botiga-dashboard-row">
                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                    <nav class="bt-navigation-links">
                        <ul>
                            <li class="bt-navigation-link has-separator">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M17 4h-2v4.5h2V7h3V5.5h-3V4zM4 5.5h9V7H4V5.5zm16 5.75h-9v1.5h9v-1.5zm-16 0h3V10h2v4.25H7v-1.5H4v-1.5zM9 17H4v1.5h5V17zm4 0h7v1.5h-7V20h-2v-4.25h2V17z"></path>
                                    </svg><?php echo esc_html__( 'All templates', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M17 4h-2v4.5h2V7h3V5.5h-3V4zM4 5.5h9V7H4V5.5zm16 5.75h-9v1.5h9v-1.5zm-16 0h3V10h2v4.25H7v-1.5H4v-1.5zM9 17H4v1.5h5V17zm4 0h7v1.5h-7V20h-2v-4.25h2V17z"></path>
                                    </svg><?php echo esc_html__( 'Single', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M17 4h-2v4.5h2V7h3V5.5h-3V4zM4 5.5h9V7H4V5.5zm16 5.75h-9v1.5h9v-1.5zm-16 0h3V10h2v4.25H7v-1.5H4v-1.5zM9 17H4v1.5h5V17zm4 0h7v1.5h-7V20h-2v-4.25h2V17z"></path>
                                    </svg><?php echo esc_html__( 'Archive', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M17 4h-2v4.5h2V7h3V5.5h-3V4zM4 5.5h9V7H4V5.5zm16 5.75h-9v1.5h9v-1.5zm-16 0h3V10h2v4.25H7v-1.5H4v-1.5zM9 17H4v1.5h5V17zm4 0h7v1.5h-7V20h-2v-4.25h2V17z"></path>
                                    </svg><?php echo esc_html__( 'Page', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M3.445 16.505a.75.75 0 001.06.05l5.005-4.55 4.024 3.521 4.716-4.715V14h1.5V8.25H14v1.5h3.19l-3.724 3.723L9.49 9.995l-5.995 5.45a.75.75 0 00-.05 1.06z"></path>
                                    </svg><?php echo esc_html__( '404', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link has-separator">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M18 5.5H6a.5.5 0 00-.5.5v3h13V6a.5.5 0 00-.5-.5zm.5 5H10v8h8a.5.5 0 00.5-.5v-7.5zm-10 0h-3V18a.5.5 0 00.5.5h2.5v-8zM6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                                    </svg><?php echo esc_html__( 'Content Block', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path fill-rule="evenodd" d="M10.289 4.836A1 1 0 0111.275 4h1.306a1 1 0 01.987.836l.244 1.466c.787.26 1.503.679 2.108 1.218l1.393-.522a1 1 0 011.216.437l.653 1.13a1 1 0 01-.23 1.273l-1.148.944a6.025 6.025 0 010 2.435l1.149.946a1 1 0 01.23 1.272l-.653 1.13a1 1 0 01-1.216.437l-1.394-.522c-.605.54-1.32.958-2.108 1.218l-.244 1.466a1 1 0 01-.987.836h-1.306a1 1 0 01-.986-.836l-.244-1.466a5.995 5.995 0 01-2.108-1.218l-1.394.522a1 1 0 01-1.217-.436l-.653-1.131a1 1 0 01.23-1.272l1.149-.946a6.026 6.026 0 010-2.435l-1.148-.944a1 1 0 01-.23-1.272l.653-1.131a1 1 0 011.217-.437l1.393.522a5.994 5.994 0 012.108-1.218l.244-1.466zM14.929 12a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"></path>
                                    </svg><?php echo esc_html__( 'Single Product', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M17 4h-2v4.5h2V7h3V5.5h-3V4zM4 5.5h9V7H4V5.5zm16 5.75h-9v1.5h9v-1.5zm-16 0h3V10h2v4.25H7v-1.5H4v-1.5zM9 17H4v1.5h5V17zm4 0h7v1.5h-7V20h-2v-4.25h2V17z"></path>
                                    </svg><?php echo esc_html__( 'Shop Archive', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M18.5 5.5V8H20V5.5h2.5V4H20V1.5h-1.5V4H16v1.5h2.5zM12 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-6h-1.5v6a.5.5 0 01-.5.5H6a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5h6V4z"></path>
                                    </svg><?php echo esc_html__( 'Cart', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M18.3 5.6L9.9 16.9l-4.6-3.4-.9 1.2 5.8 4.3 9.3-12.6z"></path>
                                    </svg><?php echo esc_html__( 'Checkout', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M10 4.5a1 1 0 11-2 0 1 1 0 012 0zm1.5 0a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zm2.25 7.5v-1A2.75 2.75 0 0011 8.25H7A2.75 2.75 0 004.25 11v1h1.5v-1c0-.69.56-1.25 1.25-1.25h4c.69 0 1.25.56 1.25 1.25v1h1.5zM4 20h9v-1.5H4V20zm16-4H4v-1.5h16V16z" fill-rule="evenodd" clip-rule="evenodd" />
                                    </svg><?php echo esc_html__( 'My Account', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li class="bt-navigation-link has-separator">
                                <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M3.445 16.505a.75.75 0 001.06.05l5.005-4.55 4.024 3.521 4.716-4.715V14h1.5V8.25H14v1.5h3.19l-3.724 3.723L9.49 9.995l-5.995 5.45a.75.75 0 00-.05 1.06z"></path>
                                    </svg><?php echo esc_html__( 'Order Thank You', 'botiga' ); ?>
                                    <div class="bt-navigation-link-lock-icon">
                                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://docs.athemes.com/article/pro-templates-builder-v3/" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                        <path d="M12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zM3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 8.75a1.5 1.5 0 01.167 2.99c-.465.052-.917.44-.917 1.01V14h1.5v-.845A3 3 0 109 10.25h1.5a1.5 1.5 0 011.5-1.5zM11.25 15v1.5h1.5V15h-1.5z"></path>
                                    </svg><?php echo esc_html__( 'Documentation', 'botiga' ); ?> 
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="botiga-dashboard-column botiga-dashboard-column-9">
                    <?php if ( ! $this->settings['has_pro'] ) : ?>
                        <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
                            <div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                            <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note this feature is available only in Botiga Pro', 'botiga' ); ?></p>
                            <a href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ); ?>" class="botiga-dashboard-external-link" target="_blank">
                                <?php echo esc_html__( 'Upgrade Now', 'botiga' ); ?>
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( $this->settings['has_pro'] && ( class_exists( 'Botiga_Modules' ) && ! Botiga_Modules::is_module_active( 'templates' ) ) ) : ?>
                        <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
                            <div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                            <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note that to use this feature you need to activate the Templates Builder module.', 'botiga' ); ?></p>
                            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-module-activation botiga-dashboard-external-link" data-module-id="templates" data-module-activate="true" data-module-after-activation-redirect="<?php echo esc_url( get_admin_url() . 'admin.php?page=botiga-dashboard&module-page=builder&settings-page=create-new' ); ?>">
                                <?php echo esc_html__( 'Activate Templates Builder', 'botiga' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="botiga-dashboard-card botiga-dashboard-card-no-box-shadow">
                        <div class="botiga-dashboard-card-inner-header with-border-bottom bt-mb-10px">
                            <h2 class="bt-font-size-20px bt-mb-10px bt-mt-0"><?php echo esc_html__( 'Create New', 'botiga' ); ?></h2>
                            <p class="bt-text-color-grey bt-mt-0"><?php echo esc_html__( 'Start from scratch and design a custom template tailored to your specific needs.', 'botiga' ); ?></p>
                        </div>
                        <div class="botiga-dashboard-card-inner-body with-top-divider">
                            <div class="botiga-dashboard-row">
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Single', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/single-post.svg' ); ?>" alt="Single">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Archive', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/product-archives.svg' ); ?>" alt="Archive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Page', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/single-page.svg' ); ?>" alt="Page">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Page', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/404.svg' ); ?>" alt="404">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Content Block', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/content-block.svg' ); ?>" alt="Content Block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Single Product', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/single-product.svg' ); ?>" alt="Single Product">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Shop Archive', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/product-archives.svg' ); ?>" alt="Shop Archive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Cart', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/cart.svg' ); ?>" alt="Order Thank You">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Checkout', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/checkout.svg' ); ?>" alt="Order Thank You">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'My Account', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/my-account.svg' ); ?>" alt="My Account">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="botiga-dashboard-column botiga-dashboard-column-3">
                                    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card bt-template-card bt-template-card--create-new css-1pd4mph e19lxcc00">
                                        <div class="css-10klw3m e19lxcc00">
                                            <div data-wp-c16t="true" data-wp-component="CardHeader" class="components-flex components-card__header components-card-header bt-template-card__header bt-d-flex bt-justify-content-between css-off1bd e19lxcc00">
                                                <h2><?php echo esc_html__( 'Order Thank You', 'botiga' ); ?></h2>
                                            </div>
                                            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body bt-template-card__body css-188a3xf e19lxcc00">
                                                <a class="components-button with-lock-icon is-primary botiga-dashboard-pro-tooltip" href="<?php echo esc_url( $this->settings['tb_upgrade_pro'] ) ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                                    <?php echo esc_html__( 'Create New', 'botiga' ); ?>
                                                    <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                                                </a>
                                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/dashboard/templates-builder/order-received-page.svg' ); ?>" alt="Order Thank You">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
