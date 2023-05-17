<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-row">
    <div class="botiga-dashboard-column botiga-dashboard-column-9">
        
        <!-- Customize Your Size -->
        <div class="botiga-dashboard-card botiga-dashboard-card-top-spacing">
            <div class="botiga-dashboard-card-header bt-d-flex bt-justify-content-between bt-align-items-center">
                <h2><?php echo esc_html__( 'Customize your site', 'botiga' ); ?></h2>
                <a href="#" class="botiga-dashboard-external-link" target="_blank">
                    Go To Customizer
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                    </svg>
                </a>
            </div>
            <div class="botiga-dashboard-card-body">
                <div class="botiga-dashboard-row">
                    <?php foreach ($this->settings[ 'features' ] as $feature) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound 
                        if( $feature[ 'type' ] !== 'free' ) {
                            continue;
                        }
                        
                        ?>

                        <div class="botiga-dashboard-column botiga-dashboard-column-4">
                            <div class="botiga-dashboard-feature-card">
                                <div class="botiga-dashboard-feature-card-title">
                                    <h3><?php echo esc_html( $feature[ 'title' ] ); ?></h3>
                                </div>
                                <div class="botiga-dashboard-feature-card-actions">
                                    <?php if( ! isset( $feature[ 'module' ] ) ) : ?>
                                        <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-default">
                                            <?php echo esc_html__( 'Customize', 'botiga' ); ?>
                                        </a>
                                        <a href="#" class="botiga-dashboard-feature-card-link-icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17 3H9L10 5H14.08L7.99 11.1L9.4 12.51L15 6.92V10L17 11V3ZM12 12V15H5V8H9L11 6H3V17H14V10L12 12Z" fill="#3858E9"/>
                                            </svg>
                                        </a>
                                    <?php elseif ( Botiga_Modules::is_module_active( $feature['module'] ) ) : ?>
                                        <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-danger">
                                            <?php echo esc_html__( 'Deactivate', 'botiga' ); ?>
                                        </a>
                                        <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-info">
                                            <?php echo esc_html__( 'Customize', 'botiga' ); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-success">
                                            <?php echo esc_html__( 'Activate', 'botiga' ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Do more with Botiga Pro -->
        <div class="botiga-dashboard-card">
            <div class="botiga-dashboard-card-header bt-d-flex bt-justify-content-between bt-align-items-center">
                <h2><?php echo esc_html__( 'Do more with Botiga Pro', 'botiga' ); ?></h2>

                <?php if( ! defined( 'BOTIGA_PRO_VERSION' ) ) : ?>
                    <a href="#" class="botiga-dashboard-external-link" target="_blank">
                        Upgrade To Pro
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <div class="botiga-dahsboard-modules-global-actions">
                        <a href="#" class="botiga-dahsboard-modules-activate-all">
                            <?php echo esc_html__( 'Activate All', 'botiga' ); ?>
                        </a>
                        <a href="#" class="botiga-dahsboard-modules-deactivate-all">
                            <?php echo esc_html__( 'Deactivate All', 'botiga' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="botiga-dashboard-card-body">
                <div class="botiga-dashboard-row">
                    <?php foreach ($this->settings[ 'features' ] as $feature) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound 
                        if( $feature[ 'type' ] !== 'pro' ) {
                            continue;
                        }
                        
                        ?>

                        <div class="botiga-dashboard-column botiga-dashboard-column-4">
                            <div class="botiga-dashboard-feature-card">
                                <div class="botiga-dashboard-feature-card-title">
                                    <h3><?php echo esc_html( $feature[ 'title' ] ); ?></h3>
                                </div>
                                <div class="botiga-dashboard-feature-card-actions">
                                    <?php if( ! defined( 'BOTIGA_PRO_VERSION' ) ) : ?>
                                        <?php if( isset( $feature[ 'docs_link' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature[ 'docs_link' ] ); ?>" class="botiga-dashboard-feature-card-link" target="_blank">
                                                <?php echo esc_html__( 'Learn More', 'botiga' ); ?>
                                            </a>
                                        <?php endif; ?>
                                        <a href="#" class="botiga-dashboard-feature-card-link-icon botiga-dashboard-feature-card-link-icon-always-visible botiga-dashboard-pro-tooltip" data-tooltip-message="<?php echo esc_attr__( 'This option is only available on Botiga Pro', 'botiga' ); ?>">
                                            <svg width="28" height="16" viewBox="0 0 28 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.41309 8.90723H5.58203V7.85254H7.41309C7.71257 7.85254 7.95508 7.80371 8.14062 7.70605C8.32943 7.60514 8.46777 7.46842 8.55566 7.2959C8.64355 7.12012 8.6875 6.91992 8.6875 6.69531C8.6875 6.47721 8.64355 6.27376 8.55566 6.08496C8.46777 5.89616 8.32943 5.74316 8.14062 5.62598C7.95508 5.50879 7.71257 5.4502 7.41309 5.4502H6.02148V11.5H4.67871V4.39062H7.41309C7.96647 4.39062 8.43848 4.48991 8.8291 4.68848C9.22298 4.88379 9.52246 5.1556 9.72754 5.50391C9.93587 5.84896 10.04 6.24284 10.04 6.68555C10.04 7.14453 9.93587 7.54004 9.72754 7.87207C9.52246 8.2041 9.22298 8.45964 8.8291 8.63867C8.43848 8.81771 7.96647 8.90723 7.41309 8.90723ZM11.0947 4.39062H13.6777C14.2181 4.39062 14.682 4.47201 15.0693 4.63477C15.4567 4.79753 15.7546 5.03841 15.9629 5.35742C16.1712 5.67643 16.2754 6.06868 16.2754 6.53418C16.2754 6.90202 16.2103 7.22103 16.0801 7.49121C15.9499 7.76139 15.766 7.98763 15.5283 8.16992C15.2939 8.35221 15.0173 8.49544 14.6982 8.59961L14.2783 8.81445H11.998L11.9883 7.75488H13.6924C13.9691 7.75488 14.1986 7.70605 14.3809 7.6084C14.5632 7.51074 14.6999 7.37565 14.791 7.20312C14.8854 7.0306 14.9326 6.83366 14.9326 6.6123C14.9326 6.37467 14.887 6.1696 14.7959 5.99707C14.7048 5.82129 14.5664 5.6862 14.3809 5.5918C14.1953 5.4974 13.9609 5.4502 13.6777 5.4502H12.4375V11.5H11.0947V4.39062ZM15.1084 11.5L13.4629 8.31641L14.8838 8.31152L16.5488 11.4316V11.5H15.1084ZM23.209 7.76465V8.13086C23.209 8.66797 23.1374 9.15137 22.9941 9.58105C22.8509 10.0075 22.6475 10.3704 22.3838 10.6699C22.1201 10.9694 21.806 11.1989 21.4414 11.3584C21.0768 11.5179 20.6715 11.5977 20.2256 11.5977C19.7861 11.5977 19.3825 11.5179 19.0146 11.3584C18.6501 11.1989 18.3343 10.9694 18.0674 10.6699C17.8005 10.3704 17.5938 10.0075 17.4473 9.58105C17.3008 9.15137 17.2275 8.66797 17.2275 8.13086V7.76465C17.2275 7.22428 17.3008 6.74089 17.4473 6.31445C17.5938 5.88802 17.7988 5.52507 18.0625 5.22559C18.3262 4.92285 18.6403 4.69173 19.0049 4.53223C19.3727 4.37272 19.7764 4.29297 20.2158 4.29297C20.6618 4.29297 21.0671 4.37272 21.4316 4.53223C21.7962 4.69173 22.1104 4.92285 22.374 5.22559C22.641 5.52507 22.846 5.88802 22.9893 6.31445C23.1357 6.74089 23.209 7.22428 23.209 7.76465ZM21.8516 8.13086V7.75488C21.8516 7.36751 21.8158 7.02734 21.7441 6.73438C21.6725 6.43815 21.5667 6.18913 21.4268 5.9873C21.2868 5.78548 21.1143 5.63411 20.9092 5.5332C20.7041 5.42904 20.473 5.37695 20.2158 5.37695C19.9554 5.37695 19.7243 5.42904 19.5225 5.5332C19.3239 5.63411 19.1546 5.78548 19.0146 5.9873C18.8747 6.18913 18.7673 6.43815 18.6924 6.73438C18.6208 7.02734 18.585 7.36751 18.585 7.75488V8.13086C18.585 8.51497 18.6208 8.85514 18.6924 9.15137C18.7673 9.44759 18.8747 9.69824 19.0146 9.90332C19.1579 10.1051 19.3304 10.2581 19.5322 10.3623C19.734 10.4665 19.9652 10.5186 20.2256 10.5186C20.486 10.5186 20.7171 10.4665 20.9189 10.3623C21.1208 10.2581 21.29 10.1051 21.4268 9.90332C21.5667 9.69824 21.6725 9.44759 21.7441 9.15137C21.8158 8.85514 21.8516 8.51497 21.8516 8.13086Z" fill="#3858E9"/>
                                                <rect x="0.5" y="1" width="27" height="14" rx="1.5" stroke="#3858E9"/>
                                            </svg>
                                        </a>
                                    <?php else : ?>
                                        <?php if( ! isset( $feature[ 'module' ] ) ) : ?>
                                            <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-default">
                                                <?php echo esc_html__( 'Customize', 'botiga' ); ?>
                                            </a>
                                            <a href="#" class="botiga-dashboard-feature-card-link-icon">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 3H9L10 5H14.08L7.99 11.1L9.4 12.51L15 6.92V10L17 11V3ZM12 12V15H5V8H9L11 6H3V17H14V10L12 12Z" fill="#3858E9"/>
                                                </svg>
                                            </a>
                                        <?php elseif ( Botiga_Modules::is_module_active( $feature['module'] ) ) : ?>
                                            <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-danger">
                                                <?php echo esc_html__( 'Deactivate', 'botiga' ); ?>
                                            </a>
                                            <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-info">
                                                <?php echo esc_html__( 'Customize', 'botiga' ); ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="#" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-success">
                                                <?php echo esc_html__( 'Activate', 'botiga' ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Useful Plugins -->
        <div class="botiga-dashboard-card">
            <div class="botiga-dashboard-card-header bt-d-flex bt-justify-content-between bt-align-items-center">
                <h2><?php echo esc_html__( 'Useful Plugins', 'botiga' ); ?></h2>
            </div>
            <div class="botiga-dashboard-card-body">
                <div class="botiga-dashboard-row">

                    <?php foreach( $this->settings[ 'plugins' ] as $plugin ) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound ?>
                        <div class="botiga-dashboard-column botiga-dashboard-column-4">
                            <div class="botiga-dashboard-feature-card">
                                <div class="botiga-dashboard-feature-card-image botiga-dashboard-feature-card-image-rounded">
                                    <figure>
                                        <img src="<?php echo esc_url( $plugin[ 'icon' ] ); ?>" alt="<?php echo esc_attr( $plugin[ 'title' ] ); ?>" />
                                    </figure>
                                </div>
                                <div class="botiga-dashboard-feature-card-title">
                                    <h3><?php echo esc_html( $plugin[ 'title' ] ); ?></h3>
                                </div>
                                <div class="botiga-dashboard-feature-card-actions">
                                    <?php if ('not_installed' === $this->get_plugin_status($plugin['path'])) : ?>
                                        <a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-info botiga-dashboard-plugin-ajax-button" data-type="install" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e( 'Install', 'botiga' ); ?></a>
                                    <?php elseif ('inactive' === $this->get_plugin_status($plugin['path'])) : ?>
                                        <a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-success botiga-dashboard-plugin-ajax-button" data-type="activate" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e('Activate', 'botiga'); ?></a>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="botiga-dashboard-feature-card-link botiga-dashboard-feature-card-link-danger botiga-dashboard-plugin-ajax-button" data-type="deactivate" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e('Deactivate', 'botiga'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
    <div class="botiga-dashboard-column botiga-dashboard-column-3">
        
        <div class="botiga-dashboard-sticky-wrapper">
            <!-- Priority Support -->
            <div class="botiga-dashboard-card bt-border-color-primary">
                <div class="botiga-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Priority support', 'botiga' ); ?></h2>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>We aim to answer all priority support requests within 2-3 hours. </p>
                    <a href="#" class="botiga-dashboard-external-link" target="_blank">
                        Get Premium Support With Botiga Pro
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Leave a Review -->
            <div class="botiga-dashboard-card">
                <div class="botiga-dashboard-card-header bt-d-flex bt-justify-content-between bt-align-items-center">
                    <h2><?php echo esc_html__( 'Leave a review', 'botiga' ); ?></h2>
                    <svg width="83" height="24" viewBox="0 0 83 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_1797)">
                        <path d="M74.6355 2.87524H4.76826C2.13482 2.87524 0 5.0091 0 7.64133V18.5084C0 21.1407 2.13482 23.2745 4.76826 23.2745H74.6355C77.2689 23.2745 79.4037 21.1407 79.4037 18.5084V7.64133C79.4037 5.0091 77.2689 2.87524 74.6355 2.87524Z" fill="#F5F5F5"/>
                        <path d="M76.2002 0.728333H6.33295C3.69952 0.728333 1.5647 2.86218 1.5647 5.49442V16.3615C1.5647 18.9938 3.69952 21.1276 6.33295 21.1276H76.2002C78.8336 21.1276 80.9684 18.9938 80.9684 16.3615V5.49442C80.9684 2.86218 78.8336 0.728333 76.2002 0.728333Z" fill="white"/>
                        <path d="M13.8982 5.11517L15.6982 8.75802L19.7219 9.34525L16.8117 12.1824L17.4983 16.1871L13.8982 14.2957L10.2981 16.1871L10.9846 12.1824L8.07446 9.34525L12.0981 8.75802L13.8982 5.11517Z" fill="#FFB840"/>
                        <path d="M27.5817 5.11517L29.3818 8.75802L33.4089 9.34525L30.4953 12.1824L31.1819 16.1871L27.5817 14.2957L23.9851 16.1871L24.6716 12.1824L21.7581 9.34525L25.7851 8.75802L27.5817 5.11517Z" fill="#FFB840"/>
                        <path d="M41.268 5.11517L43.0681 8.75802L47.0917 9.34525L44.1782 12.1824L44.8681 16.1871L41.268 14.2957L37.6679 16.1871L38.3545 12.1824L35.4443 9.34525L39.468 8.75802L41.268 5.11517Z" fill="#FFB840"/>
                        <path d="M54.9509 5.11517L56.7509 8.75802L60.7746 9.34525L57.8644 12.1824L58.551 16.1871L54.9509 14.2957L51.3508 16.1871L52.0408 12.1824L49.1272 9.34525L53.1508 8.75802L54.9509 5.11517Z" fill="#FFB840"/>
                        <path d="M68.6378 5.11517L70.4378 8.75802L74.4615 9.34525L71.5479 12.1824L72.2379 16.1871L68.6378 14.2957L65.0377 16.1871L65.7242 12.1824L62.8107 9.34525L66.8377 8.75802L68.6378 5.11517Z" fill="#FFB840"/>
                        </g>
                        <path d="M82.85 4.15852C80.8962 4.56585 80.347 5.11249 79.9415 7.06475C79.8992 7.26526 79.612 7.26526 79.5697 7.06475C79.1621 5.11249 78.615 4.56374 76.6612 4.15852C76.4606 4.1163 76.4606 3.82927 76.6612 3.78706C78.615 3.37972 79.1621 2.83309 79.5697 0.87871C79.612 0.678207 79.8992 0.678207 79.9415 0.87871C80.3491 2.83098 80.8962 3.37972 82.85 3.78495C83.0507 3.82716 83.0507 4.11419 82.85 4.15641V4.15852Z" fill="#F5F5F5"/>
                        <defs>
                        <clipPath id="clip0_1_1797">
                        <rect width="80.9681" height="22.5433" fill="white" transform="translate(0 0.728333)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>It makes us happy to hear from our users. We would appreciate a review. </p>
                    <a href="#" class="button button-primary button-outline button-medium bt-font-weight-500">
                        <?php echo esc_html__( 'Submit a Review', 'botiga' ); ?>
                    </a>
                </div>
            </div>

            <!-- Knowledge Base -->
            <div class="botiga-dashboard-card">
                <div class="botiga-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Knowledge base', 'botiga' ); ?></h2>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>Browse documentation, reference material, and tutorials for Botiga Theme. </p>
                    <a href="#" class="button button-primary button-outline button-medium bt-font-weight-500">
                        <?php echo esc_html__( 'View All', 'botiga' ); ?>
                    </a>
                </div>
            </div>

            <!-- Need Help? -->
            <div class="botiga-dashboard-card">
                <div class="botiga-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Need help? We\'re here for you!', 'botiga' ); ?></h2>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>Get the help you need, when you need it from our friendly support staff. </p>
                    <a href="#" class="button button-primary button-outline button-medium bt-font-weight-500">
                        <?php echo esc_html__( 'Submit a Ticket', 'botiga' ); ?>
                    </a>
                </div>
            </div>

            <!-- Have and idea of feedback -->
            <div class="botiga-dashboard-card">
                <div class="botiga-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Have an idea or feedback?', 'botiga' ); ?></h2>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>Got an idea for how to improve Botiga and Botiga Pro? Let us know. </p>
                    <a href="#" class="botiga-dashboard-external-link" target="_blank">
                        Suggest An Idea
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Join our facebook comunity -->
            <div class="botiga-dashboard-card">
                <div class="botiga-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Join our Facebook community', 'botiga' ); ?></h2>
                </div>
                <div class="botiga-dashboard-card-body">
                    <p>Want to share your awesome project or just say hi? Join our wonderful community! </p>
                    <a href="#" class="button button-primary button-outline button-medium bt-font-weight-500">
                        <?php echo esc_html__( 'Join Now', 'botiga' ); ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
