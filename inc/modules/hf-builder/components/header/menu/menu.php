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
        <?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
    <?php else: ?>	
        <nav id="site-navigation" class="botiga-dropdown main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'walker'         => apply_filters( 'botiga_primary_wp_nav_menu_walker', '' )
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    <?php endif;
echo '</div>';