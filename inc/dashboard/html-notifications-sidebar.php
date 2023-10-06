<?php

/**
 * Notifications Sidebar
 * 
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="botiga-dashboard-notifications-sidebar">
    <a href="#" class="botiga-dashboard-notifications-sidebar-close" title="<?php echo esc_attr__( 'Close the sidebar', 'botiga' ); ?>">
        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.4584 4.54038L12.4597 3.54163L8.50008 7.50121L4.5405 3.54163L3.54175 4.54038L7.50133 8.49996L3.54175 12.4595L4.5405 13.4583L8.50008 9.49871L12.4597 13.4583L13.4584 12.4595L9.49883 8.49996L13.4584 4.54038Z" fill="black"/>
        </svg>
    </a>
    <div class="botiga-dashboard-notifications-sidebar-inner">

        <div class="botiga-dashboard-notifications-sidebar-header">
            <div class="botiga-dashboard-notifications-sidebar-header-icon">
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.9441 20.5818C12.3228 20.8497 12.7752 20.9936 13.2391 20.9937L11.9441 20.5818ZM11.9441 20.5818C11.6044 20.3416 11.3391 20.0122 11.1764 19.6313M11.9441 20.5818L11.1764 19.6313M11.1764 19.6313H15.3018C15.1392 20.0122 14.8738 20.3416 14.5341 20.5818C14.1554 20.8497 13.703 20.9936 13.2391 20.9937L11.1764 19.6313ZM5.42653 19.6313H5.4266H9.33118C9.5281 20.5037 10.0116 21.2861 10.7057 21.8526C11.4209 22.4365 12.3158 22.7554 13.2391 22.7554C14.1624 22.7554 15.0573 22.4365 15.7725 21.8526C16.4666 21.2861 16.9501 20.5037 17.147 19.6313H21.0516H21.0517C21.344 19.6309 21.631 19.5534 21.8838 19.4068C22.1366 19.2601 22.3462 19.0494 22.4916 18.7959C22.637 18.5424 22.713 18.255 22.712 17.9628C22.7109 17.6705 22.6329 17.3837 22.4856 17.1313C21.9553 16.2176 21.1516 13.5951 21.1516 10.1562C21.1516 8.05772 20.318 6.04515 18.8341 4.56127C17.3502 3.07739 15.3376 2.24375 13.2391 2.24375C11.1406 2.24375 9.128 3.07739 7.64412 4.56127C6.16024 6.04515 5.3266 8.05772 5.3266 10.1562C5.3266 13.5963 4.52185 16.2179 3.99149 17.1314L4.07797 17.1816L3.99158 17.1313C3.84432 17.3838 3.76625 17.6707 3.76524 17.963C3.76424 18.2554 3.84034 18.5428 3.98587 18.7964C4.1314 19.0499 4.34121 19.2606 4.59414 19.4072C4.84708 19.5537 5.13419 19.631 5.42653 19.6313ZM5.59668 17.8687C6.33498 16.4852 7.0891 13.5615 7.0891 10.1562C7.0891 8.52517 7.73705 6.96089 8.8904 5.80754C10.0437 4.65419 11.608 4.00625 13.2391 4.00625C14.8702 4.00625 16.4345 4.65419 17.5878 5.80754C18.7412 6.96089 19.3891 8.52517 19.3891 10.1562C19.3891 13.5589 20.1415 16.4827 20.8815 17.8687H5.59668Z" fill="#3858E9" stroke="#3858E9" stroke-width="0.2"/>
                </svg>
            </div>
            <div class="botiga-dashboard-notifications-sidebar-header-content">
                <h3>
                    <?php 
                    if( $notification_read ) {
                        echo esc_html__( 'Latest News', 'botiga' );
                    } else {
                        echo esc_html__( 'New Update', 'botiga' );
                    } ?>
                </h3>
                <p><?php echo esc_html__( 'Check the latest news from Botiga', 'botiga' ); ?></p>
            </div>
        </div>
        <?php if( $this->settings[ 'notifications_tabs' ] ) : ?>
            <div class="botiga-dashboard-notifications-sidebar-tabs">
                <nav class="botiga-dashboard-tabs-nav botiga-dashboard-tabs-nav-no-negative-margin" data-tab-wrapper-id="notifications-sidebar">
                    <ul>
                        <li class="botiga-dashboard-tabs-nav-item active">
                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="notifications-sidebar-botiga">
                                <?php echo esc_html__( 'Botiga', 'botiga' ); ?>
                            </a>
                        </li>
                        <li class="botiga-dashboard-tabs-nav-item">
                            <a href="#" class="botiga-dashboard-tabs-nav-link" data-tab-to="notifications-sidebar-botiga-pro">
                                <?php echo esc_html__( 'Botiga Pro', 'botiga' ); ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
        <div class="botiga-dashboard-notifications-sidebar-body botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="notifications-sidebar">
            <div class="botiga-dashboard-tab-content active" data-tab-content-id="notifications-sidebar-botiga">
                <?php 
                
                if( isset( $this->settings[ 'notifications' ] ) && $this->settings[ 'notifications' ] ) : 
                    $display_version = false;

                    ?>

                    <?php foreach( $this->settings[ 'notifications' ] as $notification ) : 
                        $date    = isset( $notification->post_date ) ? $notification->post_date : false;
                        $version = isset( $notification->post_title ) ? $notification->post_title : false;
                        $content = isset( $notification->post_content ) ? $notification->post_content : false;
                        
                        ?>

                        <div class="botiga-dashboard-notification">
                            <?php if( $date ) : ?>
                                <span class="botiga-dashboard-notification-date" data-raw-date="<?php echo esc_attr( $date ); ?>">
                                    <?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?>
                                    <?php if( $display_version ) : ?>
                                        <span class="botiga-dashboard-notification-version"><?php echo sprintf( '(%s)', $version ); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <?php if( $content ) : ?>
                                <div class="botiga-dashboard-notification-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php 
                        $display_version = true;
                    endforeach; ?>

                <?php else : ?>

                    <div class="botiga-dashboard-notification">
                        <div class="botiga-dashboard-notification-content">
                            <p class="changelog-description"><?php echo esc_html__( 'No notifications found', 'botiga' ); ?></p>
                        </div>
                    </div>

                <?php 
                endif; ?>

            </div>

            <?php if( $this->settings[ 'notifications_tabs' ] ) : ?>
            <div class="botiga-dashboard-tab-content" data-tab-content-id="notifications-sidebar-botiga-pro">
                <?php 
                
                if( isset( $this->settings[ 'notifications_pro' ] ) && $this->settings[ 'notifications_pro' ] ) : 
                    $display_version = false;

                    ?>

                    <?php foreach( $this->settings[ 'notifications_pro' ] as $notification ) : 
                        $date    = isset( $notification->post_date ) ? $notification->post_date : false;
                        $version = isset( $notification->post_title ) ? $notification->post_title : false;
                        $content = isset( $notification->post_content ) ? $notification->post_content : false;
                        
                        ?>

                        <div class="botiga-dashboard-notification">
                            <?php if( $date ) : ?>
                                <span class="botiga-dashboard-notification-date">
                                    <?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?>
                                    <?php if( $display_version ) : ?>
                                        <span class="botiga-dashboard-notification-version"><?php echo sprintf( '(%s)', $version ); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <?php if( $content ) : ?>
                                <div class="botiga-dashboard-notification-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php 
                        $display_version = true;
                    endforeach; ?>

                <?php else : ?>

                    <div class="botiga-dashboard-notification">
                        <div class="botiga-dashboard-notification-content">
                            <p class="changelog-description"><?php echo esc_html__( 'No notifications found', 'botiga' ); ?></p>
                        </div>
                    </div>

                <?php 
                endif; ?>

            </div>
            <?php endif; ?>

        </div>

    </div>
</div>

<?php
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
