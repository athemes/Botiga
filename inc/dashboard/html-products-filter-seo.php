<div class="botiga-dashboard-card botiga-dashboard-card-no-box-shadow">
    <div class="botiga-dashboard-card-inner-header bt-mb-10px">
        <h2 class="bt-font-size-20px bt-mb-10px bt-mt-0"><?php echo esc_html__( 'SEO Settings', 'botiga' ); ?></h2>
        <p class="bt-text-color-grey bt-m-0">The SEO settings for the shop filters.</p>
    </div>
    <form class="bt-shop-filter-settings">
        <div class="components-panel__row">
            <div class="components-base-control components-toggle-control css-1dd79d2 ej5x27r4">
                <div class="components-base-control__field css-1sf3vf3 ej5x27r3">
                    <div data-wp-c16t="true" data-wp-component="HStack" class="components-flex components-h-stack css-1aagzef e19lxcc00">
                        <span class="components-form-toggle is-checked">
                            <input class="components-form-toggle__input" id="inspector-toggle-control-4" type="checkbox" aria-describedby="inspector-toggle-control-4__help" checked="">
                            <span class="components-form-toggle__track"></span>
                            <span class="components-form-toggle__thumb"></span>
                        </span>
                        <label data-wp-c16t="true" data-wp-component="FlexBlock" for="inspector-toggle-control-4" class="components-flex-item components-flex-block components-toggle-control__label css-13y8vek e19lxcc00">Enable SEO options</label>
                    </div>
                </div>
                <p id="inspector-toggle-control-4__help" class="components-base-control__help css-1iwb6nq ej5x27r1">Enable to add 'robots' meta tag to the head of the page when the filters are activated.</p>
            </div>
        </div>
        <div class="components-panel__row">
            <div class="components-base-control components-radio-control css-qy3gpb ej5x27r4">
                <div class="components-base-control__field css-1sf3vf3 ej5x27r3">
                    <label class="components-base-control__label css-1v57ksj ej5x27r2" for="inspector-radio-control-2">Meta tag</label>
                    <div data-wp-c16t="true" data-wp-component="VStack" class="components-flex components-h-stack components-v-stack css-1dnujmn e19lxcc00">
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-2-0" class="components-radio-control__input" type="radio" name="inspector-radio-control-2" aria-describedby="inspector-radio-control-2__help" value="disabled" checked="">
                            <label class="components-radio-control__label" for="inspector-radio-control-2-0">Disabled</label>
                        </div>
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-2-1" class="components-radio-control__input" type="radio" name="inspector-radio-control-2" aria-describedby="inspector-radio-control-2__help" value="noindex,nofollow">
                            <label class="components-radio-control__label" for="inspector-radio-control-2-1">noindex, nofollow</label>
                        </div>
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-2-2" class="components-radio-control__input" type="radio" name="inspector-radio-control-2" aria-describedby="inspector-radio-control-2__help" value="noindex,follow">
                            <label class="components-radio-control__label" for="inspector-radio-control-2-2">noindex, follow</label>
                        </div>
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-2-3" class="components-radio-control__input" type="radio" name="inspector-radio-control-2" aria-describedby="inspector-radio-control-2__help" value="index,nofollow">
                            <label class="components-radio-control__label" for="inspector-radio-control-2-3">index, nofollow</label>
                        </div>
                        <div class="components-radio-control__option">
                            <input id="inspector-radio-control-2-4" class="components-radio-control__input" type="radio" name="inspector-radio-control-2" aria-describedby="inspector-radio-control-2__help" value="index,follow">
                            <label class="components-radio-control__label" for="inspector-radio-control-2-4">index, follow</label>
                        </div>
                    </div>
                </div>
                <p id="inspector-radio-control-2__help" class="components-base-control__help css-1iwb6nq ej5x27r1">Which tag to use in the filtered pages.</p>
            </div>
        </div>
        <div class="components-panel__row">
            <div class="components-base-control components-toggle-control css-1dd79d2 ej5x27r4">
                <div class="components-base-control__field css-1sf3vf3 ej5x27r3">
                    <div data-wp-c16t="true" data-wp-component="HStack" class="components-flex components-h-stack css-1aagzef e19lxcc00">
                        <span class="components-form-toggle">
                            <input class="components-form-toggle__input" id="inspector-toggle-control-5" type="checkbox" aria-describedby="inspector-toggle-control-5__help">
                            <span class="components-form-toggle__track"></span>
                            <span class="components-form-toggle__thumb"></span>
                        </span>
                        <label data-wp-c16t="true" data-wp-component="FlexBlock" for="inspector-toggle-control-5" class="components-flex-item components-flex-block components-toggle-control__label css-13y8vek e19lxcc00">Add 'nofollow' to filter anchors</label>
                    </div>
                </div>
                <p id="inspector-toggle-control-5__help" class="components-base-control__help css-1iwb6nq ej5x27r1">Add rel="nofollow" to the filter anchors.</p>
            </div>
        </div>
    </form>
    <hr class="botiga-dashboard-divider">
    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary btsf-save-settings botiga-dashboard-pro-tooltip" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Botiga Pro', 'botiga' ); ?>" target="_blank" style="max-width: 150px;">
        Save settings
        <?php botiga_get_svg_icon( 'icon-lock-outline', true ); ?>
    </a>
</div>