<div class="botiga-dashboard-card botiga-dashboard-card-no-box-shadow">
    <div class="botiga-dashboard-card-inner-header bt-mb-10px">
        <h2 class="bt-font-size-20px bt-mb-10px bt-mt-0"><?php echo esc_html__( 'Filter Presets', 'botiga' ); ?></h2>
        <p class="bt-text-color-grey bt-m-0">The list of filter presets which you can use in your shop.</p>
    </div>
    <div class="bt-presets-list">
        <div class="bt-presets-list__header">
            <strong>Preset Name</strong>
            <strong>Shortcode</strong>
            <strong>Actions</strong>
        </div>
        <div class="bt-presets-list__body">
            <div class="bt-presets-list__item">
                <p class="bt-presets-list__item-name">My preset</p>
                <p class="bt-presets-list__item-shortcode">[botiga_shop_filters-preset-0ugb9]</p>
                <div class="bt-presets-list__item-actions">
                    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary botiga-dashboard-pro-tooltip has-icon" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank">
                        Edit
                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                    </a>
                    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-secondary botiga-dashboard-pro-tooltip has-icon has-icon-blue" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank">
                        Remove
                        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
                    </a>
                </div>
            </div>
        </div>
        <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-secondary bt-presets-list__add-button botiga-dashboard-pro-tooltip has-icon has-icon-blue" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank">
            + Add new preset
            <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
        </a>
    </div>
    <hr class="botiga-dashboard-divider">
    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary btsf-save-settings botiga-dashboard-pro-tooltip has-icon" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank" style="max-width: 150px;">
        Save settings
        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
    </a>
</div>