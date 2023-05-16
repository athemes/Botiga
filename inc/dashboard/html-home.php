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
        <div class="botiga-dashboard-card botiga-dashboard-card-top-spacing">
            <div class="botiga-dashboard-card-header bt-d-flex bt-justify-content-between">
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
                                        <a href="#" class="botiga-dashboard-feature-card-link">
                                            <?php echo esc_html__( 'Customize', 'botiga' ); ?>
                                        </a>
                                    <?php else : ?>

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

    </div>
</div>
