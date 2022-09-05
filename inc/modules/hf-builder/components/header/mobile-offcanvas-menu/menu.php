<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

echo '<div class="bhfb-builder-item bhfb-component-mobile_offcanvas_menu" data-component-id="mobile_offcanvas_menu">'; 
    $this->customizer_edit_button();
    $location = 'primary';
    if( has_nav_menu( 'mobile' ) ) {
        $location = 'mobile';
    } ?>

    <nav id="site-navigation" class="botiga-dropdown main-navigation">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => $location,
                'menu_id'        => "$location-menu",
                'walker'         => apply_filters( 'botiga_mobile_primary_wp_nav_menu_walker', '' )
            )
        );
        ?>
    </nav><!-- #site-navigation -->
<?php
echo '</div>';

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound