<div class="botiga-dashboard-card botiga-dashboard-card-no-box-shadow">
    <div class="botiga-dashboard-card-inner-header bt-mb-10px">
        <h2 class="bt-font-size-20px bt-mb-10px bt-mt-0"><?php echo esc_html__( 'Customization Settings', 'botiga' ); ?></h2>
        <p class="bt-text-color-grey bt-m-0">The customization settings for the shop filters.</p>
    </div>
    <div class="bt-shop-filter-settings">
        <div class="components-panel__row">
            <div class="components-base-control components-input-control components-number-control ep09it41 css-1guhyj3 ej5x27r4">
                <div class="components-base-control__field css-1sf3vf3 ej5x27r3">
                    <div data-wp-c16t="true" data-wp-component="InputBase" class="components-flex components-input-base em5sgkm7 css-fge3ct e19lxcc00">
                        <div data-wp-c16t="true" data-wp-component="FlexItem" class="components-flex-item em5sgkm3 css-z5z9eh e19lxcc00">
                            <label data-wp-c16t="true" data-wp-component="Text" for="inspector-input-control-0" class="components-truncate components-text components-input-control__label em5sgkm4 css-1imalal e19lxcc00">Color swatch size</label>
                        </div>
                        <div class="components-input-control__container css-1y1qek0 em5sgkm6">
                            <input autocomplete="off" inputmode="numeric" max="100" min="1" step="1" aria-describedby="inspector-input-control-0__help" class="components-input-control__input css-1f82kdl em5sgkm5" id="inspector-input-control-0" type="number" value="15">
                            <div aria-hidden="true" class="components-input-control__backdrop css-83ljq2 em5sgkm2"></div>
                        </div>
                    </div>
                </div>
                <p id="inspector-input-control-0__help" class="components-base-control__help css-1iwb6nq ej5x27r1">Controls the size for the color swatches.</p>
            </div>
        </div>
        <div class="components-panel__row">
            <div class="components-base-control components-radio-control css-qy3gpb ej5x27r4">
                <div class="components-base-control__field css-1sf3vf3 ej5x27r3">
                    <label class="components-base-control__label css-1v57ksj ej5x27r2" for="inspector-radio-control-1">Color swatch style</label>
                    <div data-wp-c16t="true" data-wp-component="VStack" class="components-flex components-h-stack components-v-stack css-1dnujmn e19lxcc00">
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-1-0" class="components-radio-control__input" type="radio" name="inspector-radio-control-1" aria-describedby="inspector-radio-control-1__help" value="rounded">
                            <label class="components-radio-control__label" for="inspector-radio-control-1-0">Rounded</label>
                        </div>
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-1-1" class="components-radio-control__input" type="radio" name="inspector-radio-control-1" aria-describedby="inspector-radio-control-1__help" value="square" checked="">
                            <label class="components-radio-control__label" for="inspector-radio-control-1-1">Square</label>
                        </div>
                    </div>
                </div>
                <p id="inspector-radio-control-1__help" class="components-base-control__help css-1iwb6nq ej5x27r1">Controls the style for the color swatches.</p>
            </div>
        </div>
    </div>
    <hr class="botiga-dashboard-divider">
    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary btsf-save-settings botiga-dashboard-pro-tooltip" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank" style="max-width: 150px;">
        Save settings
        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
    </a>
</div>