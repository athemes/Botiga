<?php

/**
 * Patcher HTML
 *
 * @package Botiga
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_script( 'botiga-plugin-installer' );

?>

<style>
    .botiga-dashboard-alert {
        background-color: #fbfbfb;
        border: 1px solid #ebebeb;
        border-radius: 6px;
        padding: 20px;
        margin: 0 0 20px;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, .15);
    }

    .botiga-dashboard-alert p {
        margin: 0
    }

    .botiga-dashboard-alert.botiga-dashboard-alert-with-icon {
        position: relative;
        padding-left: 50px
    }

    .botiga-dashboard-alert.botiga-dashboard-alert-with-icon .alert-icon {
        position: absolute;
        top: 21px;
        left: 20px;
        max-width: 17px
    }

    .botiga-dashboard-alert.botiga-dashboard-alert-with-icon .alert-icon svg {
        width: 100%;
        height: auto
    }

    .botiga-dashboard-alert.botiga-dashboard-alert-with-upsell-link {
        padding-right: 160px
    }

    .botiga-dashboard-alert.botiga-dashboard-alert-with-upsell-link .botiga-dashboard-external-link {
        position: absolute;
        top: 22px;
        right: 20px
    }

    .botiga-dashboard-external-link {
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        gap: 8px;
        font-size: 13px;
        line-height: 13px;
        font-weight: 500;
        color: #3858e9;
        white-space: nowrap;
        -webkit-transition: ease opacity 300ms;
        transition: ease opacity 300ms
    }

    .botiga-dashboard-external-link svg {
        position: relative;
        top: 1px
    }

    .botiga-dashboard-external-link:hover,.botiga-dashboard-external-link:focus,.botiga-dashboard-external-link:active {
        color: #3858e9;
        opacity: .7
    }

    h2 {
        margin-block-end: 10px;
    }

    p {
        color: #757575;
    }

    #athemes-patcher-options-page {
        max-width: 1280px;
        margin: 0 auto;
        padding: 25px 25px 25px 0px;
    }

    .athemes-patcher-info-badge {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: 7px;
        color: #444;
        background-color: #f0f2ff;
        padding: 14px;
        border-radius: 7px;
        -webkit-text-decoration: none;
        text-decoration: none;
    }

    .athemes-patcher-info-badge:hover {
        color: #212121;
    }

    .athemes-patcher-info-badge svg {
        width: 18px;
        fill: #444;
    }

    .components-panel__body {
        border: 0;
    }

    .athemes-patcher-card-title {
        font-size: 16px;
        font-weight: 600;
        margin-block-start: 0;
        margin-block-end: 10px;
    }

    .athemes-patcher-card-desc {
        color: #757575;
        margin-block-start: 0;
        margin-block-end: 20px;
    }

    .athemes-patcher-card {
        background-color: #FFF;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, .15);
        border-radius: 7px;
    }

    .athemes-patcher-card+.athemes-patcher-card {
        margin-block-start: 20px;
    }

    .athemes-patchers-table thead tr:first-of-type {
        border-top: 0;
    }

    .athemes-patchers-table tr {
        border-top: 1px solid #e3e3e3;
    }

    .athemes-patchers-table td,
    .athemes-patchers-table th {
        padding: 7px 0px;
    }

    .athemes-patchers-table th:first-of-type,
    .athemes-patchers-table th:last-of-type {
        width: 150px;
    }

    .athemes-patchers-table td {
        color: #444;
    }

    .css-1hdyajo {
        padding: 20px;
    }

    .css-3nngo0 {
        margin-block-start: 0;
        margin-block-end: 20px;
    }

    .css-1qudilh {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 7px;
        text-align: center;
    }

    .css-1yscn4x {
        margin-top: 20px;
    }

    .css-12dj36i {
        border-radius: 7px;
    }

    .css-13h15nb {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 7px;
        text-align: left;
    }

    .css-18si9r1 {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .css-wpjqd {
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: 5px;
        background-color: transparent !important;
        color: #3858e9 !important;
        border-radius: 4px;
        border: 2px solid #3858e9;
    }

    .css-wpjqd:hover {
        background-color: #3858e9;
        color: #FFF !important;
    }

    .css-wpjqd:disabled {
        color: #3858e9 !important;
        border: 2px solid #3858e9;
    }

    .css-152qpu8 {
        width: 15px;
    }

    .css-adm54n{display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;gap:5px;background-color:#3858e9;color:#FFF!important;border-radius:4px;}

    .has-lock-icon svg {
        width: 18px;
    }

    .botiga-dashboard-pro-tooltip {
        position: relative
    }

    .botiga-dashboard-pro-tooltip:before {
        content: attr(data-tooltip-message);
        position: absolute;
        bottom: calc(100% + 11px);
        left: 50%;
        color: #fff;
        font-size: 11px;
        line-height: 16px;
        padding: 3px 6px;
        background-color: #1e1e1e;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        -webkit-transform: translate3d(-50%, 6px, 0);
        transform: translate3d(-50%, 6px, 0);
        -webkit-transition: ease opacity 300ms,ease transform 300ms;
        transition: ease opacity 300ms,ease transform 300ms;
        z-index: 2
    }

    .botiga-dashboard-pro-tooltip:after {
        content: "";
        position: absolute;
        bottom: calc(100% + 3px);
        left: 50%;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 4px 4px 4px 4px;
        border-color: #1e1e1e rgba(0,0,0,0) rgba(0,0,0,0) rgba(0,0,0,0);
        opacity: 0;
        visibility: hidden;
        -webkit-transform: translate3d(-50%, 6px, 0);
        transform: translate3d(-50%, 6px, 0);
        -webkit-transition: ease opacity 300ms,ease transform 300ms;
        transition: ease opacity 300ms,ease transform 300ms;
        z-index: 2
    }

    .botiga-dashboard-pro-tooltip:hover:before,.botiga-dashboard-pro-tooltip:hover:after {
        opacity: 1;
        visibility: visible;
        -webkit-transform: translate3d(-50%, 0, 0);
        transform: translate3d(-50%, 0, 0)
    }
</style>
<div id="athemes-patcher-options-page">
    <?php if ( ! defined( 'BOTIGA_PRO_VERSION' ) ) : ?>
        <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
            <div class="alert-icon">
                <svg height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M85.57,446.25H426.43a32,32,0,0,0,28.17-47.17L284.18,82.58c-12.09-22.44-44.27-22.44-56.36,0L57.4,399.08A32,32,0,0,0,85.57,446.25Z" fill="none" stroke="#000" stroke-linecap="rounded" stroke-width="32" stroke-linejoin="round" /><path d="M250.26,195.39l5.74,122,5.73-121.95a5.74,5.74,0,0,0-5.79-6h0A5.74,5.74,0,0,0,250.26,195.39Z" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" /><path d="M256,397.25a20,20,0,1,1,20-20A20,20,0,0,1,256,397.25Z"/></svg>
            </div>
            <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note this feature is available only in Botiga Pro', 'botiga' ); ?></p>
            <a href="https://athemes.com/botiga-upgrade?utm_source=athemes-patcher&utm_medium=link&utm_campaign=Botiga" class="botiga-dashboard-external-link" target="_blank">
                <?php echo esc_html__( 'Upgrade Now', 'botiga' ); ?>

                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
                </svg>
            </a>
        </div>
    <?php endif; ?>
    <?php if ( defined( 'BOTIGA_PRO_VERSION' ) && ! defined( 'ATHEMES_PATCHER_VERSION' ) ) : ?>
        <div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
            <div class="alert-icon">
                <svg height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M85.57,446.25H426.43a32,32,0,0,0,28.17-47.17L284.18,82.58c-12.09-22.44-44.27-22.44-56.36,0L57.4,399.08A32,32,0,0,0,85.57,446.25Z" fill="none" stroke="#000" stroke-linecap="rounded" stroke-width="32" stroke-linejoin="round" /><path d="M250.26,195.39l5.74,122,5.73-121.95a5.74,5.74,0,0,0-5.79-6h0A5.74,5.74,0,0,0,250.26,195.39Z" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" /><path d="M256,397.25a20,20,0,1,1,20-20A20,20,0,0,1,256,397.25Z"/></svg>
            </div>
            <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note that to use this feature you need to install and activate the aThemes Patcher plugin.', 'botiga' ); ?></p>
            <a href="#" class="botiga-dashboard-link botiga-dashboard-link-succes botiga-dashboard-external-link botiga-install-plugin" data-type="external" data-plugin-url="https://patcher.athemes.com/athemes-patcher.zip?nocache=<?php echo esc_attr( time() ); ?>" data-plugin-name="athemes-patcher/athemes-patcher.php" data-redirect-to="<?php echo esc_url( add_query_arg('page', 'athemes-patcher-bp', admin_url('admin.php')) ); ?>">
                <?php echo esc_html__( 'Install and Activate aThemes Patcher', 'botiga' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card athemes-patcher-card css-1hdyajo css-1otwcjs e19lxcc00">
        <div class="css-10klw3m e19lxcc00">
            <h2 class="css-3nngo0">aThemes Patcher</h2>
            <p>Welcome to the aThemes Patcher settings page. The Patcher allows you to apply small fixes to your website without the need to await for new releases, keeping your website up to date.</p>
            <a href="https://docs.athemes.com/article/pro-athemes-patcher/" class="athemes-patcher-info-badge" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                    <path d="M12 3.2c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8 0-4.8-4-8.8-8.8-8.8zm0 16c-4 0-7.2-3.3-7.2-7.2C4.8 8 8 4.8 12 4.8s7.2 3.3 7.2 7.2c0 4-3.2 7.2-7.2 7.2zM11 17h2v-6h-2v6zm0-8h2V7h-2v2z"></path>
                </svg>Learn more about the Patcher </a>
        </div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
    </div>
    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card athemes-patcher-card css-1hdyajo css-1otwcjs e19lxcc00">
        <div class="css-10klw3m e19lxcc00">
            <h3 class="athemes-patcher-card-title">Botiga Pro</h3>
            <p class="athemes-patcher-card-desc">The following patches are available for the version <?php echo esc_html( BOTIGA_VERSION ); ?></p>
            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body css-13h15nb css-9ii361 e19lxcc00">
                <table class="athemes-patchers-table css-18si9r1">
                    <thead>
                        <tr>
                            <th>Patch #</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#467</td>
                            <td>Improved performance when loading custom assets during page transitions.</td>
                            <td>
                                <a class="components-button has-lock-icon css-adm54n botiga-dashboard-pro-tooltip" href="https://athemes.com/botiga-upgrade?utm_source=athemes-patcher&utm_medium=link&utm_campaign=Botiga" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>">
                                    Apply
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="48" height="48" aria-hidden="true" focusable="false"><path d="M17 10h-1.2V7c0-2.1-1.7-3.8-3.8-3.8-2.1 0-3.8 1.7-3.8 3.8v3H7c-.6 0-1 .4-1 1v8c0 .6.4 1 1 1h10c.6 0 1-.4 1-1v-8c0-.6-.4-1-1-1zM9.8 7c0-1.2 1-2.2 2.2-2.2 1.2 0 2.2 1 2.2 2.2v3H9.8V7zm6.7 11.5h-9v-7h9v7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>#465</td>
                            <td>Updated widget behavior for smoother interactions across multiple devices.</td>
                            <td>
                                <button type="button" disabled="" class="components-button css-wpjqd">Applied <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="css-152qpu8" aria-hidden="true" focusable="false">
                                        <path d="M18.3 5.6L9.9 16.9l-4.6-3.4-.9 1.2 5.8 4.3 9.3-12.6z"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#463</td>
                            <td>Minor fix to improve admin panel usability. </td>
                            <td>
                                <button type="button" disabled="" class="components-button css-wpjqd">Applied <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="css-152qpu8" aria-hidden="true" focusable="false">
                                        <path d="M18.3 5.6L9.9 16.9l-4.6-3.4-.9 1.2 5.8 4.3 9.3-12.6z"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="css-1yscn4x">
                <div class="css-12dj36i components-panel">
                    <div class="components-panel__body">
                        <h2 class="components-panel__body-title">
                            <button type="button" aria-expanded="false" class="components-button components-panel__body-toggle">
                                <span aria-hidden="true">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="components-panel__arrow" aria-hidden="true" focusable="false">
                                        <path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"></path>
                                    </svg>
                                </span>Logs </button>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
    </div>
</div>