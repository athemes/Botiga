<?php
/**
 * Header/Footer Builder
 * Menu Component
 * 
 * @package Botiga_Pro
 */

echo '<div class="bhfb-builder-item bhfb-component-menu" data-component-id="menu">';
    $this->customizer_edit_button();
    if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    <?php else: ?>	
        <nav id="site-navigation" class="botiga-dropdown main-navigation" <?php botiga_schema( 'nav' ); ?>>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => has_nav_menu( 'primary' ) ? 'primary' : '',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'botiga-dropdown-ul menu',

                    /**
                     * Hook 'botiga_primary_wp_nav_menu_walker'
                     *
                     * @since 1.0.0
                     */
                    'walker'         => apply_filters( 'botiga_primary_wp_nav_menu_walker', '' ),
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    <?php endif;
echo '</div>';
